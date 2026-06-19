<?php
ob_start();
session_start();
require_once __DIR__ . '/views/seguridad_password.php';

$sessData = !empty($_SESSION['sessData']) ? $_SESSION['sessData'] : '';
$statusMsg = '';
$statusMsgType = '';

if (!empty($sessData['estado']['msg'])) {
    $statusMsg = $sessData['estado']['msg'];
    $statusMsgType = $sessData['estado']['type'];
    unset($_SESSION['sessData']['estado']);
}

$fpCodeValue = '';
if (!empty($_REQUEST['fp_code'])) {
    $fpCodeValue = (string) $_REQUEST['fp_code'];
} elseif (!empty($_REQUEST['token'])) {
    $fpCodeValue = (string) $_REQUEST['token'];
}

include('header.php');
include('Usuarios_Conexion_Sqlserver.php');

class UsuariosModel
{
    private $dbHost = '10.1.9.113';
    private $dbUsername = 'SA';
    private $dbPassword = 'Davinci2024#';
    private $dbName = 'junta';
    private $userTbl = 'usuarios';

    public function __construct()
    {
        if (!isset($this->db)) {
            $connectionInfo = array(
                'Database' => $this->dbName,
                'UID' => $this->dbUsername,
                'PWD' => $this->dbPassword,
                'TrustServerCertificate' => true,
            );
            $conn = sqlsrv_connect($this->dbHost, $connectionInfo);
            if ($conn === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $this->db = $conn;
        }
    }

    public function obtenerUsuarioPorCodigoReset($fp_code)
    {
        $sql = 'SELECT TOP 1 id FROM ' . $this->userTbl . ' WHERE olvido_pass_iden = ? OR token = ?';
        $params = array($fp_code, $fp_code);
        $result = sqlsrv_query($this->db, $sql, $params);
        if ($result === false) {
            return false;
        }
        $data = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
        sqlsrv_free_stmt($result);
        return !empty($data) ? $data : false;
    }

    public function actualizarPassword($userId, $hashed_password)
    {
        $sql = 'UPDATE ' . $this->userTbl . ' SET password = ? WHERE id = ?';
        $params = array($hashed_password, (int) $userId);
        $update = sqlsrv_query($this->db, $sql, $params);
        return $update !== false;
    }
}

if (isset($_POST['resetSubmit'])) {
    $password = !empty($_POST['password']) ? (string) $_POST['password'] : '';
    $confirm_password = !empty($_POST['confirm_password']) ? (string) $_POST['confirm_password'] : '';
    $fp_code = !empty($_POST['fp_code']) ? (string) $_POST['fp_code'] : '';

    if ($password === '' || $confirm_password === '' || $fp_code === '') {
        $statusMsg = 'Todos los campos son obligatorios.';
        $statusMsgType = 'error';
    } elseif ($password !== $confirm_password) {
        $statusMsg = 'Las contraseñas no coinciden.';
        $statusMsgType = 'error';
    } else {
        $validacionPassword = junta_password_validar($password);
        if ($validacionPassword !== true) {
            $statusMsg = $validacionPassword;
            $statusMsgType = 'error';
        } else {
            $usuarioModel = new UsuariosModel();
            $userData = $usuarioModel->obtenerUsuarioPorCodigoReset($fp_code);

            if ($userData && isset($userData['id'])) {
                $userId = (int) $userData['id'];
                $hashed_password = junta_password_hash($password);
                $actualizacion = $usuarioModel->actualizarPassword($userId, $hashed_password);

                if ($actualizacion) {
                    header('Location: index.php');
                    exit;
                }

                $statusMsg = 'Error al actualizar la contraseña, por favor inténtalo de nuevo más tarde.';
                $statusMsgType = 'error';
            } else {
                $statusMsg = 'Código de restablecimiento no válido.';
                $statusMsgType = 'error';
            }
        }
    }

    if ($statusMsg !== '') {
        $_SESSION['sessData']['estado']['msg'] = $statusMsg;
        $_SESSION['sessData']['estado']['type'] = $statusMsgType;
        $redirectUrl = 'ReiniciarPassword.php?fp_code=' . urlencode($fp_code !== '' ? $fp_code : $fpCodeValue);
        header('Location: ' . $redirectUrl);
        exit;
    }
}
ob_end_flush();
?>

<style type="text/css">
.reinicio-password-shell {
  max-width: 520px;
  margin: 0 auto;
  padding: 0 12px 24px;
}
.reinicio-password-shell .loginForm input[type="password"] {
  width: 100%;
  box-sizing: border-box;
  margin-bottom: 12px;
}
.reinicio-password-policy {
  font-size: 12px;
  color: #6b7280;
  margin: 0 0 8px;
  line-height: 1.5;
}
#password-error-reset {
  font-size: 13px;
  margin-top: 4px;
}
p.success { color: #34A853; }
p.error { color: #EA4335; }
</style>

<div class="col-sm-3 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;"></div>

<div class="col-sm-6 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
<div class="reinicio-password-shell">
    <h2>USUARIO REGISTRO Y LOGIN</h2>
    <h4>Reiniciar contraseña de su cuenta</h4>
    <?php echo !empty($statusMsg) ? '<p class="' . htmlspecialchars($statusMsgType, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($statusMsg, ENT_QUOTES, 'UTF-8') . '</p>' : ''; ?>
    <div class="loginForm">
        <form action="ReiniciarPassword.php" method="post" id="formReiniciarPassword">
            <label for="password-reset">Nueva contraseña</label>
            <input type="password" name="password" id="password-reset" placeholder="Ingrese la nueva contraseña" required autocomplete="new-password">
            <p class="reinicio-password-policy">
                La contraseña debe cumplir: <?php echo htmlspecialchars(junta_password_requisitos_texto(), ENT_QUOTES, 'UTF-8'); ?>
            </p>
            <div id="password-policy-checklist-reset"></div>

            <label for="confirm_password-reset">Confirmar contraseña</label>
            <input type="password" name="confirm_password" id="confirm_password-reset" placeholder="Repita la nueva contraseña" required autocomplete="new-password">
            <div id="password-error-reset" class="text-danger"></div>

            <input type="hidden" name="fp_code" value="<?php echo htmlspecialchars($fpCodeValue, ENT_QUOTES, 'UTF-8'); ?>">
            <div class="send-button">
                <input type="submit" name="resetSubmit" value="REINICIAR PASSWORD">
            </div>
        </form>
    </div>
</div>
</div>

<div class="col-sm-3 text wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;"></div>

<script src="views/inc/junta-password-policy.js"></script>
<script>
(function () {
    var passwordInput = document.getElementById('password-reset');
    var confirmInput = document.getElementById('confirm_password-reset');
    var errorBox = document.getElementById('password-error-reset');
    var form = document.getElementById('formReiniciarPassword');
    var validarPolitica = null;

    if (window.JuntaPasswordPolicy) {
        validarPolitica = JuntaPasswordPolicy.bindPolicy(
            passwordInput,
            document.getElementById('password-policy-checklist-reset'),
            false
        );
    }

    function validarFormularioReset() {
        var errores = [];

        if (validarPolitica) {
            var resultado = validarPolitica();
            if (!resultado.ok) {
                errores = errores.concat(resultado.errores);
            }
        }

        if (passwordInput.value !== confirmInput.value) {
            errores.push('Las contraseñas no coinciden.');
        }

        errorBox.innerHTML = errores.length
            ? errores.map(function (e) { return '• ' + e; }).join('<br>')
            : '';

        return errores.length === 0;
    }

    if (confirmInput) {
        confirmInput.addEventListener('input', validarFormularioReset);
    }
    if (passwordInput) {
        passwordInput.addEventListener('input', validarFormularioReset);
    }

    if (form) {
        form.addEventListener('submit', function (event) {
            if (!validarFormularioReset()) {
                event.preventDefault();
            }
        });
    }
})();
</script>

<?php include('footer.php'); ?>
