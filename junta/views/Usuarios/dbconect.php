<?php
ob_start();
// Datos de conexión a SQL Server
$serverName = "10.1.9.113"; // o la dirección IP del servidor
$database = "Junta";
$username = "SA"; // Reemplaza con tu usuario
$password = 'Davinci2024#'; // Reemplaza con tu contraseña

try {
    // Crear una instancia de PDO para SQL Server
    $link = new PDO("sqlsrv:server=$serverName;Database=$database;TrustServerCertificate=true", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
ob_end_flush();
?>
