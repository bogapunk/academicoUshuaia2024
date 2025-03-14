<?php 
require_once 'docentes.entidad.php';
require_once 'docentes.model.php';
include('header2.php');



// Logica
$doc = new Docente();
$model = new DocentesModel();

if(isset($_REQUEST['action']))
{
  switch($_REQUEST['action'])
  {
    case 'actualizar':
      $doc->__SET('id2',     $_REQUEST['id2']);
      $doc->__SET('legajo',     $_REQUEST['legajo']);
      $doc->__SET('apellidoynombre',  $_REQUEST['apellidoynombre']);
      $doc->__SET('dni',  $_REQUEST['dni']);
      $doc->__SET('domicilio',  $_REQUEST['domicilio']);
      $doc->__SET('lugarinsc',    $_REQUEST['lugarinsc']);
      $doc->__SET('fechanacim',    $_REQUEST['fechanacim']);
      $doc->__SET('promediot',    $_REQUEST['promediot']);
      $doc->__SET('telefonos',    $_REQUEST['telefonos']);
      $doc->__SET('titulobas',    $_REQUEST['titulobas']);
      $doc->__SET('fechatit',    $_REQUEST['fechatit']);
      $doc->__SET('otorgadopor',    $_REQUEST['otorgadopor']);
      $doc->__SET('finicio',    $_REQUEST['finicio']);
      $doc->__SET('fingreso',    $_REQUEST['fingreso']);
      $doc->__SET('cargosdocentes',    $_REQUEST['cargosdocentes']);
      $doc->__SET('faperturaleg',    $_REQUEST['faperturaleg']);
      $doc->__SET('nacionalidad',    $_REQUEST['nacionalidad']);
      $doc->__SET('obsdoc',    $_REQUEST['obsdoc']);

  
      $model->ActualizarDocente($doc);
     // header('Location: index.php');
      break;

    case 'registrar':
      $doc->__SET('id2',     $_REQUEST['id2']);
      $doc->__SET('legajo',     $_REQUEST['legajo']);
      $doc->__SET('apellidoynombre',  $_REQUEST['apellidoynombre']);
      $doc->__SET('dni',  $_REQUEST['dni']);
      $doc->__SET('domicilio',  $_REQUEST['domicilio']);
      $doc->__SET('lugarinsc',    $_REQUEST['lugarinsc']);
      $doc->__SET('fechanacim',    $_REQUEST['fechanacim']);
      $doc->__SET('promediot',    $_REQUEST['promediot']);
      $doc->__SET('telefonos',    $_REQUEST['telefonos ']);
      $doc->__SET('titulobas',    $_REQUEST['titulobas ']);
      $doc->__SET('fechatit',    $_REQUEST['fechatit ']);
      $doc->__SET('otorgadopor',    $_REQUEST['otorgadopor']);
      $doc->__SET('finicio',    $_REQUEST['finicio']);
      $doc->__SET('fingreso',    $_REQUEST['fingreso']);
      $doc->__SET('cargosdocentes',    $_REQUEST['cargosdocentes']);
      $doc->__SET('faperturaleg',    $_REQUEST['faperturaleg']);
      $doc->__SET('nacionalidad',    $_REQUEST['nacionalidad']);
      $doc->__SET('obsdoc',    $_REQUEST['obsdoc']);
      
      $model->RegistrarDocente($id2);
      //header('Location:ListarModalidades.php');
      break;

    case 'eliminar':
      $model->EliminarDocente($_REQUEST['id2']);
      //header('Location:ListarModalidades.php');
      break;

    case 'editar':
      $doc = $model->ObtenerDocente($_REQUEST['id2']);

    case 'modificar':
      $doc = $model->obtnerInscripcion($_REQUEST['id2']);
      

      break;
  }
}




?>
<!-- Begin Page Content -->

<style type="text/css">



.nav>li>a {
    position: relative;
    display: block;
    padding: 7px 15px;
}

thead{

    display: table-header-group;
    vertical-align: middle;
    border-color: inherit;
}
table {
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th {
  cursor: pointer;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}
* {
    margin: 0;
    padding: 0;
    border: o none;
    position: relative;
}
#menu_gral {
    font-family: verdana, sans sherif;
    width: 80%;
    margin: 1.5rem auto;
}
#menu_gral ul {
    list-style-type: none; 
    text-align: left;
    font-size: 0;
}
#menu_gral > ul li {
    display: inline-block;
    width: 25%;
    position: relative;
    background: #ffffff;
}
#menu_gral li a {
    display: block;
    text-decoration: none;
    font-size: 2rem;
    font-family: 'Roboto', sans-serif;
    background-color: #2698f3;
    font-size: 18px;
    line-height: 4rem;
    color: #fff;
}
#menu_gral li:hover a, #menu_gral li a:focus {
    background: #e55916;
    color: #fff;
}

#menu_gral li ul {
    position: absolute;
    width: 0;
    overflow: hidden;
}
#menu_gral li:hover ul, #menu_gral li:focus ul {
    width: 110%;
    margin: 0 -4rem -4rem -4rem;
    padding: 0 4rem 4rem 4rem;
   
    z-index: 5;
}
#menu_gral li li {
    display: block;
    width: 130%;
}
#menu_gral li:hover li a, #menu_gral li:focus li a {
    font-family: monospace;
    font-size: .9rem;
    line-height: 1.7rem;
    border-top: 1px solid #e5e5e5;
    background: #e55916;
}
#menu_gral li li a:hover, #menu_gral li li a:focus {
    background: #8AA9B8; 
}
.results tr[visible='false'],
.no-result{
  display:none;
}

.results tr[visible='true']{
  display:table-row;
}

.counter{
  padding:8px; 
  color:#ccc;
}

.btn-flotante {
  font-size: 10px; /* Cambiar el tamaño de la tipografia */
  text-transform: uppercase; /* Texto en mayusculas */
  font-weight: bold; /* Fuente en negrita o bold */
  color: #FFFFFF; /* Color del texto */
  border-radius: 5px; /* Borde del boton */
  letter-spacing: 2px; /* Espacio entre letras */
  background-color: #2698f3; /* Color de fondo */
  padding: 18px 25px; /* Relleno del boton */
  position: fixed;
  bottom: 5px;
  right: 20px;
  transition: all 300ms ease 0ms;
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
  z-index: 99;
}
.btn-flotante:hover {
  background-color: #e55916; /* Color de fondo al pasar el cursor */
  box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
  transform: translateY(-7px);
}
@media only screen and (max-width: 600px) {
  .btn-flotante {
    font-size: 5px;
    padding: 12px 20px;
    bottom: 20px;
    right: 20px;
  }
}

.detalle-button {
  background-color: #ff7300; /* Color de fondo */
  border: none; /* Sin borde */
  color: white; /* Color de texto */
  padding: 8px 16px; /* Espacio de relleno */
  text-align: center; /* Alineación del texto */
  text-decoration: none; /* Sin subrayado */
  display: inline-block; /* Mostrar como bloque en línea */
  font-size: 14px; /* Tamaño de fuente */
  margin: 4px 2px; /* Margen superior e inferior */
  cursor: pointer; /* Cursor al pasar */
  border-radius: 4px; /* Radio del borde */
}

