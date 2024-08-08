<?php
// Definir las constantes para la conexión a la base de datos
define('BASE_URL', 'http://localhost/junta/'); // URL base de tu sistema
define('HOST', 'db'); // Host de la base de datos SQL Server
define('BD', 'junta'); // Nombre de la base de datos
define('DB_USER', 'SA'); // Usuario de la base de datos SQL Server
define('PASS', '30153846'); // Contraseña de la base de datos SQL Server
define('CHARSET', 'UTF-8'); // Juego de caracteres de la base de datos (para SQL Server no es necesario especificarlo así)

// Crea una función para conectar a la base de datos utilizando las constantes definidas
function conectarBD() {
    $serverName = HOST;
    $database = BD;
    $username = DB_USER;
    $password = PASS;
    
    $dsn = "sqlsrv:Server=$serverName;Database=$database";
    $opciones = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    );

    try {
        $conexion = new PDO($dsn, $username, $password, $opciones);
        return $conexion;
    } catch (PDOException $e) {
        die("Error al conectar a la base de datos: " . $e->getMessage());
    }
}

// Conectarse a la base de datos
$conexion = conectarBD();

// Verifica si se recibió el ID2
if (isset($_POST['id2'])) {
    // Obtiene el ID2 enviado por la solicitud AJAX
    $id2 = $_POST['id2'];

    // Realiza la eliminación del movimiento en la base de datos
    $queryEliminar = "DELETE FROM _junta_movimientos WHERE id2 = :id2";
    $stmt = $conexion->prepare($queryEliminar);
    $stmt->execute([':id2' => $id2]);

    // Verifica si la eliminación fue exitosa
    if ($stmt->rowCount() > 0) {
        // Devuelve una respuesta de éxito
        echo "Movimiento eliminado correctamente.";
    } else {
        // Devuelve un mensaje de error si la eliminación falla
        echo "Error al eliminar el movimiento.";
    }
} else {
    // Devuelve un mensaje de error si no se recibió el ID2
    echo "No se recibió el ID2 del movimiento a eliminar.";
}
?>