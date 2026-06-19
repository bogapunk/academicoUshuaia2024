<?php
session_start();
require_once __DIR__ . '/../seguridad_requiere_admin.php';
require_once __DIR__ . '/../../junta_config.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$nuevoEstado = isset($_GET['estado']) ? (int) $_GET['estado'] : -1;

if ($id <= 0 || ($nuevoEstado !== 0 && $nuevoEstado !== 1)) {
    $_SESSION['message'] = 'Solicitud de cambio de estado inválida.';
    header('Location: ListarUsuarios.php');
    exit;
}

$usuarioActualId = isset($_SESSION['sessData']['userID']) ? (int) $_SESSION['sessData']['userID'] : 0;
if ($nuevoEstado === 0 && $id === $usuarioActualId) {
    $_SESSION['message'] = 'No puede desactivar su propia cuenta mientras está conectado.';
    header('Location: ListarUsuarios.php');
    exit;
}

try {
    $link = new PDO(
        'sqlsrv:server=' . JUNTA_DB_HOST . ';Database=' . JUNTA_DB_NAME . ';TrustServerCertificate=true;ConnectionPooling=1;LoginTimeout=5',
        JUNTA_DB_USER,
        JUNTA_DB_PASS,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );

    $stmt = $link->prepare('UPDATE usuarios SET estado = :estado WHERE id = :id');
    $stmt->execute(array(
        ':estado' => (string) $nuevoEstado,
        ':id'     => $id,
    ));

    if ($stmt->rowCount() > 0) {
        $_SESSION['message'] = $nuevoEstado === 1
            ? 'Usuario activado correctamente.'
            : 'Usuario desactivado correctamente.';
    } else {
        $_SESSION['message'] = 'No se encontró el usuario o el estado ya era el solicitado.';
    }
} catch (PDOException $e) {
    error_log('CambiarEstadoUsuario: ' . $e->getMessage());
    $_SESSION['message'] = 'No se pudo cambiar el estado del usuario.';
}

$filtro = isset($_GET['filtro']) ? preg_replace('/[^a-z]/', '', (string) $_GET['filtro']) : 'activos';
header('Location: ListarUsuarios.php?filtro=' . urlencode($filtro));
exit;
