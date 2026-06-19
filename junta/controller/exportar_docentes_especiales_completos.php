<?php
require_once dirname(__DIR__) . '/views/seguridad_requiere_login.php';
require "consultaDocentesEspecialesCompletos.php";

// Instancia de la clase y obtención de datos
$docentes = new Consulta4();
$salida = "";

// Agrega una meta etiqueta para definir la codificación del archivo
$salida .= "<meta charset='UTF-8'>";

// Construcción de la tabla HTML
$salida .= "<table border='1' style='border-collapse: collapse; width: 100%;'>";
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
    $salida .= "<td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".htmlspecialchars($r->Documento, ENT_QUOTES, 'UTF-8')."</td>";
    $salida .= "<td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".htmlspecialchars($r->Legajo, ENT_QUOTES, 'UTF-8')."</td>";
    $salida .= "<td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".htmlspecialchars($r->Nombres, ENT_QUOTES, 'UTF-8')."</td>";
    $salida .= "<td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".htmlspecialchars($r->Total, ENT_QUOTES, 'UTF-8')."</td>";
    $salida .= "<td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".htmlspecialchars($r->Establecimiento, ENT_QUOTES, 'UTF-8')."</td>";
    $salida .= "</tr>";
}

$salida .= "</tbody>";
$salida .= "</table>";

// Encabezados para la descarga del archivo Excel
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=DocentesEspecialesCompletos_" . date("d-m-Y_H-i-s") . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

// Imprimir la tabla HTML como salida
echo $salida;
?>