<?php
require "consultaDocentesEspeciales.php";

// Instancia de la clase y obtención de datos
$docentes = new Consulta2();
$salida = "";

// Agrega una meta etiqueta para definir la codificación del archivo
$salida .= "<meta charset='UTF-8'>";

// Genera la tabla HTML
$salida .= "<table border='1' style='border-collapse: collapse; width: 100%;'>";
$salida .= "<thead><tr><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Documento</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Legajo</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Nombres</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Total</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Establecimiento</th></tr></thead>";

foreach($docentes->buscarDocentesEspeciales() as $r){
    $salida .= "<tr><td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".htmlspecialchars($r->Documento, ENT_QUOTES, 'UTF-8')."</td><td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".htmlspecialchars($r->Legajo, ENT_QUOTES, 'UTF-8')."</td><td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".htmlspecialchars($r->Nombres, ENT_QUOTES, 'UTF-8')."</td><td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".htmlspecialchars($r->Total, ENT_QUOTES, 'UTF-8')."</td><td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".htmlspecialchars($r->Establecimiento, ENT_QUOTES, 'UTF-8')."</td></tr>";
}
$salida .= "</table>";

// Define los encabezados para la descarga del archivo Excel
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=DocentesEspeciales_" . date("d-m-Y_H-i-s") . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

// Imprime el contenido generado
echo $salida;
?>