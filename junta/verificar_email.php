<?php
header('Content-Type: application/json');

// Conexión a la base de datos SQL Server
$host = '10.1.9.113';
$dbname = 'Junta';
$user = 'SA';
$pass = 'Davinci2024#';

try {
    $pdo = new PDO("sqlsrv:Server=$host;Database=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']);
    exit;
}

// Verifica si se recibió el email
if (!isset($_POST['email']) || empty($_POST['email'])) {
    echo json_encode(['success' => false, 'message' => 'Correo no recibido']);
    exit;
}

$email = $_POST['email'];

// Buscar el correo en la base de datos
$sql = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$count = $stmt->fetchColumn();

if ($count > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'El correo no se encuentra registrado']);
}
