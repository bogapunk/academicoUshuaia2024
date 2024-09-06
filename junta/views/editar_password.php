<?php
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

// Obtener los valores del formulario
$current_password = $_POST['current_password'];
$new_password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$user_id = $_POST['userID'];  // Recibir el ID del usuario desde el formulario

// Verificar que las nuevas contraseñas coincidan
if ($new_password !== $confirm_password) {
    echo "Las nuevas contraseñas no coinciden.";
    exit;
}

// Obtener la contraseña actual del usuario desde la base de datos
$query = "SELECT password FROM usuarios WHERE id = :user_id";
$stmt = $conexion->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    echo "Usuario no encontrado.";
    exit;
}

// Verificar la contraseña actual con MD5
if (md5($current_password) !== $result['password']) {  // Se usa md5() para verificar
    echo "La contraseña actual es incorrecta.";
    exit;
}

// Encriptar la nueva contraseña con MD5
$hashed_password = md5($new_password);

// Actualizar la contraseña en la base de datos
$update_query = "UPDATE usuarios SET password = :new_password WHERE id = :user_id";  // Reemplaza 'contrasena' por 'password' si es el nombre correcto del campo
$update_stmt = $conexion->prepare($update_query);
$update_stmt->bindParam(':new_password', $hashed_password);
$update_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

if ($update_stmt->execute()) {
    echo "Contraseña actualizada con éxito.";
} else {
    echo "Error al actualizar la contraseña.";
}
?>