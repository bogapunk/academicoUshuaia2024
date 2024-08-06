<?php
require "../Config/conexionSqlserver.php";

class ConsultaConfiguracionListados{
    private $_db;
    private  $lista_ConfiguracionListados;

    public function __construct(){
        $this->_db = new Conexion();
        
    }

    public function buscarConfiguracionListados(){
         
        $this->_db->conectar();


        $consulta = $this->_db->cnx->prepare("SELECT * FROM _junta_listadosgenerales order by listado asc");

        $consulta->execute();

        while($row = $consulta->fetch(PDO::FETCH_OBJ)){
            $this->lista_ConfiguracionListados[] =$row;
        }

        $this->_db->desconectar();
        return $this->lista_ConfiguracionListados;

    }

}