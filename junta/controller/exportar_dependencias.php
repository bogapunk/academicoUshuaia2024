<?php
// Iniciar el buffer de salida
ob_start();

require "consultaDependencias.php";
$dependencia = new ConsultaDependencias();
$salida = "";

// Agregar la declaración de tipo de contenido HTML
$salida .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
$salida .= "<table border='1' style='border-collapse: collapse;'>";
$salida .= "<thead>
    <tr>
        <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Nº</th>
        <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Codigo Dependencia</th>
        <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Dependencia</th>
        <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Domicilio</th>
        <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Ciudad</th>
    </tr>
</thead>";
foreach ($dependencia->buscarDependencias() as $r) {
    $salida .= "<tr>
        <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->iddep}</td>
        <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->coddep}</td>
        <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->nomdep}</td>
        <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->domicilio}</td>
        <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->codloc}</td>
    </tr>";
}
$salida .= "</table>";

// Enviar las cabeceras HTTP
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header("Content-Disposition: attachment; filename=dependencia_" . date("d-m-Y_H-i-s") . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

// Enviar el contenido generado
echo $salida;

// Finalizar el buffer de salida y enviar todo el contenido
ob_end_flush();
?>