/* Cambio de color al pasar el mouse sobre el botón */
.detalle-button:hover {
  background-color: #45a049; /* Color de fondo cuando se pasa el mouse */
}

/* Cambio de color cuando el botón está activo (seleccionado) */
.detalle-button:active {
  background-color: #367c39; /* Color de fondo cuando se selecciona */
}
/* aca va el estilo de los imput */
.materialize-input1 {
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 0px 0px; /* Adjust padding for a comfortable fit */
  font-size: 15px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 28%; /* Make the input element fill the container */
  cursor: pointer;
  /* Add the focus styling here */
  &:focus {
    border-color: #42a5f5; /* Change border color to blue on focus */
  }
}
.materialize-input2 {
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add unde.materialize-input1 rline border */
  background-color: transparent; /* Transparent background */
  padding: 0px 0px; /* Adjust padding for a comfortable fit */
  font-size: 15px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 65%; /* Make the input element fill the container */
  cursor: pointer;
}



.materialize-input3 {
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 0px 0px; /* Adjust padding for a comfortable fit */
  font-size: 15px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 10%; /* Make the input element fill the container */
  cursor: pointer;
  /* Add the focus styling here */
  &:focus {
    border-color: #42a5f5; /* Change border color to blue on focus */
  }
}


.materialize-input_obs {
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 0px 0px; /* Adjust padding for a comfortable fit */
  font-size: 13px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: %; /* Make the input element fill the container */
  cursor: pointer;
  /* Add the focus styling here */
  &:focus {
    border-color: #42a5f5; /* Change border color to blue on focus */
  }
}
.materialize-input_obs:focus {
  border-color: #42a5f5; /* Change border color to blue on focus */
  /* Additional focus styling */
  box-shadow: 0 0 5px rgba(66, 165, 245, 0.5); /* Add box shadow on focus */
  /* Add any other focus styles here */
}



.materialize-input2:focus {
  border-color: #42a5f5; /* Change border color to blue on focus */
  /* Additional focus styling */
  box-shadow: 0 0 5px rgba(66, 165, 245, 0.5); /* Add box shadow on focus */
  /* Add any other focus styles here */
}
.materialize-input1:focus {
  border-bottom: 2px solid #42a5f5; /* Thicker and blue border on focus */
}

.materialize-input1:focus + label {
  color: #42a5f5; /* Change label color to blue on focus */
}

.materialize-input3:focus {
  border-bottom: 2px solid #42a5f5; /* Thicker and blue border on focus */
}

.materialize-input3:focus + label {
  color: #42a5f5; /* Change label color to blue on focus */
}


.materialize-select3 {
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 0px 0; /* Adjust padding for a comfortable fit */
  font-size: 16px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 85%; /* Make the select element fill the container */
  cursor: pointer; /* Indicate interactivity on hover */
  &:focus {
    border-color: #42a5f5; /* Change border color to blue on focus */
  }
}

.materialize-select4 {
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 0px 0; /* Adjust padding for a comfortable fit */
  font-size: 16px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 67%; /* Make the select element fill the container */
  cursor: pointer; /* Indicate interactivity on hover */
  font-weight: bold;
  &:focus {
    border-color: #42a5f5; /* Change border color to blue on focus */
  }
}
.materialize-select5 {
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 0px 0; /* Adjust padding for a comfortable fit */
  font-size: 16px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width:100%; /* Make the select element fill the container */
  cursor: pointer; /* Indicate interactivity on hover */
  font-weight: bold;
  &:focus {
    border-color: #42a5f5; /* Change border color to blue on focus */
  }
}


.hidden {
            display: none;
        }




</style>
<link rel="icon" type="./image/png" href="./imagenes/escudo-32x32.png">
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Agencia de innovacion</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!--  esto son los archivos de exportacion -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
      <!-- sweeteralert2 -->
      <link rel="stylesheet" href="../Assets/swal2/sweetalert2.min.css" type="text/css" />

      <!--aca esta las extensiones para el paginado de la las tablas --->
  
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

  
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>




</head>
<body>
  <div class="container">
   <center> <h1><u>Movimiento Nuevo</u></h1></center>
  <br>
  <br>

<?php
// Te recomiendo utilizar esta conexión, la que utilizas ya no es la recomendada.
// conexion anterior $link = new PDO('mysql:host=localhost;dbname=junta', 'root', ''); // el campo vaciío es para la password.
// Datos de conexión a la base de datos

// Datos de conexión a la base de datos
$serverName = "10.1.9.113"; // Servidor de SQL Server
$database = "junta"; // Nombre de la base de datos
$username = "SA"; // Usuario de la base de datos
$password = 'Davinci2024#'; // Contraseña de la base de datos (eliminé las comillas innecesarias)

// DSN para SQL Server con TrustServerCertificate activado
$dsn = "sqlsrv:Server=$serverName;Database=$database;TrustServerCertificate=True";

