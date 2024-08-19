<?php
// Iniciar sesión
session_start();

// Definir las credenciales de la base de datos
define('DB_HOST', 'db');
define('DB_USER', 'SA');
define('DB_PASS', '"asd123"');
define('DB_NAME', 'junta');

try {
    // Construir la cadena de conexión para SQL Server con TrustServerCertificate=true
    $dsn = "sqlsrv:Server=" . DB_HOST . ";Database=" . DB_NAME . ";TrustServerCertificate=true";
    $connect = new PDO($dsn, DB_USER, DB_PASS);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit("Error de conexión: " . $e->getMessage());
}

if (isset($_POST['insertar'])) {
    // Recoger datos enviados por el formulario
    $codmod = isset($_POST['codmod']) ? (int) $_POST['codmod'] : 0;
    $nommod = isset($_POST['nommod']) ? $_POST['nommod'] : '';
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
    $tope = isset($_POST['tope']) ? (int) $_POST['tope'] : 0;

    // SQL para la inserción de datos
    $sql = "INSERT INTO _junta_modalidades (codmod, nommod, titulo, tope) 
            VALUES (:codmod, :nommod, :titulo, :tope)";

    // Preparar la consulta
    $stmt = $connect->prepare($sql);

    // Vincular los parámetros
    $stmt->bindParam(':codmod', $codmod, PDO::PARAM_INT);
    $stmt->bindParam(':nommod', $nommod, PDO::PARAM_STR);
    $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
    $stmt->bindParam(':tope', $tope, PDO::PARAM_INT);

    try {
        // Ejecutar la consulta
        $stmt->execute();
        $lastInsertId = $connect->lastInsertId(); // Obtener el último ID insertado
        
        if ($lastInsertId > 0) {
            // Mensaje de éxito
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
            echo '<strong>¡Éxito!</strong> Los datos se han insertado correctamente.';
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
    
            // Redirigir después de 3 segundos
            echo '<script>';
            echo 'setTimeout(function() { window.location.href = "RegistroModalidad.php"; }, 3000);'; // Redirige después de 3 segundos
            echo '</script>';
        } else {
            // Mensaje de error
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo '<strong>Error:</strong> No se pueden agregar datos, comuníquese con el administrador.';
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
            print_r($stmt->errorInfo());
        }
    
    } catch (PDOException $e) {
        // Error al ejecutar la consulta
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo '<strong>Error:</strong> ' . $e->getMessage();
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
}
?>
