<?php

/**

 * Configuración centralizada del Sistema de Juntas.

 *

 * Ajuste los valores en .env (recomendado) o en este archivo como respaldo.

 * No modifica la lógica de negocio ni los procesos existentes.

 */



require_once __DIR__ . '/junta_env.php';

junta_cargar_env(__DIR__ . '/.env');



// —— Base de datos (clase User / autenticación) ———————————————————————

if (!defined('JUNTA_DB_HOST')) {

    define('JUNTA_DB_HOST', junta_env('JUNTA_DB_HOST', '10.1.9.113'));

}

if (!defined('JUNTA_DB_USER')) {

    define('JUNTA_DB_USER', junta_env('JUNTA_DB_USER', 'SA'));

}

if (!defined('JUNTA_DB_PASS')) {

    define('JUNTA_DB_PASS', junta_env('JUNTA_DB_PASS', 'Davinci2024#'));

}

if (!defined('JUNTA_DB_NAME')) {

    define('JUNTA_DB_NAME', junta_env('JUNTA_DB_NAME', 'Junta'));

}

if (!defined('JUNTA_APP_BASE_URL')) {

    define('JUNTA_APP_BASE_URL', junta_env('JUNTA_APP_BASE_URL', 'http://localhost:8080/Juntas2024/junta/'));

}



// —— Sesión por inactividad ——————————————————————————————————————————

if (!defined('JUNTA_SESSION_TIMEOUT_SEC')) {

    $timeoutEnv = junta_env('JUNTA_SESSION_TIMEOUT_SEC', '');

    define('JUNTA_SESSION_TIMEOUT_SEC', $timeoutEnv !== '' ? (int) $timeoutEnv : 20 * 60);

}



if (!defined('JUNTA_SESSION_WARNING_SEC')) {

    $warningEnv = junta_env('JUNTA_SESSION_WARNING_SEC', '');

    define('JUNTA_SESSION_WARNING_SEC', $warningEnv !== '' ? (int) $warningEnv : 60);

}



if (!defined('JUNTA_SESSION_DEBUG')) {

    $debugEnv = strtolower((string) junta_env('JUNTA_SESSION_DEBUG', 'false'));

    define('JUNTA_SESSION_DEBUG', in_array($debugEnv, array('1', 'true', 'yes'), true));

}