try {
    // Crear una nueva conexión PDO
    $link = new PDO($dsn, $username, $password);

    // Configurar el modo de error de PDO a excepción
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
<?php

if (isset($_SESSION['message'])) {
  ?>
  <div class="alert alert-info text-center" style="margin-top:20px;">
    <?php echo $_SESSION['message']; ?>
  </div>
  <?php

  unset($_SESSION['message']);
}
?>


<?php
// Definir el parámetro legajo
if (isset($_GET['legajo'])) {
  $legajo = $_GET['legajo'];
} else {
  die("El parámetro 'legajo' no está presente en la URL.");
}

// Configuración de la conexión a SQL Server
$serverName = "10.1.9.113"; // Dirección y puerto del servidor SQL Server
$connectionOptions = array(
  "Database" => "junta",
  "Uid" => "SA", // Usuario de la base de datos
  "PWD" => 'Davinci2024#',
    "TrustServerCertificate"=>true,    // Contraseña de la base de datos
  "CharacterSet" => "UTF-8" // Para caracteres especiales
);

// Configuración de las opciones de conexión para manejar certificados auto-firmados
$connectionOptions['TrustServerCertificate'] = true; // Ignorar problemas de certificados SSL

// Establecer la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Comprobar la conexión
if ($conn === false) {
  die("Error de conexión: " . print_r(sqlsrv_errors(), true));
}

// Consulta SQL
$query = "SELECT legajo, apellidoynombre, fechanacim, titulobas, promediot, otrostit, cargosdocentes, fingreso FROM _junta_docentes WHERE legajo = ?";
$params = array($legajo);
$stmt = sqlsrv_query($conn, $query, $params);

// Verificar si se encontraron docentes
if ($stmt === false) {
  die("Error en la consulta: " . print_r(sqlsrv_errors(), true));
}


// Consulta SQL
$query = "SELECT legajo, apellidoynombre, fechanacim, titulobas, promediot, otrostit, cargosdocentes, fingreso FROM _junta_docentes WHERE legajo = ?";
$params = array($legajo);
$stmt = sqlsrv_query($conn, $query, $params);

// Verificar si se encontraron docentes
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_has_rows($stmt)) {
    echo "<table border='1'>";
    echo "<tr><th>Legajo</th><th>Apellido y Nombre</th><th>Detalle</th></tr>";

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $legajo = $row['legajo'];
        $apellidoynombre = $row['apellidoynombre'];
        if ($row['fechanacim'] == null){
          $fechanacim = $row['fechanacim'];
        }else{
          $fechanacim = $row['fechanacim']->format('d/m/Y'); 
        } 
        $titulobas = $row['titulobas'];
        $promediot = $row['promediot'];
        $otrostit = $row['otrostit'];
        $cargosdocentes = $row['cargosdocentes'];
       // $fingreso = $row['fingreso']->format('d/m/Y'); // Si `fingreso` es un campo datetime
        if ($row['fingreso'] == null){
          $fingreso = $row['fingreso'];
        }else{
          $fingreso = $row['fingreso']->format('d/m/Y'); 
        } 
        echo "<tr>";
        echo "<td>{$legajo}</td>";
        echo "<td>{$apellidoynombre}</td>";
        echo "<td><button type='button' onclick='showDetails(\"$legajo\")' class='detalle-button' title='Detalle del Docente'> <i class='glyphicon glyphicon-list-alt'></i> Detalle</button></td>";
        echo "</tr>";

        // Detalles del docente (oculto por defecto)
        echo "<tr id='details_$legajo' style='display:none'>";
        echo "<td colspan='3'><b>Detalles del Docente</b></td>";
        echo "</tr>";
        echo "<tr id='details_info_$legajo' style='display:none'>";
        echo "<td>Fecha Nac.:</td><td colspan='2'>{$fechanacim}</td>";
        echo "</tr>";
        echo "<tr id='details_info_$legajo' style='display:none'>";
        echo "<td>Tít. Básico:</td><td colspan='2'>{$titulobas}</td>";
        echo "</tr>";
        echo "<tr id='details_info_$legajo' style='display:none'>";
        echo "<td>Promedio:</td><td colspan='2'>{$promediot}</td>";
        echo "</tr>";
        echo "<tr id='details_info_$legajo' style='display:none'>";
        echo "<td>Otro título:</td><td colspan='2'>{$otrostit}</td>";
        echo "</tr>";
        echo "<tr id='details_info_$legajo' style='display:none'>";
        echo "<td>Cargo Docente:</td><td colspan='2'>{$cargosdocentes}</td>";
        echo "</tr>";
        echo "<tr id='details_info_$legajo' style='display:none'>";
        echo "<td>Residencia:</td><td colspan='2'>{$fingreso}</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron docentes en la base de datos.";
}

// Liberar el statement y cerrar la conexión
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

?>
<!--Este script me muestra la tabla con mas detalle del docente -->
<script type="text/javascript">
function showDetails(legajo) {
  var detailsElement = document.getElementById("details_" + legajo);
  var detailsInfoElements = document.querySelectorAll("[id^='details_info_" + legajo + "']");
  if (detailsElement.style.display === "none") {
    detailsElement.style.display = "table-row"; // Mostrar la fila de detalles
    detailsInfoElements.forEach(function(item) {
      item.style.display = "table-row"; // Mostrar las filas de detalles adicionales
    });
  } else {
    detailsElement.style.display = "none"; // Ocultar la fila de detalles
    detailsInfoElements.forEach(function(item) {
      item.style.display = "none"; // Ocultar las filas de detalles adicionales
    });
  }
}
</script>
<!--aca coloco el script del tipo si me habilita o no los campos observacion y horas si es del tipo titular -->
<script>
        function habilitarTipo(value) {
            var fechaCampo = document.getElementById('fechaCampo');
            var observacionTipo = document.getElementById("observacionTipo");
            var horasTipo = document.getElementById("horasTipo");
            var thObservaciones = document.getElementById("thObservaciones");
            var thHoras = document.getElementById("thHoras");
            
          
            // Mostrar/ocultar campos según el valor del select
            if (value === 'permanente') {
                fechaCampo.style.display = 'table-row';
            } else {
                fechaCampo.style.display = 'none';
            }

            if (value === "titulares") {
                thObservaciones.style.display = "table-row";
                thHoras.style.display = "table-row";
                observacionTipo.style.display = "table-cell";
                horasTipo.style.display = "table-cell";
            } else {
                thObservaciones.style.display = "none";
                thHoras.style.display = "none";
                observacionTipo.style.display = "none";
                horasTipo.style.display = "none";
            }

           
        }
</script>
<?php
// Consulta SQL para obtener todas las modalidades
// Configuración de la conexión a SQL Server
$serverName = "10.1.9.113"; // Cambia esto si tu servidor no es localhost
$connectionOptions = array(
    "Database" => "junta",
    "Uid" => "SA", // Cambia esto a tu usuario real
    "PWD" => 'Davinci2024#',     // Cambia esto a tu contraseña real
    "TrustServerCertificate"=>True,
    "CharacterSet" => 'UTF-8'
);

// Establecer la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Comprobar la conexión
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Consulta SQL para obtener todas las modalidades
$queryModalidades = "SELECT codmod, nommod FROM _junta_modalidades ORDER BY codmod ASC;";
$stmt = sqlsrv_query($conn, $queryModalidades);

$modalidades = array(); // Array para almacenar los datos de modalidades

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

while ($rowModalidad = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $modalidades[$rowModalidad['codmod']] = $rowModalidad['nommod'];
}

// Liberar el statement y cerrar la conexión
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>

<center><h4><u>Carga de Movimiento</u></h4></center>
<form action="MovimientoNuevo.php" method="post"> 
<div id="antartidaFields" style="display: none;">
    <label for="legajo">Legajo viculado:</label>
    <input type="text" name="legajo2" id="legajo" placeholder="Ingrese legajo" />

    <span id="legajoStatus"></span> <!-- Aquí mostramos el estado del legajo -->

    <label for="checkboxAntartida">Marque para confirmar</label>
    <input type="checkbox" name="checkboxAntartida" id="checkboxAntartida" />
     <!-- Campo para la cantidad de hijos -->
     <label for="numHijos">Cantidad de Hijos:</label>
    <input type="number" name="hijos" id="hijos" placeholder="cantidad de hijos" min="0" style="width: 80px;"  />
</div>
<input type="hidden" name="legajo" value="<?php echo htmlspecialchars($legajo); ?>">
    <table border='2'>
        <tr>
            <th>Curso: &nbsp &nbsp;<input type="text" id="anodoc" class="materialize-input1" name="anodoc"  required></th>         
        </tr>
        <tr>
           <!-- <th>Cod.Mod: &nbsp;<input type="text" id="codmod" class="materialize-input1" name="codmod"  required></th>-->
           
         <tr>
         <th>Cód. Mod: 
    <input type="text" name="codmod" id="codmod" 
           value="<?php echo isset($row['codmod']) ? htmlspecialchars($row['codmod'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
           size="8" onchange="fetchModalidad()">
</th>

