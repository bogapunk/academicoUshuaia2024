<?php
require "consultaDocentesEspeciales.php";
$docentes = new Consulta2();
$salida = "";
$salida .= "<table>";
$salida .= "<thead <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Documento</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Legajo</th><th>Nombres</th> <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Total</th> <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Establecimiento</th></thead>";
foreach($docentes->buscarDocentesEspeciales() as $r){
    $salida .= "<tr><td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->Documento."</td> <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->Legajo."</td>"."</td><td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->Nombres."</td>  <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->Total."</td>"."<td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->Establecimiento."</td>". "</tr>";
}
$salida .= "</table>";
header("Content-type: application/vnd.ms-excel;charset=utf-8");
//header("Content-Disposition: attachment; filename=DocentesEspeciales_".time().".xls");
header("Content-Disposition: attachment; filename=DocentesEspeciales_" . date("d-m-Y_H-i-s") . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $salida;

?>
