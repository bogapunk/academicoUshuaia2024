<?php
require_once __DIR__ . '/../seguridad_requiere_admin.php';
session_start();
include_once('dbconect.php');

if(isset($_POST['agregar'])){
	$database = new Connection();
	$db = $database->open();
	try{
		$stmt = $db->prepare("INSERT INTO usuarios (nombres, apellidos, email, telefono, rol) VALUES (:nombres, :apellidos, :email, :telefono, :password,:rol)");
		$resultado = $stmt->execute(array(
			':nombres'  => $_POST['nombres'],
			':apellidos'=> $_POST['apellidos'],
			':email'    => $_POST['email'],
			':telefono' => $_POST['telefono'],
			':password' => $_POST['password'],
			':rol'      => $_POST['rol']
		));

		if ($resultado) {
			$nuevoId = $db->lastInsertId();
			$_SESSION['message'] = 'Usuario guardado correctamente';
			$_SESSION['usuario_creado'] = array(
				'id'        => $nuevoId,
				'nombres'   => $_POST['nombres'],
				'apellidos' => $_POST['apellidos'],
				'email'     => $_POST['email'],
				'rol'       => $_POST['rol']
			);
		} else {
			$_SESSION['message'] = 'Algo salió mal. No se puede agregar miembro';
		}
	}
	catch(PDOException $e){
		$_SESSION['message'] = $e->getMessage();
	}

	$database->close();
}
else{
	$_SESSION['message'] = 'Llene el formulario';
}

header('location: ListarUsuarios.php');
exit;
?>