<?php
require "consultaConfiguracionListados.php";
$confLis = new ConsultaConfiguracionListados();
$salida = "";
$salida .= "<table>";
$salida .= "<thead> <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Listados</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Nombre de la modalidad</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Ciudad</th></thead>";
foreach($confLis->buscarConfiguracionListados() as $r){
    $salida .= "<tr><td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->Listado."</td> <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->modalidades."</td>"."</td><td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->ciudad."</td>"."</tr>";
}
$salida .= "</table>";
header("Content-type: application/vnd.ms-excel;charset=utf-8");
//header("Content-Disposition: attachment; filename=ConfiguracionListados_".time().".xls");
header("Content-Disposition: attachment; filename=ConfiguracionListados_" . date("d-m-Y_H-i-s") . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $salida;

?>