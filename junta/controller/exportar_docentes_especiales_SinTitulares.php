<?php
require "consultaDocentesEspecialesSinTitulares.php";
$docentes = new Consulta3();
$salida = "";
$salida .= "<table>";
$salida .= "<thead <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Documento</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Legajo</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Nombres</th> <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Total</th></thead>";
foreach($docentes->buscarDocentesEspecialesSinTitulares() as $r){
    $salida .= "<tr><td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->Documento."</td> <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->Legajo."</td>"."</td><td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->Nombres."</td>  <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->Total."</td>"."</tr>";
}
$salida .= "</table>";
header("Content-type: application/vnd.ms-excel;charset=utf-8");
header("Content-Disposition: attachment; filename=DocentesEspecialesSinTitulares_".time().".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $salida;

?>
