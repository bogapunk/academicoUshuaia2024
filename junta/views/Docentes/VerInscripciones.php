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
      $mov->__SET('otitulo', $_REQUEST['otitulo']);
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
      $mov->__SET('otitulo', $_REQUEST['otitulo']);
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
      
      $model->RegistrarMovimiento($id2);
      //header('Location:ListarModalidades.php');
      break;

    case 'eliminar':
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

function traenombremodalidad($cual) {
                $sqlNroNota = "SELECT * FROM _junta_modalidades WHERE codmod = $cual ORDER BY 1";

                $con = mysqli_connect("db", "root", "", "junta"); // Replace with your database connection details
                if (!$con) {
                  die("Error connecting to database: " . mysqli_connect_error());
                }

                $rs = mysqli_query($con, $sqlNroNota);

                if (mysqli_num_rows($rs) == 0) {
                  $traenombremodalidad = "No existe a descripcion para esta modalidad :" . $cual;
                } else {
                  $row = mysqli_fetch_assoc($rs);
                  $traenombremodalidad = $row["nommod"];
                }

                mysqli_close($con);

                return $traenombremodalidad;
              }

              function traeestablecimiento($cual) {
                $sqlNroNota = "SELECT * FROM _junta_dependencias WHERE coddep = $cual ORDER BY 1";

                $con = mysqli_connect("db", "root", "", "junta"); // Replace with your database connection details
                if (!$con) {
                  die("Error connecting to database: " . mysqli_connect_error());
                }

                $rs = mysqli_query($con, $sqlNroNota);

                if (mysqli_num_rows($rs) == 0) {
                  $traeestablecimiento = " - ";
                } else {
                  $row = mysqli_fetch_assoc($rs);
                  $traeestablecimiento = $row["nomdep"];
                }

                mysqli_close($con);

                return $traeestablecimiento;
              }

              function traenombredoc($doc) {
                $sqlNroNota = "SELECT * FROM _junta_docentes WHERE legajo =$mov ORDER BY 1";

                $con = mysqli_connect("db", "root", "", "junta"); // Replace with your database connection details
                if (!$con) {
                  die("Error connecting to database: " . mysqli_connect_error());
                }

                $rs = mysqli_query($con, $sqlNroNota);

                if (mysqli_num_rows($rs) == 0) {
                  $traenombredoc = "No existe el docente :" .$mov;
                } else {
                  $row = mysqli_fetch_assoc($rs);
                  $traenombredoc = $row["ApellidoyNombre"];
                }

                mysqli_close($con);

                return $traenombredoc;
              }

              function traepuntaje($anio, $modalidad,$mov, $esc, $eltipo) {
                $sqlNroNota = "SELECT puntajetotal FROM _junta_movimientos WHERE legdoc =$mov AND anodoc = $anio AND codmod = $modalidad AND establecimiento = $esc AND tipo = '$eltipo' ORDER BY 1";

                $con = mysqli_connect("db", "root", "", "junta"); // Replace with your database connection details
                if (!$con) {
                  die("Error connecting to database: " . mysqli_connect_error());
                }

                $rs = mysqli_query($con, $sqlNroNota);

                if (mysqli_num_rows($rs) == 0) {
                  $traepuntaje = "No existe el docente :" .$mov;
                } else {
                  $row = mysqli_fetch_assoc($rs);
                  $traepuntaje = $row["puntajetotal"]; // Cast to integer if needed
                }

                mysqli_close($con);

                return $traepuntaje;
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
  padding: 15px 15px; /* Relleno del boton */
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
<button class="btn-flotante" onclick="topFunction()" title='Subir'>Subir</button>


  <div class="container">
  <script>
        // Get the button
        let myButton = document.querySelector(".btn-flotante");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                myButton.style.display = "block";
            } else {
                myButton.style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>


    <h1> <center><u>Listado de Inscripciones</u></center></h1>

<br>
<br>
<?php
//iniciar la session

// Te recomiendo utilizar esta conexión, la que utilizas ya no es la recomendada. 
//$link = new PDO('mysql:host=localhost;dbname=junta', 'root', ''); // el campo vaciío es para la password. 
$serverName = "10.1.9.113"; // Reemplaza con tu servidor SQL Server
$database = "junta"; // Reemplaza con tu nombre de base de datos
$username = "SA"; // Reemplaza con tu nombre de usuario de SQL Server
$password = 'Davinci2024#'; // Reemplaza con tu contraseña de SQL Server (deja vacío si no hay contraseña)

try {
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database;TrustServerCertificate=True", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "";
} catch (PDOException $e) {
    exit("Error de conexión: " . $e->getMessage());
}
?>

   <?php

  if(isset($_SESSION['message'])){
    ?>
    <div class="alert alert-info text-center" style="margin-top:20px;">
      <?php echo $_SESSION['message']; ?>
    </div>
    <?php

    unset($_SESSION['message']);
  }
?>
   <th> <?php

// Retrieve legajo from URL
$legajo = $_GET['legajo'];

// Connect to database
// Database connection
$serverName = "10.1.9.113"; // Replace with your SQL Server hostname
$connectionOptions = array(
    "Database" => "junta",       // Replace with your database name
    "Uid"      => "SA",      // Replace with your SQL Server username
    "PWD"      => 'Davinci2024#',      // Replace with your SQL Server password
    "TrustServerCertificate" => true, // Trust the server certificate
    "CharacterSet" => "UTF-8" // Add this to support UTF-8 characters (important for accents)
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true)); // Print the error details for debugging
}


