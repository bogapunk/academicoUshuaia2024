<?php

/**
 * Genera un nombre descriptivo para la descarga de PDF de listados.
 * Formato: Listado-{TipoListado}-{YYYY-MM-DD}.pdf
 * Ejemplo: Listado-Permanente-2026-06-12.pdf
 */
function generarNombreArchivoListadoPdf(array $opciones = []): string
{
    $params = array_merge($_GET, $_POST, $opciones);

    $segmentos = ['Listado'];

    $listado = trim((string)($params['listado'] ?? ''));
    $tipoc = trim((string)($params['tipoc'] ?? ''));

    if ($listado !== '') {
        $segmentos[] = sanitizarSegmentoNombrePdf($listado);
    } elseif ($tipoc !== '') {
        $segmentos[] = sanitizarSegmentoNombrePdf($tipoc);
    } else {
        $segmentos[] = 'General';
    }

    if (!empty($params['excluidos'])) {
        $segmentos[] = 'Excluidos';
    }

    $localidad = trim((string)($params['localidad'] ?? ''));
    if ($localidad === 'ANT') {
        $segmentos[] = 'Antartida';
    }

    $segmentos[] = date('Y-m-d');

    return implode('-', $segmentos) . '.pdf';
}

function sanitizarSegmentoNombrePdf(string $texto): string
{
    $texto = html_entity_decode($texto, ENT_QUOTES, 'UTF-8');
    $texto = preg_replace('/[\s\/\\\\:*?"<>|]+/u', '-', $texto);
    $texto = preg_replace('/-+/u', '-', $texto);

    return trim($texto, '-');
}
