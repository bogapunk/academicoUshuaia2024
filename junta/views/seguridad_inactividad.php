<?php
/**
 * Control de expiración de sesión por inactividad.
 * Incluido desde seguridad_rol.php en cada solicitud autenticada.
 *
 * Tiempos configurables en: junta_config.php (raíz del proyecto).
 */
require_once dirname(__DIR__) . '/junta_config.php';

if (!function_exists('junta_session_es_autenticado')) {    function junta_session_es_autenticado()
    {
        return !empty($_SESSION['sessData']['userLoggedIn']) && !empty($_SESSION['sessData']['userID']);
    }
}

if (!function_exists('junta_session_inicializar_actividad')) {
    function junta_session_inicializar_actividad()
    {
        if (junta_session_es_autenticado()) {
            $_SESSION['sessData']['lastActivity'] = time();
        }
    }
}

if (!function_exists('junta_session_actualizar_actividad')) {
    function junta_session_actualizar_actividad()
    {
        if (junta_session_es_autenticado()) {
            $_SESSION['sessData']['lastActivity'] = time();
        }
    }
}

if (!function_exists('junta_session_segundos_inactivo')) {
    function junta_session_segundos_inactivo()
    {
        if (!junta_session_es_autenticado()) {
            return 0;
        }

        $last = !empty($_SESSION['sessData']['lastActivity'])
            ? (int) $_SESSION['sessData']['lastActivity']
            : time();

        return max(0, time() - $last);
    }
}

if (!function_exists('junta_session_expirada_por_inactividad')) {
    function junta_session_expirada_por_inactividad()
    {
        if (!junta_session_es_autenticado()) {
            return false;
        }

        if (empty($_SESSION['sessData']['lastActivity'])) {
            return false;
        }

        return junta_session_segundos_inactivo() > JUNTA_SESSION_TIMEOUT_SEC;
    }
}

if (!function_exists('junta_url_login_desde_script')) {
    function junta_url_login_desde_script()
    {
        $script = $_SERVER['SCRIPT_NAME'] ?? '';
        if (preg_match('#^(.*?)/(?:views|controller)/#', $script, $m)) {
            return $m[1] . '/index.php';
        }

        return 'index.php';
    }
}

if (!function_exists('junta_session_cerrar_por_inactividad')) {
    function junta_session_cerrar_por_inactividad()
    {
        unset($_SESSION['sessData']);
        $_SESSION['sessData'] = array(
            'estado' => array(
                'type' => 'error',
                'msg' => 'Su sesión finalizó por inactividad. Por favor inicie sesión nuevamente.',
            ),
        );
    }
}

if (!function_exists('junta_session_redirigir_login_por_inactividad')) {
    function junta_session_redirigir_login_por_inactividad()
    {
        junta_session_cerrar_por_inactividad();
        header('Location: ' . junta_url_login_desde_script());
        exit;
    }
}

if (!function_exists('junta_session_aplicar_control_inactividad')) {
    function junta_session_aplicar_control_inactividad()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!junta_session_es_autenticado()) {
            return;
        }

        if (junta_session_expirada_por_inactividad()) {
            junta_session_redirigir_login_por_inactividad();
        }
    }
}