// Ejecutar la consulta SQL
$queryData = "SELECT j_doc.apellidoynombre, j_doc.legajo, j_mov.legdoc, j_mov.anodoc, j_mov.codmod, j_mov.establecimiento, j_mod.nommod, j_dep.coddep, j_dep.nomdep, j_mov.puntajetotal, j_mov.tipo, j_mov.fecha, j_mov.obs, j_mov.horas, j_mov.id2,j_mov.excluido,j_mov.codloc,j_mov.hijos,j_mov.legvinc
FROM _junta_docentes j_doc
INNER JOIN _junta_movimientos j_mov ON j_doc.legajo = j_mov.legdoc
LEFT JOIN _junta_modalidades j_mod ON j_mov.codmod = j_mod.codmod 
LEFT JOIN _junta_dependencias j_dep ON j_mov.establecimiento = j_dep.coddep
WHERE j_doc.legajo = '$legajo'
ORDER BY j_mov.anodoc desc";
// se ordena por el ultimo registro del año 2024

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


if (isset($_GET['legajo'])) {
    // Asignar el valor de legajo a la variable
    $legajo = $_GET['legajo'];

    // Consulta para obtener el nombre del docente
    $queryNombreDocente = "SELECT apellidoynombre FROM _junta_docentes WHERE legajo = '$legajo'";
    $resultNombreDocente = sqlsrv_query($conn, $queryNombreDocente);

    // Verificar si se encontró el nombre del docente
    if (sqlsrv_has_rows($resultNombreDocente)) {
        $rowNombreDocente = sqlsrv_fetch_array($resultNombreDocente, SQLSRV_FETCH_ASSOC);
        $nombreDocente = $rowNombreDocente['apellidoynombre'];

        // Imprimir el nombre del docente
        echo "<h2><u>Docente:</u> " . $nombreDocente . "</h2>";
        
        $resultData = sqlsrv_query($conn, $queryData);
              if ($resultData === false) {
                  die(print_r(sqlsrv_errors(), true)); // Imprimir errores si la consulta falla
              }

              // Mostrar el botón de actualización de tabla registro nuevo moeviento y volver
              echo "<div class='d-flex justify-content-center align-items-center mt-3'>
              <a href='javascript:void(0);' onclick='history.go(-1); location.reload();' class='btn btn-info mx-2' title='Actualizar Tabla' style='margin-top: 10px;'>
                  <i class='glyphicon glyphicon-refresh'></i> Actualizar Tabla
              </a>
              <a href='RegistroMovimiento.php?legajo=" . urlencode($legajo) . "' class='btn btn-primary mx-2 pt-2' style='margin-top: 10px;'>
                  <i class='glyphicon glyphicon-plus'></i> Nuevo Movimiento
              </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href='./ListarDocentes.php' class='btn btn-success mx-2'>
                  <i class='glyphicon glyphicon-arrow-left'></i> Volver atrás
              </a>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <label for='tipoFiltro'>Filtrar por Tipo de Inscripción: </label>
                  <select id='tipoFiltro' class='form-control' style='width: 200px; display: inline-block;'>
                      <option value=''>Todos</option> <!-- Opción para mostrar todos -->
                      <option value='permanente'>Permanente</option>
                      <option value='concurso'>Concurso</option>
                      <option value='transitorio'>Interino</option>
                      <option value='titulares'>Titulares</option>
                  </select>
            
          </div>";
          echo"<br>";
          echo"<br>";
          
      // Filtro por Tipo de Inscripción
         
   
              // Ejecutar la consulta original y mostrar los resultados en la tabla
              if (sqlsrv_has_rows($resultData)) {
                  echo "<table border='1'>";
                  echo "<tr>";
                  echo "<th style='text-align: center;'>Año</th>";
                  echo "<th style='text-align: center;'>Código Modalidad</th>";
                  echo "<th style='text-align: center;'>Descripción</th>";
                  echo "<th style='text-align: center;'>Establecimiento</th>";
                  echo "<th style='text-align: center;'>Puntaje Total</th>";
                  echo "<th style='text-align: center;'>Tipo Inscripción</th>";
                  echo "<th style='text-align: center;width: 150px;'>Fecha</th>";
                  echo "<th style='text-align: center; width: 330px;'>Opciones</th>";
                  echo "</tr>";

                  $odd = true;

                  while ($row = sqlsrv_fetch_array($resultData, SQLSRV_FETCH_ASSOC)) {
                      $tipo = $row['tipo'];  // Valor del tipo
                      $color = '';

                      // Asignar el color según el valor de 'tipo'
                      if ($tipo == 'Permanente'  || $tipo == 'permanente') {
                          $color = '#A3D9A5';  // Verde claro para "Permanente"
                      } elseif ($tipo == 'Concurso' ||$tipo == 'concurso' ) {
                          $color = '#F9D423';  // Amarillo para "Concurso"
                      } elseif ($tipo == 'Interino'|| $tipo == 'interino' || $tipo == 'interinos' || $tipo == 'transitorio' || $tipo == 'Transitorio' ) {
                          $color = '#FF6B6B';  // Rojo para "Interino"
                      } elseif ($tipo == 'Titulares'|| $tipo == 'titulares' ) {
                          $color = '#4A90E2';  // Azul para "Titulares"
                      } else {
                          // Si no es ninguno de los anteriores, puedes usar un color por defecto
                          $color = $odd ? '#FFFFFF' : '#F2F2F2';  // Alternar colores si el tipo es otro
                      }

                      $odd = !$odd;

                      // Imprimir la fila de la tabla con el color de fondo asignado

                      echo "<tr class='tipoFila' data-tipo='" . strtolower($tipo) . "' style='background-color: $color;'>"; // Asegúrate de que el tipo esté en minúsculas
                      echo "<td style='text-align: center;'>" . $row['anodoc'] . "</td>";
                      echo "<td style='text-align: center;'>" . $row['codmod'] . "</td>";
                      echo "<td style='text-align: center;'>" . $row['nommod'] . "</td>";
                      echo "<td style='text-align: center;'>" . (($row['nomdep'] == '-' || empty($row['nomdep']) || $row['establecimiento'] == 0) ? "No tiene establecimiento asignado" : $row['nomdep']) . "</td>";
                      echo "<td style='text-align: center;'>" . number_format($row['puntajetotal'], 2, '.', ',') . "</td>";


                      echo "<td style='text-align: center;'>" . (strcasecmp($row['tipo'], 'Transitorio') === 0 ? 'Interino' : $row['tipo']) . "</td>";


                      echo "<td style='text-align: center;'>";

                      // Mostrar la fecha de la inscripción (si existe)
                      if ($row['fecha'] !== null) {
                          echo $row['fecha']->format('d-m-Y');
                      } else {
                          echo "Fecha no disponible";
                      }


                
                // Verificar si nomdep está vacío
                    if (empty($nomdep)) {
                      $encodedNomdep = urlencode("No tiene establecimiento asignado");
                    } else {
                      $encodedNomdep = urlencode($nomdep);
                    }
                                    echo "</td>";
                                    echo "<td style='text-align: center;'>";
                                    echo "<a class='btn btn-sm btn-danger movimientoBorrado' href='#' data-id2='" . htmlspecialchars($row['id2'], ENT_QUOTES, 'UTF-8') . "' title='Eliminar'><i class='glyphicon glyphicon-trash'></i>  Eliminar</a>";


                                    // Asegúrate de que las variables sean cadenas antes de aplicar urlencode
                                    $encodedNomdep = isset($row['nomdep']) ? urlencode((string) $row['nomdep']) : '';
                                    $encodedObs = isset($row['obs']) ? urlencode((string) $row['obs']) : '';
                                    //$encodedFecha = isset($row['fecha']) ? urlencode((string) $row['fecha']) : ''; // Suponiendo que también necesitas codificar $row['fecha']
                                      
                                    $encodedFecha = isset($row['fecha']) && $row['fecha'] instanceof DateTime? urlencode($row['fecha']->format('Y-m-d H:i:s')) : '';

                                     
                                    // Codificar otros valores en la URL
                                    $encodedLegajo = isset($legajo) ? urlencode((string) $legajo) : '';
                                    $encodedCodmod = isset($row['codmod']) ? urlencode((string) $row['codmod']) : '';
                                    $encodedTipo = isset($row['tipo']) ? urlencode((string) $row['tipo']) : '';
                                    $encodedHoras = isset($row['horas']) ? urlencode((string) $row['horas']) : '';
                                    $encodedAnodoc = isset($row['anodoc']) ? urlencode((string) $row['anodoc']) : '';
                                    $encodedId2 = isset($row['id2']) ? urlencode((string) $row['id2']) : '';
                                    $encodedexcluido = isset($row['excluido']) && !empty($row['excluido']) ? urlencode((string) $row['excluido']) : urlencode('no');

                                    $hijos = isset($row['hijos']) ? $row['hijos'] : 0;
                                    $encodedHijos = urlencode($hijos);
                                    $encodedLegvinc = isset($row['legvinc']) ? urlencode((string) $row['legvinc']) : '0'; // Si 'legvinc' está vacío, se asigna '0'nc'] : '0';

                                    $codloc = isset($row['codloc']) ? $row['codloc'] : '';
                                    // Asegúrate de que $codloc esté correctamente asignado antes de codificarlo
                                    $encodedCodloc = urlencode($codloc);
                                    // El resto del código
                                   // Generación del enlace con los parámetros codificados
                                      echo "<a href='Inscripcion.php?legajo=" . $encodedLegajo . 
                                      "&codmod=" . $encodedCodmod . 
                                      "&tipo=" . $encodedTipo . 
                                      "&nomdep=" . $encodedNomdep . 
                                      "&obs=" . $encodedObs . 
                                      "&horas=" . $encodedHoras . 
                                      "&anodoc=" . $encodedAnodoc . 
                                      "&id2=" . $encodedId2 . 
                                      "&fecha=" . $encodedFecha . 
                                      "&excluido=" . $encodedexcluido . 
                                      "&hijos=" . $encodedHijos . 
                                      "&codloc=" . $encodedCodloc . 
                                      "&legvinc=" . $encodedLegvinc . 
                                      "' class='btn btn-success' title='Modificar' style='margin-right: 10px; margin-top: 10px;'>";

                                    echo "<span class='glifo glifo-lápiz'></span><i class='glyphicon glyphicon-pencil'></i>  Modificar";
                                    echo "</a>";
                                    
                                    $encodedCodloc = urlencode($codloc); // Codificar correctamente el valor de codloc

                                    echo "<a href='Duplicar.php?legajo=" . $encodedLegajo . 
                                    "&codmod=" . $encodedCodmod . 
                                    "&tipo=" . $encodedTipo . 
                                    "&nomdep=" . $encodedNomdep . 
                                    "&obs=" . $encodedObs . 
                                    "&horas=" . $encodedHoras . 
                                    "&anodoc=" . $encodedAnodoc . 
                                    "&id2=" . $encodedId2 . 
                                    "&fecha=" . $encodedFecha . 
                                    "&excluido=" . $encodedexcluido . 


                                    "&codloc=" . $encodedCodloc . "' 
                                    class='btn btn-warning' title='Duplicar'>";
                                    echo "<span class='glifo glifo-lápiz' style='margin-right: 8px;'></span><i class='glyphicon glyphicon-copy'></i>  Duplicar";
                                    echo "</a>";
                

                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No se encontraron registros para el apellido y nombre.</p>";
        }
    } else {
        echo "<p>No se encontró el nombre del docente.</p>";
    }

} else {
    // Si legajo no está definido, mostrar un mensaje de error
    echo "<p>El parámetro legajo no está definido.</p>";
}
echo"<script>
document.getElementById('tipoFiltro').addEventListener('change', function() {
    var tipoSeleccionado = this.value.toLowerCase();
    var filas = document.querySelectorAll('.tipoFila');

    filas.forEach(function(fila) {
        var tipoFila = fila.getAttribute('data-tipo');
        if (tipoSeleccionado === '' || tipoFila === tipoSeleccionado) {
            fila.style.display = ''; // Mostrar fila
        } else {
            fila.style.display = 'none'; // Ocultar fila
        }
    });
});
</script>";
//javascript para borrado de movimiento

echo "<script>

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
                  alert(response); // Muestra el mensaje devuelto por el servidor
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

</script>";




// Cerrar la conexión
sqlsrv_close($conn);

// Determina el color según el valor de 'tipo'
function determinarColor($tipo) {
    switch ($tipo) {
        case 'titulares':
            return '#FFF4DD';
        case 'Interino y Suple.':
            return '#E8FCFF';
        case 'permanente':
            return '#CEFFEF';
        case 'concurso':
            return '#F3F3F3';
        default:
            return '#FFFFFF'; // Color blanco por defecto
    }
}


?>
   </th>
   <br>
  <br>
<!--<a href="RegistroMovimiento.php?legajo=<?php echo $legajo; ?>" class="btn btn-primary" > <span class="glyphicon glyphicon-plus"></span> Nuevo Movimiento</a>-->
<br>
<br>

    </table>

   
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 
  </div>

<!--
<center>
  <a href="./ListarDocentes.php" class="btn btn-success"> <i class="glyphicon glyphicon-arrow-left"></i> Volver atrás</a>
</center>--S

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agencia de Innovación</title>
  <style>
    .btn-success {
      margin: 10px;
    }
    .main {
      margin: 20px;
    }
    body {
      font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
      text-align: center;
    }
    .hide {
      max-height: 0 !important;
    }
    .dropdown {
      border: 0.1em solid black;
      width: 10em;
      margin-bottom: 1em;
    }
    .dropdown .title {
      margin: .3em .3em .3em .3em;
      width: 100%;
    }
    .dropdown .title .fa-angle-right {
      float: right;
      margin-right: .7em;
      transition: transform .3s;
    }
    .dropdown .menu {
      transition: max-height .5s ease-out;
      max-height: 20em;
      overflow: hidden;
    }
    .dropdown .menu .option {
      margin: .3em .3em .3em .3em;
      margin-top: 0.3em;
    }
    .dropdown .menu .option:hover {
      background: rgba(0,0,0,0.2);
    }
    .pointerCursor:hover {
      cursor: pointer;
    }
    .rotate-90 {
      transform: rotate(90deg);
    }

    * {
      margin: 0;
      padding: 0;
      border: 0 none;
      position: relative;
    }

    #menu_gral2 {
      font-family: verdana, sans-serif;
      width: 80%;
      margin: 1.5rem auto;
    }

    #menu_gral2 ul {
      list-style-type: none;
      text-align: center;
      font-size: 0;
    }

    #menu_gral2 > ul li {
      display: inline-block;
      width: 25%;
      position: relative;
      background: #337ab7;
    }

    #menu_gral2 li a {
      display: block;
      text-decoration: none;
      font-size: 2rem;
      width: 100%;
      font-family: 'Roboto', sans-serif;
      background-color: #2698f3;
      font-size: 18px;
      line-height: 2.5rem;
      color: #fff;
    }

    #menu_gral2 li:hover a, #menu_gral li a:focus {
      background: #e55916;
      color: #fff;
    }

    #menu_gral2 li ul {
      position: absolute;
      width: 0;
      overflow: hidden;
    }

    #menu_gral2 li:hover ul, #menu_gral li:focus ul {
      width: 100%;
      margin: 0 -4rem -4rem -4rem;
      padding: 0 4rem 4rem 4rem;
      z-index: 5;
    }

    #menu_gral2 li li {
      display: block;
      width: 100%;
    }

    #menu_gral2 li:hover li a, #menu_gral li:focus li a {
      font-family: monospace;
      font-size: .9rem;
      line-height: 1.7rem;
      border-top: 1px solid #e5e5e5;
      background: #444;
    }

    #menu_gral2 li li a:hover, #menu_gral li li a:focus {
      background: #8AA9B8;
    }
  </style>
</head>
<body>
  <div class="main">
    <div class="panel panel-default">
      <div class="panel-heading">
        <ul class="nav nav-pills">
          <div class="panel-footer">
            <a href="" target="_blank">Agencia de Innovación</a>
          </div>
        </ul>
        <img src="../../imagenes/pie_footer.png" width="50" height="50" alt="Logo" />
        <nav id="menu_gral2">
          <ul>
            <li>
              <div class="card-body d-flex justify-content-between align-items-center">
                <a href="../../MiCuenta.php?logoutSubmit=1" class="btn btn-primary">Cerrar Sesión</a>
              </div>
            </li>
          </ul>
        </nav>
      </div><!-- Panel cierra -->
      </div>
  </div>

  <!-- Paginación de la tabla -->

  <center>
  <?php include('footer2.php');?>
  </center>

</body>
</html>