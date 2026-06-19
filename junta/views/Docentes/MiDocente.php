<?php
session_start();
require_once __DIR__ . '/../../junta_config.php';

/**
 * Normaliza una fecha de formulario a 'Y-m-d' para SQL Server.
 */
function parseFechaSqlServer($date)
{
    $date = trim((string) $date);
    if ($date === '') {
        return null;
    }

    if (preg_match('/^(\d{4}-\d{2}-\d{2})/', $date, $matches)) {
        $date = $matches[1];
    }

    $formats = array('Y-m-d', 'd/m/Y', 'd-m-Y');
    foreach ($formats as $format) {
        $dateTime = DateTime::createFromFormat($format, $date);
        if ($dateTime instanceof DateTime) {
            $errors = DateTime::getLastErrors();
            if (empty($errors['warning_count']) && empty($errors['error_count'])) {
                return $dateTime->format('Y-m-d');
            }
        }
    }

    return null;
}

function bindDateParam($stmt, $name, $value)
{
    if ($value === null) {
        $stmt->bindValue($name, null, PDO::PARAM_NULL);
        return;
    }
    $stmt->bindValue($name, $value, PDO::PARAM_STR);
}

function redirectRegistroDocente($type, $message)
{
    if (!isset($_SESSION['sessData'])) {
        $_SESSION['sessData'] = array();
    }
    $_SESSION['sessData']['estado'] = array(
        'type' => $type,
        'msg'  => $message,
    );
    header('Location: RegistroDocente.php');
    exit;
}

if (!isset($_POST['insertar'])) {
    header('Location: RegistroDocente.php');
    exit;
}

$legajo = isset($_POST['legajo']) ? trim($_POST['legajo']) : '';
$apellidoynombre = isset($_POST['apellidoynombre']) ? trim($_POST['apellidoynombre']) : '';
$dni = isset($_POST['dni']) ? trim($_POST['dni']) : '';
$Domicilio = isset($_POST['Domicilio']) ? trim($_POST['Domicilio']) : '';
$lugarinsc = isset($_POST['lugarinsc']) ? trim($_POST['lugarinsc']) : '';
$fechanacim = parseFechaSqlServer(isset($_POST['fechanacim']) ? $_POST['fechanacim'] : '');
$promedioT = isset($_POST['promedioT']) ? str_replace(',', '.', trim($_POST['promedioT'])) : '';
$telefonos = isset($_POST['telefonos']) ? trim($_POST['telefonos']) : '';
$Titulobas = isset($_POST['Titulobas']) ? trim($_POST['Titulobas']) : '';
$otorgadopor = isset($_POST['otorgadopor']) ? trim($_POST['otorgadopor']) : '';
$otrostit = isset($_POST['otrostit']) ? trim($_POST['otrostit']) : '';
$fingreso = parseFechaSqlServer(isset($_POST['fingreso']) ? $_POST['fingreso'] : '');
$cargosdocentes = isset($_POST['cargosdocentes']) ? trim($_POST['cargosdocentes']) : '';
$faperturaleg = parseFechaSqlServer(isset($_POST['faperturaleg']) ? $_POST['faperturaleg'] : '');
$Nacionalidad = isset($_POST['Nacionalidad']) ? trim($_POST['Nacionalidad']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$obsdoc = isset($_POST['obsdoc']) ? trim($_POST['obsdoc']) : '';

if ($legajo === '' || $apellidoynombre === '' || $dni === '') {
    redirectRegistroDocente('error', 'Complete legajo, apellido y nombre, y DNI.');
}
if ($fechanacim === null) {
    redirectRegistroDocente('error', 'La fecha de nacimiento es inválida o está incompleta.');
}
if ($fingreso === null) {
    redirectRegistroDocente('error', 'La fecha de residencia es inválida o está incompleta.');
}
if ($faperturaleg === null) {
    redirectRegistroDocente('error', 'La fecha de apertura de legajo es inválida o está incompleta.');
}

try {
    $connect = new PDO(
        'sqlsrv:Server=' . JUNTA_DB_HOST . ';Database=' . JUNTA_DB_NAME . ';TrustServerCertificate=True;ConnectionPooling=1;LoginTimeout=5',
        JUNTA_DB_USER,
        JUNTA_DB_PASS
    );
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO _junta_docentes
            (legajo, ApellidoyNombre, dni, Domicilio, lugarinsc, fechanacim, promedioT, telefonos, Titulobas, otorgadopor, otrostit, fingreso, cargosdocentes, faperturaleg, Nacionalidad, email, obsdoc)
            VALUES
            (:legajo, :apellidoynombre, :dni, :Domicilio, :lugarinsc, CAST(:fechanacim AS date), :promedioT, :telefonos, :Titulobas, :otorgadopor, :otrostit, CAST(:fingreso AS date), :cargosdocentes, CAST(:faperturaleg AS date), :Nacionalidad, :email, :obsdoc)";

    $stmt = $connect->prepare($sql);
    $stmt->bindValue(':legajo', (int) $legajo, PDO::PARAM_INT);
    $stmt->bindValue(':apellidoynombre', $apellidoynombre, PDO::PARAM_STR);
    $stmt->bindValue(':dni', (int) $dni, PDO::PARAM_INT);
    $stmt->bindValue(':Domicilio', $Domicilio, PDO::PARAM_STR);
    $stmt->bindValue(':lugarinsc', $lugarinsc, PDO::PARAM_STR);
    bindDateParam($stmt, ':fechanacim', $fechanacim);
    $stmt->bindValue(':promedioT', $promedioT, PDO::PARAM_STR);
    $stmt->bindValue(':telefonos', $telefonos, PDO::PARAM_STR);
    $stmt->bindValue(':Titulobas', $Titulobas, PDO::PARAM_STR);
    $stmt->bindValue(':otorgadopor', $otorgadopor, PDO::PARAM_STR);
    $stmt->bindValue(':otrostit', $otrostit, PDO::PARAM_STR);
    bindDateParam($stmt, ':fingreso', $fingreso);
    $stmt->bindValue(':cargosdocentes', $cargosdocentes, PDO::PARAM_STR);
    bindDateParam($stmt, ':faperturaleg', $faperturaleg);
    $stmt->bindValue(':Nacionalidad', $Nacionalidad, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':obsdoc', $obsdoc, PDO::PARAM_STR);

    if (!$stmt->execute()) {
        redirectRegistroDocente('error', 'No se pudieron agregar los datos. Comuníquese con el administrador.');
    }

    $_SESSION['docente_creado'] = array(
        'legajo'          => $legajo,
        'apellidoynombre' => $apellidoynombre,
        'dni'             => $dni,
    );
    header('Location: RegistroDocente.php');
    exit;
} catch (PDOException $e) {
    error_log('MiDocente insert error: ' . $e->getMessage());
    redirectRegistroDocente('error', 'Error al registrar docente: ' . $e->getMessage());
}
