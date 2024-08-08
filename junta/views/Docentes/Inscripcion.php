<?php 
require_once 'movimientos.entidad.php';
require_once 'movimientos.model.php';
include('header2.php');


// Logica
$mov = new Movimiento();
$model = new MovimientosModel();
if(isset($_REQUEST['action']))
{
  switch($_REQUEST['action'])
  {
    case 'actualizar':
      $mov->__SET('tipo', $_REQUEST['tipo']);
      $mov->__SET('tipocarga', $_REQUEST['tipocarga']);
      $mov->__SET('id2', $_REQUEST['id2']);
      $mov->__SET('t_m_seccion', $_REQUEST['t_m_seccion']);
      $mov->__SET('t_m_anio', $_REQUEST['t_m_anio']);
      $mov->__SET('t_m_grupo', $_REQUEST['t_m_grupo']);
      $mov->__SET('t_m_ciclo', $_REQUEST['t_m_ciclo']);
      $mov->__SET('t_m_recupera', $_REQUEST['t_m_recupera']);
      $mov->__SET('t_d_pu', $_REQUEST['t_d_pu']);
      $mov->__SET('t_d_3', $_REQUEST['t_d_3']);
      $mov->__SET('t_d_2', $_REQUEST['t_d_2']);
      $mov->__SET('t_d_1', $_REQUEST['t_d_1']);
      $mov->__SET('t_d_biblio', $_REQUEST['t_d_biblio']);
      $mov->__SET('t_d_gabi', $_REQUEST['t_d_gabi']);
      $mov->__SET('t_d_seccoortec', $_REQUEST['t_d_seccoortec']);
      $mov->__SET('t_d_supsectec', $_REQUEST['t_d_supsectec']);
      $mov->__SET('t_d_supesc', $_REQUEST['t_d_supesc']);
      $mov->__SET('t_d_supgral', $_REQUEST['t_d_supgral']);
      $mov->__SET('t_d_adic', $_REQUEST['t_d_adic']);
      $mov->__SET('o_g_a', $_REQUEST['o_g_a']);
      $mov->__SET('o_g_b', $_REQUEST['o_g_b']);
      $mov->__SET('o_g_c', $_REQUEST['o_g_c']);
      $mov->__SET('o_g_d', $_REQUEST['o_g_d']);
      $mov->__SET('concepto', $_REQUEST['concepto']);
      $mov->__SET('otitulo', $_REQUEST['otitulo']);
      $mov->__SET('t_m_comple', $_REQUEST['t_m_comple']);
      $mov->__SET('t_m_biblio', $_REQUEST['t_m_biblio']);
      $mov->__SET('t_m_sec1', $_REQUEST['t_m_sec1']);
      $mov->__SET('t_m_sec2', $_REQUEST['t_m_sec2']);
      $mov->__SET('t_m_viced', $_REQUEST['t_m_viced']);
      $mov->__SET('t_m_gabinete', $_REQUEST['t_m_gabinete']);
      $mov->__SET('obs', $_REQUEST['obs']);
      $mov->__SET('horas', $_REQUEST['horas']);
      $mov->__SET('legvinc', $_REQUEST['legvinc']);
      $mov->__SET('hijos', $_REQUEST['hijos']);
      $mov->__SET('excluido', $_REQUEST['excluido']);
      $mov->__SET('fecha', $_REQUEST['fecha']);
      $mov->__SET('trial513', $_REQUEST['trial513']);

  
      $model->ActualizarMovimiento($mov);
     // header('Location: index.php');
      break;

    case 'registrar':
      $mov->__SET('tipo', $_REQUEST['tipo']);
      $mov->__SET('tipocarga', $_REQUEST['tipocarga']);
      $mov->__SET('id2', $_REQUEST['id2']);
      $mov->__SET('t_m_seccion', $_REQUEST['t_m_seccion']);
      $mov->__SET('t_m_anio', $_REQUEST['t_m_anio']);
      $mov->__SET('t_m_grupo', $_REQUEST['t_m_grupo']);
      $mov->__SET('t_m_ciclo', $_REQUEST['t_m_ciclo']);
      $mov->__SET('t_m_recupera', $_REQUEST['t_m_recupera']);
      $mov->__SET('t_d_pu', $_REQUEST['t_d_pu']);
      $mov->__SET('t_d_3', $_REQUEST['t_d_3']);
      $mov->__SET('t_d_2', $_REQUEST['t_d_2']);
      $mov->__SET('t_d_1', $_REQUEST['t_d_1']);
      $mov->__SET('t_d_biblio', $_REQUEST['t_d_biblio']);
      $mov->__SET('t_d_gabi', $_REQUEST['t_d_gabi']);
      $mov->__SET('t_d_seccoortec', $_REQUEST['t_d_seccoortec']);
      $mov->__SET('t_d_supsectec', $_REQUEST['t_d_supsectec']);
      $mov->__SET('t_d_supesc', $_REQUEST['t_d_supesc']);
      $mov->__SET('t_d_supgral', $_REQUEST['t_d_supgral']);
      $mov->__SET('t_d_adic', $_REQUEST['t_d_adic']);
      $mov->__SET('o_g_a', $_REQUEST['o_g_a']);
      $mov->__SET('o_g_b', $_REQUEST['o_g_b']);
      $mov->__SET('o_g_c', $_REQUEST['o_g_c']);
      $mov->__SET('o_g_d', $_REQUEST['o_g_d']);
      $mov->__SET('concepto', $_REQUEST['concepto']);
      $mov->__SET('otitulo', $_REQUEST['otitulo']);
      $mov->__SET('t_m_comple', $_REQUEST['t_m_comple']);
      $mov->__SET('t_m_biblio', $_REQUEST['t_m_biblio']);
      $mov->__SET('t_m_sec1', $_REQUEST['t_m_sec1']);
      $mov->__SET('t_m_sec2', $_REQUEST['t_m_sec2']);
      $mov->__SET('t_m_viced', $_REQUEST['t_m_viced']);
      $mov->__SET('t_m_gabinete', $_REQUEST['t_m_gabinete']);
      $mov->__SET('obs', $_REQUEST['obs']);
      $mov->__SET('horas', $_REQUEST['horas']);
      $mov->__SET('legvinc', $_REQUEST['legvinc']);
      $mov->__SET('hijos', $_REQUEST['hijos']);
      $mov->__SET('excluido', $_REQUEST['excluido']);
      $mov->__SET('fecha', $_REQUEST['fecha']);
      $mov->__SET('trial513', $_REQUEST['trial513']);
      
      $model->RegistrarMovimiento($mov);
      //header('Location:ListarModalidades.php');
      break;

    case 'eliminar2':
      $model->EliminarMovimiento($_REQUEST['id2']);
      //header('Location:ListarModalidades.php');
      break;

    case 'editar':
     $mov = $model->ObtenerMovimiento($_REQUEST['id2']);

    case 'modificar':
     $mov = $model->ObtenerMovimiento($_REQUEST['id2']);
    
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


</style>
<link rel="icon" type="./image/png" href="./imagenes/escudo-32x32.png">
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Agencia de Innovacion</title>

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

   <!-- Carga de jQuery -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   


</head>
<body>
  <div class="container">
    <center><h1>Inscripciones De Docentes</h1></center>
<br>

<?php
// Te recomiendo utilizar esta conexión, la que utilizas ya no es la recomendada.
//$link = new PDO('mysql:host=localhost;dbname=junta', 'root', ''); // el campo vaciío es para la password.
try {
  // Connection Parameters (Replace placeholders with your actual values)
  $serverName = "db"; // Server name or IP address
  $databaseName = "junta"; // Database name
  $username = "SA"; // Username (might be different from MySQL)
  $password = '"asd123"'; // Password

  // Connection String (PDO SQL Server Format)
  $conn = new PDO("sqlsrv:Server=$serverName;Database=$databaseName", $username, $password); 

  // Error Handling (Optional, but highly recommended)
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

  echo "";
} catch(PDOException $e) {
  die("Connection failed: " . $e->getMessage());
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

<th>
<?php
$legajo = $_GET['legajo'];
$nomdep = $_GET['nomdep'];
// Supongo que obtienes los valores de $_GET
$legajo = isset($_GET['legajo']) ? $_GET['legajo'] : '';
$codmod = isset($_GET['codmod']) ? $_GET['codmod'] : '';
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
$nomdep = isset($_GET['nomdep']) ? $_GET['nomdep'] : '';
$obs = isset($_GET['obs']) ? $_GET['obs'] : '';
$horas = isset($_GET['horas']) ? $_GET['horas'] : '';





// Configuración de la conexión a SQL Server
$serverName = "db"; // O el nombre de tu servidor SQL
$connectionOptions = array(
    "Database" => "junta", // Nombre de la base de datos
    "Uid" => "SA", // Usuario de SQL Server
    "PWD" => '"asd123"', // Contraseña de SQL Server
    "CharacterSet" => "UTF-8" // para que lea las ñ y acentos
);

// Conectar con SQL Server
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Verificar conexión
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Definir la consulta
$query = "SELECT legajo, apellidoynombre, fechanacim, titulobas, promediot, otrostit, cargosdocentes, fingreso FROM _junta_docentes WHERE legajo = ?";

// Preparar la consulta
$params = array($legajo); // Asegúrate de definir $legajo en algún lugar antes de esta línea
$stmt = sqlsrv_query($conn, $query, $params);

// Verificar si la consulta se ejecutó correctamente
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Verificar si se encontraron docentes
if (sqlsrv_has_rows($stmt)) {
    echo "<table border='1'>";
    echo "<tr><th>Legajo</th><th>Apellido y Nombre</th><th><center>Acciones</center></th></tr>";

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $legajo = $row['legajo'];
        $apellidoynombre = $row['apellidoynombre'];

        echo "<tr>";
        echo "<td>$legajo</td>";
        echo "<td>$apellidoynombre</td>";
        echo "<td><center><button type='button' onclick='showDetails($legajo)' class='detalle-button'><i class='glyphicon glyphicon-list-alt'></i>  Detalle</button></center></td>";
        echo "</tr>";

        // Detalles del docente (oculto por defecto)
        echo "<tr id='details_$legajo' style='display:none'>";
        echo "<td colspan='3'><b>Detalles del Docente</b></td>";
        echo "</tr>";
        echo "<tr id='details_info_$legajo' style='display:none'>";
            if ($row['fechanacim'] !== null) {
              echo "<td>Fecha Nac.:</td><td colspan='2'>" . $row['fechanacim']->format('d/m/Y') . "</td>";
          } else {
              echo "<td>Fecha Nac.:</td><td colspan='2'>No disponible</td>";
          }
        echo "</tr>";
        echo "<tr id='details_info_$legajo' style='display:none'>";
        echo "<td>Tít. Básico:</td><td colspan='2'>" .$row['titulobas']. "</td>";
        echo "</tr>";
        echo "<tr id='details_info_$legajo' style='display:none'>";
        echo "<td>Promedio:</td><td colspan='2'>" .$row['promediot']. "</td>";
        echo "</tr>";
        echo "<tr id='details_info_$legajo' style='display:none'>";
        echo "<td>Otro título:</td><td colspan='2'>" .$row['otrostit']. "</td>";
        echo "</tr>";
        echo "<tr id='details_info_$legajo' style='display:none'>";
        echo "<td>Cargo Docente:</td><td colspan='2'>" .$row['cargosdocentes']. "</td>";
        echo "</tr>";
        echo "<tr id='details_info_$legajo' style='display:none'>";
        if ($row['fingreso'] !== null) {
          echo "<td>Residencia::</td><td colspan='2'>" . $row['fingreso']->format('d/m/Y') . "</td>";
      } else {
          echo "<td>Residencia::</td><td colspan='2'>No disponible</td>";
      }
       
       
       
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron docentes en la base de datos.";
}

// Liberar el conjunto de resultados
sqlsrv_free_stmt($stmt);

// Cerrar la conexión a la base de datos
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
<script>
$(document).ready(function() {
    $('#grabarBtn').click(function() {
        alert('Se ha grabado la información.');
    });

    $('#cancelarBtn').click(function() {
        history.back(); // Volver a la página anterior
    });

    $('#eliminarBtn').click(function() {
        if (confirm('¿Estás seguro de que quieres eliminar esta inscripción?')) {
            // Aquí puedes agregar la lógica para eliminar el elemento con el ID 'id2'
            var elementoEliminar = document.getElementById('id2');
            var padreElemento = elementoEliminar.parentNode;
            padreElemento.removeChild(elementoEliminar);

            alert('La inscripción ha sido eliminada.');
        }
    });
});
</script>

<table>
  
 <?php
$legajo = $_GET['legajo'];
$codmod = $_GET['codmod'];
$tipo = $_GET['tipo'];
$anodoc = $_GET['anodoc'];
$receivedNomdep = urldecode($_GET['nomdep']);
$obs = urldecode($_GET['obs']); // Decodificar la observación
$horas = $_GET['horas'];
$id2 = $_GET['id2'];
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : ''; // Recibir la fecha

// Configuración de la conexión a SQL Server
$serverName = "db"; // Nombre del servidor
$connectionOptions = array(
    "Database" => "junta", // Nombre de la base de datos
    "Uid" => "SA", // Usuario
    "PWD" => '"asd123"' ,// Contraseña
    "CharacterSet" => "UTF-8" 
);

// Establecer la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Consulta SQL para obtener todos los nombres de modalidad
$queryModalidades = "SELECT nommod FROM _junta_modalidades";
$resultModalidades = sqlsrv_query($conn, $queryModalidades);

$modalidades = array(); // Almacenar los nombres de modalidad

if ($resultModalidades) {
    while ($rowModalidad = sqlsrv_fetch_array($resultModalidades, SQLSRV_FETCH_ASSOC)) {
        $modalidades[] = $rowModalidad['nommod'];
    }
} else {
    die(print_r(sqlsrv_errors(), true));
}

$queryData = "SELECT 
        j_doc.apellidoynombre, 
        j_doc.legajo, 
        j_mov.legdoc, 
        j_mov.anodoc, 
        j_mov.codmod, 
        j_mov.establecimiento, 
        j_mod.nommod, 
        j_dep.coddep, 
        j_dep.nomdep, 
        j_mov.puntajetotal, 
        j_mov.tipo, 
        j_mov.fecha,
        j_mov.codloc, 
        j_mod.nommod, 
        j_mov.titulo,
        j_mov.otitulo, 
        j_mov.promedio,
        j_mov.antiguedadgestion,
        j_mov.antiguedadtitulo,
        j_mov.serviciosprovincia,
        j_mov.otrosservicios,
        j_mov.o_g_a,
        j_mov.o_g_b,
        j_mov.o_g_c,
        j_mov.o_g_d,
        j_mov.residencia,
        j_mov.publicaciones,
        j_mov.otrosantecedentes, 
        j_mov.t_m_seccion,
        j_mov.t_m_anio,
        j_mov.t_m_grupo,
        j_mov.t_m_ciclo,
        j_mov.t_m_recupera,
        j_mov.t_m_comple,
        j_mov.t_m_biblio,
        j_mov.t_m_gabinete,
        j_mov.t_m_sec2, 
        j_mov.t_m_sec1,
        j_mov.t_m_viced,
        j_mov.t_d_pu,
        j_mov.t_d_3,
        j_mov.t_d_2,
        j_mov.t_d_1,
        j_mov.t_d_biblio,
        j_mov.t_d_gabi,
        j_mov.t_d_seccoortec,
        j_mov.t_d_supsectec,
        j_mov.t_d_supesc,
        j_mov.t_d_supgral,
        j_mov.t_d_adic,
        j_mov.concepto,
        j_mov.id2
    FROM _junta_docentes j_doc
    INNER JOIN _junta_movimientos j_mov ON j_mov.id2 = '$id2' AND j_doc.legajo = j_mov.legdoc
    INNER JOIN _junta_modalidades j_mod ON j_mov.codmod = j_mod.codmod
    INNER JOIN _junta_dependencias j_dep ON j_mov.establecimiento = j_dep.coddep";


$resultData = sqlsrv_query($conn, $queryData);

if ($resultData === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Verifica si hay filas en el resultado de la consulta
if (sqlsrv_has_rows($resultData)) {
    $row = sqlsrv_fetch_array($resultData, SQLSRV_FETCH_ASSOC);
    
    // Imprimir la tabla
    echo "<table border='1'>";
echo "<form id='miFormulario'>";
    echo "<tr>";
    
    // Curso
    if (isset($row['anodoc'])) {
        echo "<th>Curso: </th><th><input type='text' name='anodoc' value='" . $row['anodoc'] . "' size='11'></th>";
    } else {
        echo "<th>Curso: </th><th><input type='text' name='anodoc' value='' size='11'></th>"; 
    }

    // Botones de acción
    echo "<th>";
    echo "<div style='text-align: center;'>";
    echo "<a class='btn btn-sm btn-danger' id='movimientoBorrado' href='#' data-id2='" . $row['id2'] . "' title='Eliminar'><i class='glyphicon glyphicon-trash'></i> Eliminar</a>";
    echo "<button type='button' class='btn btn-success' id='grabarBtn'><i class='glyphicon glyphicon-refresh'></i> Grabar</button>";
    echo "<button type='button' class='btn btn-primary' id='cancelarBtn'><i class='glyphicon glyphicon-remove'></i> Volver</button>";
    echo "</div>";
    echo "</th>";
    echo "</tr>";

    // Código de modalidad
    echo "<tr>";
    echo "<th>Cód. Mod: <input type='text' name='codmod' value='" . $row['codmod'] . "' size='8'></th>";

    // Modalidad
    echo "<th>Modalidad:<select name='modalidad' style='width: 500px;'>";
    foreach ($modalidades as $modalidad) {
        echo "<option value='$modalidad'";
        if (trim($row['nommod']) == $modalidad) {
            echo " selected";
        }
        echo ">$modalidad</option>";
    }
    echo "</select></th>";

    // Tipo de inscripción
    echo "<th>Tipo Inscripción:";
    echo "<select name='tipo' id='tipo' style='width: 190px;' onchange='mostrarCamposAdicionales(); showTableBasedOnType();'>";
    echo "<option value='permanente'";
    if (trim($row['tipo']) == "permanente") {
        echo " selected";
    }
    echo ">Permanente</option>";
    echo "<option value='titulares'";
    if (trim($row['tipo']) == "titulares") {
        echo " selected";
    }
    echo ">Titulares</option>";
    echo "<option value='transitorio'";
    if (trim($row['tipo']) == "transitorio") {
        echo " selected";
    }
    echo ">Interinatos y Suplencias</option>";
    echo "<option value='concurso'";
    if (trim($row['tipo']) == "concurso") {
        echo " selected";
    }
    echo ">Concurso de Titularidad</option>";
    echo "</select>";
    echo "</th>";
    echo "</tr>";
    echo "</table>";
   
} else {
  
     // Curso
     $anodoc = isset($_GET['anodoc']) ? $_GET['anodoc'] : '';
    // Verificar si anodoc está definido en la URL o en la consulta de la base de datos
if (!empty($anodoc)) {
  echo "<th>Curso: </th><th><input type='text' name='anodoc' value='" . htmlspecialchars($anodoc) . "' size='11'></th>";
} else {
  echo "<th>Curso: </th><th><input type='text' name='anodoc' value='' size='11'></th>"; 
}

$id2 = isset($_GET['id2']) ? $_GET['id2'] : '';

// Botones de acción
echo "<th>";
echo "<div style='text-align: center;'>";

// Verificar si $row['id2'] está definido antes de usarlo
if (isset($row['id2'])) {
    echo "<a class='btn btn-sm btn-danger' id='movimientoBorrado' href='#' data-id2='" . htmlspecialchars($row['id2']) . "' title='Eliminar'><i class='glyphicon glyphicon-trash'></i> Eliminar</a>";
} else {
    // Manejo alternativo si $row['id2'] no está definido
    echo "<a class='btn btn-sm btn-danger' id='movimientoBorrado' href='#' data-id2='' title='Eliminar'><i class='glyphicon glyphicon-trash'></i> Eliminar</a>";
}
echo "<button type='button' class='btn btn-success' id='grabarBtn'><i class='glyphicon glyphicon-refresh'></i> Grabar</button>";
echo "<button type='button' class='btn btn-primary' id='cancelarBtn'><i class='glyphicon glyphicon-remove'></i> Volver</button>";
echo "</div>";
echo "</th>";
echo "</tr>";

// Código de modalidad
$codmod = isset($_GET['codmod']) ? $_GET['codmod'] : '';

echo "<tr>";

// Verificar si codmod está definido en la URL o en la consulta de la base de datos
if (!empty($codmod)) {
    echo "<th>Cód. Mod: <input type='text' name='codmod' value='" . htmlspecialchars($codmod) . "' size='8'></th>";
    
    // Consultar la base de datos para obtener el nombre de la modalidad
    $queryModalidad = "SELECT nommod FROM _junta_modalidades WHERE codmod = ?";
    $params = array($codmod);
    $resultModalidad = sqlsrv_query($conn, $queryModalidad, $params);
    
    if ($resultModalidad === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    if (sqlsrv_has_rows($resultModalidad)) {
        $rowModalidad = sqlsrv_fetch_array($resultModalidad, SQLSRV_FETCH_ASSOC);
        $nommod = $rowModalidad['nommod'];
    } else {
        $nommod = ''; // Manejar el caso donde no se encuentra la modalidad
    }
} else {
    echo "<th>Cód. Mod: <input type='text' name='codmod' value='' size='8'></th>"; 
    $nommod = ''; // Define $nommod como vacío si no hay codmod definido
}

// Modalidad
echo "<th>Modalidad:<select name='modalidad' style='width: 500px;'>";
foreach ($modalidades as $modalidad) {
    echo "<option value='$modalidad'";
    if ($nommod == $modalidad) {
        echo " selected";
    }
    echo ">$modalidad</option>";
}
echo "</select></th>"; // Cierra el campo de selección de modalidad
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';

// Opciones disponibles en el select
$options = [
    'permanente' => 'Permanente',
    'titulares' => 'Titulares',
    'transitorio' => 'Interinatos y Suplencias',
    'concurso' => 'Concurso de Titularidad'
];

// Tipo de inscripción
echo "<th>Tipo Inscripción:";
echo "<select name='tipo' id='tipo' style='width: 190px;' onchange='mostrarCamposAdicionales(); showTableBasedOnType();'>";

foreach ($options as $value => $label) {
    echo "<option value='$value'";
    if ($tipo === $value) {
        echo " selected";
    }
    echo ">$label</option>";
}

echo "</select>";
echo "</th>";
echo "</tr>";
echo "</table>";

}

    
?>

<script>
jQuery(document).ready(function($) {
  $('.btn-danger').click(function(e) {
      e.preventDefault(); // Previene el comportamiento predeterminado del enlace
      
      // Obtiene el ID2 del atributo de datos
      var id2 = $(this).data('id2');
      
      // Pregunta al usuario si realmente desea eliminar el movimiento
      if (confirm('¿Desea eliminar el movimiento?')) {
          // Realiza la solicitud AJAX para eliminar el movimiento
          jQuery.ajax({
              type: 'POST',
              url: 'eliminar_movimiento.php', // Ruta al script PHP que maneja la eliminación
              data: { id2: id2 }, // Envía el ID2 al servidor
              success: function(response) {
                  alert('El movimiento ha sido eliminado exitosamente.');
                  // Actualiza la página o realiza otras acciones si es necesario
                  location.reload(); // Recarga la página para reflejar los cambios
              },
              error: function(xhr, status, error) {
                  alert('Error al intentar eliminar el movimiento. Por favor, inténtalo de nuevo.');
                  console.error(xhr.responseText);
              }
          });
      }
  });
});
</script>
<?php


echo "<tr id='fechaRow' style='display: none;'>"; // Inicialmente oculto
echo "<th colspan='4'>Fecha: <input type='date' name='fecha' value='" . htmlspecialchars($fecha) . "'></th>";
echo "</tr>";

// Luego, dentro de tu script PHP, puedes agregar el siguiente código JavaScript
echo "<script>";
echo "document.addEventListener('DOMContentLoaded', function() {";
echo "    var tipoSelect = document.getElementById('tipo');";
echo "    var fechaRow = document.getElementById('fechaRow');";
echo "    tipoSelect.addEventListener('change', function() {";
echo "        if (tipoSelect.value === 'permanente') {";
echo "            fechaRow.style.display = 'table-row';";
echo "        } else {";
echo "            fechaRow.style.display = 'none';";
echo "        }";
echo "    });";

echo "    // Mostrar la fila de fecha si el tipo es 'permanente' al cargar la página";
echo "    if (tipoSelect.value === 'permanente') {";
echo "        fechaRow.style.display = 'table-row';";
echo "    }";
echo "});";
echo "</script>";


 
                                              $codloc = isset($row['codloc']) ? $row['codloc'] : null;

                                              echo "<th style='width:50px;'>Localidad:</th>";
                                              echo "<td>";
                                              echo "<select name='codloc' style='width: 200px;'>";
                                              echo "<option></option>";
                                              echo "<option value='USH'" . ($codloc === "USH" ? " selected" : "") . ">Ushuaia</option>";
                                              echo "<option value='RGD'" . ($codloc === "RGD" ? " selected" : "") . ">Rio Grande</option>";
                                              echo "<option value='TOL'" . ($codloc === "TOL" ? " selected" : "") . ">Tolhuin</option>";
                                              echo "<option value='ANT1'" . ($codloc === "ANT1" ? " selected" : "") . ">Antartida</option>";
                                              echo "</select>";
                                              echo "</td>";
                                              echo"<th>";

                                              $serverName = "localhost";
                                              $connectionOptions = array(
                                                  "Database" => "junta",
                                                  "Uid" => "SA",
                                                  "PWD" => '"asd123"',
                                                  "CharacterSet" => "UTF-8" 

                                              );
                                              
                                              // Establecer la conexión
                                              $conn = sqlsrv_connect($serverName, $connectionOptions);
                                              
                                              // Verificar la conexión
                                              if ($conn === false) {
                                                  die(print_r(sqlsrv_errors(), true));
                                              }
                                              
                                              // Consulta SQL para obtener todos los motivos de exclusión
                                              $queryMotivos = "SELECT idexclu, motivo FROM _junta_motivosexclusion";
                                              $resultMotivos = sqlsrv_query($conn, $queryMotivos);
                                              
                                              // Verificar si se encontraron registros de motivos de exclusión
                                              if ($resultMotivos && sqlsrv_has_rows($resultMotivos)) {
                                                  // Generar el botón "Excluir Inscripción"
                                                  echo "<label for='excluir'>Excluir Inscripción</label>";
                                                  echo "<input type='checkbox' id='excluir' name='excluido' onchange='toggleMotivosExclusion()' style='transform: scale(0.8);' >";
                                              
                                                  // Generar el menú desplegable de motivos de exclusión, inicialmente oculto
                                                  echo "<select id='motivosExclusion' name='excluido' style='display: none;'>";
                                                  echo "<option value=''>Seleccione un motivo de exclusión</option>";
                                              
                                                  // Iterar sobre los resultados y generar las opciones del menú desplegable
                                                  while ($rowMotivo = sqlsrv_fetch_array($resultMotivos, SQLSRV_FETCH_ASSOC)) {
                                                      echo "<option value='" . $rowMotivo['idexclu'] . "'>" . $rowMotivo['motivo'] . "</option>";
                                                  }
                                              
                                                  echo "</select>";
                                              
                                                  // Script para mostrar u ocultar el menú desplegable de motivos de exclusión según el estado del botón
                                                  echo "<script>";
                                                  echo "function toggleMotivosExclusion() {";
                                                  echo "var select = document.getElementById('motivosExclusion');";
                                                  echo "var checkbox = document.getElementById('excluir');";
                                                  echo "if (checkbox.checked) {";
                                                  echo "select.style.display = 'block';";
                                                  echo "} else {";
                                                  echo "select.style.display = 'none';";
                                                  echo "}";
                                                  echo "}";
                                                  echo "</script>";
                                                  echo "</th>";
                                              } else {
                                                  echo "No se encontraron motivos de exclusión en la base de datos.";
                                                  
                                                }
                                
                                                echo "</table>"; // Cierre de la tabla
                                                
                                              
                                              echo"<br>";
                                              
                                              // Generar los campos adicionales para "Titulares", inicialmente ocultos
                                              echo "<tr id='titularesRow' style='display: none;'>";
                                              
                                              // Realiza la consulta para obtener los nombres de los establecimientos
                                              $queryEstablecimientos = "SELECT nomdep,coddep FROM _junta_dependencias";
                                              $resultEstablecimientos = sqlsrv_query($conn, $queryEstablecimientos);
                                              
                                              // Muestra el campo de selección con los nombres de los establecimientos
                                              echo "<th>Establecimiento: <select name='establecimiento'  style='width: 200px;' >";
                                              
                                              // Itera sobre los resultados de la consulta
                                              while ($rowEstablecimiento = sqlsrv_fetch_array($resultEstablecimientos, SQLSRV_FETCH_ASSOC)) {
                                                  $nombreEstablecimiento = $rowEstablecimiento['nomdep'];
                                                  $codEstablecimiento = $rowEstablecimiento['coddep'];

                                              
                                                  // Verificar si el tipo de inscripción es "titulares" u otra opción deseada
                                                  if (trim($row['tipo']) == "titulares" || trim($row['tipo']) == "otra_opcion_deseada") {
                                                      // Si es "titulares" o la otra opción deseada, preselecciona el establecimiento
                                                      echo "<option value='$codEstablecimiento' selected>$nombreEstablecimiento</option>";
                                                  } else {
                                                      // De lo contrario, agrega la opción sin preselección
                                                      echo "<option value='$codEstablecimiento'>$nombreEstablecimiento</option>";
                                                  }
                                              }
                                              
                                              echo "</select></th>";
                            
                                              echo "<td>Observación: <input type='text' name='obs' style='width: 300px;' value='" . htmlspecialchars($obs) . "'></td>";
                                              echo "<td>Horas: <input type='number' name='horas' style='width: 50px;' value='" . htmlspecialchars($horas) . "'></td>";


                     
// Inicializar valores de $row


$row = array(
  'puntajetotal' => $row['puntajetotal'] ?? '',
  'titulo' => $row['titulo'] ?? '',
  'otitulo' => $row['otitulo'] ?? '',
  'concepto' => $row['concepto'] ?? '',
  'promedio' => $row['promedio'] ?? '',
  'antiguedadgestion' => $row['antiguedadgestion'] ?? '',
  'antiguedadtitulo' => $row['antiguedadtitulo'] ?? '',
  'serviciosprovincia' => $row['serviciosprovincia'] ?? '',
  'otrosservicios' => $row['otrosservicios'] ?? '',
  'residencia' => $row['residencia'] ?? '',
  'publicaciones' => $row['publicaciones'] ?? '',
  'otrosantecedentes' => $row['otrosantecedentes'] ?? '',
  't_m_seccion' => $row['t_m_seccion'] ?? '',
  't_m_anio' => $row['t_m_anio'] ?? '',
  't_m_grupo' => $row['t_m_grupo'] ?? '',
  't_m_ciclo' => $row['t_m_ciclo'] ?? '',
  't_m_recupera' => $row['t_m_recupera'] ?? '',
  't_m_comple' => $row['t_m_comple'] ?? '',
  't_m_biblio' => $row['t_m_biblio'] ?? '',
  't_m_gabinete' => $row['t_m_gabinete'] ?? '',
  't_m_sec1' => $row['t_m_sec1'] ?? '',
  't_m_sec2' => $row['t_m_sec2'] ?? '',
  't_m_viced' => $row['t_m_viced'] ?? '',
  't_d_pu' => $row['t_d_pu'] ?? '',
  't_d_3' => $row['t_d_3'] ?? '',
  't_d_2' => $row['t_d_2'] ?? '',
  't_d_1' => $row['t_d_1'] ?? '',
  't_d_biblio' => $row['t_d_biblio'] ?? '',
  't_d_gabi' => $row['t_d_gabi'] ?? '',
  't_d_seccoortec' => $row['t_d_seccoortec'] ?? '',
  't_d_supsectec' => $row['t_d_supsectec'] ?? '',
  't_d_supesc' => $row['t_d_supesc'] ?? '',
  't_d_supgral' => $row['t_d_supgral'] ?? '',
  't_d_adic' => $row['t_d_adic'] ?? '',
  'otrosservicios' => $row['otrosservicios'] ?? '',
  'o_g_a' => $row['o_g_a'] ?? '',
  'o_g_b' => $row['o_g_b'] ?? '',
  'o_g_c' => $row['o_g_c'] ?? '',
  'o_g_d' => $row['o_g_d'] ?? '',
  'residencia' => $row['residencia'] ?? '',
  'publicaciones' => $row['publicaciones'] ?? '',
  'otrosantecedentes' => $row['otrosantecedentes'] ?? ''
);


// Tabla Permanente Concurso Interino
echo "<table id='tablaPermanenteConcursoInterino'>"; // Inicialmente oculta la tabla
echo "<tr><td>";
echo "<h3><u>CARGA COMUN</u> </h3>";
echo "<br>";
echo "<label for='puntaje_total' style='display: inline-block; width: 225px;'>Puntaje Total:</label>";
echo "<input type='text' id='puntaje_total' name='puntajetotal' value='" . htmlspecialchars($row['puntajetotal']) . "'  size='10'>";
echo "<br><br>";

echo "<label for='titulo' style='display: inline-block; width: 225px;'>1.- Título:</label>";
echo "<input type='text' id='titulo' name='titulo' value='" . htmlspecialchars($row['titulo']) . "'  size='10'>";
echo "<br>";

echo "<label for='otrostit' style='display: inline-block; width:  225px;'>2.- Otros Título:</label>";
echo "<input type='text' id='otrostit' name='otitulo' value='" . htmlspecialchars($row['otitulo']) . "' size='10'>";
echo "<br>";

echo "<label for='concepto' style='display: inline-block; width:  225px;'>3.- Conceptos:</label>";
echo "<input type='text' id='concepto' name='concepto' value='" . htmlspecialchars($row['concepto']) . "'  size='10'>";
echo "<br>";

echo "<label for='promedio' style='display: inline-block; width:  225px;'>4.- Promedio:</label>";
echo "<input type='text' id='promedio' name='promedio' value='" . htmlspecialchars($row['promedio']) . "'  size='10'>";
echo "<br>";

echo "<label for='ant_gestion' style='display: inline-block; width:  225px;'>5.- Antigüedad Gestión:</label>";
echo "<input type='text' id='antiguedadgestion' name='antiguedadgestion' value='" . htmlspecialchars($row['antiguedadgestion']) . "'  size='10'>";
echo "<br>";

echo "<label for='ant_titulo' style='display: inline-block; width:  225px;'>6.- Antigüedad Título:</label>";
echo "<input type='text' id='antiguedadtitulo' name='antiguedadtitulo' value='" . htmlspecialchars($row['antiguedadtitulo']) . "'  size='10'>";
echo "<br>";

echo "<label for='servicios' style='display: inline-block; width:  225px;'>7.- Servicios:</label>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width:  225px;'>7.1- En la Provincia:</label>";
echo "<input type='text' id='serviciosprovincia' name='serviciosprovincia' value='" . htmlspecialchars($row['serviciosprovincia']) . "'  size='10'>";
echo "<br>";

echo "<label for='otros_serv' style='display: inline-block; width:  225px;'>7.2- Otros Servicios:</label>";
echo "<input type='text' id='otrosservicios' name='otrosservicios' value='" . htmlspecialchars($row['otrosservicios']) . "'  size='10'>";
echo "<br>";

echo "<label for='residencia' style='display: inline-block; width:  225px;'>8.- Residencia:</label>";
echo "<input type='text' id='residencia' name='residencia' value='" . htmlspecialchars($row['residencia']) . "'  size='10'>";
echo "<br>";

echo "<label for='publicaciones' style='display: inline-block; width:  225px;'>9.- Publicaciones:</label>";
echo "<input type='text' id='publicaciones' name='publicaciones' value='" . htmlspecialchars($row['publicaciones']) . "'  size='10'>";
echo "<br>";

echo "<label for='otrosantecedentes' style='display: inline-block; width:  225px;'>10.- Otros Antecedentes:</label>";
echo "<input type='text' id='otrosantecedentes' name='otrosantecedentes' value='" . htmlspecialchars($row['otrosantecedentes']) . "'  size='10'>";
echo "<br>";
echo "</td></tr>";
echo "</table>";

// Tabla Titular
echo "<table id='tablaTitular'>";
echo "<tr><td>";
echo "<h3><u>CARGA TITULAR</u> </h3>";
echo "<br>";
echo "<label for='puntaje_total' style='display: inline-block; width: 225px;'>Puntaje Total:</label>";
echo "<input type='text' id='puntajetotal' name='puntajetotal' value='" . htmlspecialchars($row['puntajetotal']) . "' size='10'>";
echo "<br><br>";

echo "<label for='titulo' style='display: inline-block; width: 225px;'>1.- Título:</label>";
echo "<input type='text' id='titulo' name='titulo' value='" . htmlspecialchars($row['titulo']) . "' size='10'>";
echo "<br>";

echo "<label for='otrostit' style='display: inline-block; width:  225px;'>2.- Otros Título:</label>";
echo "<input type='text' id='otrostit' name='otitulo' value='" . htmlspecialchars($row['otitulo']) . "' size='10'>";
echo "<br>";

echo "<label for='promedio' style='display: inline-block; width:  225px;'>4.- Promedio:</label>";
echo "<input type='text' id='promedio' name='promedio' value='" . htmlspecialchars($row['promedio']) . "' size='10'>";
echo "<br>";

echo "<label for='ant_gestion' style='display: inline-block; width:  225px;'>5.- Antigüedad Gestión:</label>";
echo "<input type='text' id='antiguedadgestion' name='antiguedadgestion' value='" . htmlspecialchars($row['antiguedadgestion']) . "' size='10'>";
echo "<br>";

echo "<label for='ant_titulo' style='display: inline-block; width:  225px;'>6.- Antigüedad Título:</label>";
echo "<input type='text' id='antiguedadtitulo' name='antiguedadtitulo' value='" . htmlspecialchars($row['antiguedadtitulo']) . "' size='10'>";
echo "<br>";

echo "<label for='servicios' style='display: inline-block; width:  225px;'>7.- Servicios:</label>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width:  225px;'>7.1- En la Provincia:</label>";
echo "<input type='text' id='serviciosprovincia' name='serviciosprovincia' value='" . htmlspecialchars($row['serviciosprovincia']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Maestro de Sección:</label>";
echo "<input type='text' id='t_m_seccion' name='t_m_seccion' value='" . htmlspecialchars($row['t_m_seccion']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Maestro de Año:</label>";
echo "<input type='text' id='t_m_anio' name='t_m_anio' value='" . htmlspecialchars($row['t_m_anio']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Maestro de Grupo:</label>";
echo "<input type='text' id='t_m_grupo' name='t_m_grupo' value='" . htmlspecialchars($row['t_m_grupo']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Maestro de Ciclo:</label>";
echo "<input type='text' id='t_m_ciclo' name='t_m_ciclo' value='" . htmlspecialchars($row['t_m_ciclo']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Maestro Recuperado:</label>";
echo "<input type='text' id='t_m_recupera' name='t_m_recupera' value='" . htmlspecialchars($row['t_m_recupera']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Maestro Complementario:</label>";
echo "<input type='text' id='t_m_comple' name='t_m_comple' value='" . htmlspecialchars($row['t_m_comple']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Maestro Bibliotecario:</label>";
echo "<input type='text' id='t_m_biblio' name='t_m_biblio' value='" . htmlspecialchars($row['t_m_biblio']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Gabinete:</label>";
echo "<input type='text' id='T_m_gabinete' name='t_m_gabinete' value='" . htmlspecialchars($row['t_m_gabinete']) . "' size='10'>";
echo "<br>";

echo "<hr>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Secretaria 1º:</label>";
echo "<input type='text' id='T_m_sec1' name='t_m_sec1' value='" . htmlspecialchars($row['t_m_sec1']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Secretaria 2º:</label>";
echo "<input type='text' id='t_m_sec2' name='t_m_sec2' value='" . htmlspecialchars($row['t_m_sec2']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Vice-Director:</label>";
echo "<input type='text' id='t_m_viced' name='t_m_viced' value='" . htmlspecialchars($row['t_m_viced']) . "' size='10'>";
echo "<br>";

echo "<hr>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Director Personal Único:</label>";
echo "<input type='text' id='t_d_pu' name='t_d_pu' value='" . htmlspecialchars($row['t_d_pu']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Director de 3º:</label>";
echo "<input type='text' id='t_d_3' name='t_d_3' value='" . htmlspecialchars($row['t_d_3']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Director de 2º:</label>";
echo "<input type='text' id='t_d_2' name='t_d_2' value='" . htmlspecialchars($row['t_d_2']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Director de 1º:</label>";
echo "<input type='text' id='t_d_1' name='t_d_1' value='" . htmlspecialchars($row['t_d_1']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Director de Biblioteca:</label>";
echo "<input type='text' id='t_d_biblio' name='t_d_biblio' value='" . htmlspecialchars($row['t_d_biblio']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Director de Gabinete:</label>";
echo "<input type='text' id='t_d_gabi' name='t_d_gabi' value='" . htmlspecialchars($row['t_d_gabi']) . "' size='10'>";
echo "<br>";

echo "<hr>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Secretario Coord. Tec.:</label>";
echo "<input type='text' id='t_d_seccoortec' name='t_d_seccoortec' value='" . htmlspecialchars($row['t_d_seccoortec']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Sup. Sec. Tec.:</label>";
echo "<input type='text' id='t_d_supsectec' name='t_d_supsectec' value='" . htmlspecialchars($row['t_d_supsectec']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Sup. Escolar:</label>";
echo "<input type='text' id='t_d_supesc' name='t_d_supesc' value='" . htmlspecialchars($row['t_d_supesc']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Sup. General:</label>";
echo "<input type='text' id='t_d_supgral' name='t_d_supgral' value='" . htmlspecialchars($row['t_d_supgral']) . "' size='10'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Adic.:</label>";
echo "<input type='text' id='t_d_adic' name='t_d_adic' value='" . htmlspecialchars($row['t_d_adic']) . "' size='10'>";
echo "<br>";

echo "<hr>";

echo "<label for='otros_serv' style='display: inline-block; width:  225px;'>7.2- Otros Servicios:</label>";
echo "<input type='text' id='otros_serv' name='otros_serv' value='" . htmlspecialchars($row['otrosservicios']) . "' size='10'>";
echo "<br>";

echo "<label for='otros_serv' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Grupo A:</label>";
echo "<input type='text' id='o_g_a' name='o_g_a' value='" . htmlspecialchars($row['o_g_a']) . "' size='10'>";
echo "<br>";

echo "<label for='otros_serv' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Grupo B:</label>";
echo "<input type='text' id='o_g_b' name='o_g_b' value='" . htmlspecialchars($row['o_g_b']) . "' size='10'>";
echo "<br>";

echo "<label for='otros_serv' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Grupo C:</label>";
echo "<input type='text' id='o_g_c' name='o_g_c' value='" . htmlspecialchars($row['o_g_c']) . "' size='10'>";
echo "<br>";

echo "<label for='otros_serv' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Grupo D:</label>";
echo "<input type='text' id='o_g_d' name='o_g_d' value='" . htmlspecialchars($row['o_g_d']) . "' size='10'>";
echo "<br>";

echo "<label for='residencia' style='display: inline-block; width:  225px;'>8.- Residencia:</label>";
echo "<input type='text' id='residencia' name='residencia' value='" . htmlspecialchars($row['residencia']) . "' size='10'>";
echo "<br>";

echo "<label for='publicaciones' style='display: inline-block; width:  225px;'>9.- Publicaciones:</label>";
echo "<input type='text' id='publicaciones' name='publicaciones' value='" . htmlspecialchars($row['publicaciones']) . "' size='10'>";
echo "<br>";

echo "<label for='otros_antec' style='display: inline-block; width:  225px;'>10.- Otros Antecedentes:</label>";
echo "<input type='text' id='otros_antec' name='otros_antec' value='" . htmlspecialchars($row['otrosantecedentes']) . "' size='10'>";
echo "<br>";
echo "</td></tr>";
echo "</table>";
    
// JavaScript para mostrar u ocultar las tablas según el tipo seleccionado
echo "<script>";
echo "document.addEventListener('DOMContentLoaded', function() {";
echo "    var tipoSelect = document.getElementById('tipo');";
echo "    var tablaPermanenteConcursoInterino = document.getElementById('tablaPermanenteConcursoInterino');";
echo "    var tablaTitular = document.getElementById('tablaTitular');";
echo "    var tablaComun = document.getElementById('tablaComun');"; // Agregar la tabla común
echo "    function mostrarTablaSegunTipo() {";
echo "        if (tipoSelect.value === 'permanente' || tipoSelect.value === 'concurso' || tipoSelect.value === 'transitorio') {";
echo "            tablaPermanenteConcursoInterino.style.display = 'table';";
echo "            tablaTitular.style.display = 'none';";
echo "            tablaComun.style.display = 'none';"; // Ocultar la tabla común
echo "        } else if (tipoSelect.value === 'titulares') {";
echo "            tablaPermanenteConcursoInterino.style.display = 'none';";
echo "            tablaTitular.style.display = 'table';";
echo "            tablaComun.style.display = 'none';"; // Ocultar la tabla común
echo "        } else {";
echo "            tablaPermanenteConcursoInterino.style.display = 'none';";
echo "            tablaTitular.style.display = 'none';";
echo "            tablaComun.style.display = 'table';"; // Mostrar la tabla común
echo "        }";
echo "    }";
echo "    tipoSelect.addEventListener('change', mostrarTablaSegunTipo);"; // Escuchar el cambio en el select
echo "    mostrarTablaSegunTipo();"; // Llamar a la función al cargar la página para mostrar la tabla correspondiente
echo "});";
echo "</script>";

                 echo"<br>";
                echo"<br>";
                echo"<br>";
  
               
         // Script para mostrar u ocultar los campos adicionales según el tipo de inscripción seleccionado
                    echo "<script>";
                    echo "function mostrarCamposAdicionales() {";
                    echo "var select = document.getElementById('tipo');";
                    echo "var titularesRow = document.getElementById('titularesRow');";
                    echo "var fechaRow = document.getElementById('fechaRow');";
                    echo "if (select.value === 'titulares') {";
                    echo "titularesRow.style.display = 'table-row';";
                    echo "fechaRow.style.display = 'none';";
                    echo "} else {";
                    echo "titularesRow.style.display = 'none';";
                    echo "fechaRow.style.display = 'table-row';";
                    echo "}";
                    echo "}";
      // Llamar a la función para mostrar campos adicionales y tablas al cargar la página
                    echo "mostrarCamposAdicionales();";
                    echo "showTableBasedOnType();";
                    echo "</script>";?>

                
              
              <?php

              echo " <input type='hidden' name='id2' id='id2'> ";
              echo"<button type='button' id='btnActualizar'>Actualizar</button>";
             
              echo "</form>";
              echo "<center>";
              echo" <a href='javascript:history.back()' class='btn btn-success'>Volver atrás</a>";
            echo "</center>";
            
         
              
             
              ?>
                <?php include('footer2.php');?>
                <script>
$(document).ready(function() {
    $('#btnActualizar').click(function() {
        var datos = $('#miFormulario').serialize(); // Serializa los datos del formulario
        $.ajax({
            type: 'POST',
            url: 'ActualizarMovimientos.php', // Archivo PHP para procesar la actualización
            data: datos,
            success: function(response) {
                // Maneja la respuesta del servidor aquí
                alert(response); // Muestra la respuesta del servidor (puedes ajustarla según tus necesidades)
            },
            error: function(xhr, status, error) {
                // Maneja errores de la solicitud AJAX
                console.error(xhr.responseText);
            }
        });
    });
});
</script>

<script>
//funcion de guardar datos
function myConfirmMov() {
  var result = confirm("¿Desea actualizar el MOVIMIENTO?");
  return result;
}
<script>



</th>


