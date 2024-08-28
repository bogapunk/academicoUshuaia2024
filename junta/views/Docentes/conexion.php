<?php
$serverName = "10.1.9.113";
$connectionOptions = array(
    "Database" => "Junta",
    "Uid" => "SA",
    "PWD" => "Davinci2024#",
    "TrustServerCertificate" => true
);

// Conexión con SQL Server
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>