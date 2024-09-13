<?php
// Conexión a la base de datos
$serverName = "10.1.9.113"; // Reemplaza con tu servidor
$connectionOptions = array(
    "Database" => "junta", // Reemplaza con tu base de datos
    "UID" => "SA", // Reemplaza con tu usuario
    "PWD" => 'Davinci2024#', // Reemplaza con tu contraseña
    "CharacterSet" => "UTF-8", // Soporte para acentos
    "TrustServerCertificate" => true
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(json_encode(['success' => false, 'error' => 'Error en la conexión a la base de datos']));
}

// Obtener el código de modalidad desde la petición POST
$codmod = isset($_POST['codmod']) ? $_POST['codmod'] : '';

if (empty($codmod)) {
    die(json_encode(['success' => false, 'error' => 'Código de modalidad no proporcionado']));
}

// Consulta SQL para obtener el nombre de la modalidad según el código
$sql_modality = "SELECT codmod, nommod FROM _junta_modalidades WHERE codmod = ?";
$params = array($codmod);
$stmt = sqlsrv_query($conn, $sql_modality, $params);

if ($stmt === false) {
    die(json_encode(['success' => false, 'error' => 'Error en la consulta a la base de datos']));
}

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

if ($row) {
    // Si se encuentra el resultado, devolver el nombre de la modalidad y el código
    echo json_encode(['success' => true, 'codmod' => $row['codmod'], 'nommod' => $row['nommod']]);
} else {
    // Si no se encuentra ningún resultado, devolver un mensaje de no encontrado
    echo json_encode(['success' => false, 'error' => 'Modalidad no encontrada']);
}

// Cerrar la conexión y liberar los recursos
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>