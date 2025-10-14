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

   <!-- Carga de jQuery -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   


</head>
<body>
  <div class="container">
    <center><h1><u>Inscripcion de Docente</u></h1></center>
    <center><h3>(Actualizacion)</h3></center>
<br>

<?php
// Establecer la conexión a SQL Server
$serverName = "10.1.9.113"; // Reemplazar con el nombre de tu servidor SQL Server
$connectionInfo = array(
    "Database" => "junta", // Reemplazar con el nombre de tu base de datos
    "Uid" => "SA", // Usuario SQL Server
    "PWD" => 'Davinci2024#', // Contraseña del usuario SQL Server
    "CharacterSet" => "UTF-8", // Para caracteres especiales
    "TrustServerCertificate" => true // Confía en certificados autofirmados
);
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn) {
    echo "";
} else {
    echo "Error en la conexión.<br>";
    // Obtener y mostrar errores detallados
    $errors = sqlsrv_errors();
    foreach ($errors as $error) {
        echo "SQLSTATE: " . $error['SQLSTATE'] . "<br>";
        echo "Code: " . $error['code'] . "<br>";
        echo "Message: " . $error['message'] . "<br>";
    }
}
    //echo "Conexión exitosa.";
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
// Establecer la conexión a SQL Server
$serverName = "10.1.9.113"; // Reemplazar con el nombre de tu servidor SQL Server
$connectionInfo = array(
    "Database" => "junta", // Reemplazar con el nombre de tu base de datos
    "Uid" => "SA", // Usuario SQL Server
    "PWD" => 'Davinci2024#', // Contraseña del usuario SQL Server
    "CharacterSet" => "UTF-8", // Para caracteres especiales
    "TrustServerCertificate" => true // Confía en certificados autofirmados
);
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn) {
    echo "";
} else {
    echo "Error en la conexión.<br>";
    // Obtener y mostrar errores detallados
    $errors = sqlsrv_errors();
    foreach ($errors as $error) {
        echo "SQLSTATE: " . $error['SQLSTATE'] . "<br>";
        echo "Code: " . $error['code'] . "<br>";
        echo "Message: " . $error['message'] . "<br>";
    }
}
    //echo "Conexión exitosa.";
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
        echo "<td><center><button type='button' onclick='showDetails($legajo)' title='detalle docente' class='detalle-button'><i class='glyphicon glyphicon-list-alt'></i>  Detalle</button></center></td>";
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
          echo "<td>Residencia:</td><td colspan='2'>" . $row['fingreso']->format('d/m/Y') . "</td>";
      } else {
          echo "<td>Residencia:</td><td colspan='2'>No disponible</td>";
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
<center><h4><u>Actualizacion de Movimiento</u></h4></center>
<table>
  
 <?php
$legajo = $_GET['legajo'];
$excluido = isset($_GET['excluido']) && $_GET['excluido'] !== null ? $_GET['excluido'] : 'no';



$hijos = isset($_GET['hijos']) ? $_GET['hijos'] : 0;

$codmod = $_GET['codmod'];
$tipo = $_GET['tipo'];
$anodoc = $_GET['anodoc'];
$receivedNomdep = urldecode($_GET['nomdep']);
$obs = urldecode($_GET['obs']); // Decodificar la observación
$horas = $_GET['horas'];
$id2 = $_GET['id2'];
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : ''; // Recibir la fecha

// Establecer la conexión a SQL Server
$serverName = "10.1.9.113"; // Reemplazar con el nombre de tu servidor SQL Server
$connectionInfo = array(
    "Database" => "junta", // Reemplazar con el nombre de tu base de datos
    "Uid" => "SA", // Usuario SQL Server
    "PWD" => 'Davinci2024#', // Contraseña del usuario SQL Server
    "CharacterSet" => "UTF-8", // Para caracteres especiales
    "TrustServerCertificate" => true // Confía en certificados autofirmados
);
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn) {
    echo "";
} else {
    echo "Error en la conexión.<br>";
    // Obtener y mostrar errores detallados
    $errors = sqlsrv_errors();
    foreach ($errors as $error) {
        echo "SQLSTATE: " . $error['SQLSTATE'] . "<br>";
        echo "Code: " . $error['code'] . "<br>";
        echo "Message: " . $error['message'] . "<br>";
    }
}
    //echo "Conexión exitosa.";

// Consulta SQL para obtener todos los nombres de modalidad
$queryModalidades = "SELECT codmod, nommod FROM _junta_modalidades";
$resultModalidades = sqlsrv_query($conn, $queryModalidades);

$modalidades = array(); // Almacenar las modalidades (código + nombre)

if ($resultModalidades) {
    while ($rowModalidad = sqlsrv_fetch_array($resultModalidades, SQLSRV_FETCH_ASSOC)) {
        $modalidades[] = [
            'codmod' => $rowModalidad['codmod'],
            'nommod' => $rowModalidad['nommod']
        ];
    }
} else {
    die(print_r(sqlsrv_errors(), true));
}

