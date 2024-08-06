<?php
	session_start();
	include_once('dbconect.php');

	if(isset($_POST['editar'])){
		$database = new ConnectionConfiguracionListado();
		$db = $database->open();
		try{
			$id = $_GET['id'];
			$id2 = $_POST['id2'];
			$listado = $_POST['listado'];
			$modalidades = $_POST['modalidades'];
			$ciudad = $_POST['ciudad'];
			

			//$comp = $_POST['comp'];

			$sql = "UPDATE listadosgnerales SET id2 = '$id2', listado = '$listado', modalidades = '$modalidades', ciudad = '$ciudad' WHERE id = '$id'";
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

	header('location: listarConfiguracionListados.php');

?>