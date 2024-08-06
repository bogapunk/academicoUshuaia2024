<?php
	session_start();
	include_once('dbconect.php');

	if(isset($_GET['id'])){
		$database = new ConnectionModalidad();
		$db = $database->open();
		try{
			$sql = "DELETE FROM modalidades WHERE id = '".$_GET['id']."'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Modalidad Borrada' : 'Hubo un error al borrar la modalidad';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//Cerrar conexión
		$database->close();

	}
	else{
		$_SESSION['message'] = 'Seleccionar la Modalidad para eliminar primero';
	}

	header('location: listarModalidades.php');

?>