// Consulta principal con joins
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
    LEFT JOIN _junta_dependencias j_dep ON j_mov.establecimiento = j_dep.coddep";

$resultData = sqlsrv_query($conn, $queryData);

if ($resultData === false) {
    die(print_r(sqlsrv_errors(), true));
}

echo "<table border='1'>";  
echo "<form action='GrabarMovimientosPermanentes.php' method='post'>";
echo "<input type='hidden' name='legajo' value='" . htmlspecialchars($legajo) . "'>";

// Verifica si hay filas
if (sqlsrv_has_rows($resultData)) {
    $row = sqlsrv_fetch_array($resultData, SQLSRV_FETCH_ASSOC);
   
    // === Fila de encabezado con curso y botones ===
    echo "<tr>";
    
    // Curso
    echo "<th>Curso: <input type='text' name='anodoc' value='" . htmlspecialchars($row['anodoc'] ?? '') . "' size='11'></th>";
    echo "<th></th>";
    
    // Botones
    echo "<td style='text-align: center;'>";
    echo "<div style='display: flex; justify-content: center; gap: 20px;'>";
    echo "<button type='button' class='btn btn-primary' id='cancelarBtn' title='Volver'>
            <i class='glyphicon glyphicon-arrow-left'></i> Volver
        </button>";
    echo "<button class='btn btn-warning' title='Duplicar Registro' type='submit'>
            <i class='glyphicon glyphicon-copy'></i> Duplicar
        </button>";
    echo "</div>";
    echo "</td>";
    echo "</tr>";

    // === Fila de modalidad ===
    echo "<tr>";

    // Código de modalidad
    echo "<th>Cód. Mod: <input type='text' name='codmod' id='codmod' value='" . htmlspecialchars($row['codmod']) . "' size='8' onchange='fetchModalidad()'></th>";

    // Modalidad (select)
    echo "<th>Modalidad:
            <select name='modalidad' id='modalidad' style='width: 500px;'>";

    foreach ($modalidades as $modalidad) {
        $selected = ($modalidad['codmod'] == $row['codmod']) ? "selected" : "";
        echo "<option value='" . htmlspecialchars($modalidad['codmod']) . "' $selected>" . htmlspecialchars($modalidad['nommod']) . "</option>";
    }

    echo "  </select>
        </th>";
       

// JavaScript para hacer la petición AJAX
echo "<script>
function fetchModalidad() {
    const codmod = document.getElementById('codmod').value;

    if (codmod) {
        // Realizar la petición AJAX
        fetch('buscar_por_codigo.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'codmod=' + codmod
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const modalidadSelect = document.getElementById('modalidad');
                // Limpiar el select antes de agregar las nuevas opciones
                modalidadSelect.innerHTML = '';

                // Crear y agregar la opción de modalidad encontrada
                const option = document.createElement('option');
                option.value = data.nommod;
                option.text = data.nommod;
                modalidadSelect.appendChild(option);
            } else {
                alert(data.error);
            }
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
        });
    }
}
</script>";

   // Tipo de inscripción
echo "<th>Tipo Inscripción:";
echo "<select name='tipo' id='tipo' style='width: 200px;' onchange='mostrarCamposAdicionales(); '>";
echo "<option value='Permanente'";
if (trim($row['tipo']) == "Permanente" || trim($row['tipo']) == "permanente") {
    echo " selected";
}
echo ">Permanente</option>";
echo "<option value='Titulares'";
if (trim($row['tipo']) == "Titulares" || trim($row['tipo']) == "titulares") {
    echo " selected";
}
echo ">Titulares</option>";
echo "<option value='transitorio'";
if (trim($row['tipo']) == "Transitorio" || trim($row['tipo']) == "transitorio" ) {
    echo " selected";
}
echo ">Interinatos y Suplencias</option>";
echo "<option value='Concurso'";
if (trim($row['tipo']) == "Concurso" || trim($row['tipo']) == "concurso") {
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
        echo "<th style='text-align: right;'>Curso: <input type='text' name='anodoc' value='" . htmlspecialchars($anodoc) . "' size='11'></th>";
    } else {
        echo "<th style='text-align: right;'>Curso: <input type='text' name='anodoc' value='' size='11'></th>"; 
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
    'Permanente' => 'Permanente',
    'Titulares' => 'Titulares',
    'transitorio' => 'Interinatos y Suplencias',
    'Concurso' => 'Concurso de Titularidad'
];

// Tipo de inscripción
echo "<th>Tipo Inscripción:";
echo "<select name='tipo' id='tipo' style='width: 242px;' onchange='mostrarCamposAdicionales();'>";

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

