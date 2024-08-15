<?php
// Configuraciones de conexión a la base de datos
define('HOST', 'db');
define('BD', 'junta');
define('DB_USER', 'SA');
define('PASS', '"asd123"');
define('CHARSET', 'utf8');

$dsn = "sqlsrv:Server=" . HOST . ";Database=" . BD;
var_dump($_POST);
//exit;
try {
    // Conexión a la base de datos
    $conexion = new PDO($dsn, DB_USER, PASS);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa.<br>";

    // Función para validar y convertir valores numéricos
    function validate_numeric($value) {
        return is_numeric($value) ? (float)$value : null;
    }

    // Recibir los datos del formulario y convertirlos al tipo correcto
    $id2 = (int)$_POST['id2'];
   
    $obs = $_POST['obs'] ?? '';
    $horas = $_POST['horas'] ?? '';
    $puntajetotal = validate_numeric($_POST['puntajetotal']);
    $titulo = validate_numeric($_POST['titulo']);
    $concepto = validate_numeric($_POST['concepto']);
    

    // Consulta SQL para actualizar los datos
    $consulta = "UPDATE _junta_movimientos SET 
       
        obs = :obs, 
        horas = :horas, 
        puntajetotal = :puntajetotal, 
        titulo = :titulo, 
        concepto = :concepto
       
    WHERE id2 = :id2";

    // Preparar la declaración
    $stmt = $conexion->prepare($consulta);

    // Vincular parámetros
    $stmt->bindParam(':obs', $obs);
    $stmt->bindParam(':horas', $horas);
    $stmt->bindParam(':puntajetotal', $puntajetotal);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':concepto', $concepto);
    $stmt->bindParam(':id2', $id2, PDO::PARAM_INT);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Actualización exitosa.<br>";
    } else {
        echo "Error en la actualización.<br>";
    }

} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
