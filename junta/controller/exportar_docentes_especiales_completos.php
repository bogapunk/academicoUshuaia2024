<?php
require "consultaDocentesEspecialesCompletos.php";

$docentes = new Consulta4();
$salida = "";

// Construcción de la tabla HTML
$salida .= "<table border='1'>";
$salida .= "<thead>";
$salida .= "<tr>";
$salida .= "<th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Documento</th>";
$salida .= "<th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Legajo</th>";
$salida .= "<th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Nombres</th>";
$salida .= "<th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Total</th>";
$salida .= "<th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Establecimiento</th>";
$salida .= "</tr>";
$salida .= "</thead>";
$salida .= "<tbody>";

// Iteración sobre los datos obtenidos de la consulta
foreach($docentes->buscarDocentesEspecialesCompletos() as $r){
    $salida .= "<tr>";
    $salida .= "<td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->Documento."</td>";
    $salida .= "<td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->Legajo."</td>";
    $salida .= "<td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->Nombres."</td>";
    $salida .= "<td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->Total."</td>";
    $salida .= "<td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->Establecimiento."</td>";
    $salida .= "</tr>";
}

$salida .= "</tbody>";
$salida .= "</table>";

// Encabezados para la descarga del archivo Excel
header("Content-type: application/vnd.ms-excel;charset=utf-8");
header("Content-Disposition: attachment; filename=DocentesEspecialesCompletos_" . date("d-m-Y_H-i-s") . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

// Imprimir la tabla HTML como salida
echo $salida;
?>