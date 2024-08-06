<?php
require "consultaDependencias.php";
$dependencia = new ConsultaDependencias();
$salida = "";
$salida .= "<table>";
$salida .= "<thead><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Nº</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Codigo Dependecia</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Depenedncia</th><th>Domicilio</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Ciudad</th></thead>";
foreach($dependencia->buscarDependencias() as $r){
    $salida .= "<tr>
    <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->iddep}</td>
    <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->coddep}</td>
    <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->nomdep}</td>
    <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->domicilio}</td>
    <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->codloc}</td>
</tr>";
}


header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
//header("Content-Disposition: attachment; filename=depedencia_".time().".xls");
header("Content-Disposition: attachment; filename=depedencia_" . date("d-m-Y_H-i-s") . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $salida;

?>
