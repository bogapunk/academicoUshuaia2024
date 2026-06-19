<?php
/**
 * Define $juntaEsAdmin según el rol (solo administrador ve módulo Usuarios en el menú).
 * Sincroniza userRol en sesión desde la base de datos en cada solicitud.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!function_exists('junta_cargar_clase_user_si_falta')) {
    function junta_cargar_clase_user_si_falta()
    {
        if (class_exists('User', false)) {
            return true;
        }

        $paths = array(
            __DIR__ . '/../Usuarios_Conexion_Sqlserver.php',
            __DIR__ . '/Usuarios.php',
        );

        foreach ($paths as $path) {
            if (!is_file($path)) {
                continue;
            }
            require_once $path;
            if (class_exists('User', false)) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('junta_normalizar_rol')) {
    function junta_normalizar_rol($rol)
    {
        return strtolower(trim((string) $rol));
    }
}

if (!function_exists('junta_es_rol_admin')) {
    function junta_es_rol_admin($rol)
    {
        $normalizado = junta_normalizar_rol($rol);
        return ($normalizado === 'admin' || $normalizado === 'administrador');
    }
}

if (!function_exists('junta_obtener_rol_usuario')) {
    function junta_obtener_rol_usuario()
    {
        if (empty($_SESSION['sessData']['userLoggedIn']) || empty($_SESSION['sessData']['userID'])) {
            return null;
        }

        if (junta_cargar_clase_user_si_falta()) {
            $u = new User();
            $r = $u->getRows(array(
                'where'         => array('id' => $_SESSION['sessData']['userID']),
                'return_type'   => 'single',
            ));

            if (!empty($r['rol'])) {
                $_SESSION['sessData']['userRol'] = $r['rol'];
                return $r['rol'];
            }
        }

        return !empty($_SESSION['sessData']['userRol']) ? $_SESSION['sessData']['userRol'] : null;
    }
}

$rolUsuario   = junta_obtener_rol_usuario();
$juntaEsAdmin = junta_es_rol_admin($rolUsuario);

require_once __DIR__ . '/seguridad_inactividad.php';
junta_session_aplicar_control_inactividad();
