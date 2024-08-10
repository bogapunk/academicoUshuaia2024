<?php
session_start();
include_once('dbconect.php');

if(isset($_POST['agregar'])){
	$database = new ConnectionModalidad();
	$db = $database->open();
	try{
		//hacer uso de una declaración preparada para prevenir la inyección de sql
		$stmt = $db->prepare("INSERT INTO modalidad (codmod, nommod, titulo, tope, comp) VALUES (:codmod, :nommod, :titulo, :tope, :comp)");
		//instrucción if-else en la ejecución de nuestra declaración preparada
		$_SESSION['message'] = ( $stmt->execute(array(':codmod' => $_POST['codmod'] , ':nommod' => $_POST['nommod'] , ':titulo' => $_POST['titulo'], ':tope' => $_POST['tope'], ':comp' => $_POST['comp'])) ) ? 'Modalidad guardado correctamente' : 'Algo salió mal. No se puede agregar';

		
	
	}
	catch(PDOException $e){
		$_SESSION['message'] = $e->getMessage();
	}

	//cerrar la conexion
	$database->close();
}

else{
	$_SESSION['message'] = 'Llene el formulario';
}

header('location: ListarModalidades.php');
	
?>