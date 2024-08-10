<?php
	session_start();
	include_once('dbconect.php');

	if(isset($_POST['editar'])){
		$database = new ConnectionDependencia();
		$db = $database->open();
		try{
			$iddep = $_GET['iddep'];
			$nomdep = $_POST['nomdep'];
			$coddep = $_POST['coddep'];
			$domicilio = $_POST['domicilio'];
			$codloc = $_POST['codloc'];
			$directo = $_POST['directo'];
			$interno = $_POST['interno'];
			$trial503 = $_POST['trial503'];

			//$comp = $_POST['comp'];

			$sql = "UPDATE dependencias SET nomdep = '$nomdep', coddep = '$coddep', domicilio = '$domicilio', codloc = '$codloc' , directo = '$directo',interno = '$interno',estado = '$estado' WHERE id = '$id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Dependencia actualizada correctamente' : 'No se puso actualizar la modalidad';

		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//Cerrar la conexión
		$database->close();
	}
	else{
		$_SESSION['message'] = 'Complete el formulario de edición';
	}

	header('location: ListarDependencias.php');

?>