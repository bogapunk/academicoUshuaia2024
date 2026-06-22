<?php
/**
 * Pantalla de inicio de sesión — diseño moderno (cabecera mínima + labels + Roboto).
 *
 * REVERTIR al diseño anterior:
 *   Opción A: reemplazar este archivo por index.login-clasico.php (renombrar o copiar).
 *   Opción B: cambiar header_login.php → header.php y footer_login.php → footer.php,
 *             y quitar el <link> a views/css/login-polish.css del encabezado.
 */
ob_start();
include('./Usuarios_Conexion_Sqlserver.php');
ob_end_flush();
session_start();
$sessData = !empty($_SESSION['sessData']) ? $_SESSION['sessData'] : '';
if (!empty($sessData['estado']['msg'])) {
    $statusMsg = $sessData['estado']['msg'];
    $statusMsgType = $sessData['estado']['type'];
    unset($_SESSION['sessData']['estado']);
}

ob_start();
include('header_login.php');
?>

<div class="container-fluid junta-login-shell junta-home">
  <div class="junta-login-hero">
    <h1 class="subrayado-hero junta-login-titulo"><b>Sistema de Juntas</b></h1>
    <p class="junta-login-leyenda">Plataforma institucional de gestión y consulta</p>
  </div>
  <div class="junta-login-form-wrap">
    <?php
    if (!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])) {

        $user = new User();
        $conditions['where'] = array(
            'id' => $sessData['userID'],
        );
        $conditions['return_type'] = 'single';
        $userData = $user->getRows($conditions);
        if ($userData['rol'] == 'admin' || strtolower(trim((string) $userData['rol'])) === 'administrador') {
            header("Location: views/panel2.php");
        } else if ($userData['rol'] == 'otro') {
            header("Location: views/panel1.php");
        } elseif ($userData['rol'] == 'comun') {
            header("Location: views/panel1.php");
        }
    ?>
    <div class="junta-bienvenida-caja">
        <h2 class="junta-secion-titulo">Bienvenido/a, <?php echo junta_e($userData['nombres']); ?></h2>
        <p class="junta-datos-lead">Datos de tu cuenta (revisá que sean correctos antes de continuar):</p>
        <div class="junta-login-datos">
        <p><b>Nombre y apellido: </b><?php echo junta_e($userData['nombres'] . ' ' . $userData['apellidos']); ?></p>
        <p><b>Correo electrónico: </b><?php echo htmlspecialchars($userData['email'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><b>Teléfono: </b><?php echo htmlspecialchars($userData['telefono'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    </div>

<?php } else { ?>
    <div class="form-container">
    <h2 class="junta-secion-titulo" id="iniciar-sesion-heading">Iniciar sesión</h2>
    <?php if (!empty($statusMsg)) :
        $alertClass = ($statusMsgType === 'success') ? 'success' : 'error';
        $alertIcon = ($statusMsgType === 'success') ? 'fa-circle-check' : 'fa-circle-exclamation';
    ?>
    <div class="junta-login-alert junta-login-alert--<?php echo $alertClass; ?>" role="alert">
      <i class="fas <?php echo $alertIcon; ?>" aria-hidden="true"></i>
      <span><?php echo htmlspecialchars($statusMsg, ENT_QUOTES, 'UTF-8'); ?></span>
    </div>
    <?php endif; ?>
    <div class="login-form">
    <form id="loginForm" action="MiCuenta.php" method="post" aria-labelledby="iniciar-sesion-heading">
            <div class="junta-form-fields">
            <div class="junta-field-group">
              <label for="login-email" class="junta-field-label">Correo electrónico</label>
              <div class="form-group junta-input-wrap">
                <span class="junta-input-icon" aria-hidden="true"><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" id="login-email" class="form-control" placeholder="Ingrese su correo electrónico" required autocomplete="username" inputmode="email">
              </div>
            </div>

            <div class="junta-field-group">
              <label for="login-password" class="junta-field-label">Contraseña</label>
              <div class="form-group junta-input-wrap">
                <span class="junta-input-icon" aria-hidden="true"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" id="login-password" class="form-control" placeholder="Ingrese su contraseña" required autocomplete="current-password">
              </div>
            </div>
            </div>
                <div class="form-group junta-form-actions" style="margin-top:1.15rem; margin-bottom:0;">
                <button type="submit" name="loginSubmit" class="junta-login-btn btn btn-primary" title="Iniciar sesión">Iniciar sesión</button>
                </div>
            </form>
            <div id="preload" class="" aria-hidden="true">
                        <div class="spinner"></div>
                        <div class="spinner-text">Cargando&hellip;</div>
            </div>
        </div>
    </div>
<?php } ?>
  </div>
</div>
<?php include('footer_login.php');
ob_end_flush();
?>

<script>
(function () {
  var f = document.getElementById('loginForm');
  if (!f) return;
  f.addEventListener('submit', function () {
    if (f.checkValidity()) {
      var p = document.getElementById('preload');
      if (p) p.className = 'junta-preload-visible';
    }
  });
})();
</script>
