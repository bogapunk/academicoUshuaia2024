<?php
// Datos de conexión a SQL Server
$serverName = "localhost"; // o la dirección IP del servidor
$database = "junta";
$username = "boga"; // Reemplaza con tu usuario
$password = "30153846"; // Reemplaza con tu contraseña

try {
    // Crear una instancia de PDO para SQL Server
    $link = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a SQL Server";
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
?>
