<?php
//start session
session_start();
//load and initialize user class

if(isset($_POST['insertar'])){
///////////// Informacion enviada por el formulario /////////////
$codmod=$_POST['codmod'];
$nommod=$_POST['nommod'];
$titulo=$_POST['titulo'];
$tope=$_POST['tope'];
//$comp=$_POST['comp'];
///////// Fin informacion enviada por el formulario ///

////////////// Insertar a la tabla la informacion generada /////////

// Te recomiendo utilizar esta conección, la que utilizas ya no es la recomendada. 
//$link = new PDO('mysql:host=localhost;dbname=junta2022', 'root', ''); // el campo 

// DB CREDENCIALES DE USUARIO.
define('DB_HOST','db');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','junta');
// Ahora, establecemos la conexión.
try
{
// Ejecutamos las variables y aplicamos UTF8
$connect = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,
array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}


$sql="insert into _junta_modalidades(codmod,nommod,titulo,tope) values(:codmod,:nommod,:titulo,:tope)";

$sql = $connect->prepare($sql);

$sql->bindParam(':codmod',$codmod,PDO::PARAM_INT, 4);
$sql->bindParam(':nommod',$nommod,PDO::PARAM_STR, 25);
$sql->bindParam(':titulo',$titulo,PDO::PARAM_STR,25);
$sql->bindParam(':tope',$tope,PDO::PARAM_INT,3);
//$sql->bindParam(':comp',$comp,PDO::PARAM_STR);

$sql->execute();


$lastInsertId = $connect->lastInsertId();
if($lastInsertId>0){

echo "<div class='content alert alert-primary' > Gracias .. Tu Nombre es : $nommod </div><script> window.location='RegistroModalidad.php'; </script>";

}
else{
echo "<div class='content alert alert-danger'> No se pueden agregar datos, comuníquese con el administrador </div>";

print_r($sql->errorInfo()); 
}// Cierra envio de guardado
}

?>