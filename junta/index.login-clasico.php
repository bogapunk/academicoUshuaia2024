<?php
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
include('header.php');
?>

<style>
    /* —— Home (login) — elevación, micro-inputs, botón: para revertir, reemplazá solo este <style> por el anterior —— */
    * { box-sizing: border-box; }
    .junta-home.junta-login-shell {
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        padding: 1.5rem 12px 2.5rem;
        min-height: 46vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        background: linear-gradient(180deg, #fbfbfb 0%, #ffffff 55%, #f7f7f7 100%);
    }
    /* Título y subtítulo fuera de la tarjeta, centrados y destacados */
    .junta-login-hero {
        width: 100%;
        max-width: 720px;
        margin: 0 auto 1.5rem;
        padding: 0.5rem 0.75rem 0;
        text-align: center;
    }
    .junta-login-titulo {
        text-align: center;
        margin: 0 0 0.45rem 0;
        font-size: clamp(2rem, 4.2vw, 2.75rem);
        line-height: 1.15;
        font-weight: 700;
        color: #111;
    }
    @media (min-width: 480px) {
        .junta-login-titulo { font-size: clamp(2.25rem, 4.5vw, 3rem); }
    }
    .junta-login-leyenda {
        text-align: center;
        font-size: clamp(1.1rem, 2.1vw, 1.4rem);
        color: #3d4a56;
        margin: 0;
        line-height: 1.4;
        font-weight: 500;
    }
    .junta-login-form-wrap {
        width: 100%;
        max-width: 480px;
        margin: 0 auto;
        padding: 0 6px;
    }
    .junta-home .form-container {
        width: 100%;
        max-width: 450px;
        margin: 0 auto;
        padding: 1.35rem 1.35rem 1.55rem;
        background: #f9f9f9;
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.06);
        box-shadow: 0 4px 20px rgba(0,0,0,0.08), 0 1px 0 rgba(255,255,255,0.8) inset;
        transition: box-shadow 0.28s ease, transform 0.28s ease;
        will-change: box-shadow, transform;
    }
    @media (hover: hover) {
        .junta-home .form-container:hover {
            box-shadow: 0 10px 32px rgba(0,0,0,0.1), 0 2px 0 rgba(255,255,255,0.85) inset;
            transform: translateY(-2px);
        }
    }
    @media (min-width: 768px) {
        .junta-home .form-container { padding: 1.5rem 1.55rem 1.75rem; max-width: 470px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .junta-home .form-container { transition: none; }
        .junta-home .form-container:hover { transform: none; }
        .junta-home .junta-input-wrap,
        .junta-home .junta-login-btn,
        .junta-home .junta-input-wrap .form-control { transition: none !important; }
    }
    .junta-secion-titulo {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0 0 1rem 0;
        text-align: center;
        color: #222;
    }
    .junta-datos-lead {
        font-size: 1.05rem;
        color: #555;
        text-align: center;
        margin: 0 0 0.75rem 0;
        line-height: 1.4;
    }
    .junta-bienvenida-caja {
        max-width: 100%;
        margin: 0 auto;
        padding: 1.25rem 1.1rem;
        background: #f4f4f4;
        border: 1px solid rgba(0,0,0,0.08);
        border-radius: 10px;
        text-align: left;
    }
    .junta-login-datos p { text-align: left; margin-bottom: 0.5rem; font-size: 1.05rem; }
    @media (min-width: 480px) {
        .junta-login-hero { margin-bottom: 1.75rem; }
    }
    .form-group { width: 100%; margin-bottom: 1rem; }
    .junta-home .junta-input-wrap {
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .junta-home .junta-input-wrap:focus-within {
        border-color: rgba(0, 123, 255, 0.5) !important;
        box-shadow: 0 0 0 1px rgba(0, 123, 255, 0.15);
    }
    .junta-home .junta-input-icon {
        transition: color 0.2s ease, background 0.2s ease;
    }
    .junta-home .junta-input-wrap:focus-within .junta-input-icon {
        color: #007bff;
    }
    .junta-home .junta-input-wrap .form-control {
        font-size: 17px;
        transition: box-shadow 0.2s ease;
    }
    .junta-home .junta-input-wrap .form-control:focus {
        box-shadow: inset 0 0 0 1px rgba(0, 123, 255, 0.35) !important;
    }
    .junta-login-btn {
        width: 100%;
        padding: 12px 18px;
        font-size: 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        box-shadow: 0 2px 0 rgba(0, 0, 0, 0.08);
        transition: background-color 0.22s ease, color 0.22s ease, box-shadow 0.22s ease, transform 0.2s ease;
    }
    @media (hover: hover) {
        .junta-login-btn:hover, .junta-login-btn:focus {
            background-color: #e55916;
            color: #fff;
            box-shadow: 0 3px 10px rgba(229, 89, 22, 0.45);
            transform: translateY(-1px);
        }
    }
    @media (hover: none) {
        .junta-login-btn:hover, .junta-login-btn:focus { background-color: #e55916; color: #fff; }
    }
    h2, h3 { font-size: 1.4rem; margin: 0 0 0.75rem; text-align: center; }
    .login-form p { font-size: 1rem; text-align: center; margin-bottom: 10px; }
    @media (max-width: 480px) {
        .junta-secion-titulo { font-size: 1.3rem; }
    }
    .subrayado-hero {
        border-bottom: 3px solid #1a1a1a;
        display: inline-block;
        padding-bottom: 0.12rem;
    }
    #preload {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(255, 255, 255, 0.92);
        z-index: 99999;
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    #preload.junta-preload-visible { display: flex; }
    .spinner {
        width: 60px; height: 60px;
        border: 5px solid #e2e8f0;
        border-top-color: #007bff;
        border-radius: 50%;
        animation: juntaSpin 0.85s linear infinite;
    }
    .spinner-text {
        margin-top: 18px;
        font-size: 1.05rem;
        font-weight: 600;
        color: #374151;
        font-family: 'Roboto', 'Lucida Sans', Arial, sans-serif;
        letter-spacing: 0.01em;
    }
    @keyframes juntaSpin { to { transform: rotate(360deg); } }
    /* Refuerzo: icono + input; iconos siempre visibles (z-index, ancho fijo, sin colapsar) */
    .junta-home .login-form .junta-form-fields { text-align: left !important; }
    .junta-home .login-form .form-group.junta-input-wrap {
        position: relative !important;
        overflow: visible !important;
    }
    .junta-home .login-form .junta-input-icon {
        position: absolute !important;
        left: 0 !important;
        top: 0 !important;
        bottom: 0 !important;
        width: 58px !important;
        min-width: 58px !important;
        z-index: 5 !important;
        flex-shrink: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .junta-home .login-form .junta-input-icon i {
        font-size: 1.28rem !important;
        line-height: 1 !important;
    }
    .junta-home .login-form .junta-input-wrap input.form-control { width: 100% !important; padding-left: 74px !important; }
    .junta-home .login-form .junta-input-wrap .form-control { z-index: 1; }
</style>

<div class="container-fluid junta-login-shell junta-home">
  <div class="junta-login-hero">
    <h1 class="subrayado-hero junta-login-titulo"><b>Sistema de Juntas</b></h1>
    <p class="junta-login-leyenda">Plataforma institucional de gestión y consulta</p>
  </div>
  <div class="junta-login-form-wrap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        <h2 class="junta-secion-titulo">Bienvenido/a, <?php echo htmlspecialchars($userData['nombres'], ENT_QUOTES, 'UTF-8'); ?></h2>
        <p class="junta-datos-lead">Datos de tu cuenta (revisá que sean correctos antes de continuar):</p>
        <div class="junta-login-datos">
        <p><b>Nombre y apellido: </b><?php echo htmlspecialchars($userData['nombres'] . ' ' . $userData['apellidos'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><b>Correo electrónico: </b><?php echo htmlspecialchars($userData['email'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><b>Teléfono: </b><?php echo htmlspecialchars($userData['telefono'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    </div>

<?php } else { ?>
    <div class="form-container">
    <h2 class="junta-secion-titulo" id="iniciar-sesion-heading">Iniciar sesión</h2>
    <?php echo !empty($statusMsg) ? '<p class="' . $statusMsgType . '" style="text-align:center;margin:0 0 0.75rem;">' . $statusMsg . '</p>' : ''; ?>
    <div class="login-form">
    <form id="loginForm" action="MiCuenta.php" method="post" aria-labelledby="iniciar-sesion-heading">
            <div class="junta-form-fields">
            <div class="form-group junta-input-wrap" style="margin-bottom: 0.9rem;">
            <span class="junta-input-icon" aria-hidden="true"><i class="fas fa-user"></i></span>
            <input type="email" name="email" class="form-control" placeholder="Email" required autocomplete="username" inputmode="email" aria-label="Email">
        </div>

            <div class="form-group junta-input-wrap" style="margin-bottom: 0;">
                <span class="junta-input-icon" aria-hidden="true"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required autocomplete="current-password" aria-label="Contraseña">
            </div>
            </div>
                <div class="form-group junta-form-actions" style="margin-top:1rem; margin-bottom:0;">
                <button type="submit" name="loginSubmit" class="junta-login-btn" title="Iniciar sesión">Iniciar sesión</button>
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
<?php include('footer.php');
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

