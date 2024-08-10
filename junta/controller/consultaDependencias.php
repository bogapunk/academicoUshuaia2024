<?php
require "../Config/conexionSqlServer.php";

class ConsultaDependencias{
    private $_db;
    private  $lista_Dependencias;

    public function __construct(){
        $this->_db = new Conexion();
        
    }

    public function buscarDependencias(){
         
        $this->_db->conectar();


        $consulta = $this->_db->cnx->prepare("SELECT * FROM _junta_dependencias order by  nomdep asc");

        $consulta->execute();

        while($row = $consulta->fetch(PDO::FETCH_OBJ)){
            $this->lista_Dependencias[] =$row;
        }

        $this->_db->desconectar();
        return $this->lista_Dependencias;

    }

}