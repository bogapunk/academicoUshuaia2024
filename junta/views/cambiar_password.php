<?php
session_start();

// Inicializa las variables de sesión si no están definidas
$sessData = !empty($_SESSION['sessData']) ? $_SESSION['sessData'] : array();
$statusMsg = '';
$statusMsgType = '';

// Verifica si el usuario está autenticado y tiene un ID
if (!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])) {
    $userID = $sessData['userID']; // Extrae el ID de la sesión
    include 'Usuarios.php'; // Asegúrate de que este archivo esté en el mismo directorio o proporciona la ruta correcta

    $user = new User();
    
    $conditions['where'] = array(
        'id' => $sessData['userID']
    );
    $conditions['return_type'] = 'single';

    // Obtiene los datos del usuario
    $userData = $user->getRows($conditions);
    
    // Puedes usar los datos del usuario para mostrar información en la página si es necesario
}
 // Incluir la conexión a la base de datos
$serverName = "10.1.9.113"; // Dirección IP del servidor
$database = "Junta";
$username = "SA"; // Usuario
$password = 'Davinci2024#'; // Contraseña

try {
    // Crear una instancia de PDO para SQL Server
    $conexion = new PDO("sqlsrv:server=$serverName;Database=$database;TrustServerCertificate=true", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
    exit;
}
// Si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar la solicitud de cambio de contraseña
    $current_password = $_POST['current_password'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Verificar que las contraseñas coincidan
    if ($new_password !== $confirm_password) {
        $statusMsg = "Las nuevas contraseñas no coinciden.";
        $statusMsgType = 'danger';
    } else {
        // Verificar la contraseña actual
        $conditions['where'] = array(
            'id' => $sessData['userID'],
            'password' => md5($current_password)
        );
        $conditions['return_type'] = 'single';

        $userData = $user->getRows($conditions);

        if ($userData) {
            // Actualizar la contraseña en la base de datos
            $hashed_password = md5($new_password);
            $update_query = "UPDATE usuarios SET password = :new_password WHERE id = :user_id";
            $update_stmt = $conexion->prepare($update_query);
            $update_stmt->bindParam(':new_password', $hashed_password);
            $update_stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);

            if ($update_stmt->execute()) {
                $statusMsg = "Contraseña actualizada con éxito.";
                $statusMsgType = 'success';
            } else {
                $statusMsg = "Error al actualizar la contraseña.";
                $statusMsgType = 'danger';
            }
        } else {
            $statusMsg = "La contraseña actual es incorrecta.";
            $statusMsgType = 'danger';
        }
    }
}

// Si tienes mensajes de estado en la sesión, muestra el mensaje y luego lo elimina
if (!empty($sessData['estado']['msg'])) {
    $statusMsg = $sessData['estado']['msg'];
    $statusMsgType = $sessData['estado']['type'];
    unset($_SESSION['sessData']['estado']);
}

include('header1.php');
?>
<style>
input::placeholder {
    text-align: center; /* Centra el texto del placeholder */
}

input {
    text-align: center; /* Centra el texto ingresado */
}

</style>
<center>
    <div class="container mt-5">
        <div class="row justify-content-center" style="width: 50%;">
            <div class="col-sm-7" style="width: 100%;">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="text-center"><u>Cambiar Contraseña</u></h2>
                        <h4 class="text-center text-muted mb-4">(Contraseña Nueva)</h4>
                        <br>
                        <?php if (!empty($statusMsg)) { ?>
                            <div class="alert alert-<?php echo htmlspecialchars($statusMsgType); ?>">
                                <?php echo htmlspecialchars($statusMsg); ?>
                            </div>
                        <?php } ?>
                        <form action="" method="post" onsubmit="return validarFormulario();">
                            <!-- Campo oculto para el ID de usuario -->
                            <input type="hidden" name="userID" value="<?php echo htmlspecialchars($userID); ?>">
                            
                            <div class="form-group">
                                <label for="current_password">Contraseña Actual</label>
                                <input style="width: 70%;" type="password" name="current_password" id="current_password" class="form-control" placeholder="Ingrese su contraseña actual" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Nueva Contraseña</label>
                                <input style="width: 70%;" type="password" class="form-control" id="password" name="password" placeholder="Ingrese nueva contraseña" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirmar Nueva Contraseña</label>
                                <input style="width: 70%; text-align: center;" type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Repita la nueva contraseña" required>
                                <div id="password-error" class="text-danger mt-2"></div>
                            </div>
                            <div class="text-center">
                              <center>  <button type="submit" name="signupSubmit" class="btn btn-primary btn-block" style="width: 40%;">Cambiar Contraseña</button>
                            </div></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</center>

<!-- Script para validar contraseñas -->
<script>
    var passwordInput = document.getElementById("password");
    var repeatedPasswordInput = document.getElementById("confirm_password");
    var passwordError = document.getElementById("password-error");

    repeatedPasswordInput.addEventListener("input", function() {
        validarContraseñas();
    });

    function validarContraseñas() {
        var password = passwordInput.value;
        var repeatedPassword = repeatedPasswordInput.value;

        if (password !== repeatedPassword) {
            passwordError.innerHTML = "Las contraseñas no coinciden. Por favor, inténtelo de nuevo.";
        } else {
            passwordError.innerHTML = "";
        }
    }

    function validarFormulario() {
        validarContraseñas();

        if (passwordError.innerHTML !== "") {
            return false;
        }
        return true;
    }
</script>

<?php include('footer2.php'); ?>