if (!empty($fecha)) {
    $fecha = date('Y-m-d', strtotime($fecha));
} else {
    $fecha = '';
}



echo "<tr id='fechaRow' style='display: none;'>"; // Inicialmente oculto
echo "<th colspan='4'>Fecha: <input type='date' name='fecha' value='" . htmlspecialchars($fecha) . "'></th>";
echo "</tr>";

// Luego, dentro de tu script PHP, puedes agregar el siguiente código JavaScript
echo "<script>";
echo "document.addEventListener('DOMContentLoaded', function() {";
echo "    var tipoSelect = document.getElementById('tipo');";
echo "    var fechaRow = document.getElementById('fechaRow');";
echo "    tipoSelect.addEventListener('change', function() {";
echo "        if (tipoSelect.value === 'Permanente') {";
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
echo "<select name='codloc' style='width: 200px;' onchange='checkLocalidad()'>";
echo "<option></option>";
echo "<option value='USH'" . ($codloc === "USH" ? " selected" : "") . ">Ushuaia</option>";
echo "<option value='RGD'" . ($codloc === "RGD" ? " selected" : "") . ">Rio Grande</option>";
echo "<option value='TOL'" . ($codloc === "TOL" ? " selected" : "") . ">Tolhuin</option>";
echo "<option value='ANT'" . ($codloc === "ANT" ? " selected" : "") . ">Antartida</option>";
echo "</select>";
echo "</td>";

                    // Verificar si la localidad es diferente de "ANT1" (Antártida) para mostrar "Cantidad de Hijos"
                    if ($codloc == "ANT") {
                        echo "<th style='width:50px;'>Cantidad de Hijos:</th>";
                        echo "<td>";
                        echo "<input type='number' name='hijos' id='hijos' value='$hijos' min='0' style='width: 80px;'>";
                        echo "</td>";
                        // Correcto: HTML fuera del echo
                                ?>
                                                               <label for="legajo">Legajo vinculado:</label>
                                <input type="text" name="legajo2" id="legajo" placeholder="Ingrese legajo" value="<?php echo isset($row['legvinc']) && $row['legvinc'] !== '' ? htmlspecialchars($row['legvinc']) : '0'; ?>" disabled />

                                <?php

                    } else {
                        // Si la localidad es Antártida, no mostrar el campo "Cantidad de Hijos"
                        echo "<script>
                                document.getElementById('hijos').style.display = 'none';
                            </script>";
}
                                              echo "</td>";
                                              echo"<th>";
                                              echo"<br>";


                                              
                                              



                                             
                                                
                                                                                    // Establecer la conexión a SQL Server
                                        $serverName = "10.1.9.113"; // Reemplazar con el nombre de tu servidor SQL Server
                                        $connectionInfo = array(
                                            "Database" => "junta", // Reemplazar con el nombre de tu base de datos
                                            "Uid" => "SA", // Usuario SQL Server
                                            "PWD" => 'Davinci2024#', // Contraseña del usuario SQL Server
                                            "CharacterSet" => "UTF-8", // Para caracteres especiales
                                            "TrustServerCertificate" => true // Confía en certificados autofirmados
                                        );
                                        $conn = sqlsrv_connect($serverName, $connectionInfo);

                                        if ($conn) {
                                            echo "";
                                        } else {
                                            echo "Error en la conexión.<br>";
                                            // Obtener y mostrar errores detallados
                                            $errors = sqlsrv_errors();
                                            foreach ($errors as $error) {
                                                echo "SQLSTATE: " . $error['SQLSTATE'] . "<br>";
                                                echo "Code: " . $error['code'] . "<br>";
                                                echo "Message: " . $error['message'] . "<br>";
                                            }
                                        }
                                        
                                            //echo "Conexión exitosa.";
                                              
                                              // Consulta SQL para obtener todos los motivos de exclusión
                                                    // Recuperar el motivo de exclusión seleccionado si existe en el POST
                                                    $excluidoSeleccionado = isset($_GET['excluido']) ? $_GET['excluido'] : null;
                                                    
                                                   // Verificar si el checkbox debe estar marcado: solo si excluido es distinto de "23" y excluido no es "no"
                                                            $excluirChecked = ($excluidoSeleccionado !== "23" && $excluidoSeleccionado !== "no") ? "checked" : "";

                                                            // Consulta SQL para obtener todos los motivos de exclusión
                                                            $queryMotivos = "SELECT idexclu, motivo FROM _junta_motivosexclusion";
                                                            $resultMotivos = sqlsrv_query($conn, $queryMotivos);

                                                            // Verificar si se encontraron registros de motivos de exclusión
                                                            if ($resultMotivos && sqlsrv_has_rows($resultMotivos)) {
                                                               // Generar el botón "Excluir Inscripción"
                                                                    echo "<div style='display: flex; align-items: center;'>"; // Crear un contenedor flexible
                                                                    echo "<label for='excluir' style='margin-right: 10px; margin-bottom: -3px;'>Excluir Inscripción</label>";

                                                                    // Mostrar el checkbox y verificar si debe estar marcado
                                                                    echo "<input type='checkbox' id='excluir' name='excluido_checkbox' onchange='toggleMotivosExclusion()' style='transform: scale(0.9); margin-right: 10px;' $excluirChecked>";

                                                                    // Mostrar el menú desplegable de motivos de exclusión (visible si excluido != "23" y excluido != "no")
                                                                    $display = ($excluidoSeleccionado !== "23" && $excluidoSeleccionado !== "no") ? "block" : "none";
                                                                    echo "<select id='motivosExclusion' name='excluido' style='display: $display; width: 600px;'>"; // Ajusta el ancho según necesites
                                                                    echo "<option value=''>Seleccione un motivo de exclusión</option>";

                                                                    // Iterar sobre los resultados y generar las opciones del menú desplegable
                                                                    while ($rowMotivo = sqlsrv_fetch_array($resultMotivos, SQLSRV_FETCH_ASSOC)) {
                                                                        // Verificar si este motivo es el seleccionado
                                                                        $selected = ($rowMotivo['idexclu'] == $excluidoSeleccionado) ? "selected" : "";
                                                                        echo "<option value='" . $rowMotivo['idexclu'] . "' $selected>" . $rowMotivo['motivo'] . "</option>";
                                                                    }

                                                                    echo "</select>";
                                                                    echo "</div>"; // Cerrar el contenedor flexible

                                                                // Añadir el script para mostrar u ocultar el menú desplegable
                                                                echo "<script>
                                                                function toggleMotivosExclusion() {
                                                                    var select = document.getElementById('motivosExclusion');
                                                                    var checkbox = document.getElementById('excluir');
                                                                    if (checkbox.checked) {
                                                                        select.style.display = 'block';
                                                                    } else {
                                                                        select.style.display = 'none';
                                                                        select.selectedIndex = 0; // Reiniciar selección cuando se desmarca el checkbox
                                                                    }
                                                                }

                                                                // Mostrar el menú desplegable si el checkbox ya está marcado al cargar la página
                                                                window.onload = function() {
                                                                    var checkbox = document.getElementById('excluir');
                                                                    if (checkbox.checked) {
                                                                        document.getElementById('motivosExclusion').style.display = 'block';
                                                                    }
                                                                };
                                                                </script>";
                                                            } else {
                                                                echo "No se encontraron motivos de exclusión en la base de datos.";
                                                            }
                                                echo "</table>"; // Cierre de la tabla
                                                
                                              
                                           
                                              
                                              // Generar los campos adicionales para "Titulares", inicialmente ocultos
                                              echo "<tr id='titularesRow' style='display: none;'>";
                                              
                                              // Realiza la consulta para obtener los nombres de los establecimientos
                                             // Realiza la consulta para obtener los nombres de los establecimientos
                                                $queryEstablecimientos = "   SELECT iddep, nomdep, coddep
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
                                                $resultEstablecimientos = sqlsrv_query($conn, $queryEstablecimientos);

                                                // Muestra el campo de selección con los nombres de los establecimientos
                                                echo "<th>Establecimiento: <select name='establecimiento' style='width: 200px;'>";

                                                // Itera sobre los resultados de la consulta
                                                while ($rowEstablecimiento = sqlsrv_fetch_array($resultEstablecimientos, SQLSRV_FETCH_ASSOC)) {
                                                    $nombreEstablecimiento = $rowEstablecimiento['nomdep'];
                                                    $codEstablecimiento = $rowEstablecimiento['coddep'];
                                                    
                                                    // Verifica si el establecimiento actual coincide con el valor recibido
                                                    $selected = ($nombreEstablecimiento === $receivedNomdep) ? "selected" : "";

                                                    // Genera la opción del select, incluyendo "selected" si es la opción preseleccionada
                                                    echo "<option value='$codEstablecimiento' $selected>$nombreEstablecimiento</option>";
                                                }

                                                // Cierra el select
                                                echo "</select></th>";
                            
                                              echo "<td>Observación: <input type='text' id='obs' name='obs' style='width: 300px;' value='" . htmlspecialchars($obs) . "'></td>";
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


