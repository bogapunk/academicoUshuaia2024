<?php
require "consultaUsuarios.php";
$usuarios = new Consulta();
$salida = "";
$salida .= "<table>";
$salida .= "<thead> <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>ID</th> <th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Nombres</th><th style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>Apellidos</th><th>Usuario</th> <th>Telefono</th> <th>Creado</th><th>Modificado</th><th>Rol</th></thead>";
foreach($usuarios->buscarUsuarios() as $r){
    $salida .= "<tr><td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->id."</td> <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->nombres."</td> <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->apellidos."</td>"."</td><td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->email."</td>  <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->telefono."</td>"."<td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->creado."</td>". "<td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->modificado." </td>"."</td> <td style='text-align: justify; border: 1px solid #ccc; padding: 10px 20px;'>".$r->rol."</td></tr>";
}
$salida .= "</table>";
header("Content-type: application/vnd.ms-excel;charset=utf-8");
//header("Content-Disposition: attachment; filename=usuarios_".time().".xls");
header("Content-Disposition: attachment; filename=usuarios_" . date("d-m-Y_H-i-s") . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $salida;

?>
