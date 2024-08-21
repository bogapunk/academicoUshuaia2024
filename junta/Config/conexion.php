<?php
require "Config.php";
class Conexion{
    public $cnx;
    public function conectar(){
        try {
            $this->cnx = new PDO(
                "sqlsrv:Server=10.1.9.113;Database=junta;TrustServerCertificate=yes",
                DB_USER, 
                PASS
            );
            return $this->cnx;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function desconectar(){
        $this->cnx = null;
    }

public function buscar(){
        
        $this->_db->conectar();

        $consulta = $this->_db->cnx->prepare("SELECT * FROM usuarios");

        $consulta->execute();
        
        while($row = $consulta->fetch(PDO::FETCH_OBJ)){
            $this->lista_usuarios[] =$row;
        }

        $this->_db->desconectar();
        return $this->lista_usuarios;

    }

}