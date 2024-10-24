<?php
//start session
//session_start();
/*
if(isset($_POST['insertar'])){
///////////// Informacion enviada por el formulario /////////////
$legajo=$_POST['legajo'];
$apellidoynombre=$_POST['apellidoynombre'];
$dni=$_POST['dni'];
$domicilio=$_POST['domicilio'];
$lugarinsc=$_POST['lugarinsc'];
$fechanacim=$_POST['fechanacim'];
$promediot=$_POST['promediot'];
$telefonos=$_POST['telefonos'];
$titulobas=$_POST['titulobas'];
$fechatit=$_POST['fechatit'];
$otorgadopor=$_POST['otorgadopor'];
$finicio=$_POST['finicio'];
$otrostit=$_POST['otrostit'];
$fingreso=$_POST['fingreso'];
$cargosdocentes=$_POST['cargosdocentes'];
$faperturaleg=$_POST['faperturaleg'];
$nacionalidad=$_POST['nacionalidad'];
$obsdoc=$_POST['obsdoc'];

///////// Fin informacion enviada por el formulario ///
////////////// Insertar a la tabla la informacion generada /////////

// DB CREDENCIALES DE USUARIO.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','junta');
// Ahora, establecemos la conexión.
try
{
// Ejecutamos las variables y aplicamos UTF8
$connect = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,
array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}

$sql ="insert into _junta_docentes(legajo, apellidoynombre, dni, domicilio, lugarinsc, fechanacim, promediot, telefonos, titulobas, fechatit, otorgadopor, finicio, otrostit, fingreso,cargosdocentes, faperturaleg, nacionalidad, obsdoc) values(:legajo, :apellidoynombre, :dni, :domicilio, :lugarinsc, :fechanacim, :promediot, :telefonos, :titulobas, :fechatit, :otorgadopor, :finicio, :otrostit, :fingreso, :cargosdocentes, :faperturaleg, :nacionalidad, :obsdoc)";
$sql = $connect->prepare($sql);

$sql->bindParam(':legajo',$legajo,PDO::PARAM_INT,11 );
$sql->bindParam(':apellidoynombre',$apellidoynombre,PDO::PARAM_STR,90);
$sql->bindParam(':dni',$dni,PDO::PARAM_STR,12);
$sql->bindParam(':domicilio',$domicilio,PDO::PARAM_INT,50);
$sql->bindParam(':lugarinsc',$lugarinsc,PDO::PARAM_STR,30);
$sql->bindParam(':fechanacim',$fechanacim,PDO::PARAM_STR);
$sql->bindParam(':promediot',$promediot,PDO::PARAM_INT,5);
$sql->bindParam(':telefonos',$telefonos,PDO::PARAM_STR,50);
$sql->bindParam(':titulobas',$titulobas,PDO::PARAM_STR);
$sql->bindParam(':fechatit',$fechatit,PDO::PARAM_STR,12);
$sql->bindParam(':otorgadopor',$otorgadopor,PDO::PARAM_STR,50);
$sql->bindParam(':finicio',$finicio,PDO::PARAM_STR,15);
$sql->bindParam(':otrostit',$otrostit,PDO::PARAM_STR,50);
$sql->bindParam(':fingreso',$fingreso,PDO::PARAM_STR,15);
$sql->bindParam(':cargosdocentes',$cargosdocentes,PDO::PARAM_STR,25);
$sql->bindParam(':faperturaleg',$faperturaleg,PDO::PARAM_STR,15);
$sql->bindParam(':nacionalidad',$nacionalidad,PDO::PARAM_STR,25);
$sql->bindParam(':obsdoc',$obsdoc,PDO::PARAM_STR,70);


//$sql->bindParam(':comp',$comp,PDO::PARAM_STR);



 $result = $sql->execute();


if ($result) {
    // Obtener el último ID insertado
    $lastInsertId = $connect->lastInsertId();
    echo "<div class='content alert alert-primary'>Gracias. Tu Nombre es: $apellidoynombre. El legajo del docente creado es: $lastInsertId.</div> ";
    // Redirigir al usuario a RegistroModalidad.php después de unos segundos
    $redirect_time = 3; // tiempo en segundos antes de redirigir
    $redirect_url = "RegistroDocente.php";
    echo "<script>setTimeout(function() { window.location='$redirect_url'; }, $redirect_time * 1000);</script>";
} else {
    // Si hubo un error en la inserción
    echo "<div class='content alert alert-danger'>No se pueden agregar datos, comuníquese con el administrador.</div>";
    // Mostrar detalles del error
    print_r($sql->errorInfo());
}
}
*/
if(isset($_POST['insertar'])){
    // Variables recibidas del formulario
    $legajo = $_POST['legajo'];
    $apellidoynombre = $_POST['apellidoynombre'];
    $dni = $_POST['dni'];
    $Domicilio = $_POST['Domicilio'];
    $lugarinsc = $_POST['lugarinsc'];
    
    $fechanacim = $_POST['fechanacim'];
   
    $promedioT = $_POST['promedioT'];
    $telefonos = $_POST['telefonos'];
    $Titulobas = $_POST['Titulobas'];
    //$fechatit = $_POST['fechatit'];
    $otorgadopor = $_POST['otorgadopor'];
    //$finicio = $_POST['finicio'];
    $otrostit = $_POST['otrostit'];
    $fingreso = $_POST['fingreso'];
    $cargosdocentes = $_POST['cargosdocentes'];
    $faperturaleg = $_POST['faperturaleg'];
    $Nacionalidad = $_POST['Nacionalidad'];
    $email = $_POST['email'];
    $obsdoc = $_POST['obsdoc'];
   
    // Función para formatear la fecha
    function formatDate($date) {
        $dateTime = DateTime::createFromFormat('Y-m-d', $date); 
        return $dateTime ? $dateTime->format('Y-m-d H:i:s') : null; // Cambiamos el formato a 'Y-m-d H:i:s'
    }
    // Convertir las fechas
    $fechanacim = formatDate($fechanacim);
    //$fechatit = formatDate($fechatit);
    //$finicio = formatDate($finicio);
    $fingreso = formatDate($fingreso);
    $faperturaleg = formatDate($faperturaleg);

   

    // DB CREDENCIALES DE USUARIO.
    define('DB_HOST', '10.1.9.113');
    define('DB_USER', 'SA');
    define('DB_PASS', 'Davinci2024#');
    define('DB_NAME', 'junta');

    try {
        // Establecer la conexión a la base de datos
        $connect = new PDO("sqlsrv:Server=" . DB_HOST . ";Database=" . DB_NAME . ";TrustServerCertificate=True", DB_USER, DB_PASS);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar la consulta SQL
        $sql = "INSERT INTO _junta_docentes 
                (legajo, ApellidoyNombre, dni, Domicilio, lugarinsc, fechanacim, promedioT, telefonos, Titulobas, otorgadopor, otrostit, fingreso, cargosdocentes, faperturaleg, Nacionalidad,email, obsdoc) 
                VALUES 
                (:legajo, :apellidoynombre, :dni, :Domicilio, :lugarinsc, :fechanacim, :promedioT, :telefonos, :Titulobas,  :otorgadopor,  :otrostit, :fingreso, :cargosdocentes, :faperturaleg, :Nacionalidad, :email, :obsdoc)";
       
        $stmt = $connect->prepare($sql);

        // Enlazar parámetros
        $stmt->bindParam(':legajo', $legajo, PDO::PARAM_INT);
        $stmt->bindParam(':apellidoynombre', $apellidoynombre, PDO::PARAM_STR);
        $stmt->bindParam(':dni', $dni, PDO::PARAM_INT);
        $stmt->bindParam(':Domicilio', $Domicilio, PDO::PARAM_STR);
        $stmt->bindParam(':lugarinsc', $lugarinsc, PDO::PARAM_STR);
        $stmt->bindParam(':fechanacim', $fechanacim, PDO::PARAM_STR);
        $stmt->bindParam(':promedioT', $promedioT, PDO::PARAM_STR);
        $stmt->bindParam(':telefonos', $telefonos, PDO::PARAM_STR);
        $stmt->bindParam(':Titulobas', $Titulobas, PDO::PARAM_STR);
       // $stmt->bindParam(':fechatit', $fechatit, PDO::PARAM_STR);
        $stmt->bindParam(':otorgadopor', $otorgadopor, PDO::PARAM_STR);
        //$stmt->bindParam(':finicio', $finicio, PDO::PARAM_STR);
        $stmt->bindParam(':otrostit', $otrostit, PDO::PARAM_STR);
        $stmt->bindParam(':fingreso', $fingreso, PDO::PARAM_STR);
        $stmt->bindParam(':cargosdocentes', $cargosdocentes, PDO::PARAM_STR);
        $stmt->bindParam(':faperturaleg', $faperturaleg, PDO::PARAM_STR);
        $stmt->bindParam(':Nacionalidad', $Nacionalidad, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':obsdoc', $obsdoc, PDO::PARAM_STR);

        // Ejecutar la consulta
        $result = $stmt->execute(); // Aquí se ejecuta la consulta y se guarda el resultado en $result
        
        if ($result) {
            // Obtener el último ID insertado
            //$lastInsertId = $connect->lastInsertId();
           // $legajo = $connect->legajo();
            echo "<div class='content alert alert-primary'>Gracias. Tu Nombre es: $apellidoynombre. El legajo del docente creado es: $legajo.</div> ";
            // Redirigir al usuario a RegistroDocente.php después de unos segundos
            $redirect_time = 3; // tiempo en segundos antes de redirigir
            $redirect_url = "RegistroDocente.php";
            echo "<script>setTimeout(function() { window.location='$redirect_url'; }, $redirect_time * 1000);</script>";
        } else {
            // Si hubo un error en la inserción
            echo "<div class='content alert alert-danger'>No se pueden agregar datos, comuníquese con el administrador.</div>";
            // Mostrar detalles del error
            print_r($stmt->errorInfo());
        }
    } catch (PDOException $e) {
        // Manejo de errores de conexión
        exit("Error: " . $e->getMessage());
    }
}