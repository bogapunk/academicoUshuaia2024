<?php
require "../Config/conexionSqlserver.php";

class Consulta4{
    private $_db;
    private  $lista_DocentesEspecialesCompletos;

    public function __construct(){
        $this->_db = new Conexion();
        
    }

    public function buscarDocentesEspecialesCompletos(){
         
        $this->_db->conectar();


        $consulta = $this->_db->cnx->prepare("SELECT * FROM docentestespecialescompleto ORDER by Total DESC ");

        $consulta->execute();

        while($row = $consulta->fetch(PDO::FETCH_OBJ)){
            $this->lista_DocentesEspecialesCompletos[] =$row;
        }

        $this->_db->desconectar();
        return $this->lista_DocentesEspecialesCompletos;

    }

}