<?php
require "../Config/conexionSqlServer.php";

class Consulta2{
    private $_db;
    private  $lista_DocentesEspeciales;

    public function __construct(){
        $this->_db = new Conexion();
        
    }

    public function buscarDocentesEspeciales(){
         
        $this->_db->conectar();


        $consulta = $this->_db->cnx->prepare("SELECT * FROM DocentesEspeciales ORDER by Total DESC");

        $consulta->execute();

        while($row = $consulta->fetch(PDO::FETCH_OBJ)){
            $this->lista_DocentesEspeciales[] =$row;
        }

        $this->_db->desconectar();
        return $this->lista_DocentesEspeciales;

    }

}