<th>Modalidad:
    <select name="modalidad" id="modalidad" style="width: 331px;">
        <?php if (!empty($modalidades)): ?>
            <?php foreach ($modalidades as $modalidad): ?>
                <option value="<?php echo htmlspecialchars($modalidad, ENT_QUOTES, 'UTF-8'); ?>" 
                    <?php echo isset($row['nommod']) && trim($row['nommod']) === trim($modalidad) ? "selected='selected'" : ""; ?>>
                    <?php echo htmlspecialchars($modalidad, ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="">No hay modalidades disponibles</option>
        <?php endif; ?>
    </select>
</th>
<!-- JavaScript para dejar selccionado el legajo 2 -->
<script>
document.getElementById("checkboxAntartida").addEventListener("change", function() {
    let legajoInput = document.getElementById("legajo");
    
    if (this.checked) {
        legajoInput.readOnly = true; // Bloquea el campo
    } else {
        legajoInput.readOnly = false; // Desbloquea el campo si se desmarca
    }
});


  </script>

<!-- JavaScript verifica el codigo modalidad -->
<script>
function fetchModalidad() {
    const codmod = document.getElementById('codmod').value;

    if (codmod.trim()) { // Validar que el código no esté vacío
        // Realizar la solicitud AJAX
        fetch('buscar_por_codigo.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'codmod=' + encodeURIComponent(codmod) // Escapar el valor
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor.');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const modalidadSelect = document.getElementById('modalidad');
                modalidadSelect.innerHTML = ''; // Limpiar el select

                // Crear y agregar la opción de modalidad encontrada
                const option = document.createElement('option');
                option.value = data.nommod;
                option.text = data.nommod;
                option.selected = true; // Preseleccionar la opción
                modalidadSelect.appendChild(option);
            } else {
                alert(data.error || 'No se encontró la modalidad.');
            }
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
            alert('Hubo un error al procesar la solicitud.');
        });
    } else {
        alert('Por favor, ingrese un código de modalidad válido.');
    }
}
</script>
              </select></th>
                <td> <b>Tipo Listado:</b>
                <select name="tipoc" id="tipoc" class="materialize-select4" onchange="habilitarTipo(this.value)" style='width: 150px;'>
                          <option value=""><strong>Seleccione</strong></option>
                          <option value="permanente"><strong>Permanente</strong></option>
                          <option value="titulares"><strong>Titulares</strong></option>
                          <option value="transitorio"><strong>Interinatos y Suplencias</strong></option>
                          <option value="concurso"><strong>Concurso de Titularidad</strong></option>
                      </select>
  
                 </td>
            </th>
        </tr>
        <tr>    
                      <tr>
        <th id="fechaCampo"  style="display: none;">Fecha:&nbsp;&nbsp;<input type="date" id="fecha" name="fecha" class="materialize-input2"></th>
        </tr>

<th id='thObservaciones'  style='display: none;'>Observaciones: <input type="text" id="obs" class="materialize-input_obs" name="obs" ></th>
<th id='thHoras' style='display: none;'>Horas: <input type="number" id="horas" class="materialize-input1" name="horas" style='width: 50px;'></th>

                

<?php
// Realiza la consulta para obtener los nombres y IDs de los establecimientos
// Configuración de la conexión a SQL Server
$serverName = "10.1.9.113"; // Cambia esto si tu servidor no es localhost
$connectionOptions = array(
    "Database" => "junta",
    "Uid" => "SA", // Cambia esto a tu usuario real
    "PWD" => 'Davinci2024#',     // Cambia esto a tu contraseña real
    "TrustServerCertificate"=>True,
    "CharacterSet" => 'UTF-8'
);

// Establecer la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Comprobar la conexión
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Consulta SQL para obtener todos los establecimientos
$queryEstablecimientos = "
    SELECT iddep, nomdep, coddep
FROM _junta_dependencias
ORDER BY 
    CASE 
        WHEN nomdep COLLATE Latin1_General_CI_AI LIKE '%jardín%' THEN 1
        WHEN nomdep COLLATE Latin1_General_CI_AI LIKE '%escuela%' THEN 2
        ELSE 3
    END,
    -- Extraer el número más robustamente, eliminando texto adicional
    TRY_CAST(
        TRIM(REPLACE(REPLACE(REPLACE(REPLACE(
            SUBSTRING(nomdep, PATINDEX('%[0-9]%', nomdep), LEN(nomdep)),
            '-', ''), 'TOLHUIN', ''), 'ALMANZA', ''), 'N°', ''))
        AS INT
    ),
    coddep;
";
$stmt = sqlsrv_query($conn, $queryEstablecimientos);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Muestra el campo de selección con los nombres de los establecimientos
echo "<th id='thEstablecimiento' style='display:none;'>Establecimiento:
    <select name='establecimiento' id='establecimiento' class='materialize-select4'>";

// Itera sobre los resultados de la consulta
while ($rowEstablecimiento = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $idEstablecimiento = $rowEstablecimiento['iddep'];
    $nombreEstablecimiento = $rowEstablecimiento['nomdep'];
    $codigoEstablecimiento = $rowEstablecimiento['coddep'];
    
    // Codificar caracteres especiales HTML en el nombre del establecimiento
    $nombreEstablecimientoHTML = htmlspecialchars($nombreEstablecimiento);

    // Verificar si el ID recibido coincide con el ID obtenido
    if ($idEstablecimiento === $receivedID) {
        // Opción seleccionada si coincide
        echo "<option value='$codigoEstablecimiento' data-coddep='$idEstablecimiento' selected>$nombreEstablecimientoHTML</option>";
    } else {
        // Otra opción de nomdep
        echo "<option value='$codigoEstablecimiento' data-coddep='$idEstablecimiento'>$nombreEstablecimientoHTML</option>";
    }
}

echo "</select></th>";



// Liberar el statement y cerrar la conexión
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo "</select></th>"; // Cierra el campo de selección'''''''


// Campo oculto para enviar el coddep seleccionado
echo "<input type='hidden' name='coddep' id='coddep' value=''>";

// Script para actualizar el valor del campo oculto coddep
echo "
<script>
function updateCoddep() {
  var select = document.getElementById('establecimiento');
  var selectedOption = select.options[select.selectedIndex];
  var coddep = selectedOption.getAttribute('data-coddep');
  document.getElementById('coddep').value = coddep;
}

// Actualiza el valor al cambiar la selección
document.getElementById('establecimiento').addEventListener('change', updateCoddep);

// Inicializa el valor al cargar la página
document.addEventListener('DOMContentLoaded', function() {
  updateCoddep();
});
</script>";

// Verificar si el formulario se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener el valor seleccionado del campo de selección 'establecimiento'
  $nomdep = isset($_POST['establecimiento']) ? $_POST['establecimiento'] : '';

  // Verificar si se ha seleccionado un establecimiento
  if (!empty($nomdep)) {
      try {
          // Configuración de la conexión a SQL Server
          $serverName = "10.1.9.113"; // Nombre del servidor SQL Server
          $connectionOptions = array(
              "Database" => "junta", // Nombre de la base de datos
              "Uid" => "SA", // Usuario de la base de datos
              "TrustServerCertificate"=>True,
              "PWD" => 'Davinci2024#' // Contraseña de la base de datos
          );

          // Establecer la conexión
          $conn = sqlsrv_connect($serverName, $connectionOptions);

          if ($conn === false) {
              die(print_r(sqlsrv_errors(), true));
          }

          // Preparar la consulta SQL para insertar el establecimiento
          $queryInsertar = "INSERT INTO _junta_movimientos (establecimiento) VALUES (?)";
          $params = array($nomdep);
          $stmt = sqlsrv_prepare($conn, $queryInsertar, $params);

          // Ejecutar la consulta preparada
          if (sqlsrv_execute($stmt) === false) {
              die(print_r(sqlsrv_errors(), true));
          }

          // Verificar si se insertó correctamente
          $rowsAffected = sqlsrv_rows_affected($stmt);
          if ($rowsAffected > 0) {
              echo "Establecimiento seleccionado: " . htmlspecialchars($nomdep) . " ha sido guardado correctamente.";
          } else {
              echo "Error al guardar el establecimiento.";
          }

          // Cerrar la conexión y la declaración preparada
          sqlsrv_free_stmt($stmt);
          sqlsrv_close($conn);

      } catch (Exception $e) {
          echo "Error: " . $e->getMessage();
      }
  } else {
      echo "No se ha seleccionado ningún establecimiento.";
  }
}

