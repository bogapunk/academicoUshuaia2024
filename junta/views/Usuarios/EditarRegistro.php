<?php
class Connection {
    private $serverName = "localhost"; // o la dirección IP del servidor
    private $database = "junta";
    private $username = "boga"; // Reemplaza con tu usuario
    private $password = "30153846"; // Reemplaza con tu contraseña
    private $conn;

    public function open() {
        try {
            $this->conn = new PDO("sqlsrv:server=$this->serverName;Database=$this->database", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }

    public function close() {
        $this->conn = null;
    }
}

	session_start();
	include_once('dbconect.php');

	if(isset($_POST['editar'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$id = $_GET['id'];
			$nombres = $_POST['nombres'];
			$apellidos = $_POST['apellidos'];
			$email = $_POST['email'];
			$telefono = $_POST['telefono'];
			$rol = $_POST['rol'];
			$password = md5($_POST['password']);
		

			$sql = "UPDATE usuarios SET nombres = '$nombres', apellidos = '$apellidos', email = '$email', telefono = '$telefono', rol = '$rol', password ='$password'   WHERE id = '$id'";
			//if-else statement in executing our query
              
               echo "se actualizo usuario!!!!!!!!";
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Usuario actualizado correctamente!!!' : 'No se puso actualizar un usuario';
           
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

	header('location: listarUsuarios.php');

?>