//Tabla Permanente Concurso Interino 
echo "<script >
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
</script>";


echo "<table id='tablaPermanenteConcursoInterino'>";
echo "<tr><td>";
echo "<h3><u>CARGA COMUN</u> </h3>";
echo "<br>";
echo "<label for='puntajetotal2' style='display: inline-block; width: 225px;'>Puntaje Total:</label>";
echo "<input type='number' id='puntajetotal2' name='puntajetotal2' value='" . htmlspecialchars($row['puntajetotal']) . "' step='0.01' size='5' readonly>";
echo "<br><br>";

echo "<label for='titulo2' style='display: inline-block; width: 225px;'>1.- Título:</label>";
echo "<input type='number' id='titulo2' name='titulo2' value='" . htmlspecialchars($row['titulo']) . "' step='0.01' size='5' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>";
echo "<br>";

echo "<label for='otitulo2' style='display: inline-block; width:225px;'>2.- Otros Título:</label>";
echo "<input type='number' id='otitulo2' name='otitulo2' value='" . htmlspecialchars($row['otitulo']) . "' step='0.01' size='5' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>";
echo "<br>";



echo "<label for='promedio2' style='display: inline-block; width:  225px;'>3.- Promedio:</label>";
echo "<input type='number' id='promedio2' name='promedio2' value='" . htmlspecialchars($row['promedio']) . "' step='0.01' size='5' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>";
echo "<br>";

