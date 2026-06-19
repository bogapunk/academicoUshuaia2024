<?php
require_once __DIR__ . '/seguridad_requiere_admin.php';

$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['estado']['msg'])){
    $statusMsg = $sessData['estado']['msg'];
    $statusMsgType = $sessData['estado']['type'];
    unset($_SESSION['sessData']['estado']);
}

include('header2.php');
require_once __DIR__ . '/../Usuarios_Conexion_Sqlserver.php';
require_once __DIR__ . '/seguridad_password.php';
?>
<style type="text/css">
.registro-user-page {
  padding: 12px 0 32px;
}

.registro-user-shell {
  max-width: 720px;
  margin: 0 auto;
  padding: 0 12px;
  box-sizing: border-box;
}

.registro-user-shell .form-container {
  background: #fff;
  border: 1px solid rgba(0, 0, 0, 0.08);
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
  padding: 22px 24px 26px;
}

.registro-user-header {
  text-align: center;
  margin-bottom: 18px;
}

.registro-user-title {
  font-family: 'Roboto', 'Open Sans', sans-serif;
  font-size: 28px;
  font-weight: 700;
  color: #1f2937;
  margin: 0 0 6px;
  padding-bottom: 8px;
  border-bottom: 2px solid rgba(38, 152, 243, 0.35);
  letter-spacing: 0.04em;
  text-transform: uppercase;
}

.registro-user-subtitle {
  font-family: 'Roboto', 'Open Sans', sans-serif;
  font-size: 16px;
  font-weight: 500;
  color: #6b7280;
  margin: 0;
}

.registro-user-shell .form-group {
  margin-bottom: 16px;
}

.registro-user-shell .form-group label {
  display: block;
  font-weight: 600;
  font-size: 13px;
  color: #374151;
  margin-bottom: 6px;
}

.registro-user-shell .form-control,
.registro-user-shell select.form-control {
  width: 100%;
  max-width: 100%;
  min-height: 40px;
  border-radius: 6px;
  border: 1px solid #ced4da;
  box-shadow: none;
  font-size: 14px;
  padding: 8px 12px;
  box-sizing: border-box;
}

.registro-user-shell .form-control:focus {
  border-color: #2698f3;
  box-shadow: 0 0 0 2px rgba(38, 152, 243, 0.18);
  outline: none;
}

.registro-user-shell select.form-control {
  height: auto;
  line-height: 1.35;
  -webkit-appearance: menulist;
  appearance: menulist;
}

.registro-user-sec {
  margin-top: 20px;
  padding-top: 16px;
  border-top: 1px solid #e5e7eb;
}

.registro-user-sec-title {
  font-size: 13px;
  font-weight: 700;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  color: #1e40af;
  margin: 0 0 14px;
}

.registro-user-actions {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  gap: 12px;
  margin-top: 24px;
  padding-top: 18px;
  border-top: 1px solid #e5e7eb;
}

.registro-user-actions .btn {
  min-width: 140px;
  border-radius: 6px;
  font-weight: 600;
  padding: 10px 18px;
}

.registro-user-actions .btn-success {
  text-decoration: none;
}

#password-error {
  margin-top: 4px;
  font-size: 13px;
}

@media (max-width: 767px) {
  .registro-user-shell .form-container {
    padding: 16px 12px;
  }
  .registro-user-title {
    font-size: 22px;
  }
}