?>

<?php
// Consulta SQL para obtener los valores únicos de codloc desde _junta_movimientos
// Configuración de la conexión a SQL Server
$serverName = "10.1.9.113"; // Cambia esto si tu servidor no es localhost
$connectionOptions = array(
    "Database" => "junta",
    "Uid" => "SA", // Cambia esto a tu usuario real
    "PWD" => 'Davinci2024#',
    "TrustServerCertificate"=>True,// Cambia esto a tu contraseña real
    "CharacterSet" => "UTF-8" // para que lea los acentos y ñ
);

// Establecer la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Comprobar la conexión
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Consulta SQL para obtener las localidades distintas
$queryLocalidades = "SELECT DISTINCT codloc FROM _junta_movimientos";
$stmtLocalidades = sqlsrv_query($conn, $queryLocalidades);

if ($stmtLocalidades === false) {
    die(print_r(sqlsrv_errors(), true));
}

$localidades = array(); // Array para almacenar los códigos de localidades

// Guardar los códigos de localidades en un array
while ($rowLocalidad = sqlsrv_fetch_array($stmtLocalidades, SQLSRV_FETCH_ASSOC)) {
    $localidades[] = $rowLocalidad['codloc'];
    
}

// Nombres de las localidades (puedes modificar según tus necesidades)
$nombreLocalidades = array(
    'RGD' => 'Rio Grande',
    'USH' => 'Ushuaia',
    'TOL' => 'Tolhuin',
    'ANT' => 'Antartida'
);
// Asegúrate de que el array $localidades esté correctamente definido
$localidades = ['RGD', 'USH', 'TOL', 'ANT'];  // Array de localidades, incluye 'ANT' para Antartida

?>

<th>Localidad:
    <select name='codloc' class="materialize-select3" style='width: 160px;' id="selectLocalidad">
        <option value="">Seleccione</option>
        <?php 
        foreach ($localidades as $localidad) {
            $nombreLocalidad = isset($nombreLocalidades[$localidad]) ? $nombreLocalidades[$localidad] : $localidad;
            echo "<option value='$localidad'>$nombreLocalidad</option>";
        }
        ?>
    </select>
    
</th>



<script>
 document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("selectLocalidad").addEventListener("change", function() {
        var selectedValue = this.value;
        var antartidaFields = document.getElementById("antartidaFields");

        if (selectedValue === "ANT") {
            antartidaFields.style.display = "block";
        } else {
            antartidaFields.style.display = "none";
            document.getElementById("legajo").value = ""; // Limpiar legajo si no se selecciona Antártida
            document.getElementById("legajoStatus").innerHTML = ""; // Limpiar mensaje de estado
        }
    });

    document.getElementById("legajo").addEventListener("input", function() {
        var legajo = this.value.trim();
        var statusMessage = document.getElementById("legajoStatus");

        // Depuración: Mostrar el valor de legajo2 en la consola
        var legajo2Value = document.querySelector('[name="legajo2"]').value;
        console.log("Legajo2 enviado:", legajo2Value);

        if (legajo !== "") {
            // Realizar la consulta AJAX para verificar si el legajo existe
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "verifica_legajo.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    console.log(response);  // Depuración

                    if (response.status === "exists") {
                        statusMessage.innerHTML = "<span style='color: green;'>Legajo válido. Docente: " 
                            + response.docente.ApellidoyNombre + "</span>";
                    } else if (response.status === "not_found") {
                        statusMessage.innerHTML = "<span style='color: red;'>Legajo no encontrado.</span>";
                    } else {
                        statusMessage.innerHTML = "<span style='color: red;'>Error al verificar el legajo.</span>";
                    }
                }
            };
            xhr.send("legajo=" + legajo);
        } else {
            statusMessage.innerHTML = ""; // Limpiar mensaje si el campo está vacío
        }
    });
});


</script>
      </th>

      <?php
echo "<th>";
$excluidoSeleccionado = isset($_GET['excluido']) ? $_GET['excluido'] : "23"; // Valor por defecto 23 si no se pasa un valor

// Si no hay valor para 'excluido', el checkbox no está marcado
$excluirChecked = ($excluidoSeleccionado == "23") ? "" : "checked";

// Mostrar el select de motivos oculto por defecto
$display = ($excluidoSeleccionado == "23") ? "none" : "block"; // Ocultar si es 23

$queryMotivos = "SELECT idexclu, motivo FROM _junta_motivosexclusion";
$resultMotivos = sqlsrv_query($conn, $queryMotivos);

