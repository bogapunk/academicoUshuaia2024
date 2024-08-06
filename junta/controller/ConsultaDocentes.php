<?php
require "../Config/conexion.php";

class ConsultaDocentes{
    private $_db;
    private  $lista_Docentes;

    public function __construct(){
        $this->_db = new Conexion();
        
    }

    public function buscarDocentes(){
         
        $this->_db->conectar();


        $consulta = $this->_db->cnx->prepare("SELECT * FROM _junta_docentes ORDER by legajo asc ");

        $consulta->execute();

        while($row = $consulta->fetch(PDO::FETCH_OBJ)){
            $this->lista_Docentes[] =$row;
        }

        $this->_db->desconectar();
        return $this->lista_Docentes;

    }

}