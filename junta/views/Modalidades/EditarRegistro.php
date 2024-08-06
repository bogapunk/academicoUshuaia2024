<?php
	session_start();
	include_once('dbconect.php');

	if(isset($_POST['editar'])){
		$database = new ConnectionModalidad();
		$db = $database->open();
		try{
			$id = $_GET['id'];
			$codmod = $_POST['codmod'];
			$nommod = $_POST['nommod'];
			$titulo = $_POST['titulo'];
			$tope = $_POST['tope'];
			//$comp = $_POST['comp'];

			$sql = "UPDATE modalidades SET codmod = '$codmod', nommod = '$nommod', titulo = '$titulo', tope = '$tope' WHERE id = '$id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Modalidad actualizada correctamente' : 'No se puso actualizar la modalidad';

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

	header('location: listarModalidades.php');

?>