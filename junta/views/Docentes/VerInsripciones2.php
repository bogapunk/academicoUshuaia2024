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
    <h1> <center><u>Listado de Inscripciones</u></center></h1>

<br>
<br>
<?php
//iniciar la session

// Te recomiendo utilizar esta conexión, la que utilizas ya no es la recomendada. 
$link = new PDO('mysql:host=db;dbname=junta', 'root', ''); // el campo vaciío es para la password.

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

          // Connect to database anterior
          /*
$conn = mysqli_connect('localhost', 'root', '', 'junta'); // Replace with your database connection details
if (!$conn) {
  die("Error connecting to database: " . mysqli_connect_error());
}

*/

// Database connection
$serverName = "10.1.9.113"; // Replace with your SQL Server hostname
$connectionOptions = array(
    "Database" => "junta",       // Replace with your database name
    "Uid"      => "SA",      // Replace with your SQL Server username
    "PWD"      => 'Davinci2024#',      // Replace with your SQL Server password
    "CharacterSet" => "UTF-8" // Add this to support UTF-8 characters (important for accents)
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true)); // Print the error details for debugging
}


// Ejecutar la consulta SQL
$queryData = "SELECT j_doc.apellidoynombre, j_doc.legajo, j_mov.legdoc, j_mov.anodoc, j_mov.codmod, j_mov.establecimiento, j_mod.nommod, j_dep.coddep, j_dep.nomdep, j_mov.puntajetotal, j_mov.tipo, j_mov.fecha, j_mov.obs, j_mov.horas, j_mov.id2
FROM _junta_docentes j_doc
INNER JOIN _junta_movimientos j_mov ON j_doc.legajo = j_mov.legdoc
LEFT JOIN _junta_modalidades j_mod ON j_mov.codmod = j_mod.codmod 
LEFT JOIN _junta_dependencias j_dep ON j_mov.establecimiento = j_dep.coddep
WHERE j_doc.legajo = '$legajo'
ORDER BY j_mov.fecha ASC";
// Establecer la conexión a SQL Server
$serverName = "10.1.9.113"; // Reemplazar con el nombre de tu servidor SQL Server
$connectionInfo = array(
    "Database" => "junta", // Reemplazar con el nombre de tu base de datos
    "UID" => "SA",
    "PWD" => 'Davinci2024#',
    "CharacterSet" => "UTF-8"
);
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn) {
    echo "Conexión establecida.<br>";
} else {
    echo "Error en la conexión.<br>";
    die(print_r(sqlsrv_errors(), true));
}

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
        echo "<h2>Docente: " . $nombreDocente . "</h2>";
        $resultData = sqlsrv_query($conn, $queryData);
        if ($resultData === false) {
            die(print_r(sqlsrv_errors(), true)); // Imprimir errores si la consulta falla
        }
        // Ejecutar la consulta original y mostrar los resultados en la tabla
        if (sqlsrv_has_rows($resultData)) {
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th style='text-align: center;'>Año</th>";
            echo "<th style='text-align: center;'>Código Modalidad</th>";
            echo "<th style='text-align: center;'>Descripción</th>";
            echo "<th style='text-align: center;'>Establecimiento</th>";
            echo "<th style='text-align: center;'>Puntaje Total</th>";
            echo "<th style='text-align: center;'>Tipo Inscripcion</th>";
            echo "<th style='text-align: center;width: 150px;'>Fecha</th>";
            echo "<th style='text-align: center; width: 235px;'>Opciones</th>";
            echo "</tr>";

            $odd = true;

            while ($row = sqlsrv_fetch_array($resultData, SQLSRV_FETCH_ASSOC)) {
                $color = $odd ? '#FFFFFF' : '#F2F2F2';
                $odd = !$odd;

                echo "<tr style='background-color: $color;'>";
                echo "<td style='text-align: center;'>" . $row['anodoc'] . "</td>";
                echo "<td style='text-align: center;'>" . $row['codmod'] . "</td>";
                echo "<td style='text-align: center;'>" . $row['nommod'] . "</td>";
                echo "<td style='text-align: center;'>" . ($row['nomdep'] == '-' || empty($row['nomdep']) || $row['establecimiento'] == 0 ? "No tiene establecimiento asignado" : $row['nomdep']) . "</td>";
                echo "<td style='text-align: center;'>" . $row['puntajetotal'] . "</td>";
                echo "<td style='text-align: center;'>" . $row['tipo'] . "</td>";
                echo "<td style='text-align: center;'>";
                if ($row['fecha'] !== null) {
                    echo $row['fecha']->format('d-m-Y');
                } else {
                    echo "Fecha no disponible";
                }
                echo "</td>";
                echo "<td style='text-align: center;'>";
                echo "<a class='btn btn-sm btn-danger movimientoBorrado' href='#' data-id2='" . $row['id2'] . "' title='Eliminar'><i class='glifo glifo-trash'></i> Eliminar</a>";
                $encodedNomdep = urlencode($row['nomdep']);
                $encodeObs = urlencode($row['obs']);
                echo "<a href='Inscripcion.php?legajo=" . $legajo . "&codmod=" . $row['codmod'] . "&tipo=" . $row['tipo'] . "&nomdep=" . $encodedNomdep . "&obs=" . $encodeObs . "&horas=" . $row['horas'] . "' class='btn btn-success' title='Modificar'>";
                echo "<span class='glifo glifo-lápiz'></span> Modificar";
                echo "</a>";
                echo "</td>";
                

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



//javascript para borrado de movimiento
echo "<script>
$(document).ready(function() {
  $('.movimientoBorrado').on('click', function(e) {
      e.preventDefault(); 

      const id2 = $(this).data('id2');
      const rowToDelete = $(this).closest('tr'); // Get the entire row to remove later

      if (confirm('¿Desea eliminar el movimiento?')) {
          $.ajax({
              type: 'POST',
              url: 'eliminar_movimiento.php', 
              data: { id2: id2 },
              success: function(response) {
                  if (response.success) { // Check for success response from the PHP script
                      alert('El movimiento ha sido eliminado exitosamente.');
                      rowToDelete.remove(); // Remove the row from the table
                  } else {
                      alert('Error al eliminar el movimiento: ' + response.message); // Display error message from PHP
                  }
              },
              error: function(xhr, status, error) {
                  alert('Error en la solicitud AJAX: ' + error);
                  console.error(xhr.responseText);
              }
          });
      }
  });
});
</script>";


sqlsrv_free_stmt($resultData);
// Cerrar la conexión
sqlsrv_close($conn);

// Determina el color según el valor de 'tipo'
function determinarColor($tipo) {
    switch ($tipo) {
        case 'titulares':
            return '#FFF4DD';
        case 'transitorio':
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
<a href="RegistroMovimiento.php?legajo=<?php echo $legajo; ?>" class="btn btn-primary" > <span class="glyphicon glyphicon-plus"></span> Nuevo Movimiento</a>
<br>
<br>

    </table>

   
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 
  </div>


<center>
  <a href="javascript:history.back()" class="btn btn-success">Volver atrás</a>
</center>

  <?php include('footer2.php');?>
</body>
</html>