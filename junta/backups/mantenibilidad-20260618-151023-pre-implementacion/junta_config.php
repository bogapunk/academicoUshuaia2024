<?php
/**
 * Configuración centralizada del Sistema de Juntas.
 *
 * Ajuste los valores de este archivo para cambiar parámetros del sistema
 * sin modificar la lógica de negocio ni los procesos existentes.
 */

// —— Sesión por inactividad ——————————————————————————————————————————
// Tiempo máximo sin interacción antes de cerrar la sesión (en segundos).
// Valor actual: 20 minutos = 1200 segundos.
if (!defined('JUNTA_SESSION_TIMEOUT_SEC')) {
    define('JUNTA_SESSION_TIMEOUT_SEC', 20 * 60);
}

// Segundos de anticipación para mostrar el aviso previo al cierre.
// Valor actual: 1 minuto = 60 segundos (el aviso aparece a los 19 minutos).
if (!defined('JUNTA_SESSION_WARNING_SEC')) {
    define('JUNTA_SESSION_WARNING_SEC', 60);
}

// Modo depuración: escribe tiempos en la consola del navegador (F12).
// Poner en false en producción.
if (!defined('JUNTA_SESSION_DEBUG')) {
    define('JUNTA_SESSION_DEBUG', false);
}