if ($resultMotivos && sqlsrv_has_rows($resultMotivos)) {
    echo "<div style='display: flex; align-items: center;'>"; // Contenedor flexible
    echo "<label for='excluir' style='margin-right: 10px; margin-bottom: -3px;'>Excluir Inscripción</label>";

    // Checkbox de exclusión
    echo "<input type='checkbox' id='excluir' name='excluido_checkbox' onclick='toggleMotivosExclusion(this)' style='transform: scale(0.9); margin-right: 10px;' $excluirChecked>";

    // Menú desplegable de motivos de exclusión (oculto por defecto)
    echo "<select id='motivosExclusion' name='excluido' style='display: $display; width: 127px;'>";
    echo "<option value='23' " . ($excluidoSeleccionado == "23" ? "selected" : "") . ">Ningún motivo de exclusión</option>"; // Opción por defecto

    while ($rowMotivo = sqlsrv_fetch_array($resultMotivos, SQLSRV_FETCH_ASSOC)) {
        $selected = ($rowMotivo['idexclu'] == $excluidoSeleccionado) ? "selected" : "";
        echo "<option value='" . $rowMotivo['idexclu'] . "' $selected>" . $rowMotivo['motivo'] . "</option>";
    }
    
    echo "</select>";

    // Campo oculto para guardar el motivo de exclusión seleccionado
    echo "<input type='hidden' name='idexclu' id='idexclu' value='" . htmlspecialchars($excluidoSeleccionado, ENT_QUOTES, 'UTF-8') . "'>";

    echo "</div>"; // Cerrar contenedor flexible

    // Script mejorado
    echo "<script>
    function toggleMotivosExclusion(checkbox) {
        var select = document.getElementById('motivosExclusion');
        var hiddenInput = document.getElementById('idexclu');

        if (checkbox.checked) {
            select.style.display = 'block'; // Mostrar el menú desplegable si el checkbox está marcado
        } else {
            select.style.display = 'none'; // Ocultar el menú desplegable si el checkbox está desmarcado
            select.selectedIndex = 0; // Reiniciar selección cuando se desmarca el checkbox
            hiddenInput.value = '23'; // Valor por defecto '23' cuando no se selecciona nada
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        var select = document.getElementById('motivosExclusion');
        var hiddenInput = document.getElementById('idexclu');

        select.addEventListener('change', function() {
            hiddenInput.value = select.value; // Asignar el valor seleccionado al campo oculto
        });

        // Asegurar que el menú desplegable esté visible si el checkbox ya está marcado al cargar la página
        if (document.getElementById('excluir').checked) {
            select.style.display = 'block';
        }
    });
    </script>";
} else {
    echo "No se encontraron motivos de exclusión en la base de datos.";
}
echo "</th>";
echo "</table>"; // Cierre de la tabla
?>
<!-- HTML para el formulario -->

    <!-- Tabla para Permanente, Concurso, Interino -->
    <table id="tablaPermanenteConcursoInterino" style="display: none;">
        <tr>
            <td>
            <h3><u>CARGA COMUN</u> </h3>
              <br>
                <label for="comun_puntajetotal" style="display: inline-block; width: 225px;">Puntaje Total:</label>
                <input type='number' id='puntajetotal2' name='puntajetotal2' value='" . htmlspecialchars($row['puntajetotal']) . "' step='0.01' size='5' readonly>
                <br><br>

                <label for="titulo" style="display: inline-block; width: 225px;">1.- Título:</label>
                <input type="number" id="titulo2" name="titulo2" class="materialize-input3" size="10"  step="0.01" onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()' >
                <br>

                <label for="otrostit" style="display: inline-block; width: 225px;">2.- Otros Título:</label>
                <input type="number" id="otitulo2" name="otitulo2" class="materialize-input3" size="10" step="0.01" onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>
                <br>

             <!-- Campo Conceptos -->
                    <div id="conceptoField" style="display: none;">
                        <label for="concepto2" style="display: inline-block; width: 225px;">3.- Conceptos:</label>
                        <input type="number" id="concepto2" name="concepto2" class="materialize-input3" size="10" step="0.01">
                        <br>
                    </div>
                <label for="promedio" style="display: inline-block; width: 225px;">3.- Promedio:</label>
                <input type="number" id="promedio2" name="promedio2" class="materialize-input3" size="10" step="0.01" onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>
                <br>

                <label for="ant_gestion" style="display: inline-block; width: 225px;">4.- Antigüedad Gestión:</label>
                <input type="number" id="antiguedadgestion2" name="antiguedadgestion2" class="materialize-input3" size="10" step="0.01"  onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>
                <br>

                <label for="ant_titulo" style="display: inline-block; width: 225px;">5.- Antigüedad Título:</label>
                <input type="number" id="antiguedadtitulo2" name="antiguedadtitulo2" class="materialize-input3" size="10" step="0.01"  onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>
                <br>

                <label for="servicios" style="display: inline-block; width: 225px;">6.- Servicios:</label>
                <br>

                <label for="serv_prov" style="display: inline-block; width: 225px;">6.1- En la Provincia:</label>
                <input type="number" id="serviciosprovincia2" name="serviciosprovincia2" class="materialize-input3" size="10" step="0.01"  onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>
                <br>

                <label for="otrosservicios2" style="display: inline-block; width: 225px;">6.2- Otros Servicios:</label>
                <input type="number" id="otrosservicios2" name="otrosservicios2" class="materialize-input3" size="10" step="0.01" onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>
                <br>

                <label for="residencia" style="display: inline-block; width: 225px;">7.- Residencia:</label>
                <input type="number" id="residencia2" name="residencia2" class="materialize-input3" size="10" step="0.01"  onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>
                <br>

                <label for="publicaciones" style="display: inline-block; width: 225px;">8.- Publicaciones:</label>
                <input type="number" id="publicaciones2" name="publicaciones2" class="materialize-input3" size="10" step="0.01"  onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>
                <br>

                <label for="otrosantecedentes2" style="display: inline-block; width: 225px;">9.- Otros Antecedentes:</label>
                <input type="number" id="otrosantecedentes2" name="otrosantecedentes2" class="materialize-input3" size="10" step="0.01" onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>
                <br>
            </td>
        </tr>
    </table>

    

<script >
  function calcularPuntajeTotal() {
    try {
      var titulo = parseFloat(document.getElementById('titulo2').value) || 0;
      var otitulo = parseFloat(document.getElementById('otitulo2').value) || 0;
      
      var promedio = parseFloat(document.getElementById('promedio2').value) || 0;
      var antiguedadgestion = parseFloat(document.getElementById('antiguedadgestion2').value) || 0;
      var antiguedadtitulo = parseFloat(document.getElementById('antiguedadtitulo2').value) || 0;
      var serviciosprovincia = parseFloat(document.getElementById('serviciosprovincia2').value) || 0;
      var otrosservicios = parseFloat(document.getElementById('otrosservicios2').value) || 0;
      var residencia = parseFloat(document.getElementById('residencia2').value) || 0;
      var publicaciones = parseFloat(document.getElementById('publicaciones2').value) || 0;
      var otrosantecedentes = parseFloat(document.getElementById('otrosantecedentes2').value) || 0;

      // Sumar todos los valores y actualizar el campo de puntajetotal2
      var puntajeTotal = (titulo + otitulo + promedio + antiguedadgestion + antiguedadtitulo + serviciosprovincia + otrosservicios + residencia + publicaciones + otrosantecedentes).toFixed(2);

      document.getElementById('puntajetotal2').value = puntajeTotal;
    } catch (e) {
      document.getElementById('puntajetotal2').value = Error;
    }
  }
