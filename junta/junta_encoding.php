<?php

if (!function_exists('junta_charset_init')) {
    function junta_charset_init()
    {
        if (function_exists('mb_internal_encoding')) {
            mb_internal_encoding('UTF-8');
        }
        ini_set('default_charset', 'UTF-8');
    }
}

if (!function_exists('junta_sqlsrv_connection_info')) {
    function junta_sqlsrv_connection_info($database = null, $user = null, $pass = null)
    {
        return array(
            'Database' => $database !== null ? $database : JUNTA_DB_NAME,
            'UID' => $user !== null ? $user : JUNTA_DB_USER,
            'PWD' => $pass !== null ? $pass : JUNTA_DB_PASS,
            'TrustServerCertificate' => true,
            'CharacterSet' => 'UTF-8',
        );
    }
}

if (!function_exists('junta_pdo_sqlsrv_options')) {
    function junta_pdo_sqlsrv_options(array $extra = array())
    {
        $opts = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        );
        if (defined('PDO::SQLSRV_ATTR_ENCODING') && defined('PDO::SQLSRV_ENCODING_UTF8')) {
            $opts[PDO::SQLSRV_ATTR_ENCODING] = PDO::SQLSRV_ENCODING_UTF8;
        }
        return array_replace($opts, $extra);
    }
}

if (!function_exists('junta_utf8_reparar')) {
    function junta_utf8_reparar($text)
    {
        if ($text === null || $text === '') {
            return (string) $text;
        }

        $text = (string) $text;
        if (!function_exists('mb_check_encoding')) {
            return $text;
        }

        $tieneProblemas = !mb_check_encoding($text, 'UTF-8')
            || strpos($text, "\xEF\xBF\xBD") !== false
            || preg_match('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', $text);

        if (!$tieneProblemas) {
            return $text;
        }

        foreach (array('Windows-1252', 'ISO-8859-1') as $from) {
            $converted = @mb_convert_encoding($text, 'UTF-8', $from);
            if ($converted !== false
                && mb_check_encoding($converted, 'UTF-8')
                && strpos($converted, "\xEF\xBF\xBD") === false
            ) {
                return $converted;
            }
        }

        $clean = @iconv('UTF-8', 'UTF-8//IGNORE', $text);
        return $clean !== false ? $clean : $text;
    }
}

if (!function_exists('junta_normalizar_fila_utf8')) {
    function junta_normalizar_fila_utf8($row)
    {
        if (!is_array($row)) {
            return $row;
        }
        foreach ($row as $key => $value) {
            if (is_string($value)) {
                $row[$key] = junta_utf8_reparar($value);
            }
        }
        return $row;
    }
}

if (!function_exists('junta_e')) {
    function junta_e($text, $flags = ENT_QUOTES, $encoding = 'UTF-8')
    {
        return htmlspecialchars(junta_utf8_reparar($text), $flags, $encoding);
    }
}
