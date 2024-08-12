<?php
// Iniciar el buffer de salida
ob_start();

require "consultaModalidades.php";
$modalidad = new Consulta3();
$salida = "";

// Agregar la declaración de tipo de contenido HTML con UTF-8
$salida .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
$salida .= "<table border='1' style='border-collapse: collapse;'>";
$salida .= "<thead>
    <tr>
        <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Codigo de Modalidad</th>
        <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Nombre de la modalidad</th>
        <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Titulo</th>
        <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Tope</th>
        <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Complementaria</th>
    </tr>
</thead>";

foreach ($modalidad->buscarModalidades() as $r) {
    $salida .= "<tr>
        <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->codmod}</td>
        <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->nommod}</td>
        <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->titulo}</td>
        <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->tope}</td>
        <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->comp}</td>
    </tr>";
}
$salida .= "</table>";

// Enviar las cabeceras HTTP
header("Content-type: application/vnd.ms-excel;charset=utf-8");
header("Content-Disposition: attachment; filename=Modalidad_" . date("d-m-Y_H-i-s") . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

// Enviar el contenido generado
echo $salida;

// Finalizar el buffer de salida y enviar todo el contenido
ob_end_flush();
?>
