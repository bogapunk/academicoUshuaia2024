<?php
session_start();
include_once('dbconect.php');

if(isset($_POST['agregar'])){
	$database = new Connection();
	$db = $database->open();
	try{
		//hacer uso de una declaración preparada para prevenir la inyección de sql
		$stmt = $db->prepare("INSERT INTO usuarios (nombres, apellidos, email, telefono, rol) VALUES (:nombres, :apellidos, :email, :telefono, :password,:rol)");
		//instrucción if-else en la ejecución de nuestra declaración preparada
		$_SESSION['message'] = ( $stmt->execute(array(':nombres' => $_POST['nombres'] , ':apellidos' => $_POST['apellidos'] , ':email' => $_POST['email'], ':telefono' => $_POST['telefono'], ':password' => $_POST['password'], ':rol' => $_POST['rol'])) ) ? 'Usuario guardado correctamente' : 'Algo salió mal. No se puede agregar miembro';

		var_dump($stmt);
		exit;	
	
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

header('location: ListarUsuarios.php');
	
?>