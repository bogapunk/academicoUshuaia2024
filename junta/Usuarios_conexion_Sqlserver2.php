<?php

class UsuariosManager {
    private $dbHost     = "localhost";
    private $dbUsername = "boga";
    private $dbPassword = "30153846";
    private $dbName     = "junta";
    private $userTbl    = "usuarios";
    private $db; // Variable para almacenar la conexión

    public function __construct(){
        if(!isset($this->db)){
            // Conexión a la base de datos
            $connectionInfo = array("Database"=>$this->dbName, "UID"=>$this->dbUsername, "PWD"=>$this->dbPassword);
            $conn = sqlsrv_connect($this->dbHost, $connectionInfo);
            if($conn === false){
                die(print_r(sqlsrv_errors(), true));
            } else {
                $this->db = $conn;
            }
        }
    }

    public function getConnection() {
        return $this->db;
    }

    public function closeConnection() {
        sqlsrv_close($this->db);
    }

    // Métodos para operaciones con la base de datos como selectUsuarios, insertarUsuarios, etc.
    
    // Destructor para cerrar la conexión
    public function __destruct() {
        if (isset($this->db)) {
            sqlsrv_close($this->db);
        }
    }
}
?>