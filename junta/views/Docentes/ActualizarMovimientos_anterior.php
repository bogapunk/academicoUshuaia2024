<?php
// Conectar a la base de datos
define('HOST', 'db'); // Host de la base de datos
define('BD', 'junta'); // Nombre de la base de datos
define('DB_USER', 'SA'); // Usuario de la base de datos
define('PASS', '30153846'); // Contraseña de la base de datos
define('CHARSET', 'utf8'); // Juego de caracteres de la base de datos

$dsn = "sqlsrv:Server=" . HOST . ";Database=" . BD.";TrustServerCertificate=True";

try {
    $conexion = new PDO($dsn, DB_USER, PASS);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Función para validar y convertir valores numéricos
    function validate_numeric($value) {
        if (is_numeric($value)) {
            return (float)$value;
        }
        return null;
    }

    // Recibir los datos del formulario y convertirlos al tipo correcto
    $id2 = (int)$_POST['id2'];
    $tipo = $_POST['tipo'];
    $anodoc = validate_numeric($_POST['anodoc']);
    $codmod = validate_numeric($_POST['codmod']);
    $establecimiento = validate_numeric($_POST['establecimiento']);
    $titulo = validate_numeric($_POST['titulo']);
    $promedioT = validate_numeric($_POST['promedioT']);
    $antiguedadgestion = validate_numeric($_POST['antiguedadgestion']);
    $antiguedadtitulo = validate_numeric($_POST['antiguedadtitulo']);
    $serviciosprovincia = validate_numeric($_POST['serviciosprovincia']);
    $otrosservicios = validate_numeric($_POST['otrosservicios']);
    $residencia = validate_numeric($_POST['residencia']);
    $publicaciones = validate_numeric($_POST['publicaciones']);
    $otrosantecedentes = validate_numeric($_POST['otrosantecedentes']);
    $puntajetotal = validate_numeric($_POST['puntajetotal']);
    $codloc = $_POST['codloc'];
    $t_m_seccion = validate_numeric($_POST['t_m_seccion']);
    $t_m_anio = validate_numeric($_POST['t_m_anio']);
    $t_m_grupo = validate_numeric($_POST['t_m_grupo']);
    $t_m_ciclo = validate_numeric($_POST['t_m_ciclo']);
    $t_m_recupera = validate_numeric($_POST['t_m_recupera']);
    $t_d_pu = validate_numeric($_POST['t_d_pu']);
    $t_d_3 = validate_numeric($_POST['t_d_3']);
    $t_d_2 = validate_numeric($_POST['t_d_2']);
    $t_d_1 = validate_numeric($_POST['t_d_1']);
    $t_d_biblio = validate_numeric($_POST['t_d_biblio']);
    $t_d_gabi = validate_numeric($_POST['t_d_gabi']);
    $t_d_seccoortec = validate_numeric($_POST['t_d_seccoortec']);
    $t_d_supsectec = validate_numeric($_POST['t_d_supsectec']);
    $t_d_supesc = validate_numeric($_POST['t_d_supesc']);
    $t_d_supgral = validate_numeric($_POST['t_d_supgral']);
    $t_d_adic = validate_numeric($_POST['t_d_adic']);
    $o_g_a = validate_numeric($_POST['o_g_a']);
    $o_g_b = validate_numeric($_POST['o_g_b']);
    $o_g_c = validate_numeric($_POST['o_g_c']);
    $o_g_d = validate_numeric($_POST['o_g_d']);
    $concepto = validate_numeric($_POST['concepto']);
    $otitulo = validate_numeric($_POST['otitulo']);
    $t_m_comple = validate_numeric($_POST['t_m_comple']);
    $t_m_biblio = validate_numeric($_POST['t_m_biblio']);
    $t_m_sec1 = validate_numeric($_POST['t_m_sec1']);
    $t_m_sec2 = validate_numeric($_POST['t_m_sec2']);
    $t_m_viced = validate_numeric($_POST['t_m_viced']);
    $t_m_gabinete = validate_numeric($_POST['t_m_gabinete']);
    $obs = $_POST['obs'];
    $horas = $_POST['horas'];
    $excluido = $_POST['excluido'];
    $fecha = date('Y-m-d', strtotime($_POST['fecha']));

    // Imprimir los valores que se están enviando a la base de datos
    echo "<pre>";
    print_r([
        'tipo' => $tipo,
        'anodoc' => $anodoc,
        'codmod' => $codmod,
        'establecimiento' => $coddep,
        'titulo' => $titulo,
        'promedioT' => $promedioT,
        'antiguedadgestion' => $antiguedadgestion,
        'antiguedadtitulo' => $antiguedadtitulo,
        'serviciosprovincia' => $serviciosprovincia,
        'otrosservicios' => $otrosservicios,
        'residencia' => $residencia,
        'publicaciones' => $publicaciones,
        'otrosantecedentes' => $otrosantecedentes,
        'puntajetotal' => $puntajetotal,
        'codloc' => $codloc,
        't_m_seccion' => $t_m_seccion,
        't_m_anio' => $t_m_anio,
        't_m_grupo' => $t_m_grupo,
        't_m_ciclo' => $t_m_ciclo,
        't_m_recupera' => $t_m_recupera,
        't_d_pu' => $t_d_pu,
        't_d_3' => $t_d_3,
        't_d_2' => $t_d_2,
        't_d_1' => $t_d_1,
        't_d_biblio' => $t_d_biblio,
        't_d_gabi' => $t_d_gabi,
        't_d_seccoortec' => $t_d_seccoortec,
        't_d_supsectec' => $t_d_supsectec,
        't_d_supesc' => $t_d_supesc,
        't_d_supgral' => $t_d_supgral,
        't_d_adic' => $t_d_adic,
        'o_g_a' => $o_g_a,
        'o_g_b' => $o_g_b,
        'o_g_c' => $o_g_c,
        'o_g_d' => $o_g_d,
        'concepto' => $concepto,
        'otitulo' => $otitulo,
        't_m_comple' => $t_m_comple,
        't_m_biblio' => $t_m_biblio,
        't_m_sec1' => $t_m_sec1,
        't_m_sec2' => $t_m_sec2,
        't_m_viced' => $t_m_viced,
        't_m_gabinete' => $t_m_gabinete,
        'obs' => $obs,
        'horas' => $horas,
        'excluido' => $excluido,
        'fecha' => $fecha,
        'id2' => $id2,
    ]);
    echo "</pre>";

    // Consulta SQL para actualizar los datos
    $consulta = "UPDATE _junta_movimientos SET 
        tipo = :tipo, 
        anodoc = :anodoc, 
        codmod = :codmod, 
        establecimiento = :establecimiento, 
        titulo = :titulo, 
        promedioT = :promedioT, 
        antiguedadgestion = :antiguedadgestion, 
        antiguedadtitulo = :antiguedadtitulo, 
        serviciosprovincia = :serviciosprovincia, 
        otrosservicios = :otrosservicios, 
        residencia = :residencia, 
        publicaciones = :publicaciones, 
        otrosantecedentes = :otrosantecedentes, 
        puntajetotal = :puntajetotal, 
        codloc = :codloc, 
        t_m_seccion = :t_m_seccion, 
        t_m_anio = :t_m_anio, 
        t_m_grupo = :t_m_grupo, 
        t_m_ciclo = :t_m_ciclo, 
        t_m_recupera = :t_m_recupera, 
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
        o_g_a = :o_g_a, 
        o_g_b = :o_g_b, 
        o_g_c = :o_g_c, 
        o_g_d = :o_g_d, 
        concepto = :concepto, 
        otitulo = :otitulo, 
        t_m_comple = :t_m_comple, 
        t_m_biblio = :t_m_biblio, 
        t_m_sec1 = :t_m_sec1, 
        t_m_sec2 = :t_m_sec2, 
        t_m_viced = :t_m_viced, 
        t_m_gabinete = :t_m_gabinete, 
        obs = :obs, 
        horas = :horas, 
        excluido = :excluido, 
        fecha = :fecha 
    WHERE id2 = :id2";

    // Preparar la declaración
    $stmt = $conexion->prepare($consulta);

    // Vincular parámetros
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':anodoc', $anodoc, PDO::PARAM_STR);
    $stmt->bindParam(':codmod', $codmod, PDO::PARAM_STR);
    $stmt->bindParam(':establecimiento', $coddep, PDO::PARAM_STR);
    $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
    $stmt->bindParam(':promedioT', $promedioT, PDO::PARAM_STR);
    $stmt->bindParam(':antiguedadgestion', $antiguedadgestion, PDO::PARAM_STR);
    $stmt->bindParam(':antiguedadtitulo', $antiguedadtitulo, PDO::PARAM_STR);
    $stmt->bindParam(':serviciosprovincia', $serviciosprovincia, PDO::PARAM_STR);
    $stmt->bindParam(':otrosservicios', $otrosservicios, PDO::PARAM_STR);
    $stmt->bindParam(':residencia', $residencia, PDO::PARAM_STR);
    $stmt->bindParam(':publicaciones', $publicaciones, PDO::PARAM_STR);
    $stmt->bindParam(':otrosantecedentes', $otrosantecedentes, PDO::PARAM_STR);
    $stmt->bindParam(':puntajetotal', $puntajetotal, PDO::PARAM_STR);
    $stmt->bindParam(':codloc', $codloc);
    $stmt->bindParam(':t_m_seccion', $t_m_seccion, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_anio', $t_m_anio, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_grupo', $t_m_grupo, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_ciclo', $t_m_ciclo, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_recupera', $t_m_recupera, PDO::PARAM_STR);
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
    $stmt->bindParam(':o_g_a', $o_g_a, PDO::PARAM_STR);
    $stmt->bindParam(':o_g_b', $o_g_b, PDO::PARAM_STR);
    $stmt->bindParam(':o_g_c', $o_g_c, PDO::PARAM_STR);
    $stmt->bindParam(':o_g_d', $o_g_d, PDO::PARAM_STR);
    $stmt->bindParam(':concepto', $concepto, PDO::PARAM_STR);
    $stmt->bindParam(':otitulo', $otitulo, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_comple', $t_m_comple, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_biblio', $t_m_biblio, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_sec1', $t_m_sec1, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_sec2', $t_m_sec2, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_viced', $t_m_viced, PDO::PARAM_STR);
    $stmt->bindParam(':t_m_gabinete', $t_m_gabinete, PDO::PARAM_STR);
    $stmt->bindParam(':obs', $obs);
    $stmt->bindParam(':horas', $horas);
    $stmt->bindParam(':excluido', $excluido);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':id2', $id2, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    // Devolver una respuesta al cliente
    echo "Los datos se actualizaron correctamente.";

} catch (PDOException $e) {
    // Manejar errores de conexión o consultas SQL
    echo "Error al actualizar los datos: " . $e->getMessage();
}
exit;