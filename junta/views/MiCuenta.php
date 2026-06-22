<?php
// Start session
session_start();

// Clase User centralizada (misma BD que login y listado)
require_once __DIR__ . '/../Usuarios_Conexion_Sqlserver.php';
require_once __DIR__ . '/seguridad_password.php';
$user = new User();

function setSessionState($type, $msg) {
    $_SESSION['sessData']['estado'] = array(
        'type' => $type,
        'msg' => $msg
    );
}

if (isset($_POST['signupSubmit'])) {
    require_once __DIR__ . '/seguridad_requiere_admin.php';

    // Check whether user details are empty
    if (!empty($_POST['nombres']) && !empty($_POST['apellidos']) && !empty($_POST['email']) && !empty($_POST['telefono']) && !empty($_POST['rol']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
        // Password and confirm password comparison
        if ($_POST['password'] !== $_POST['confirm_password']) {
            setSessionState('error', 'Confirmar que la contraseña debe coincidir con la contraseña.');
        } else {
            $validacionPassword = junta_password_validar($_POST['password']);
            if ($validacionPassword !== true) {
                setSessionState('error', $validacionPassword);
            } else {
            // Check if user exists in the database
            $prevCon['where'] = array('email' => $_POST['email']);
            $prevCon['return_type'] = 'count';
            $prevUser = $user->getRows($prevCon);

            if ($prevUser > 0) {
                setSessionState('error', 'Email existe, Por favor otro email.');
            } else {
                // Insert user data in the database
                $userData = array(
                    'nombres' => $_POST['nombres'],
                    'apellidos' => $_POST['apellidos'],
                    'email' => $_POST['email'],
                    'password' => junta_password_hash($_POST['password']),
                    'telefono' => $_POST['telefono'],
                    'rol' => $_POST['rol'],
                    'estado' => '1'
                );
                $newUserId = $user->insert($userData);

                if ($newUserId) {
                    $_SESSION['usuario_creado'] = array(
                        'id'        => $newUserId,
                        'nombres'   => $_POST['nombres'],
                        'apellidos' => $_POST['apellidos'],
                        'email'     => $_POST['email'],
                        'rol'       => $_POST['rol'],
                    );
                } else {
                    setSessionState('error', 'No se pudo crear el usuario. Por favor, intente de nuevo.');
                }
            }
            }
        }
    } else {
        setSessionState('error', 'Todos los campos son obligatorios, por favor complete todos los campos.');
    }

    // Redirect to the registration page
    $redirectURL = 'Registro.php';
    header("Location: ".$redirectURL);

} elseif (isset($_POST['loginSubmit'])) {
    // Check whether login details are empty
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        // Get user data from user class
        $conditions['where'] = array(
            'email' => $_POST['email'],
            'estado' => '1'
        );
        $conditions['return_type'] = 'single';
        $userData = $user->getRows($conditions);

        // Validate credentials (bcrypt moderno o MD5 legacy)
        if ($userData && junta_password_verificar_actual($userData['password'], $_POST['password'])) {
            if (strlen((string) $userData['password']) === 32 && ctype_xdigit((string) $userData['password'])) {
                $user->update(
                    array('password' => junta_password_hash($_POST['password'])),
                    array('id' => $userData['id'])
                );
            }
            $_SESSION['sessData']['userLoggedIn'] = TRUE;
            $_SESSION['sessData']['userID'] = $userData['id'];
            if (!empty($userData['rol'])) {
                $_SESSION['sessData']['userRol'] = $userData['rol'];
            }
            setSessionState('success', 'Bienvenido '.junta_utf8_reparar($userData['nombres']).'!');
        } else {
            setSessionState('error', 'Email o contraseña incorrectos, por favor intente de nuevo.');
        }
    } else {
        setSessionState('error', 'Ingrese email y password.');
    }

    // Redirect to the home page
    header("Location: Usuarios/ListarUsuarios.php");

} elseif (isset($_POST['forgotSubmit'])) {
    // Check whether email is empty
    if (!empty($_POST['email'])) {
        // Check whether user exists in the database
        $prevCon['where'] = array('email' => $_POST['email']);
        $prevCon['return_type'] = 'count';
        $prevUser = $user->getRows($prevCon);

        if ($prevUser > 0) {
            // Generate unique string
            $uniqidStr = md5(uniqid(mt_rand()));

            // Update data with forgot pass code
            $conditions = array('email' => $_POST['email']);
            $data = array('olvido_pass_iden' => $uniqidStr);
            $update = $user->update($data, $conditions);

            if ($update) {
                $resetPassLink = 'http://localhost:8080/juntas/ReiniciarPassword.php?fp_code='.$uniqidStr;

                // Get user details
                $con['where'] = array('email' => $_POST['email']);
                $con['return_type'] = 'single';
                $userDetails = $user->getRows($con);

                // Send reset password email
                $to = $userDetails['email'];
                $subject = "Solicitud de actualización de contraseña";
                $mailContent = 'Estimado '.$userDetails['nombres'].',<br/>Recientemente se envió una solicitud para restablecer una contraseña para su cuenta. Si esto fue un error, simplemente ignore este correo electrónico y no pasará nada.<br/>Para restablecer su contraseña, visite el siguiente enlace: <a href="'.$resetPassLink.'">'.$resetPassLink.'</a><br/><br/>Saludos,<br/>Sistema Junta';
                
                // Set content-type header for sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: Bogarin<bogarin1983@gmail.com>' . "\r\n";

                // Send email
                mail($to, $subject, $mailContent, $headers);

                setSessionState('success', 'Por favor revise su correo electrónico, hemos enviado un enlace de restablecimiento de contraseña a su correo electrónico registrado.');
            } else {
                setSessionState('error', 'Ha ocurrido algún problema, por favor intente de nuevo.');
            }
        } else {
            setSessionState('error', 'El correo electrónico dado no está asociado con ninguna cuenta.');
        }
    } else {
        setSessionState('error', 'Ingrese el correo electrónico para crear una nueva contraseña para su cuenta.');
    }

    // Redirect to the forgot password page
    header("Location: EnviarPassword.php");

} elseif (isset($_POST['resetSubmit'])) {
    if (!empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['fp_code'])) {
        $fp_code = $_POST['fp_code'];

        // Password and confirm password comparison
        if ($_POST['password'] !== $_POST['confirm_password']) {
            setSessionState('error', 'Confirmar que la contraseña debe coincidir con la contraseña.');
        } else {
            $validacionPassword = junta_password_validar($_POST['password']);
            if ($validacionPassword !== true) {
                setSessionState('error', $validacionPassword);
            } else {
            // Check whether identity code exists in the database
            $prevCon['where'] = array('olvido_pass_iden' => $fp_code);
            $prevCon['return_type'] = 'single';
            $prevUser = $user->getRows($prevCon);

            if (!empty($prevUser)) {
                // Update data with new password
                $conditions = array('olvido_pass_iden' => $fp_code);
                $data = array('password' => password_hash($_POST['password'], PASSWORD_DEFAULT));
                $update = $user->update($data, $conditions);

                if ($update) {
                    setSessionState('success', 'La contraseña de su cuenta se ha restablecido con éxito. Por favor inicie sesión con su nueva contraseña.');
                } else {
                    setSessionState('error', 'Ha ocurrido algún problema, por favor intente de nuevo.');
                }
            } else {
                setSessionState('error', 'No está autorizado a restablecer una nueva contraseña de esta cuenta.');
            }
            }
        }
    } else {
        setSessionState('error', 'Todos los campos son obligatorios, por favor complete todos los campos.');
    }

    // Redirect to the login/reset password page
    $redirectURL = ($_SESSION['sessData']['estado']['type'] == 'success') ? 'panel.php' : 'ReiniciarPassword.php?fp_code='.$fp_code;
    header("Location: ".$redirectURL);

} elseif (!empty($_REQUEST['logoutSubmit'])) {
    // Remove session data
    unset($_SESSION['sessData']);
    session_destroy();

    // Store logout estado into the session
    setSessionState('success', 'Has salido exitosamente de tu cuenta.');

    // Redirect to the home page
    header("Location: Usuarios/ListarUsuarios.php");
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email']) && !empty($_POST['password'])) {
    setSessionState('error', 'No se pudo procesar la solicitud de alta. Por favor, intente nuevamente.');
    header('Location: Registro.php');
} else {
    // Redirect to the home page
    header("Location: Usuarios/ListarUsuarios.php");
}
?>