</script>













    <!-- Tabla para Titular -->
    <table id="tablaTitular" style="display: none;">
        <tr>
            <td>
              <h3><u>CARGA TITULAR</u> </h3>
              <br>
                <label for="puntajetotal" style="display: inline-block; width: 225px;">Puntaje Total:</label>
                <input type='number' id='puntajetotal' name='puntajetotal' value='" . htmlspecialchars($row['puntajetotal']) . "' size='10' readonly>
                <br><br>

                <label for="titulo" style="display: inline-block; width: 225px;">1.- Título:</label>
                <input type="number" id="titulo" name="titulo"  class="materialize-input3" size="10" step="0.01" onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>
                <br>

                <label for="otrostit" style="display: inline-block; width: 225px;">2.- Otros Título:</label>
                <input type="number" id="otrostit" name="otitulo"  class="materialize-input3" size="10" step="0.01" onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>
                <br>
                <label for="concepto" style="display: inline-block; width: 225px;">3.- Conceptos:</label>
                <input type="number" id="concepto" name="concepto" class="materialize-input3" size="10" step="0.01"  onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>
                <br>
                <label for="promedio" style="display: inline-block; width: 225px;">4.- Promedio:</label>
                <input type="number" id="promedio" name="promedio"  class="materialize-input3" size="10" step="0.01" onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()' >
                <br>

                <label for="ant_gestion" style="display: inline-block; width: 225px;">5.- Antigüedad Gestión:</label>
                <input type="number" id="antiguedadgestion" name="antiguedadgestion"  class="materialize-input3" size="10" step="0.01" onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>
                <br>

                <label for="ant_titulo" style="display: inline-block; width: 225px;">6.- Antigüedad Título:</label>
                <input type="number" id="antiguedadtitulo" name="antiguedadtitulo"  class="materialize-input3" size="10" step="0.01"  onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>
                <br>

                <label for="servicios" style="display: inline-block; width: 225px;">7.- Servicios:</label>
                <br>

                <label for="serv_prov" style="display: inline-block; width: 208px;margin-left: 20px; ">7.1- En la Provincia:</label>
                <input type="number" id="serviciosprovincia" name="serviciosprovincia"  class="materialize-input3" size="10" step="0.01"  >
                <br>

                <label for="t_m_seccion" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;">Maestro de Sección:</label>
                <input type="number" id="t_m_seccion" name="t_m_seccion"   class="materialize-input3" size="10" step="0.01" >
                <br>

                <label for="t_m_anio" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF; ">Maestro de Año:</label>
                <input type="number" id="t_m_anio" name="t_m_anio"  class="materialize-input3" size="10" step="0.01" >
                <br>

                <label for="t_m_grupo" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF; ">Maestro de Grupo:</label>
                <input type="number" id="t_m_grupo" name="t_m_grupo"  class="materialize-input3" size="10" step="0.01"  >
                <br>

                <label for="t_m_ciclo" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF; ">Maestro de Ciclo:</label>
                <input type="number" id="t_m_ciclo" name="t_m_ciclo"  class="materialize-input3" size="10" step="0.01"  >
                <br>

                <label for="t_m_recupera" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF; ">Maestro Recuperador:</label>
                <input type="number" id="t_m_recupera" name="t_m_recupera"  class="materialize-input3" size="10" step="0.01" >
                <br>

                <label for="t_m_comple" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF; ">Maestro Complementario:</label>
                <input type="number" id="t_m_comple" name="t_m_comple"  class="materialize-input3" size="10" step="0.01" >
                <br>

                <label for="t_m_biblio" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF; ">Maestro Bibliotecario:</label>
                <input type="number" id="t_m_biblio" name="t_m_biblio"  class="materialize-input3" size="10" step="0.01" >
                <br>

                <label for="t_m_gabinete" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF; ">Gabinete:</label>
                <input type="number" id="t_m_gabinete" name="t_m_gabinete"  class="materialize-input3" size="10" step="0.01">
                <br>

                <hr>

                <label for="t_m_sec1" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF; ">Secretaría 1º:</label>
                <input type="number" id="t_m_sec1" name="t_m_sec1"  class="materialize-input3" size="10" step="0.01">
                <br>

                <label for="t_m_sec2" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF; ">Secretaría 2º:</label>
                <input type="number" id="t_m_sec2" name="t_m_sec2"  class="materialize-input3" size="10" step="0.01">
                <br>

                <label for="t_m_viced" style="display: inline-block; width: 208px;margin-left: 20px; color:#0000FF;">Vice-Director:</label>
                <input type="number" id="t_m_viced" name="t_m_viced"  class="materialize-input3" size="10" step="0.01">
                <br>

                <hr>

                <label for="t_d_pu" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF; ">Director Personal Único:</label>
                <input type="number" id="t_d_pu" name="t_d_pu"  class="materialize-input3" size="10"step="0.01">
                <br>

                <label for="t_d_3" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF; ">Director de 3º:</label>
                <input type="number" id="t_d_3" name="t_d_3"  class="materialize-input3" size="10" step="0.01">
                <br>

                <label for="t_d_2" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF; ">Director de 2º:</label>
                <input type="number" id="t_d_2" name="t_d_2"  class="materialize-input3"  size="10" step="0.01">
                <br>

                <label for="t_d_1" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF; ">Director de 1º:</label>
                <input type="number" id="t_d_1" name="t_d_1"  class="materialize-input3" size="10" step="0.01">
                <br>

                <label for="t_d_biblio" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;  ">Director de Biblioteca:</label>
                <input type="number" id="t_d_biblio" name="t_d_biblio"  class="materialize-input3" size="10" step="0.01">
                <br>

                <label for="t_d_gabi" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF; ">Director de Gabinete:</label>
                <input type="number" id="t_d_gabi" name="t_d_gabi"  class="materialize-input3" size="10" step="0.01">
                <br>

                <hr>

                <label for="t_d_seccoortec" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF; ">Secretario Coord. Tec.:</label>
                <input type="number" id="t_d_seccoortec" name="t_d_seccoortec"  class="materialize-input3" size="10" step="0.01">
                <br>

                <label for="t_d_supsectec" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF; ">Supe. Sec. Tec.:</label>
                <input type="number" id="t_d_supsectec" name="t_d_supsectec"  class="materialize-input3" size="10" step="0.01">
                <br>

                <label for="t_d_supesc" style="display: inline-block; width: 208px;margin-left: 20px;color:#0000FF; ">Sup. Escolar:</label>
                <input type="number" id="t_d_supesc" name="t_d_supesc" class="materialize-input3" size="10" step="0.01">
                <br>

                <label for="t_d_supgral" style="display: inline-block; width: 208px;margin-left: 20px; color:#0000FF;">Sup. General:</label>
                <input type="number" id="t_d_supgral" name="t_d_supgral"  class="materialize-input3" size="10" step="0.01">
                <br>

                <label for="t_d_adic" style="display: inline-block; width: 208px; margin-left: 20px; color:#0000FF;">Adic.:</label>
                <input type="number" id="t_d_adic" name="t_d_adic"  class="materialize-input3" size="10"step="0.01">
                <br>

                <hr>

                <label for="otrosservicios" style="display: inline-block; width: 225px;">7.2- Otros Servicios:</label>
                <input type="number" id="otrosservicios" name="otrosservicios" class="materialize-input3" size="10" step="0.01">
                <br>

                <label for="o_g_a" style="display: inline-block; width: 208px; margin-left: 20px; color:#0000FF;">Grupo A:</label>
                <input type="number" id="o_g_a" name="o_g_a"  class="materialize-input3" size="10" step="0.01">
                <br>

                <label for="o_g_b" style="ddisplay: inline-block; width: 208px; margin-left: 20px; color:#0000FF;">Grupo B:</label>
                <input type="number" id="o_g_b" name="o_g_b" class="materialize-input3"  size="10" step="0.01" >
                <br>

                <label for="o_g_c" style="display: inline-block; width: 208px; margin-left: 20px; color:#0000FF;">Grupo C:</label>
                <input type="number" id="o_g_c" name="o_g_c"   class="materialize-input3" size="10" step="0.01">
                <br>

                <label for="o_g_d" style="display: inline-block; width: 208px; margin-left: 20px; color:#0000FF;">Grupo D:</label>
                <input type="number" id="o_g_d" name="o_g_d" class="materialize-input3" size="10" step="0.01" >
                <br>

                <label for="residencia" style="display: inline-block; width: 225px;">8.- Residencia:</label>
                <input type="number" id="residencia" name="residencia"  class="materialize-input3" size="10" step="0.01" onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>
                <br>

                <label for="publicaciones" style="display: inline-block; width: 225px;">9.- Publicaciones:</label>
                <input type="number" id="publicaciones" name="publicaciones"  class="materialize-input3" size="10" step="0.01" onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>
                <br>

                <label for="otrosantecedentes" style="display: inline-block; width: 225px;">10.- Otros Antecedentes:</label>
                <input type="number" id="otrosantecedentes" name="otrosantecedentes" class="materialize-input3" size="10" step="0.01" onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>
                <br>
            </td>
        </tr>


        <script>