p.success { color: #34A853; }
p.error { color: #EA4335; }
</style>

<?php
$user = new User();
$conditions['return_type'] = 'single';
$userData = $user->getRows($conditions);
?>

<div class="registro-user-page">
<div class="registro-user-shell">
  <div class="registro-user-header">
    <h1 class="registro-user-title">Crear Usuario</h1>
    <p class="registro-user-subtitle">Complete los datos de la nueva cuenta</p>
  </div>

  <?php echo !empty($statusMsg) ? '<p class="' . $statusMsgType . '">' . $statusMsg . '</p>' : ''; ?>

  <div class="form-container">
    <form action="MiCuenta.php" method="post" id="formCrearUsuario" data-junta-confirm-submit="1">

      <h2 class="registro-user-sec-title">Datos Personales</h2>

      <div class="form-group">
        <label for="nombres">Nombre</label>
        <input type="text" name="nombres" id="nombres" placeholder="Ingrese el nombre" required class="form-control">
      </div>

      <div class="form-group">
        <label for="apellidos">Apellido</label>
        <input type="text" name="apellidos" id="apellidos" placeholder="Ingrese el apellido" required class="form-control">
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Ingrese el email" required class="form-control">
      </div>

      <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" placeholder="Ingrese el teléfono" required class="form-control">
      </div>

      <div class="registro-user-sec">
        <h2 class="registro-user-sec-title">Rol y Seguridad</h2>

        <div class="form-group">
          <label for="rol">Rol</label>
          <select id="rol" class="form-control" name="rol">
            <option value="admin" <?php if (isset($userData['rol']) && $userData['rol'] == "admin") echo "selected"; ?>>Administrador</option>
            <option value="comun" <?php if (isset($userData['rol']) && $userData['rol'] == "comun") echo "selected"; ?>>Comun</option>
            <option value="otro" <?php if (isset($userData['rol']) && $userData['rol'] == "otro") echo "selected"; ?>>Otro</option>
          </select>
        </div>

        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese la contraseña" required autocomplete="new-password">
          <p class="text-muted" style="font-size:12px;margin-top:6px;margin-bottom:0;">
            La contraseña debe cumplir: <?php echo htmlspecialchars(junta_password_requisitos_texto(), ENT_QUOTES, 'UTF-8'); ?>
          </p>
          <div id="password-policy-checklist"></div>
        </div>

        <div class="form-group">
          <label for="confirm_password">Confirmar Contraseña</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Repita la contraseña" required>
          <div id="password-error" class="text-danger"></div>
        </div>
      </div>

      <div class="registro-user-actions">
        <button type="submit" name="signupSubmit" value="Crear Cuenta" class="btn btn-primary" id="btnSignupSubmit">Crear Cuenta</button>
        <a href="./Usuarios/ListarUsuarios.php" class="btn btn-success">
          <span class="glyphicon glyphicon-arrow-left"></span> Volver
        </a>
      </div>

    </form>
  </div>
</div>
</div>

<script src="inc/junta-password-policy.js"></script>
<script>
var passwordInput = document.getElementById("password");
var repeatedPasswordInput = document.getElementById("confirm_password");
var passwordError = document.getElementById("password-error");
var formCrearUsuario = document.getElementById("formCrearUsuario");
var enviandoFormulario = false;
var validarPoliticaPassword = null;

if (window.JuntaPasswordPolicy) {
    validarPoliticaPassword = JuntaPasswordPolicy.bindPolicy(
        passwordInput,
        document.getElementById("password-policy-checklist"),
        false
    );
}

repeatedPasswordInput.addEventListener("input", function() {
    validarContraseñas();
});

passwordInput.addEventListener("input", function() {
    validarContraseñas();
});

function validarContraseñas() {
    var password = passwordInput.value;
    var repeatedPassword = repeatedPasswordInput.value;
    var errores = [];

    if (validarPoliticaPassword) {
        var resultadoPolitica = validarPoliticaPassword();
        if (!resultadoPolitica.ok) {
            errores = resultadoPolitica.errores;
        }
    }

    if (password !== repeatedPassword) {
        errores.push("Las contraseñas no coinciden.");
    }

    passwordError.innerHTML = errores.length
        ? errores.map(function(e) { return "• " + e; }).join("<br>")
        : "";
}

function validarFormulario() {
    validarContraseñas();
    return passwordError.innerHTML === "";
}

function obtenerEtiquetaRol() {
    var rolSelect = document.getElementById("rol");
    return rolSelect.options[rolSelect.selectedIndex].text;
}

function armarResumenUsuario() {
    var nombres = document.getElementById("nombres").value.trim();
    var apellidos = document.getElementById("apellidos").value.trim();
    var email = document.getElementById("email").value.trim();
    var telefono = document.getElementById("telefono").value.trim();
    var rol = obtenerEtiquetaRol();

    return "Nombre: " + nombres + " " + apellidos +
        "\nEmail: " + email +
        "\nTeléfono: " + telefono +
        "\nRol: " + rol;
}

function enviarFormularioConfirmado() {
    var btnSubmit = document.getElementById("btnSignupSubmit");
    formCrearUsuario.setAttribute("data-junta-submit-confirmed", "1");
    enviandoFormulario = true;

    if (btnSubmit && typeof formCrearUsuario.requestSubmit === "function") {
        formCrearUsuario.requestSubmit(btnSubmit);
        return;
    }

    var hiddenFlag = document.getElementById("signupSubmitHidden");
    if (!hiddenFlag) {
        hiddenFlag = document.createElement("input");
        hiddenFlag.type = "hidden";
        hiddenFlag.name = "signupSubmit";
        hiddenFlag.value = "Crear Cuenta";
        hiddenFlag.id = "signupSubmitHidden";
        formCrearUsuario.appendChild(hiddenFlag);
    }

    formCrearUsuario.submit();
}

formCrearUsuario.addEventListener("submit", function(event) {
    if (enviandoFormulario) {
        return;
    }

    event.preventDefault();

    if (typeof juntaSpinnerHide === "function") {
        juntaSpinnerHide();
    }

    if (!validarFormulario()) {
        return;
    }

    if (typeof Swal === "undefined") {
        enviarFormularioConfirmado();
        return;
    }

    Swal.fire({
        title: '¿Está seguro?',
        text: '¿Está seguro de que desea crear este usuario?\n\n' + armarResumenUsuario(),
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#2698f3',
        cancelButtonColor: '#6c757d',
        reverseButtons: true
    }).then(function(result) {
        if (result.isConfirmed) {
            enviarFormularioConfirmado();
        }
    });
});
</script>

<?php if (!empty($statusMsg) && $statusMsgType === 'error') : ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Swal === 'undefined') {
        return;
    }
    Swal.fire({
        title: 'No se pudo crear el usuario',
        text: <?php echo json_encode($statusMsg, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>,
        icon: 'error',
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#2698f3'
    });
});
</script>
<?php endif; ?>

