<?php
require "Config2.php";

class Conexion {
    public $cnx;

    public function conectar() {
        try {
            $opciones = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::SQLSRV_ATTR_ENCODING => PDO::SQLSRV_ENCODING_UTF8,
                // Puedes añadir más opciones si es necesario
            );

            // Cadena de conexión simplificada sin Connection Timeout
            $dsn = "sqlsrv:Server=192.168.18.207,1433;Database=" . BD . ";TrustServerCertificate=true";

            $this->cnx = new PDO($dsn, DB_USER, PASS, $opciones);

            return $this->cnx;
        } catch (PDOException $e) {
            // Registrar el error para depuración
            error_log("Error de conexión: " . $e->getMessage(), 0);
            echo "Error de conexión: " . $e->getMessage();
        }
    }

    public function desconectar() {
        $this->cnx = null;
    }

    public function buscar() {
        $this->conectar();

        try {
            $consulta = $this->cnx->prepare("SELECT * FROM usuarios");
            $consulta->execute();

            $this->lista_usuarios = array();
            while ($row = $consulta->fetch(PDO::FETCH_OBJ)) {
                $this->lista_usuarios[] = $row;
            }
            
            $this->desconectar();
            return $this->lista_usuarios;
        } catch (PDOException $e) {
            // Registrar el error de la consulta
            error_log("Error en la consulta: " . $e->getMessage(), 0);
            echo "Error en la consulta: " . $e->getMessage();
        }
    }
}
?>