function calcularPuntajeTotal2() { 
    try {
        // Campos principales
        var titulo = parseFloat(document.getElementById('titulo').value) || 0,
            otitulo = parseFloat(document.getElementById('otrostit').value) || 0,
            concepto = parseFloat(document.getElementById('concepto').value) || 0,
            promedio = parseFloat(document.getElementById('promedio').value) || 0,
            antiguedadGestion = parseFloat(document.getElementById('antiguedadgestion').value) || 0,
            antiguedadTitulo = parseFloat(document.getElementById('antiguedadtitulo').value) || 0,
            residencia = parseFloat(document.getElementById('residencia').value) || 0,
            publicaciones = parseFloat(document.getElementById('publicaciones').value) || 0,
            otrosantecedentes = parseFloat(document.getElementById('otrosantecedentes').value) || 0;

        // Sumar campos relacionados con servicios provincia
        var serviciosProvincia = 
            (parseFloat(document.getElementById('t_m_seccion').value) || 0) +
            (parseFloat(document.getElementById('t_m_anio').value) || 0) +
            (parseFloat(document.getElementById('t_m_grupo').value) || 0) +
            (parseFloat(document.getElementById('t_m_ciclo').value) || 0) +
            (parseFloat(document.getElementById('t_m_recupera').value) || 0) +
            (parseFloat(document.getElementById('t_m_comple').value) || 0) +
            (parseFloat(document.getElementById('t_m_biblio').value) || 0) +
            (parseFloat(document.getElementById('t_m_gabinete').value) || 0) +
            (parseFloat(document.getElementById('t_m_sec1').value) || 0) +
            (parseFloat(document.getElementById('t_m_sec2').value) || 0) +
            (parseFloat(document.getElementById('t_m_viced').value) || 0) +
            (parseFloat(document.getElementById('t_d_pu').value) || 0) +
            (parseFloat(document.getElementById('t_d_3').value) || 0) +
            (parseFloat(document.getElementById('t_d_2').value) || 0) +
            (parseFloat(document.getElementById('t_d_1').value) || 0) +
            (parseFloat(document.getElementById('t_d_biblio').value) || 0) +
            (parseFloat(document.getElementById('t_d_gabi').value) || 0) +
            (parseFloat(document.getElementById('t_d_seccoortec').value) || 0) +
            (parseFloat(document.getElementById('t_d_supsectec').value) || 0) +
            (parseFloat(document.getElementById('t_d_supesc').value) || 0) +
            (parseFloat(document.getElementById('t_d_supgral').value) || 0) +
            (parseFloat(document.getElementById('t_d_adic').value) || 0);

        // Calcular el total de otros servicios
        var otrosServicios = 
           // (parseFloat(document.getElementById('otrosservicios').value) || 0) +
            (parseFloat(document.getElementById('o_g_a').value) || 0) +
            (parseFloat(document.getElementById('o_g_b').value) || 0) +
            (parseFloat(document.getElementById('o_g_c').value) || 0) +
            (parseFloat(document.getElementById('o_g_d').value) || 0);

        // Actualizar el valor de otrosServicios en el campo correspondiente
        document.getElementById('otrosservicios').value = otrosServicios.toFixed(2);
        
        // Actualizar el valor de serviciosProvincia en el campo correspondiente
        document.getElementById('serviciosprovincia').value = serviciosProvincia.toFixed(2);
        
        // Calcular el puntaje total
        var puntajeTotal = titulo + otitulo + concepto + promedio + antiguedadGestion +
                           antiguedadTitulo + serviciosProvincia + residencia + publicaciones +
                           otrosantecedentes + otrosServicios;

        // Actualizar el valor en el campo puntajetotal
        document.getElementById('puntajetotal').value = puntajeTotal.toFixed(2);
    } catch (error) {
        console.error("Error al calcular el puntaje total: ", error);
    }
}


// Escuchar eventos en todos los campos
document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('input', calcularPuntajeTotal2);
});
</script>
    </table>

  
   
    

<!-- JavaScript para mostrar u ocultar las tablas según el tipo seleccionado -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var tipoSelect = document.getElementById('tipoc');
    var tablaPermanenteConcursoInterino = document.getElementById('tablaPermanenteConcursoInterino');
    var tablaTitular = document.getElementById('tablaTitular');
    var conceptoField = document.getElementById('conceptoField'); // Campo de Conceptos
    var thEstablecimiento = document.getElementById('thEstablecimiento'); // Campo de establecimiento

    function mostrarTablaSegunTipo() {
        var tipo = tipoSelect.value;
        
        // Mostrar/ocultar tablas según el tipo
        tablaPermanenteConcursoInterino.style.display = (tipo === 'permanente' || tipo === 'concurso' || tipo === 'transitorio') ? 'table' : 'none';
        tablaTitular.style.display = (tipo === 'titulares') ? 'table' : 'none';
        
        // Mostrar/ocultar campo de conceptos según el tipo
        if (conceptoField) {
            conceptoField.style.display = (tipo === 'transitorio' || tipo === 'permanente' || tipo === 'concurso' ) ? 'none' : 'block';
        } else {
            console.error('Elemento con ID "conceptoField" no encontrado.');
        }

        // Mostrar/ocultar el campo de establecimiento según el tipo
        if (thEstablecimiento) {
            thEstablecimiento.style.display = (tipo === 'titulares') ? 'table-cell' : 'none';
        } else {
            console.error('Elemento con ID "thEstablecimiento" no encontrado.');
        }
    }

    // Añadir event listener para el cambio en el select
    if (tipoSelect) {
        tipoSelect.addEventListener('change', mostrarTablaSegunTipo);
    } else {
        console.error('Elemento con ID "tipoc" no encontrado.');
    }

    // Llamar a la función al cargar la página
    mostrarTablaSegunTipo();
});

</script>


                 <br>
                <br>
                <br>
              
              

  

<!-- Script para mostrar u ocultar el menú desplegable de motivos de exclusión según el estado del botón -->
<script>
function toggleMotivosExclusion(checkbox) {
    var select = document.getElementById('motivosExclusion');
    if (checkbox.checked) {
        select.style.display = 'block';
    } else {
        select.style.display = 'none';
    }
}
</script>
    </table>
    <button class="btn btn-success" title="Guardar Registro" type="submit">
    <i class="glyphicon glyphicon-floppy-disk"></i> Guardar
</button>
    
</form>


 


<center>
  <a href="javascript:history.back()" class="btn btn-success"> <i class="glyphicon glyphicon-arrow-left"></i> Volver atrás</a>
</center>


</th>
<?php include('footer2.php');?>