<?php
if (isset($_SESSION['usuario_creado'])) {
    $uc = $_SESSION['usuario_creado'];
    unset($_SESSION['usuario_creado']);

    $htmlUsuarioCreado = '<div style="text-align:left;font-size:15px;line-height:1.8;">';
    if (!empty($uc['id'])) {
        $htmlUsuarioCreado .= '<p><strong>ID:</strong> ' . htmlspecialchars((string) $uc['id'], ENT_QUOTES, 'UTF-8') . '</p>';
    }
    $htmlUsuarioCreado .= '<p><strong>Nombre:</strong> ' . htmlspecialchars($uc['nombres'] . ' ' . $uc['apellidos'], ENT_QUOTES, 'UTF-8') . '</p>';
    $htmlUsuarioCreado .= '<p><strong>Email:</strong> ' . htmlspecialchars($uc['email'], ENT_QUOTES, 'UTF-8') . '</p>';
    $htmlUsuarioCreado .= '<p><strong>Rol:</strong> ' . htmlspecialchars($uc['rol'], ENT_QUOTES, 'UTF-8') . '</p>';
    $htmlUsuarioCreado .= '</div>';
    ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        title: 'Usuario creado exitosamente',
        html: <?php echo json_encode($htmlUsuarioCreado, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>,
        icon: 'success',
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#2698f3'
    });
});
</script>
    <?php
}
?>

<?php include('footer2.php');?>
