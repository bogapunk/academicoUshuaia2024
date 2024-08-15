<?php
require "../Config/conexionSqlServer.php";

class Consulta3{
    private $_db;
    private  $lista_DocentesEspeciales;

    public function __construct(){
        $this->_db = new Conexion();
        
    }

    public function buscarModalidades(){
         
        $this->_db->conectar();


        $consulta = $this->_db->cnx->prepare("SELECT * FROM _junta_modalidades order by codmod asc");

        $consulta->execute();

        while($row = $consulta->fetch(PDO::FETCH_OBJ)){
            $this->lista_Modalidades[] =$row;
        }

        $this->_db->desconectar();
        return $this->lista_Modalidades;

    }

}