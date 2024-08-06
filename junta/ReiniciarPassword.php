<?php
session_start();
$sessData = !empty($_SESSION['sessData']) ? $_SESSION['sessData'] : '';

if (!empty($sessData['estado']['msg'])) {
    $statusMsg = $sessData['estado']['msg'];
    $statusMsgType = $sessData['estado']['type'];
    unset($_SESSION['sessData']['estado']);
}

include('header.php');

if (isset($_POST['resetSubmit'])) {
    // Validar y sanitizar los campos recibidos del formulario
    $password = !empty($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = !empty($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    $fp_code = !empty($_POST['fp_code']) ? $_POST['fp_code'] : '';

    // Verificar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        $statusMsg = 'Las contraseñas no coinciden.';
        $statusMsgType = 'error';
    } else {
        // Verificar si el código de restablecimiento es válido (aquí debes implementar tu lógica específica)
        // Por ejemplo, podrías usar una consulta a la base de datos para verificar el código y obtener el usuario asociado

        // Si el código de restablecimiento es válido, actualiza la contraseña del usuario
        // Reemplaza la lógica de verificación y actualización según tu implementación específica

        // Ejemplo ficticio:
        $usuarioModel = new UsuariosModel();
        $userData = $usuarioModel->obtenerUsuarioPorCodigoReset($fp_code);

        if ($userData && isset($userData['id'])) {
            $userId = (int) $userData['id'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hashear la nueva contraseña

            // Actualizar la contraseña en la base de datos
            $actualizacion = $usuarioModel->actualizarPassword($userId, $hashed_password);

            if ($actualizacion) {
                $statusMsg = 'Se ha restablecido la contraseña correctamente.';
                $statusMsgType = 'success';

                // Redirigir a una página de éxito o a la página de inicio de sesión
                header('Location: login.php');
                exit;
            } else {
                $statusMsg = 'Error al actualizar la contraseña, por favor inténtalo de nuevo más tarde.';
                $statusMsgType = 'error';
            }
        } else {
            $statusMsg = 'Código de restablecimiento no válido.';
            $statusMsgType = 'error';
        }
    }

    $_SESSION['sessData']['estado']['msg'] = $statusMsg;
    $_SESSION['sessData']['estado']['type'] = $statusMsgType;
}

?>

<div class="col-sm-3 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;"></div>

<div class="col-sm-6 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
    <h2>USUARIO REGISTRO Y LOGIN</h2>
    <h4>Reiniciar contraseña de su cuenta</h4>
    <?php echo !empty($statusMsg) ? '<p class="'.$statusMsgType.'">'.$statusMsg.'</p>' : ''; ?>
    <div class="loginForm">
        <form action="ReseteoMail.php" method="post">
            <input type="password" name="password" placeholder="PASSWORD" required="">
            <input type="password" name="confirm_password" placeholder="CONFIRMAR PASSWORD" required="">
            <input type="hidden" name="fp_code" value="<?php echo isset($_REQUEST['fp_code']) ? $_REQUEST['fp_code'] : ''; ?>"/>
            <div class="send-button">
                <input type="submit" name="resetSubmit" value="REINICIAR PASSWORD">
            </div>
        </form>
    </div>
</div>

<div class="col-sm-3 text wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;"></div>

<?php include('footer.php'); ?>