echo "<label for='antiguedadgestion2' style='display: inline-block; width:  225px;'>4.- Antigüedad Gestión:</label>";
echo "<input type='number' id='antiguedadgestion2' name='antiguedadgestion2' value='" . htmlspecialchars($row['antiguedadgestion']) . "' step='0.01' size='5' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>";
echo "<br>";

echo "<label for='antiguedadtitulo2' style='display: inline-block; width:  225px;'>5.- Antigüedad Título:</label>";
echo "<input type='number' id='antiguedadtitulo2' name='antiguedadtitulo2' value='" . htmlspecialchars($row['antiguedadtitulo']) ."' step='0.01' size='5' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>";
echo "<br>";

echo "<label for='servicios' style='display: inline-block; width:  225px;'>6.- Servicios:</label>";
echo "<br>";

echo "<label for='serviciosprovincia2' style='display: inline-block; width:  225px;'>6.1- En la Provincia:</label>";
echo "<input type='number' id='serviciosprovincia2' name='serviciosprovincia2' value='" . htmlspecialchars($row['serviciosprovincia']) ."' step='0.01' size='5' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>";
echo "<br>";

echo "<label for='otrosservicios2' style='display: inline-block; width:  225px;'>6.2- Otros Servicios:</label>";
echo "<input type='number' id='otrosservicios2' name='otrosservicios2' value='" . htmlspecialchars($row['otrosservicios']) . "' step='0.01' size='5' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>";
echo "<br>";

echo "<label for='residencia2' style='display: inline-block; width:  225px;'>7.- Residencia:</label>";
echo "<input type='number' id='residencia2' name='residencia2' value='" . htmlspecialchars($row['residencia']) . "' step='0.01' size='5' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>";
echo "<br>";

echo "<label for='publicaciones2' style='display: inline-block; width:  225px;'>8.- Publicaciones:</label>";
echo "<input type='number' id='publicaciones2' name='publicaciones2' value='" . htmlspecialchars($row['publicaciones']) . "' step='0.01' size='5' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>";
echo "<br>";

echo "<label for='otrosantecedentes2' style='display: inline-block; width:  225px;'>9.- Otros Antecedentes:</label>";
echo "<input type='number' id='otrosantecedentes2' name='otrosantecedentes2' value='" . htmlspecialchars($row['otrosantecedentes']) . "' step='0.01' size='5' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'>";
echo "<br>";

echo "</td></tr>";
echo "</table>";


