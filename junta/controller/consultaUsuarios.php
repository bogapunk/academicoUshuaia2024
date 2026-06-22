<?php
require "../Config/conexion.php";

class Consulta{
    private $_db;
    private  $lista_usuarios;

    public function __construct(){
        $this->_db = new Conexion();
        
    }

    public function buscarUsuarios(){
         
        $this->_db->conectar();


        $consulta = $this->_db->cnx->prepare("SELECT * FROM usuarios");

        $consulta->execute();

        while($row = $consulta->fetch(PDO::FETCH_ASSOC)){
            $this->lista_usuarios[] = (object) junta_normalizar_fila_utf8($row);
        }

        $this->_db->desconectar();
        return $this->lista_usuarios;

    }

}