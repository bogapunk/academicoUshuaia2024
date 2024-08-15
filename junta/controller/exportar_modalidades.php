<?php
require "consultaModalidades.php";
$modalidad = new Consulta3();
$salida = "";
$salida .= "<table>";
$salida .= "<thead> <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Codigo de Modalidad</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Nombre de la modalidad</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Titulo</th> <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Tope</th> <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Complementaria</th></thead>";
foreach($modalidad->buscarModalidades() as $r){
    $salida .= "<tr><td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->codmod."</td> <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->nommod."</td>"."</td><td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->titulo."</td>  <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->tope."</td>"."<td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->comp."</td>". "</tr>";
}
$salida .= "</table>";
header("Content-type: application/vnd.ms-excel;charset=utf-8");
//header("Content-Disposition: attachment; filename=Modalidad_".time().".xls");
header("Content-Disposition: attachment; filename=Modalidad_" . date("d-m-Y_H-i-s") . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $salida;

?>
