<?php
require_once dirname(__DIR__) . '/junta_config.php';

class Conexion{
    public $cnx;
    public function conectar(){
        try {
            $this->cnx = new PDO(
                'sqlsrv:Server=' . JUNTA_DB_HOST . ';Database=' . JUNTA_DB_NAME . ';TrustServerCertificate=true',
                JUNTA_DB_USER,
                JUNTA_DB_PASS,
                junta_pdo_sqlsrv_options()
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
