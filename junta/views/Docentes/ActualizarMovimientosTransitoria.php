<?php
// Configuraciones de conexión a la base de datos
define('HOST', '10.1.9.113');
define('BD', 'junta');
define('DB_USER', 'SA');
define('PASS', 'Davinci2024#');
define('CHARSET', 'utf8');

$dsn = "sqlsrv:Server=" . HOST . ";Database=" . BD . ";TrustServerCertificate=yes";
//var_dump($_POST);
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
    $anodoc =$_POST['anodoc'];
    $fecha = $_POST['fecha'];
    $establecimiento = validate_numeric($_POST['establecimiento']);
    $codloc =  $_POST['codloc'];
    $tipo = $_POST['tipo'];
    $codmod = $_POST['codmod'];
    $obs = $_POST['obs'] ?? '';
    $horas = $_POST['horas'] ?? '';
    $puntajetotal = validate_numeric($_POST['puntajetotal2']);
    $titulo = validate_numeric($_POST['titulo2']);
    $otitulo = validate_numeric($_POST['otitulo2']);
    //$concepto = validate_numeric($_POST['concepto2']);
    $promedio = validate_numeric($_POST['promedio2']);
    $antiguedadgestion = validate_numeric($_POST['antiguedadgestion2']);
    $antiguedadtitulo = validate_numeric($_POST['antiguedadtitulo2']);
    $serviciosprovincia = validate_numeric($_POST['serviciosprovincia2']);
    $otrosservicios = validate_numeric($_POST['otrosservicios2']);
    $residencia = validate_numeric($_POST['residencia2']);
    $publicaciones = validate_numeric($_POST['publicaciones2']);
    $otrosantecedentes = validate_numeric($_POST['otrosantecedentes2']);
    $hijos =  validate_numeric($_POST['hijos']);
    
    $excluido = validate_numeric($_POST['excluido']);
    // Consulta SQL para actualizar los datos
    $consulta = "UPDATE _junta_movimientos SET 
        anodoc = :anodoc,
        fecha = :fecha,
        codloc = :codloc,
        establecimiento = :establecimiento, 
        tipo = :tipo, 
        codmod = :codmod,
        obs = :obs, 
        horas = :horas, 
        puntajetotal = :puntajetotal, 
        titulo = :titulo, 
    
        otitulo= :otitulo,
        promedio = :promedio,
        antiguedadgestion = :antiguedadgestion,
        antiguedadtitulo = :antiguedadtitulo,
        serviciosprovincia = :serviciosprovincia,
        otrosservicios = :otrosservicios,
        residencia = :residencia, 
        publicaciones = :publicaciones,
        otrosantecedentes = :otrosantecedentes,
        excluido = :excluido,
        hijos = :hijos


    WHERE id2 = :id2";
      
    // Preparar la declaración
    $stmt = $conexion->prepare($consulta);

    // Vincular parámetros
    $stmt->bindParam(':anodoc', $anodoc);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':codloc', $codloc);
    $stmt->bindParam(':establecimiento', $establecimiento, PDO::PARAM_STR);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':codmod', $codmod);
    $stmt->bindParam(':obs', $obs);
    $stmt->bindParam(':horas', $horas);
    $stmt->bindParam(':puntajetotal', $puntajetotal, is_null($puntajetotal) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':otitulo', $otitulo, PDO::PARAM_STR);
    //$stmt->bindParam(':concepto', $concepto);
    $stmt->bindParam(':promedio', $promedio, PDO::PARAM_STR);
    $stmt->bindParam(':antiguedadgestion', $antiguedadgestion, PDO::PARAM_STR);
    $stmt->bindParam(':antiguedadtitulo', $antiguedadtitulo, PDO::PARAM_STR);
    $stmt->bindParam(':serviciosprovincia', $serviciosprovincia, PDO::PARAM_STR);
    $stmt->bindParam(':otrosservicios', $otrosservicios, PDO::PARAM_STR);
    $stmt->bindParam(':residencia', $residencia, PDO::PARAM_STR);
    $stmt->bindParam(':publicaciones', $publicaciones, PDO::PARAM_STR);
    $stmt->bindParam(':otrosantecedentes', $otrosantecedentes, PDO::PARAM_STR);
    
    $stmt->bindParam(':excluido', $excluido, PDO::PARAM_STR);
    $stmt->bindParam(':hijos', $hijos);

     
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
