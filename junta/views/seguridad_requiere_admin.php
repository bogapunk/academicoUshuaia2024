<?php
/**
 * Uso: require al inicio de pantallas o acciones reservadas al administrador.
 */
require_once __DIR__ . '/seguridad_rol.php';
require_once __DIR__ . '/seguridad_requiere_login.php';

if (!empty($juntaEsAdmin)) {
    return;
}

$script = $_SERVER['SCRIPT_NAME'] ?? '';
if (preg_match('#^(.*)/views/#', $script, $m)) {
    $dest = $m[1] . '/views/panel1.php';
} else {
    $dest = 'index.php';
}
header('Location: ' . $dest);
exit;
