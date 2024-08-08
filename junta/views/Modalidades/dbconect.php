<?php
/* conexion a mysql
Class ConnectionModalidad{
 
	private $server = "mysql:host=localhost;dbname=junta";
	private $username = "root";
	private $password = "";
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
	protected $conn;
 	
	public function open(){
 		try{
 			$this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
 			return $this->conn;
 		}
 		catch (PDOException $e){
 			echo "Hubo un problema con la conexión: " . $e->getMessage();
 		}
 
    }
 
	public function close(){
   		$this->conn = null;
 	}
 
}
*/ 
class ConnectionModalidad {
 
    private $server = "sqlsrv:server=db;database=junta;TrustServerCertificate=yes";
    private $username = "SA"; // Actualiza con tu usuario de SQL Server
    private $password = '"asd123"'; // Actualiza con tu contraseña de SQL Server
    private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
    protected $conn;
     
    public function open() {
        try {
            $this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Hubo un problema con la conexión: " . $e->getMessage();
        }
    }
     
    public function close() {
        $this->conn = null;
    }
}
 




?>