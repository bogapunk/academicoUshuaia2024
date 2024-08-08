
<?php
// Inicia la sesión
session_start();

// Credenciales de la base de datos SQL Server
define('DB_HOST', 'localhost'); // Cambia localhost por la dirección del servidor SQL Server
define('DB_USER', 'SA'); // Cambia tu_usuario por el nombre de usuario de SQL Server
define('DB_PASS', '30153846'); // Cambia tu_contraseña por la contraseña de SQL Server
define('DB_NAME', 'junta'); // Nombre de la base de datos en SQL Server

try {
    // Intenta conectar con la base de datos SQL Server
    $connect = new PDO("sqlsrv:Server=" . DB_HOST . ";Database=" . DB_NAME, DB_USER, DB_PASS);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    exit("Error de conexión: " . $e->getMessage());
}

// Verifica si se ha enviado el formulario
if (isset($_POST['insertar'])) {
    // Obtiene los datos del formulario
    $listado = $_POST['listado'];
    $modalidades = $_POST['modalidades'];
    $ciudad = $_POST['ciudad'];
   

    // Prepara la consulta SQL para la inserción
    $sql = "INSERT INTO _junta_listadosgenerales (listado, modalidades, ciudad) 
            VALUES (:listado, :modalidades, :ciudad)";

    // Prepara la consulta SQL
    $stmt = $connect->prepare($sql);

    // Bind de los parámetros
    $stmt->bindParam(':listado', $listado, PDO::PARAM_STR);
    $stmt->bindParam(':modalidades', $modalidades, PDO::PARAM_STR);
    $stmt->bindParam(':ciudad', $ciudad, PDO::PARAM_STR);
   

    try {
        $stmt->execute();
        $lastInsertId = $connect->lastInsertId();

        if ($lastInsertId > 0) {
            // Mensaje de éxito
            echo "<script>alert('Los datos se han insertado correctamente.'); window.location='RegistroConfiguracionListado.php';</script>";
        } else {
            // Mensaje de error
            echo "<div class='content alert alert-danger'>No se pueden agregar datos, comuníquese con el administrador</div>";
            print_r($stmt->errorInfo());
        }

    } catch (PDOException $e) {
        // Error al ejecutar la consulta
        echo "Error al ejecutar la consulta: " . $e->getMessage();
    }
}
?>