echo "<script>
 function calcularPuntajeTotal2() { 
    try {
        var getFieldValue = function(id) {
            var element = document.getElementById(id);
            return element ? parseFloat(element.value) || 0 : 0;
        };

        // Campos principales
        var titulo = getFieldValue('titulo'),
            otitulo = getFieldValue('otrostit'),
            concepto = getFieldValue('concepto'),
            promedio = getFieldValue('promedio'),
            antiguedadGestion = getFieldValue('antiguedadgestion'),
            antiguedadTitulo = getFieldValue('antiguedadtitulo'),
            residencia = getFieldValue('residencia'),
            publicaciones = getFieldValue('publicaciones'),
            otrosantecedentes = getFieldValue('otrosantecedentes');

        // Sumar campos relacionados con servicios provincia
        var serviciosProvincia = 
            getFieldValue('t_m_seccion') +
            getFieldValue('t_m_anio') +
            getFieldValue('t_m_grupo') +
            getFieldValue('t_m_ciclo') +
            getFieldValue('t_m_recupera') +
            getFieldValue('t_m_comple') +
            getFieldValue('t_m_biblio') +
            getFieldValue('t_m_gabinete') +
            getFieldValue('t_m_sec1') +
            getFieldValue('t_m_sec2') +
            getFieldValue('t_m_viced') +
            getFieldValue('t_d_pu') +
            getFieldValue('t_d_3') +
            getFieldValue('t_d_2') +
            getFieldValue('t_d_1') +
            getFieldValue('t_d_biblio') +
            getFieldValue('t_d_gabi') +
            getFieldValue('t_d_seccoortec') +
            getFieldValue('t_d_supsectec') +
            getFieldValue('t_d_supesc') +
            getFieldValue('t_d_supgral') +
            getFieldValue('t_d_adic');

        // Calcular el total de otros servicios
        var otrosServicios = 
            getFieldValue('o_g_a') +
            getFieldValue('o_g_b') +
            getFieldValue('o_g_c') +
            getFieldValue('o_g_d');

        // Actualizar el valor de otrosServicios en el campo correspondiente
        var otrosServiciosElement = document.getElementById('otrosservicios');
        if (otrosServiciosElement) otrosServiciosElement.value = otrosServicios.toFixed(2);

        // Actualizar el valor de serviciosProvincia en el campo correspondiente
        var serviciosProvinciaElement = document.getElementById('serviciosprovincia');
        if (serviciosProvinciaElement) serviciosProvinciaElement.value = serviciosProvincia.toFixed(2);

        // Calcular el puntaje total
        var puntajeTotal = titulo + otitulo + concepto + promedio + antiguedadGestion +
                           antiguedadTitulo + serviciosProvincia + residencia + publicaciones +
                           otrosantecedentes + otrosServicios;

        // Actualizar el valor en el campo puntajetotal
        var puntajeTotalElement = document.getElementById('puntajetotal');
        if (puntajeTotalElement) puntajeTotalElement.value = puntajeTotal.toFixed(2);
    } catch (error) {
        console.error('Error al calcular el puntaje total: ', error);
    }
}
</script>";

// Tabla Titular
echo "<table id='tablaTitular'>";
echo "<tr><td>";
echo "<h3><u>CARGA TITULAR</u> </h3>";
echo "<br>";
echo "<label for='puntajetotal' style='display: inline-block; width: 225px;'>Puntaje Total:</label>";
echo "<input type='number' id='puntajetotal' name='puntajetotal' value='" . htmlspecialchars($row['puntajetotal']) . "' size='10' readonly>";
echo "<br><br>";

