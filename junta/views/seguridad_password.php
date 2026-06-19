<?php

/**
 * Política mínima de contraseñas del Sistema de Juntas.
 */

if (!function_exists('junta_password_requisitos_lista')) {
    function junta_password_requisitos_lista()
    {
        return array(
            'Mínimo 8 caracteres.',
            'Al menos una letra mayúscula.',
            'Al menos una letra minúscula.',
            'Al menos un número.',
            'Al menos un carácter especial (@, #, $, %, &, *, etc.).',
        );
    }
}

if (!function_exists('junta_password_requisitos_texto')) {
    function junta_password_requisitos_texto()
    {
        return implode(' ', junta_password_requisitos_lista());
    }
}

if (!function_exists('junta_password_validar')) {
    /**
     * @return true|string true si cumple, mensaje de error si no.
     */
    function junta_password_validar($password)
    {
        $password = (string) $password;

        if (strlen($password) < 8) {
            return 'La contraseña debe tener al menos 8 caracteres.';
        }
        if (!preg_match('/[A-Z]/u', $password)) {
            return 'La contraseña debe incluir al menos una letra mayúscula.';
        }
        if (!preg_match('/[a-z]/u', $password)) {
            return 'La contraseña debe incluir al menos una letra minúscula.';
        }
        if (!preg_match('/[0-9]/', $password)) {
            return 'La contraseña debe incluir al menos un número.';
        }
        if (!preg_match('/[^A-Za-z0-9]/', $password)) {
            return 'La contraseña debe incluir al menos un carácter especial (@, #, $, %, &, *, etc.).';
        }

        return true;
    }
}

if (!function_exists('junta_password_hash')) {
    function junta_password_hash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}

if (!function_exists('junta_password_verificar_actual')) {
    /**
     * Verifica la contraseña actual contra el hash almacenado (bcrypt o MD5 legacy).
     */
    function junta_password_verificar_actual($hashAlmacenado, $passwordPlano)
    {
        $hashAlmacenado = (string) $hashAlmacenado;
        $passwordPlano = (string) $passwordPlano;

        if ($hashAlmacenado === '' || $passwordPlano === '') {
            return false;
        }

        if (password_verify($passwordPlano, $hashAlmacenado)) {
            return true;
        }

        if (strlen($hashAlmacenado) === 32 && ctype_xdigit($hashAlmacenado)) {
            return hash_equals($hashAlmacenado, md5($passwordPlano));
        }

        return false;
    }
}
