<?php
session_start();

define('DB_HOST', '192.168.18.207,1433');
define('DB_USER', 'SA');
define('DB_PASS', '"asd123"');
define('DB_NAME', 'junta');

try {
    // Construir la cadena de conexión para SQL Server con TrustServerCertificate=true
    $dsn = "sqlsrv:Server=" . DB_HOST . ";Database=" . DB_NAME . ";TrustServerCertificate=true";
    $connect = new PDO($dsn, DB_USER, DB_PASS);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Conexión exitosa";
} catch (PDOException $e) {
    exit("Error de conexión: " . $e->getMessage());
}

if (isset($_POST['insertar'])) {
    $nomdep = $_POST['nomdep'];
    $coddep = $_POST['coddep'];
    $domicilio = $_POST['domicilio'];
    $codloc = $_POST['codloc'];
    $directo = $_POST['directo'];
    $interno = $_POST['interno'];
    $codniv = $_POST['codniv'];

    $sql = "INSERT INTO _junta_dependencias (nomdep, coddep, domicilio, codloc, directo, interno, codniv) 
            VALUES (:nomdep, :coddep, :domicilio, :codloc, :directo, :interno, :codniv)";

    $stmt = $connect->prepare($sql);

    $stmt->bindParam(':nomdep', $nomdep, PDO::PARAM_STR);
    $stmt->bindParam(':coddep', $coddep, PDO::PARAM_INT);
    $stmt->bindParam(':domicilio', $domicilio, PDO::PARAM_STR);
    $stmt->bindParam(':codloc', $codloc, PDO::PARAM_STR);
    $stmt->bindParam(':directo', $directo, PDO::PARAM_STR);
    $stmt->bindParam(':interno', $interno, PDO::PARAM_STR);
    $stmt->bindParam(':codniv', $codniv, PDO::PARAM_INT);

    try {
        $stmt->execute();
        $lastInsertId = $connect->lastInsertId();
        
        if ($lastInsertId > 0) {
            // Alerta de éxito con Bootstrap
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
            echo '<strong>¡Éxito!</strong> Los datos se han insertado correctamente.';
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
    
            // Redirección a RegistroDependencia.php después de 3 segundos
            echo '<script>';
            echo 'setTimeout(function() { window.location.href = "RegistroDependencia.php"; }, 3000);'; // Redirige después de 3 segundos
            echo '</script>';
        } else {
            // Mensaje de error utilizando Bootstrap
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