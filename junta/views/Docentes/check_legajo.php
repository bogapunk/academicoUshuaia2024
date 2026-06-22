<?php

require_once __DIR__ . '/../seguridad_requiere_login.php';

require_once __DIR__ . '/../../junta_config.php';



header('Content-Type: application/json; charset=utf-8');



if (!isset($_POST['legajo']) || trim((string) $_POST['legajo']) === '') {

    echo json_encode(array('status' => 'error'));

    exit;

}



$legajo = (int) $_POST['legajo'];



try {

    $connect = new PDO(

        'sqlsrv:Server=' . JUNTA_DB_HOST . ';Database=' . JUNTA_DB_NAME . ';TrustServerCertificate=True;ConnectionPooling=1;LoginTimeout=5',

        JUNTA_DB_USER,

        JUNTA_DB_PASS

    );

    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    $checkSql = "SELECT TOP 1

            legajo,

            ApellidoyNombre,

            dni,

            Domicilio,

            lugarinsc,

            CONVERT(varchar(10), fechanacim, 23) AS fechanacim,

            promedioT,

            telefonos,

            Titulobas,

            CONVERT(varchar(10), fechatit, 23) AS fechatit,

            otorgadopor,

            CONVERT(varchar(10), finicio, 23) AS finicio,

            otrostit,

            CONVERT(varchar(10), fingreso, 23) AS fingreso,

            cargosdocentes,

            CONVERT(varchar(10), faperturaleg, 23) AS faperturaleg,

            Nacionalidad,

            email,

            obsdoc

        FROM _junta_docentes

        WHERE legajo = :legajo";



    $checkStmt = $connect->prepare($checkSql);

    $checkStmt->bindValue(':legajo', $legajo, PDO::PARAM_INT);

    $checkStmt->execute();

    $docente = $checkStmt->fetch(PDO::FETCH_ASSOC);



    if ($docente) {

        echo json_encode(array('status' => 'exists', 'docente' => $docente));

    } else {

        echo json_encode(array('status' => 'available'));

    }

} catch (PDOException $e) {

    error_log('check_legajo error: ' . $e->getMessage());

    echo json_encode(array('status' => 'error'));

}

