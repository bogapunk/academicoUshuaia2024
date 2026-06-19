<?php
/**
 * Cargador simple de variables desde archivo .env (sin dependencias externas).
 * Usado por junta_config.php — no modificar la lógica de negocio.
 */

if (!function_exists('junta_cargar_env')) {
    /**
     * Lee KEY=VALUE desde un archivo .env y los expone vía getenv().
     *
     * @param string $rutaArchivo Ruta absoluta al .env
     */
    function junta_cargar_env($rutaArchivo)
    {
        if (!is_file($rutaArchivo) || !is_readable($rutaArchivo)) {
            return;
        }

        $lineas = file($rutaArchivo, FILE_IGNORE_NEW_LINES);
        if ($lineas === false) {
            return;
        }

        foreach ($lineas as $linea) {
            $linea = trim($linea);

            if ($linea === '' || strpos($linea, '#') === 0) {
                continue;
            }

            $pos = strpos($linea, '=');
            if ($pos === false) {
                continue;
            }

            $clave = trim(substr($linea, 0, $pos));
            $valor = trim(substr($linea, $pos + 1));

            if ($clave === '') {
                continue;
            }

            if (strlen($valor) >= 2) {
                $comilla = $valor[0];
                if (($comilla === '"' || $comilla === "'") && substr($valor, -1) === $comilla) {
                    $valor = substr($valor, 1, -1);
                }
            }

            if (getenv($clave) === false) {
                putenv($clave . '=' . $valor);
                $_ENV[$clave] = $valor;
            }
        }
    }
}

if (!function_exists('junta_env')) {
    /**
     * Obtiene una variable de entorno con valor por defecto.
     *
     * @param string $clave
     * @param mixed  $porDefecto
     * @return mixed
     */
    function junta_env($clave, $porDefecto = '')
    {
        $valor = getenv($clave);
        if ($valor === false) {
            return $porDefecto;
        }
        return $valor;
    }
}
