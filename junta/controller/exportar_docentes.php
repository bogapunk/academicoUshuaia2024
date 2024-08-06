<?php
require "ConsultaDocentes.php";
$docente = new ConsultaDocentes();

$salida = "";
$salida .= "<table>";
$salida .= "<thead><th style='text-align:justify; border: 1px solid #ccc; padding: 10px 20px;'>Legajo</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Apellido y Nombre</th><th  style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Fecha Nacimmiento</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Telefono</th><th  style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Localidad</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Dni</th></thead>";
foreach($docente->buscarDocentes() as $r){
    $fechaNacimiento = explode(' ', $r->fechanacim)[0]; // Extract date part only
    $fechaNacimientoFormateada = date('d/m/Y', strtotime($fechaNacimiento)); // Format date

    $salida .= "<tr>
    <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->legajo}</td>
    <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->apellidoynombre}</td>
    <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$fechaNacimientoFormateada}</td>
    <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->telefonos}</td>
    <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->lugarinsc}</td>
    <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>{$r->dni}</td>
</tr>";
}


header("Content-type: application/vnd.ms-excel;charset=utf-8");
header("Content-Disposition: attachment; filename=docentes_" . date("d-m-Y_H-i-s") . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $salida;

?>
