<?php
//start session
session_start();
//load and initialize user class
include 'Usuarios_Conexion_Sqlserver.php';
require_once __DIR__ . '/views/seguridad_password.php';
$user = new User();

function junta_login_actualizar_hash_si_corresponde($user, $userId, $hashAlmacenado, $passwordPlano) {
    $hashAlmacenado = (string) $hashAlmacenado;
    $debeActualizar = false;

    if (strlen($hashAlmacenado) === 32 && ctype_xdigit($hashAlmacenado)) {
        $debeActualizar = true;
    } elseif ($hashAlmacenado !== '') {
        $info = password_get_info($hashAlmacenado);
        if (!empty($info['algo']) && password_needs_rehash($hashAlmacenado, PASSWORD_DEFAULT)) {
            $debeActualizar = true;
        }
    }

    if ($debeActualizar) {
        $user->update(
            array('password' => junta_password_hash($passwordPlano)),
            array('id' => (int) $userId)
        );
    }
}

if(isset($_POST['signupSubmit'])){
    require_once __DIR__ . '/views/seguridad_requiere_admin.php';

    //check whether user details are empty
    if(!empty($_POST['nombres']) && !empty($_POST['apellidos']) && !empty($_POST['email']) && !empty($_POST['telefono']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){
        //password and confirm password comparison
        if($_POST['password'] !== $_POST['confirm_password']){
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Confirmar que la contraseña debe coincidir con la contraseña.'; 
        } else {
            //check if email exists in the database
            $prevCon['where'] = array('email'=>$_POST['email']);
            $prevCon['return_type'] = 'count';
            $prevUser = $user->getRows($prevCon);
            if($prevUser > 0){
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'El email ya existe, por favor usa otro email.';
            } else {
                //insert user data into the database
                $userData = array(
                    'nombres' => $_POST['nombres'],
                    'apellidos' => $_POST['apellidos'],
                    'email' => $_POST['email'],
                    'password' => md5($_POST['password']),
                    'telefono' => $_POST['telefono']
                );
                $insert = $user->insert($userData);
                //set status based on data insertion
                if($insert){
                    $sessData['estado']['type'] = 'success';
                    $sessData['estado']['msg'] = 'Te registraste exitosamente, inicia sesión con tus credenciales.';
                } else {
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
                }
            }
        }
    } else {
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'Todos los campos son obligatorios, por favor complete todos los campos.'; 
    }
    //store signup status into the session
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['estado']['type'] == 'success') ? 'index.php' : 'Registro.php';
    //redirect to the home/registration page
    header("Location:".$redirectURL);

} elseif(isset($_POST['loginSubmit'])){
    //check whether login details are empty
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $conditions['where'] = array(
            'email' => $_POST['email'],
            'estado' => '1'
        );
        $conditions['return_type'] = 'single';
        $userData = $user->getRows($conditions);

        if($userData && junta_password_verificar_actual($userData['password'], $_POST['password'])){
            junta_login_actualizar_hash_si_corresponde($user, $userData['id'], $userData['password'], $_POST['password']);
            $sessData['userLoggedIn'] = TRUE;
            $sessData['userID'] = $userData['id'];
            if (!empty($userData['rol'])) {
                $sessData['userRol'] = $userData['rol'];
            }
            $sessData['lastActivity'] = time();
            $sessData['estado']['type'] = 'success';
        } else {
            $userData = false;
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Email o contraseña incorrectos, por favor intente de nuevo.'; 
        }
    } else {
        $userData = false;
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'Ingrese email y contraseña.'; 
    }
    //store login status into the session
    $_SESSION['sessData'] = $sessData;
    //redirect to the appropriate page based on role
    $rolLogin = !empty($userData['rol']) ? strtolower(trim($userData['rol'])) : '';
    if ($userData && ($rolLogin === 'admin' || $rolLogin === 'administrador')){
        header("Location: views/panel2.php");
    } else if ($userData && ($userData['rol'] == 'otro' || $userData['rol'] == 'comun')){
        header("Location: views/panel1.php");
    } else {
        header("Location: index.php");
    }

} elseif(isset($_POST['forgotSubmit'])){
    //check whether email is empty
    if(!empty($_POST['email'])){
        //check whether user exists in the database
        $prevCon['where'] = array('email'=>$_POST['email']);
        $prevCon['return_type'] = 'count';
        $prevUser = $user->getRows($prevCon);
        if($prevUser > 0){
            //generate unique string
            $uniqidStr = md5(uniqid(mt_rand()));
            
            //update data with forgot pass code
            $conditions = array(
                'email' => $_POST['email']
            );
            $data = array(
                'olvido_pass_iden' => $uniqidStr
            );
            $update = $user->update($data, $conditions);
            
            if($update){
                $resetPassLink = 'http://localhost:8080/juntas/ReiniciarPassword.php?fp_code='.$uniqidStr;
                
                //get user details
                $con['where'] = array('email'=>$_POST['email']);
                $con['return_type'] = 'single';
                $userDetails = $user->getRows($con);
                
                //send reset password email
                $to = $userDetails['email'];
                $subject = "Solicitud de actualización de contraseña";
                $mailContent = 'Estimado '.$userDetails['nombres'].', 
                <br/>Recientemente se envió una solicitud para restablecer una contraseña para su cuenta. Si esto fue un error, simplemente ignore este correo electrónico y no pasará nada.
                <br/>Para restablecer su contraseña, visite el siguiente enlace: <a href="'.$resetPassLink.'">'.$resetPassLink.'</a>
                <br/><br/>Saludos,
                <br/>Sistema Junta ';
                //set content-type header for sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                //additional headers
                $headers .= 'From: SArin<bogarin1983@gmail.com>' . "\r\n";
                //send email
                mail($to,$subject,$mailContent,$headers);
                
                $sessData['estado']['type'] = 'success';
                $sessData['estado']['msg'] = 'Por favor revise su correo electrónico, hemos enviado un enlace de restablecimiento de contraseña a su correo electrónico registrado.';
            } else {
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
            }
        } else {
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'El correo electrónico dado no está asociado con ninguna cuenta.'; 
        }
        
    } else {
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'Ingrese el correo electrónico para crear una nueva contraseña para su cuenta.'; 
    }
    //store reset password status into the session
    $_SESSION['sessData'] = $sessData;
    //redirect to the forgot password page
    header("Location:EnviarPassword.php");

} elseif(isset($_POST['resetSubmit'])){
    $fp_code = '';
    if(!empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['fp_code'])){
        $fp_code = $_POST['fp_code'];
        //password and confirm password comparison
        if($_POST['password'] !== $_POST['confirm_password']){
            $sessData['estado']['type'] = 'error';
            $sessData['estado']['msg'] = 'Confirmar que la contraseña debe coincidir con la contraseña.'; 
        } else {
            //check whether identity code exists in the database
            $prevCon['where'] = array('olvido_pass_iden' => $fp_code);
            $prevCon['return_type'] = 'single';
            $prevUser = $user->getRows($prevCon);
            if(!empty($prevUser)){
                //update data with new password
                $conditions = array(
                    'olvido_pass_iden' => $fp_code
                );
                $data = array(
                    'password' => junta_password_hash($_POST['password']),
                    'olvido_pass_iden' => ''
                );
                $update = $user->update($data, $conditions);
                if($update){
                    $sessData['estado']['type'] = 'success';
                    $sessData['estado']['msg'] = 'La contraseña de su cuenta se ha restablecido con éxito. Por favor inicie sesión con su nueva contraseña.';
                } else {
                    $sessData['estado']['type'] = 'error';
                    $sessData['estado']['msg'] = 'Ha ocurrido algún problema, por favor intente de nuevo.';
                }
            } else {
                $sessData['estado']['type'] = 'error';
                $sessData['estado']['msg'] = 'No está autorizado a restablecer una nueva contraseña de esta cuenta.';
            }
        }
    } else {
        $sessData['estado']['type'] = 'error';
        $sessData['estado']['msg'] = 'Todos los campos son obligatorios, por favor complete todos los campos.'; 
    }
    //store reset password status into the session
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['estado']['type'] == 'success') ? 'index.php' : 'ReiniciarPassword.php?fp_code='.$fp_code;
    //redirect to the login/reset password page
    header("Location:".$redirectURL);

} elseif(!empty($_REQUEST['logoutInactividad'])){
    unset($_SESSION['sessData']);
    $_SESSION['sessData'] = array(
        'estado' => array(
            'type' => 'error',
            'msg' => 'Su sesión finalizó por inactividad. Por favor inicie sesión nuevamente.',
        ),
    );
    header("Location:index.php");

} elseif(!empty($_REQUEST['logoutSubmit'])){
    //remove session data
    unset($_SESSION['sessData']);
    session_destroy();
    //store logout status into the session
    $sessData['estado']['type'] = 'success';
    $sessData['estado']['msg'] = 'Has salido exitosamente de tu cuenta.';
    $_SESSION['sessData'] = $sessData;
    //redirect to the home page
    header("Location:index.php");

} else {
    //redirect to the home page
    header("Location:index.php");
}
?>
