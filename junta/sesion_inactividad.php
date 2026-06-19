<?php
/**
 * API ligera para renovar o consultar la sesión por inactividad (respuesta JSON).
 */
session_start();

require_once __DIR__ . '/views/seguridad_inactividad.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate');

$action = isset($_REQUEST['action']) ? (string) $_REQUEST['action'] : 'status';

if (!junta_session_es_autenticado()) {
    echo json_encode(array(
        'ok' => false,
        'expired' => true,
        'authenticated' => false,
    ));
    exit;
}

if (junta_session_expirada_por_inactividad()) {
    junta_session_cerrar_por_inactividad();
    echo json_encode(array(
        'ok' => false,
        'expired' => true,
        'redirect' => junta_url_login_desde_script(),
    ));
    exit;
}

if ($action === 'extend' || $action === 'ping') {
    junta_session_actualizar_actividad();
}

$remaining = JUNTA_SESSION_TIMEOUT_SEC - junta_session_segundos_inactivo();

echo json_encode(array(
    'ok' => true,
    'expired' => false,
    'expiresIn' => max(0, $remaining),
    'timeoutSec' => JUNTA_SESSION_TIMEOUT_SEC,
    'warningSec' => JUNTA_SESSION_WARNING_SEC,
));