echo "<label for='titulo' style='display: inline-block; width: 225px;'>1.- Título:</label>";
echo "<input type='number' id='titulo' name='titulo' value='" . htmlspecialchars($row['titulo']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='otrostit' style='display: inline-block; width:  225px;'>2.- Otros Título:</label>";
echo "<input type='number' id='otrostit' name='otitulo' value='" . htmlspecialchars($row['otitulo']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='concepto' style='display: inline-block; width:  225px;'>3.- Conceptos:</label>";
echo "<input type='number' id='concepto' name='concepto' value='" . htmlspecialchars($row['concepto']) . "'  size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='promedio' style='display: inline-block; width:  225px;'>4.- Promedio:</label>";
echo "<input type='number' id='promedio' name='promedio' value='" . htmlspecialchars($row['promedio']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='ant_gestion' style='display: inline-block; width:  225px;'>5.- Antigüedad Gestión:</label>";
echo "<input type='number' id='antiguedadgestion' name='antiguedadgestion' value='" . htmlspecialchars($row['antiguedadgestion']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='ant_titulo' style='display: inline-block; width:  225px;'>6.- Antigüedad Título:</label>";
echo "<input type='number' id='antiguedadtitulo' name='antiguedadtitulo' value='" . htmlspecialchars($row['antiguedadtitulo']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='servicios' style='display: inline-block; width:  225px;'>7.- Servicios:</label>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width:  225px;'>7.1- En la Provincia:</label>";
echo "<input type='number' id='serviciosprovincia' name='serviciosprovincia' value='" . htmlspecialchars($row['serviciosprovincia']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Maestro de Sección:</label>";
echo "<input type='number' id='t_m_seccion' name='t_m_seccion' value='" . htmlspecialchars($row['t_m_seccion']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Maestro de Año:</label>";
echo "<input type='number' id='t_m_anio' name='t_m_anio' value='" . htmlspecialchars($row['t_m_anio']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Maestro de Grupo:</label>";
echo "<input type='number' id='t_m_grupo' name='t_m_grupo' value='" . htmlspecialchars($row['t_m_grupo']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Maestro de Ciclo:</label>";
echo "<input type='number' id='t_m_ciclo' name='t_m_ciclo' value='" . htmlspecialchars($row['t_m_ciclo']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Maestro Recuperado:</label>";
echo "<input type='number' id='t_m_recupera' name='t_m_recupera' value='" . htmlspecialchars($row['t_m_recupera']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Maestro Complementario:</label>";
echo "<input type='number' id='t_m_comple' name='t_m_comple' value='" . htmlspecialchars($row['t_m_comple']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Maestro Bibliotecario:</label>";
echo "<input type='number' id='t_m_biblio' name='t_m_biblio' value='" . htmlspecialchars($row['t_m_biblio']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Gabinete:</label>";
echo "<input type='number' id='t_m_gabinete' name='t_m_gabinete' value='" . htmlspecialchars($row['t_m_gabinete']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<hr>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Secretaria 1º:</label>";
echo "<input type='number' id='t_m_sec1' name='t_m_sec1' value='" . htmlspecialchars($row['t_m_sec1']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Secretaria 2º:</label>";
echo "<input type='number' id='t_m_sec2' name='t_m_sec2' value='" . htmlspecialchars($row['t_m_sec2']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Vice-Director:</label>";
echo "<input type='number' id='t_m_viced' name='t_m_viced' value='" . htmlspecialchars($row['t_m_viced']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<hr>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Director Personal Único:</label>";
echo "<input type='number' id='t_d_pu' name='t_d_pu' value='" . htmlspecialchars($row['t_d_pu']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Director de 3º:</label>";
echo "<input type='number' id='t_d_3' name='t_d_3' value='" . htmlspecialchars($row['t_d_3']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Director de 2º:</label>";
echo "<input type='number' id='t_d_2' name='t_d_2' value='" . htmlspecialchars($row['t_d_2']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Director de 1º:</label>";
echo "<input type='number' id='t_d_1' name='t_d_1' value='" . htmlspecialchars($row['t_d_1']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Director de Biblioteca:</label>";
echo "<input type='number' id='t_d_biblio' name='t_d_biblio' value='" . htmlspecialchars($row['t_d_biblio']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Director de Gabinete:</label>";
echo "<input type='number' id='t_d_gabi' name='t_d_gabi' value='" . htmlspecialchars($row['t_d_gabi']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<hr>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Secretario Coord. Tec.:</label>";
echo "<input type='number' id='t_d_seccoortec' name='t_d_seccoortec' value='" . htmlspecialchars($row['t_d_seccoortec']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Sup. Sec. Tec.:</label>";
echo "<input type='number' id='t_d_supsectec' name='t_d_supsectec' value='" . htmlspecialchars($row['t_d_supsectec']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Sup. Escolar:</label>";
echo "<input type='number' id='t_d_supesc' name='t_d_supesc' value='" . htmlspecialchars($row['t_d_supesc']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Sup. General:</label>";
echo "<input type='number' id='t_d_supgral' name='t_d_supgral' value='" . htmlspecialchars($row['t_d_supgral']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='serv_prov' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Adic.:</label>";
echo "<input type='number' id='t_d_adic' name='t_d_adic' value='" . htmlspecialchars($row['t_d_adic']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<hr>";

echo "<label for='otrosservicios' style='display: inline-block; width:  225px;'>7.2- Otros Servicios:</label>";
echo "<input type='number' id='otrosservicios' name='otrosservicios' value='" . htmlspecialchars($row['otrosservicios']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='o_g_a' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Grupo A:</label>";
echo "<input type='number' id='o_g_a' name='o_g_a' value='" . htmlspecialchars($row['o_g_a']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='o_g_b' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Grupo B:</label>";
echo "<input type='number' id='o_g_b' name='o_g_b' value='" . htmlspecialchars($row['o_g_b']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='o_g_c' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Grupo C:</label>";
echo "<input type='number' id='o_g_c' name='o_g_c' value='" . htmlspecialchars($row['o_g_c']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='o_g_d' style='display: inline-block; width: 208px;margin-left: 20px;color:#0000FF;'>Grupo D:</label>";
echo "<input type='number' id='o_g_d' name='o_g_d' value='" . htmlspecialchars($row['o_g_d']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='residencia' style='display: inline-block; width:  225px;'>8.- Residencia:</label>";
echo "<input type='number' id='residencia' name='residencia' value='" . htmlspecialchars($row['residencia']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='publicaciones' style='display: inline-block; width:  225px;'>9.- Publicaciones:</label>";
echo "<input type='number' id='publicaciones' name='publicaciones' value='" . htmlspecialchars($row['publicaciones']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";

echo "<label for='otrosantecedentes' style='display: inline-block; width:  225px;'>10.- Otros Antecedentes:</label>";
echo "<input type='number' id='otrosantecedentes' name='otrosantecedentes' value='" . htmlspecialchars($row['otrosantecedentes']) . "' size='10' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'>";
echo "<br>";
echo "</td></tr>";





echo "</table>";

echo "<br>";
echo"<button type='button' class='btn btn-info' title='Actulizar Registro'  id='btnActualizar2'><i class='glyphicon glyphicon-refresh'></i> Actualizar</button>";

// JavaScript para mostrar u ocultar las tablas según el tipo seleccionado
echo "<script>";
echo "document.addEventListener('DOMContentLoaded', function() {";
echo "    var tipoSelect = document.getElementById('tipo');";
echo "    var tablaPermanenteConcursoInterino = document.getElementById('tablaPermanenteConcursoInterino');";
echo "    var tablaTitular = document.getElementById('tablaTitular');";
echo "    var tablaComun = document.getElementById('tablaComun');"; 

echo "    function mostrarTablaSegunTipo() {";
echo "        if (!tipoSelect) return;"; // Si el select no existe, salir
echo "        if (tipoSelect.value === 'Permanente' || tipoSelect.value === 'permanente' ||";
echo "            tipoSelect.value === 'Concurso' || tipoSelect.value === 'concurso' ||";
echo "            tipoSelect.value === 'transitorio' || tipoSelect.value === 'Transitorio') {";
echo "            if (tablaPermanenteConcursoInterino) tablaPermanenteConcursoInterino.style.display = 'table';";
echo "            if (tablaTitular) tablaTitular.style.display = 'none';";
echo "            if (tablaComun) tablaComun.style.display = 'none';";
echo "        } else if (tipoSelect.value === 'Titulares' || tipoSelect.value === 'titulares') {";
echo "            if (tablaPermanenteConcursoInterino) tablaPermanenteConcursoInterino.style.display = 'none';";
echo "            if (tablaTitular) tablaTitular.style.display = 'table';";
echo "            if (tablaComun) tablaComun.style.display = 'none';";
echo "        } else {";
echo "            if (tablaPermanenteConcursoInterino) tablaPermanenteConcursoInterino.style.display = 'none';";
echo "            if (tablaTitular) tablaTitular.style.display = 'none';";
echo "            if (tablaComun) tablaComun.style.display = 'table';";
echo "        }";
echo "    }";
echo "    if (tipoSelect) tipoSelect.addEventListener('change', mostrarTablaSegunTipo);";
echo "    mostrarTablaSegunTipo();";
echo "});";
echo "</script>";


           
                echo"<br>";
  
               
         // Script para mostrar u ocultar los campos adicionales según el tipo de inscripción seleccionado
                    echo "<script>
document.addEventListener('DOMContentLoaded', function() {
    function mostrarCamposAdicionales() {
        var select = document.getElementById('tipo');
        var titularesRow = document.getElementById('titularesRow');
        var fechaRow = document.getElementById('fechaRow');

        // Verificar que los elementos existen antes de intentar manipularlos
        if (!titularesRow || !fechaRow) {
            console.warn('Algunos elementos no se encontraron en el DOM.');
            return;
        }

        // Mostrar u ocultar según el tipo seleccionado
        if (select.value === 'titulares' || select.value === 'Titulares') {
            titularesRow.style.display = 'table-row';
            fechaRow.style.display = 'none';
        } else {
            titularesRow.style.display = 'none';
            fechaRow.style.display = 'table-row';
        }
    }

    // Llamar a la función para inicializar
    mostrarCamposAdicionales();
});</script>
";?>

                
              
              <?php

              echo " <input type='hidden' name='id2' id='id2' value='" . $_GET['id2'] . "'> ";
             
             
              echo "</form>";
              echo "<center>";
              echo" <a href='javascript:history.back()' class='btn btn-success' title='Volver'><i class='glyphicon glyphicon-arrow-left'></i> Volver atrás</a>";
            echo "</center>";
            
         
              
             
              ?>
                <?php include('footer2.php');?>
                <script>
$(document).ready(function() {
    $('#btnActualizar, #btnActualizar2').click(function(event) {
        event.preventDefault(); // Evitar el envío tradicional del formulario

        var datos = $('#miFormulario').serialize(); // Serializa los datos del formulario
        //console.log(datos);
        var elementoEliminar = document.getElementById('id2');
        console.log(elementoEliminar.value);

        var archivo='ActualizarMovimientosPermanentes.php';
        var tipoSelect = document.getElementById('tipo');
        if (tipoSelect.value === 'Permanente') {
        }else if (tipoSelect.value === 'Titulares'){
          archivo='ActualizarMovimientosTitulares.php';
        }else if (tipoSelect.value === 'transitorio'){
          archivo='ActualizarMovimientosTransitoria.php';

        }else if (tipoSelect.value === 'Concurso'){
          archivo='ActualizarMovimientosConcurso.php';
        }


        $.ajax({
            type: 'POST',
            url: archivo, // Archivo PHP para procesar la actualización
            data: datos,
            success: function(response) {
                // Maneja la respuesta del servidor aquí
                console.log(response); // Muestra la respuesta en la consola para depuración
                alert("Datos actualizados y guardados con éxito: " + response);
            },
            error: function(xhr, status, error) {
                // Maneja errores de la solicitud AJAX
                console.error("Error: " + xhr.responseText);
                alert("Ocurrió un error durante la actualización: " + xhr.responseText);
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


