<?php
// Datos de conexión a SQL Server
$serverName = "db"; // o la dirección IP del servidor
$database = "junta";
$username = "SA"; // Reemplaza con tu usuario
$password = '"asd123"'; // Reemplaza con tu contraseña

try {
    // Crear una instancia de PDO para SQL Server
    $link = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
?>
