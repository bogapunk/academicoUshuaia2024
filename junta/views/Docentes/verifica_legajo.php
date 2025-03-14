<?php
// verifica y vincula legajo
// verifica_legajo.php
if (isset($_POST['legajo'])) {
    $legajo = $_POST['legajo'];

    // Credenciales de la base de datos
    define('DB_HOST', '10.1.9.113');
    define('DB_USER', 'SA');
    define('DB_PASS', 'Davinci2024#');
    define('DB_NAME', 'junta');

    try {
        // Conectar a la base de datos
        $connect = new PDO("sqlsrv:Server=" . DB_HOST . ";Database=" . DB_NAME . ";TrustServerCertificate=True", DB_USER, DB_PASS);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verificar si el legajo ya existe
        $checkSql = "SELECT ApellidoyNombre FROM _junta_docentes WHERE legajo = :legajo";
        $checkStmt = $connect->prepare($checkSql);
        $checkStmt->bindParam(':legajo', $legajo, PDO::PARAM_INT);
        $checkStmt->execute();

        // Verificar si se encuentra el docente
        $docente = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($docente) {
            // Si el docente existe, devuelve el nombre completo
            echo json_encode(['status' => 'exists', 'docente' => $docente]);
        } else {
            // Si no se encuentra el legajo
            echo json_encode(['status' => 'not_found']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}


?>
