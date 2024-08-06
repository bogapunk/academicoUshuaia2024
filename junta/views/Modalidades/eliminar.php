<?php
	
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['delete']) {
		
		require_once 'dbconect.php';
		
		$id = intval($_POST['delete']);
		$query = "DELETE FROM modalidades WHERE id=:id";
		$stmt = $DBcon->prepare2( $query );
		$stmt->execute(array(':id'=>$id));
		
		if ($stmt) {
			$response['status']  = 'success';
			$response['message'] = 'Modalidad eliminada correctamente...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'No se puede eliminar la modalidad ...';
		}
		echo json_encode($response);
	}