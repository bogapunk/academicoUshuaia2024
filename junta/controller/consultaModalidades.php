<?php
require "../Config/conexionSqlServer.php";

class Consulta3 {
    private $_db;
    private $lista_Modalidades; // Asegúrate de que el nombre de la propiedad sea correcto

    public function __construct() {
        $this->_db = new Conexion();
        $this->lista_Modalidades = []; // Inicializa la lista
    }

    public function buscarModalidades() {
        $this->_db->conectar(); // Establece la conexión

        // Verifica si la conexión fue exitosa
        if ($this->_db->cnx === null) {
            die("Error: La conexión a la base de datos no se estableció.");
        }

        try {
            $consulta = $this->_db->cnx->prepare("SELECT * FROM _junta_modalidades ORDER BY codmod ASC");
            $consulta->execute();

            while ($row = $consulta->fetch(PDO::FETCH_OBJ)) {
                $this->lista_Modalidades[] = $row; // Agrega a la lista
            }
            
            $this->_db->desconectar(); // Cierra la conexión
            return $this->lista_Modalidades;
        } catch (PDOException $e) {
            $this->_db->desconectar(); // Asegúrate de desconectar en caso de error
            die("Error en la consulta: " . $e->getMessage());
        }
    }
}
?>