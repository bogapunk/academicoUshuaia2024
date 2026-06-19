<?php
session_start();
require_once __DIR__ . '/seguridad_requiere_login.php';
require_once __DIR__ . '/seguridad_password.php';
require_once __DIR__ . '/../junta_config.php';

$sessData = !empty($_SESSION['sessData']) ? $_SESSION['sessData'] : array();
$statusMsg = '';
$statusMsgType = '';

if (empty($sessData['userLoggedIn']) || empty($sessData['userID'])) {
    header('Location: ../index.php');
    exit;
}

$userID = (int) $sessData['userID'];

try {
    $conexion = new PDO(
        'sqlsrv:server=' . JUNTA_DB_HOST . ';Database=' . JUNTA_DB_NAME . ';TrustServerCertificate=true;ConnectionPooling=1;LoginTimeout=5',
        JUNTA_DB_USER,
        JUNTA_DB_PASS,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (PDOException $e) {
    error_log('cambiar_password conexión: ' . $e->getMessage());
    die('Error en la conexión a la base de datos.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = isset($_POST['current_password']) ? (string) $_POST['current_password'] : '';
    $new_password = isset($_POST['password']) ? (string) $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? (string) $_POST['confirm_password'] : '';

    if ($current_password === '' || $new_password === '' || $confirm_password === '') {
        $statusMsg = 'Todos los campos son obligatorios.';
        $statusMsgType = 'danger';
    } elseif ($new_password !== $confirm_password) {
        $statusMsg = 'Las nuevas contraseñas no coinciden.';
        $statusMsgType = 'danger';
    } else {
        $validacionPassword = junta_password_validar($new_password);
        if ($validacionPassword !== true) {
            $statusMsg = $validacionPassword;
            $statusMsgType = 'danger';
        } elseif ($current_password === $new_password) {
            $statusMsg = 'La nueva contraseña debe ser diferente a la contraseña actual.';
            $statusMsgType = 'danger';
        } else {
            $stmtUser = $conexion->prepare('SELECT id, password FROM usuarios WHERE id = :user_id');
            $stmtUser->execute(array(':user_id' => $userID));
            $userRow = $stmtUser->fetch(PDO::FETCH_ASSOC);

            if ($userRow && junta_password_verificar_actual($userRow['password'], $current_password)) {
                $hashed_password = junta_password_hash($new_password);
                $update_stmt = $conexion->prepare('UPDATE usuarios SET password = :new_password WHERE id = :user_id');
                $update_stmt->bindValue(':new_password', $hashed_password, PDO::PARAM_STR);
                $update_stmt->bindValue(':user_id', $userID, PDO::PARAM_INT);

                if ($update_stmt->execute()) {
                    $statusMsg = 'Contraseña actualizada con éxito.';
                    $statusMsgType = 'success';
                } else {
                    $statusMsg = 'Error al actualizar la contraseña.';
                    $statusMsgType = 'danger';
                }
            } else {
                $statusMsg = 'La contraseña actual es incorrecta.';
                $statusMsgType = 'danger';
            }
        }
    }
}

if (!empty($sessData['estado']['msg'])) {
    $statusMsg = $sessData['estado']['msg'];
    $statusMsgType = $sessData['estado']['type'];
    unset($_SESSION['sessData']['estado']);
}

include('header1.php');
?>
<style>
<?php readfile(__DIR__ . '/css/junta-panel-polish.css'); ?>

.cambiar-password-page {
  padding: 12px 0 32px;
}

.cambiar-password-shell {
  max-width: 520px;
  margin: 0 auto;
}

.cambiar-password-shell .cfg-page-title {
  margin-bottom: 0.5rem;
}

.cambiar-password-subtitle {
  text-align: center;
  font-size: 15px;
  color: var(--cfg-muted);
  margin: 0 0 1.25rem;
}

.cambiar-password-policy {
  font-size: 12px;
  color: #6b7280;
  margin: 6px 0 0;
  line-height: 1.5;
}

.cambiar-password-shell .form-group {
  margin-bottom: 16px;
}

.cambiar-password-shell .form-group label {
  display: block;
  font-weight: 600;
  font-size: 13px;
  color: #374151;
  margin-bottom: 6px;
}

.cambiar-password-shell .form-control {
  width: 100%;
  min-height: 40px;
  border-radius: 8px;
  border: 1px solid #ced4da;
  padding: 8px 12px;
  font-size: 14px;
  box-shadow: inset 0 1px 2px rgba(15, 23, 42, 0.04);
}

.cambiar-password-shell .form-control:focus {
  border-color: var(--cfg-primary-light);
  box-shadow: 0 0 0 3px rgba(43, 143, 217, 0.14);
  outline: none;
}

.cambiar-password-actions {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  gap: 12px;
  margin-top: 24px;
  padding-top: 18px;
  border-top: 1px solid #e5e7eb;
}

.cambiar-password-actions button.btn,
.cambiar-password-actions a.btn {
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  align-self: center;
  flex: 0 0 220px;
  width: 220px;
  min-width: 220px;
  max-width: 220px;
  min-height: 44px;
  height: 44px;
  margin: 0 !important;
  padding: 0 16px !important;
  border-width: 1px !important;
  border-style: solid !important;
  border-radius: 8px;
  font-family: 'Roboto', 'Segoe UI', sans-serif;
  font-weight: 600;
  font-size: 15px;
  line-height: 1 !important;
  box-sizing: border-box;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  position: relative;
  top: 0;
  transform: none;
  -webkit-appearance: none;
  appearance: none;
}

.cambiar-password-shell .alert {
  border-radius: 10px;
  margin-bottom: 1rem;
}

#password-error {
  font-size: 13px;
  margin-top: 6px;
}
</style>

<div class="col-sm-2"></div>

<div class="col-sm-8 cambiar-password-page">
    <div class="cfg-listados-polish">
        <div class="container">
            <div class="cfg-card cambiar-password-shell">
                <h1 class="cfg-page-title">Cambiar contraseña</h1>
                <p class="cambiar-password-subtitle">Ingrese su contraseña actual y defina una nueva contraseña.</p>

                <?php if (!empty($statusMsg)) { ?>
                    <div class="alert alert-<?php echo htmlspecialchars($statusMsgType, ENT_QUOTES, 'UTF-8'); ?>">
                        <?php echo htmlspecialchars($statusMsg, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                <?php } ?>

                <form action="" method="post" id="formCambiarPassword">
                    <input type="hidden" name="userID" value="<?php echo (int) $userID; ?>">

                    <div class="form-group">
                        <label for="current_password">Contraseña actual</label>
                        <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Ingrese su contraseña actual" required autocomplete="current-password">
                    </div>

                    <div class="form-group">
                        <label for="password">Nueva contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese nueva contraseña" required autocomplete="new-password">
                        <p class="cambiar-password-policy">
                            La contraseña debe cumplir: <?php echo htmlspecialchars(junta_password_requisitos_texto(), ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        <div id="password-policy-checklist"></div>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirmar nueva contraseña</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Repita la nueva contraseña" required autocomplete="new-password">
                        <div id="password-error" class="text-danger"></div>
                    </div>

                    <div class="cambiar-password-actions">
                        <button type="submit" name="cambiarPasswordSubmit" class="btn btn-primary">Cambiar contraseña</button>
                        <a href="panel1.php" class="btn btn-success">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-2"></div>

<script src="inc/junta-password-policy.js"></script>
<script>
(function () {
    var passwordInput = document.getElementById('password');
    var repeatedPasswordInput = document.getElementById('confirm_password');
    var currentPasswordInput = document.getElementById('current_password');
    var passwordError = document.getElementById('password-error');
    var form = document.getElementById('formCambiarPassword');
    var validarPolitica = null;

    if (window.JuntaPasswordPolicy) {
        validarPolitica = JuntaPasswordPolicy.bindPolicy(
            passwordInput,
            document.getElementById('password-policy-checklist'),
            false
        );
    }

    function validarFormulario() {
        var errores = [];

        if (validarPolitica) {
            var resultadoPolitica = validarPolitica();
            if (!resultadoPolitica.ok) {
                errores = errores.concat(resultadoPolitica.errores);
            }
        }

        if (passwordInput.value !== repeatedPasswordInput.value) {
            errores.push('Las contraseñas no coinciden.');
        }

        if (currentPasswordInput.value && passwordInput.value &&
            currentPasswordInput.value === passwordInput.value) {
            errores.push('La nueva contraseña debe ser diferente a la contraseña actual.');
        }

        passwordError.innerHTML = errores.length
            ? errores.map(function (e) { return '• ' + e; }).join('<br>')
            : '';

        return errores.length === 0;
    }

    if (repeatedPasswordInput) {
        repeatedPasswordInput.addEventListener('input', validarFormulario);
    }
    if (passwordInput) {
        passwordInput.addEventListener('input', validarFormulario);
    }
    if (currentPasswordInput) {
        currentPasswordInput.addEventListener('input', validarFormulario);
    }

    if (form) {
        form.addEventListener('submit', function (event) {
            if (!validarFormulario()) {
                event.preventDefault();
            }
        });
    }
})();
</script>

<?php include('footer1.php'); ?>
