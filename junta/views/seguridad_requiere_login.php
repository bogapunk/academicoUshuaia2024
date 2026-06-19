<?php
/**
 * Exige sesión activa. Incluir desde headers autenticados y endpoints sueltos.
 * Para endpoints AJAX/API responde JSON 401 si no hay sesión.
 */
require_once __DIR__ . '/seguridad_rol.php';

if (!function_exists('junta_es_solicitud_ajax_api')) {
    function junta_es_solicitud_ajax_api()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower((string) $_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            return true;
        }

        $accept = isset($_SERVER['HTTP_ACCEPT']) ? (string) $_SERVER['HTTP_ACCEPT'] : '';
        if (stripos($accept, 'application/json') !== false) {
            return true;
        }

        return false;
    }
}

if (!function_exists('junta_seguridad_denegar_no_autenticado')) {
    function junta_seguridad_denegar_no_autenticado($forzarAjax = null)
    {
        $esAjax = ($forzarAjax === null) ? junta_es_solicitud_ajax_api() : (bool) $forzarAjax;

        if ($esAjax) {
            if (!headers_sent()) {
                http_response_code(401);
                header('Content-Type: application/json; charset=utf-8');
                header('Cache-Control: no-store, no-cache, must-revalidate');
            }

            echo json_encode(array(
                'ok'            => false,
                'error'         => 'No autorizado',
                'message'       => 'Debe iniciar sesión para continuar.',
                'authenticated' => false,
            ));
            exit;
        }

        header('Location: ' . junta_url_login_desde_script());
        exit;
    }
}

if (!function_exists('junta_seguridad_requiere_login')) {
    function junta_seguridad_requiere_login($forzarAjax = null)
    {
        if (junta_session_es_autenticado()) {
            return;
        }

        junta_seguridad_denegar_no_autenticado($forzarAjax);
    }
}

junta_seguridad_requiere_login();
