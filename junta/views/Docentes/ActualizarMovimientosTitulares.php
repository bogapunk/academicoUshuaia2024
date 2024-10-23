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
    echo "SE ACTUALIZO CORRECTAMENTE!!! <br>";

    // Función para validar y convertir valores numéricos
    function validate_numeric($value) {
        return is_numeric($value) ? (float)$value : null;
    }

    // Recibir los datos del formulario y convertirlos al tipo correcto
    $id2 = (int)$_POST['id2'];
    $fecha = $_POST['fecha'];
    $establecimiento = validate_numeric($_POST['establecimiento']);
    $codloc =  $_POST['codloc'];

    $tipo = $_POST['tipo'];
    $codmod = $_POST['codmod'];
    $obs = $_POST['obs'] ?? '';
    $horas = $_POST['horas'] ?? '';
    $puntajetotal = validate_numeric($_POST['puntajetotal']);
    $titulo = validate_numeric($_POST['titulo']);
    $otitulo = validate_numeric($_POST['otitulo']);
    $concepto = validate_numeric($_POST['concepto']);
    $promedio = validate_numeric($_POST['promedio']);
    $antiguedadgestion = validate_numeric($_POST['antiguedadgestion']);
    $antiguedadtitulo = validate_numeric($_POST['antiguedadtitulo']);
    $serviciosprovincia = validate_numeric($_POST['serviciosprovincia']);
    $t_m_seccion = validate_numeric($_POST['t_m_seccion']);
    $t_m_anio = validate_numeric($_POST['t_m_anio']);
    $t_m_grupo = validate_numeric($_POST['t_m_grupo']);
    $t_m_ciclo = validate_numeric($_POST['t_m_ciclo']);
    $t_m_recupera = validate_numeric($_POST['t_m_recupera']);
    $t_m_comple = validate_numeric($_POST['t_m_comple']);
    $t_m_biblio = validate_numeric($_POST['t_m_biblio']);
    $t_m_gabinete = validate_numeric($_POST['t_m_gabinete']);
    $t_m_sec1 = validate_numeric($_POST['t_m_sec1']);
    $t_m_sec2 = validate_numeric($_POST['t_m_sec2']);
    $t_m_viced = validate_numeric($_POST['t_m_viced']);
    $t_d_pu = validate_numeric($_POST['t_d_pu']);
    $t_d_3 = validate_numeric($_POST['t_d_3']);
    $t_d_2 = validate_numeric($_POST['t_d_2']);
    $t_d_1 = validate_numeric($_POST['t_d_1']);
    $t_d_biblio = validate_numeric($_POST['t_d_biblio']);
    $t_d_gabi = validate_numeric($_POST['t_d_gabi']);
    $t_d_seccoortec = validate_numeric($_POST['t_d_seccoortec']);
    $t_d_supsectec = isset($_POST['t_d_supsectec']) && $_POST['t_d_supsectec'] !== '' ? validate_numeric($_POST['t_d_supsectec']) : NULL;

    $t_d_supesc = validate_numeric($_POST['t_d_supesc']);
    $t_d_supgral = validate_numeric($_POST['t_d_supgral']);
    $t_d_adic = validate_numeric($_POST['t_d_adic']);
    $otrosservicios = validate_numeric($_POST['otrosservicios']);
    $o_g_a = validate_numeric($_POST['o_g_a']);
    $o_g_b = validate_numeric($_POST['o_g_b']);
    $o_g_c = validate_numeric($_POST['o_g_c']);
    $o_g_d = validate_numeric($_POST['o_g_d']);
    $residencia = validate_numeric($_POST['residencia']);
    $publicaciones = validate_numeric($_POST['publicaciones']);
    $otrosantecedentes = validate_numeric($_POST['otrosantecedentes']);

    $excluido = validate_numeric($_POST['excluido']);
    
   

    // Consulta SQL para actualizar los datos
    $consulta = "UPDATE _junta_movimientos SET 
        
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
        concepto = :concepto,
        promedio = :promedio,
        antiguedadgestion = :antiguedadgestion, 
        antiguedadtitulo = :antiguedadtitulo,
        serviciosprovincia = :serviciosprovincia,
        t_m_seccion = :t_m_seccion, 
        t_m_anio = :t_m_anio, 
        t_m_grupo = :t_m_grupo, 
        t_m_ciclo = :t_m_ciclo, 
        t_m_recupera = :t_m_recupera,
        t_m_comple = :t_m_comple, 
        t_m_biblio = :t_m_biblio, 
        t_m_gabinete = :t_m_gabinete, 
        t_m_sec1 = :t_m_sec1, 
        t_m_sec2 = :t_m_sec2, 
        t_m_viced = :t_m_viced,
        t_d_pu = :t_d_pu, 
        t_d_3 = :t_d_3, 
        t_d_2 = :t_d_2, 
        t_d_1 = :t_d_1, 
        t_d_biblio = :t_d_biblio, 
        t_d_gabi = :t_d_gabi, 
        t_d_seccoortec = :t_d_seccoortec, 
        t_d_supsectec = :t_d_supsectec, 
        t_d_supesc = :t_d_supesc, 
        t_d_supgral = :t_d_supgral, 
        t_d_adic = :t_d_adic,
        otrosservicios = :otrosservicios, 
        o_g_a = :o_g_a, 
        o_g_b = :o_g_b, 
        o_g_c = :o_g_c, 
        o_g_d = :o_g_d, 
        residencia = :residencia, 
        publicaciones = :publicaciones, 
        otrosantecedentes = :otrosantecedentes,
        excluido = :excluido

    WHERE id2 = :id2";
  
  


    // Preparar la declaración
    $stmt = $conexion->prepare($consulta);

    // Vincular parámetros
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
    $stmt->bindParam(':concepto', $concepto);
    $stmt->bindParam(':promedio', $promedio, PDO::PARAM_STR);
    $stmt->bindParam(':antiguedadgestion', $antiguedadgestion, PDO::PARAM_STR);
    $stmt->bindParam(':antiguedadtitulo', $antiguedadtitulo, PDO::PARAM_STR);
    $stmt->bindParam(':serviciosprovincia', $serviciosprovincia, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_seccion', $t_m_seccion, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_anio', $t_m_anio, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_grupo', $t_m_grupo, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_ciclo', $t_m_ciclo, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_recupera', $t_m_recupera, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_comple', $t_m_comple, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_biblio', $t_m_biblio, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_gabinete', $t_m_gabinete, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_sec1', $t_m_sec1, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_sec2', $t_m_sec2, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_viced', $t_m_viced, PDO::PARAM_STR);
    $stmt->bindParam(':t_d_pu', $t_d_pu, PDO::PARAM_STR);
    $stmt->bindParam(':t_d_3', $t_d_3, PDO::PARAM_STR);
    $stmt->bindParam(':t_d_2', $t_d_2, PDO::PARAM_STR);
    $stmt->bindParam(':t_d_1', $t_d_1, PDO::PARAM_STR);
    $stmt->bindParam(':t_d_biblio', $t_d_biblio, PDO::PARAM_STR);
    $stmt->bindParam(':t_d_gabi', $t_d_gabi, PDO::PARAM_STR);
    $stmt->bindParam(':t_d_seccoortec', $t_d_seccoortec, PDO::PARAM_STR);
    $stmt->bindParam(':t_d_supsectec', $t_d_supsectec, PDO::PARAM_STR);
    $stmt->bindParam(':t_d_supesc', $t_d_supesc, PDO::PARAM_STR);
    $stmt->bindParam(':t_d_supgral', $t_d_supgral, PDO::PARAM_STR);
    $stmt->bindParam(':t_d_adic', $t_d_adic, PDO::PARAM_STR);
    $stmt->bindParam(':otrosservicios', $otrosservicios, PDO::PARAM_STR);
    $stmt->bindParam(':o_g_a', $o_g_a, PDO::PARAM_STR);
    $stmt->bindParam(':o_g_b', $o_g_b, PDO::PARAM_STR);
    $stmt->bindParam(':o_g_c', $o_g_c, PDO::PARAM_STR);
    $stmt->bindParam(':o_g_d', $o_g_d, PDO::PARAM_STR);
    $stmt->bindParam(':residencia', $residencia, PDO::PARAM_STR);
    $stmt->bindParam(':publicaciones', $publicaciones, PDO::PARAM_STR);
    $stmt->bindParam(':otrosantecedentes', $otrosantecedentes, PDO::PARAM_STR);
    $stmt->bindParam(':excluido', $excluido, PDO::PARAM_STR);


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
