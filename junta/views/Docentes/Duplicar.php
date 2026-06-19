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

/* --- Coherencia con Movimiento nuevo (solo presentación) --- */
.mov-shell {
  max-width: 1140px;
  margin: 0 auto;
  padding: 12px 12px 40px;
  box-sizing: border-box;
}
.mov-page-title {
  font-family: 'Roboto', 'Open Sans', sans-serif;
  font-size: 30px;
  font-weight: 700;
  color: #1f2937;
  text-align: center;
  margin: 0 0 8px;
  padding-bottom: 10px;
  border-bottom: 2px solid rgba(38, 152, 243, 0.35);
  letter-spacing: 0.03em;
}
.mov-page-title .mov-page-sub {
  display: block;
  font-size: 16px;
  font-weight: 600;
  color: #64748b;
  margin-top: 6px;
  letter-spacing: 0.02em;
}
.mov-section-title {
  font-family: 'Roboto', 'Open Sans', sans-serif;
  font-size: 19px;
  font-weight: 700;
  color: #1e40af;
  margin: 24px 0 14px;
  padding-bottom: 6px;
  border-bottom: 1px solid #e5e7eb;
  text-align: left;
}
.mov-card {
  background: #fff;
  border: 1px solid rgba(0, 0, 0, 0.08);
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
  padding: 18px 16px 20px;
  margin-bottom: 20px;
}
.mov-card .table {
  margin-bottom: 0;
}
.mov-docente-resumen td,
.mov-docente-resumen th {
  font-weight: 600;
  font-size: 15px;
}
.mov-docente-resumen thead th {
  font-weight: 700;
}
.mov-docente-actions {
  text-align: right;
  vertical-align: middle !important;
}
.mov-field-label {
  display: block;
  font-weight: 600;
  font-size: 14px;
  color: #374151;
  margin-bottom: 6px;
}
.mov-carga-movimiento .form-group {
  margin-bottom: 14px;
}
.mov-carga-fila-mixta {
  margin-bottom: 8px;
}
.mov-carga-fila-mixta > [class*="col-"] {
  margin-bottom: 8px;
}
.mov-carga-movimiento .form-control {
  border-radius: 6px;
  min-height: 38px;
  font-size: 15px;
}
.mov-placeholder-col {
  min-height: 1px;
}
.mov-excluir-row {
  margin-top: 8px;
  margin-bottom: 8px;
}
.mov-excluir-row .mov-motivos-select {
  max-width: 100%;
}
.mov-puntajes-panel {
  margin: 16px 0 0;
  padding: 16px 14px 20px;
  background: #fff;
  border: 1px solid rgba(0, 0, 0, 0.08);
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
  width: 100%;
  box-sizing: border-box;
}
.mov-puntajes-inner.container-fluid {
  padding-left: 15px;
  padding-right: 15px;
  text-align: left;
}
.mov-puntajes-inner label:not(.mov-puntajes-inline-label) {
  display: block !important;
  width: auto !important;
  text-align: left !important;
  font-weight: 600;
  font-size: 14px;
  color: #374151;
  margin-bottom: 6px;
}
.mov-puntajes-panel h3.mov-puntajes-heading {
  font-family: 'Roboto', 'Open Sans', sans-serif;
  font-size: 18px;
  font-weight: 700;
  color: #1f2937;
  margin: 0 0 16px;
  padding-bottom: 8px;
  border-bottom: 1px solid #e5e7eb;
  text-align: left;
}
.mov-input-num {
  max-width: 140px;
  width: 100%;
}
.mov-puntajes-panel .form-control.mov-input-num {
  max-width: 140px;
}
.mov-form-actions {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 12px;
  margin: 28px 0 16px;
  padding-top: 18px;
  border-top: 1px solid #e5e7eb;
}
.mov-section-head {
  margin: 24px 0 14px;
}
.mov-section-head-actions {
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-end;
  gap: 8px;
  margin-bottom: 10px;
}
.mov-section-head-actions .btn {
  min-width: 210px;
  width: 210px;
  max-width: 100%;
  height: 48px !important;
  min-height: 48px !important;
  padding: 0 18px !important;
  box-sizing: border-box !important;
  border-radius: 6px !important;
  font-weight: 600 !important;
  font-size: 15px !important;
  line-height: 1 !important;
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  white-space: nowrap;
  vertical-align: middle !important;
}
.mov-section-head-actions .btn .glyphicon {
  margin-right: 12px !important;
}
@media (max-width: 480px) {
  .mov-section-head-actions .btn {
    width: 100%;
    min-width: 0;
  }
}
.mov-section-head .mov-section-title--in-head {
  margin: 0;
  margin-top: 0;
  padding-bottom: 6px;
  border-bottom: 1px solid #e5e7eb;
  text-align: left;
}
.mov-form-actions--footer {
  justify-content: center;
}
.mov-puntajes-grid2 {
  max-width: 760px;
}
.mov-puntajes-field-row {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  margin-bottom: 10px;
  gap: 6px 10px;
}
.mov-puntajes-field-row .mov-puntajes-label-col {
  flex: 1 1 auto;
  min-width: min(260px, 100%);
  padding-right: 6px;
}
.mov-puntajes-field-row .mov-puntajes-input-col {
  flex: 0 0 148px;
  width: 148px;
  max-width: 148px;
  text-align: right;
}
.mov-puntajes-field-row .mov-puntajes-input-col .form-control {
  width: 100%;
  max-width: 140px;
  margin-left: auto;
  text-align: right;
}
.mov-puntajes-field-row .mov-puntajes-input-col input[type="number"],
.mov-puntajes-field-row .mov-puntajes-input-col input[type="text"],
.mov-puntajes-field-row .mov-puntajes-input-col select {
  margin-bottom: 0;
  font-size: 15px;
}
.mov-puntajes-inline-label {
  margin: 0 !important;
  font-weight: 600;
  font-size: 14px;
  color: #374151;
  line-height: 1.4;
}
.mov-puntajes-field-row--indent .mov-puntajes-label-col {
  padding-left: 18px;
}
.mov-puntajes-subsec {
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  color: #1e3a5f;
  margin: 14px 0 8px;
  padding-top: 2px;
}
.mov-puntajes-servicios-head {
  margin: 6px 0 4px;
}
.mov-puntajes-servicios-head .mov-field-label {
  margin-bottom: 0;
}
.mov-field-label-sec {
  color: #1e40af !important;
}
.mov-puntajes-sep {
  margin: 14px 0;
  border: 0;
  border-top: 1px solid #e5e7eb;
  clear: both;
}
@media (max-width: 767px) {
  .mov-shell {
    padding-left: 8px;
    padding-right: 8px;
  }
  .mov-docente-actions {
    text-align: left;
  }
  .mov-input-num,
  .mov-puntajes-panel .form-control.mov-input-num {
    max-width: 100%;
  }
  .mov-puntajes-field-row .mov-puntajes-input-col {
    flex: 1 1 100%;
    width: 100%;
    max-width: 100%;
    text-align: left;
  }
  .mov-puntajes-field-row .mov-puntajes-input-col .form-control {
    margin-left: 0;
    max-width: 100%;
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
      <!-- SweetAlert2 CSS loaded globally via header -->

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
  <div class="container mov-shell">
    <h1 class="mov-page-title">Inscripción de docente<span class="mov-page-sub">(Duplicado)</span></h1>

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
    echo "<h2 class='mov-section-title'>Datos del docente</h2>";
    echo "<div class='mov-card'><table class='table table-bordered table-condensed mov-docente-resumen'>";
    echo "<thead><tr><th>Legajo</th><th>Apellido y Nombre</th><th class='mov-docente-actions'>Detalle</th></tr></thead><tbody>";

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $legajoDoc = $row['legajo'];
        $apellidoynombre = $row['apellidoynombre'];
        if ($row['fechanacim'] == null) {
            $fechanacim = $row['fechanacim'];
        } else {
            $fechanacim = $row['fechanacim']->format('d/m/Y');
        }
        $titulobas = $row['titulobas'];
        $promediot = $row['promediot'];
        $otrostit = $row['otrostit'];
        $cargosdocentes = $row['cargosdocentes'];
        if ($row['fingreso'] == null) {
            $fingreso = $row['fingreso'];
        } else {
            $fingreso = $row['fingreso']->format('d/m/Y');
        }

        echo "<tr>";
        echo "<td>" . htmlspecialchars((string) $legajoDoc, ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars((string) $apellidoynombre, ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td class='mov-docente-actions'><button type='button' onclick='showDetails(\"" . htmlspecialchars((string) $legajoDoc, ENT_QUOTES, 'UTF-8') . "\")' class='btn btn-warning btn-sm detalle-button' title='Detalle del docente'><i class='glyphicon glyphicon-list-alt'></i> Detalle</button></td>";
        echo "</tr>";

        echo "<tr id='details_" . htmlspecialchars((string) $legajoDoc, ENT_QUOTES, 'UTF-8') . "' style='display:none' class='active'>";
        echo "<td colspan='3'><strong>Detalles del docente</strong></td>";
        echo "</tr>";
        echo "<tr data-detail-info='" . htmlspecialchars((string) $legajoDoc, ENT_QUOTES, 'UTF-8') . "' style='display:none'><td>Fecha Nac.:</td><td colspan='2'>" . htmlspecialchars((string) $fechanacim, ENT_QUOTES, 'UTF-8') . "</td></tr>";
        echo "<tr data-detail-info='" . htmlspecialchars((string) $legajoDoc, ENT_QUOTES, 'UTF-8') . "' style='display:none'><td>Tít. Básico:</td><td colspan='2'>" . htmlspecialchars((string) $titulobas, ENT_QUOTES, 'UTF-8') . "</td></tr>";
        echo "<tr data-detail-info='" . htmlspecialchars((string) $legajoDoc, ENT_QUOTES, 'UTF-8') . "' style='display:none'><td>Promedio:</td><td colspan='2'>" . htmlspecialchars((string) $promediot, ENT_QUOTES, 'UTF-8') . "</td></tr>";
        echo "<tr data-detail-info='" . htmlspecialchars((string) $legajoDoc, ENT_QUOTES, 'UTF-8') . "' style='display:none'><td>Otro título:</td><td colspan='2'>" . htmlspecialchars((string) $otrostit, ENT_QUOTES, 'UTF-8') . "</td></tr>";
        echo "<tr data-detail-info='" . htmlspecialchars((string) $legajoDoc, ENT_QUOTES, 'UTF-8') . "' style='display:none'><td>Cargo docente:</td><td colspan='2'>" . htmlspecialchars((string) $cargosdocentes, ENT_QUOTES, 'UTF-8') . "</td></tr>";
        echo "<tr data-detail-info='" . htmlspecialchars((string) $legajoDoc, ENT_QUOTES, 'UTF-8') . "' style='display:none'><td>Residencia:</td><td colspan='2'>" . htmlspecialchars((string) $fingreso, ENT_QUOTES, 'UTF-8') . "</td></tr>";
    }

    echo "</tbody></table></div>";
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
  var detailsInfoElements = document.querySelectorAll("[data-detail-info='" + legajo + "']");
  if (!detailsElement) { return; }
  if (detailsElement.style.display === "none" || detailsElement.style.display === "") {
    detailsElement.style.display = "table-row";
    detailsInfoElements.forEach(function(item) {
      item.style.display = "table-row";
    });
  } else {
    detailsElement.style.display = "none";
    detailsInfoElements.forEach(function(item) {
      item.style.display = "none";
    });
  }
}
</script>
<script>
$(document).ready(function() {
    $('#grabarBtn').click(function() {
        juntaSuccess('Grabado', 'Se ha grabado la información.');
    });

    $('#cancelarBtn').click(function() {
        history.back();
    });

    $('#eliminarBtn').click(function() {
        juntaConfirmDanger('¿Estás seguro de que quieres eliminar esta inscripción?', function() {
            var elementoEliminar = document.getElementById('id2');
            var padreElemento = elementoEliminar.parentNode;
            padreElemento.removeChild(elementoEliminar);

            juntaSuccess('Eliminado', 'La inscripción ha sido eliminada.');
        });
    });
});
</script>
<?php
$legajo = $_GET['legajo'];
$excluido = $_GET['excluido'];

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

echo "<form id=\"formDuplicarMov\" action='GrabarMovimientosPermanentes.php' method='post'>";
echo "<input type='hidden' name='legajo' value='" . htmlspecialchars((string) $legajo, ENT_QUOTES, 'UTF-8') . "'>";
echo "<input type='hidden' name='id2' id='id2' value='" . htmlspecialchars((string) $id2, ENT_QUOTES, 'UTF-8') . "'>";

echo '<div class="mov-section-head">';
echo '<div class="mov-section-head-actions">';
echo '<button class="btn btn-warning" type="submit" title="Duplicar registro"><i class="glyphicon glyphicon-copy"></i> Duplicar</button>';
echo '<a href="javascript:history.back()" class="btn btn-default" title="Volver atrás"><i class="glyphicon glyphicon-arrow-left"></i> Volver atrás</a>';
echo '</div>';
echo '<h2 class="mov-section-title mov-section-title--in-head">Duplicado de movimiento</h2>';
echo '</div>';
echo '<div class="mov-card mov-carga-movimiento"><div class="container-fluid">';

if (sqlsrv_has_rows($resultData)) {
    $row = sqlsrv_fetch_array($resultData, SQLSRV_FETCH_ASSOC);
    $anodocVal = isset($row['anodoc']) ? htmlspecialchars((string) $row['anodoc'], ENT_QUOTES, 'UTF-8') : '';
    $codlocSel = isset($row['codloc']) ? $row['codloc'] : null;

    echo '<div class="row">';
    echo '<div class="col-sm-4"><div class="form-group"><label class="mov-field-label" for="anodoc">Curso</label>';
    echo "<input type=\"text\" class=\"form-control\" name=\"anodoc\" id=\"anodoc\" value=\"{$anodocVal}\"></div></div>";
    echo '<div class="col-sm-4"><div class="form-group"><label class="mov-field-label" for="codmod">Cód. mod.</label>';
    echo "<input type=\"text\" class=\"form-control\" name=\"codmod\" id=\"codmod\" value=\"" . htmlspecialchars((string) $row['codmod'], ENT_QUOTES, 'UTF-8') . "\" onchange=\"fetchModalidad()\"></div></div>";
    echo '<div class="col-sm-4"><div class="form-group"><label class="mov-field-label" for="modalidad">Modalidad</label>';
    echo "<select class=\"form-control\" name=\"modalidad\" id=\"modalidad\">";
    foreach ($modalidades as $modalidad) {
        $selected = ($modalidad['codmod'] == $row['codmod']) ? "selected" : "";
        echo "<option value='" . htmlspecialchars($modalidad['codmod'], ENT_QUOTES, 'UTF-8') . "' $selected>" . htmlspecialchars($modalidad['nommod'], ENT_QUOTES, 'UTF-8') . "</option>";
    }
    echo "</select></div></div></div>";

    echo '<div class="row mov-carga-fila-mixta">';
    echo '<div class="col-sm-4"><div class="form-group"><label class="mov-field-label" for="tipo">Tipo inscripción</label>';
    echo "<select class=\"form-control\" name=\"tipo\" id=\"tipo\" onchange=\"mostrarCamposAdicionales(); showTableBasedOnType();\">";
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
    if (trim($row['tipo']) == "Interino" || trim($row['tipo']) == "transitorio"  || trim($row['tipo']) == "Transitorio") {
        echo " selected";
    }
    echo ">Interinatos y Suplencias</option>";
    echo "<option value='Concurso'";
    if (trim($row['tipo']) == "Concurso" || trim($row['tipo']) == "concurso") {
        echo " selected";
    }
    echo ">Concurso de Titularidad</option>";
    echo "</select></div></div>";
    echo '<div class="col-sm-4"><div class="form-group"><label class="mov-field-label" for="codloc">Localidad</label>';
    echo "<select class=\"form-control\" name=\"codloc\" id=\"codloc\">";
    echo "<option value=\"\">Seleccione</option>";
    echo "<option value='USH'" . ($codlocSel === "USH" ? " selected" : "") . ">Ushuaia</option>";
    echo "<option value='RGD'" . ($codlocSel === "RGD" ? " selected" : "") . ">Rio Grande</option>";
    echo "<option value='TOL'" . ($codlocSel === "TOL" ? " selected" : "") . ">Tolhuin</option>";
    echo "<option value='ANT'" . ($codlocSel === "ANT" ? " selected" : "") . ">Antártida</option>";
    echo "</select></div></div>";
    echo '<div class="col-sm-4 hidden-xs"><div class="form-group mov-placeholder-col"><span class="text-muted">&nbsp;</span></div></div>';
    echo '</div>';

echo "<script>
function fetchModalidad() {
    const codmod = document.getElementById('codmod').value;

    if (codmod) {
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
                modalidadSelect.innerHTML = '';
                const option = document.createElement('option');
                option.value = data.nommod;
                option.text = data.nommod;
                modalidadSelect.appendChild(option);
            } else {
                juntaError('Error', data.error);
            }
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
        });
    }
}
</script>";

} else {
    $row = array();
    $anodoc = isset($_GET['anodoc']) ? $_GET['anodoc'] : '';
    $codmod = isset($_GET['codmod']) ? $_GET['codmod'] : '';
    $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
    $nommod = '';
    if (!empty($codmod)) {
        $queryModalidad = "SELECT nommod FROM _junta_modalidades WHERE codmod = ?";
        $params = array($codmod);
        $resultModalidad = sqlsrv_query($conn, $queryModalidad, $params);
        if ($resultModalidad && sqlsrv_has_rows($resultModalidad)) {
            $rowModalidad = sqlsrv_fetch_array($resultModalidad, SQLSRV_FETCH_ASSOC);
            $nommod = $rowModalidad['nommod'];
        }
    }
    $codlocSel = isset($_GET['codloc']) ? $_GET['codloc'] : null;
    $anodocVal = htmlspecialchars((string) $anodoc, ENT_QUOTES, 'UTF-8');

    echo '<div class="row">';
    echo '<div class="col-sm-4"><div class="form-group"><label class="mov-field-label" for="anodoc">Curso</label>';
    echo "<input type=\"text\" class=\"form-control\" name=\"anodoc\" id=\"anodoc\" value=\"{$anodocVal}\"></div></div>";
    echo '<div class="col-sm-4"><div class="form-group"><label class="mov-field-label" for="codmod">Cód. mod.</label>';
    echo "<input type=\"text\" class=\"form-control\" name=\"codmod\" id=\"codmod\" value=\"" . htmlspecialchars((string) $codmod, ENT_QUOTES, 'UTF-8') . "\" onchange=\"fetchModalidad()\"></div></div>";
    echo '<div class="col-sm-4"><div class="form-group"><label class="mov-field-label" for="modalidad">Modalidad</label>';
    echo "<select class=\"form-control\" name=\"modalidad\" id=\"modalidad\">";
    foreach ($modalidades as $modalidad) {
        $sel = (isset($modalidad['nommod']) && $nommod !== '' && trim((string) $nommod) === trim((string) $modalidad['nommod'])) ? ' selected' : '';
        echo "<option value='" . htmlspecialchars($modalidad['codmod'], ENT_QUOTES, 'UTF-8') . "'" . $sel . ">" . htmlspecialchars($modalidad['nommod'], ENT_QUOTES, 'UTF-8') . "</option>";
    }
    echo "</select></div></div></div>";

    $options = [
        'Permanente' => 'Permanente',
        'Titulares' => 'Titulares',
        'transitorio' => 'Interinatos y Suplencias',
        'Concurso' => 'Concurso de Titularidad'
    ];
    echo '<div class="row mov-carga-fila-mixta">';
    echo '<div class="col-sm-4"><div class="form-group"><label class="mov-field-label" for="tipo">Tipo inscripción</label>';
    echo "<select class=\"form-control\" name=\"tipo\" id=\"tipo\" onchange=\"mostrarCamposAdicionales(); showTableBasedOnType();\">";
    foreach ($options as $value => $label) {
        echo "<option value='" . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . "'";
        if ($tipo === $value) {
            echo " selected";
        }
        echo ">" . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . "</option>";
    }
    echo "</select></div></div>";
    echo '<div class="col-sm-4"><div class="form-group"><label class="mov-field-label" for="codloc">Localidad</label>';
    echo "<select class=\"form-control\" name=\"codloc\" id=\"codloc\">";
    echo "<option value=\"\">Seleccione</option>";
    echo "<option value='USH'" . ($codlocSel === "USH" ? " selected" : "") . ">Ushuaia</option>";
    echo "<option value='RGD'" . ($codlocSel === "RGD" ? " selected" : "") . ">Rio Grande</option>";
    echo "<option value='TOL'" . ($codlocSel === "TOL" ? " selected" : "") . ">Tolhuin</option>";
    echo "<option value='ANT'" . ($codlocSel === "ANT" ? " selected" : "") . ">Antártida</option>";
    echo "</select></div></div>";
    echo '<div class="col-sm-4 hidden-xs"><div class="form-group mov-placeholder-col"><span class="text-muted">&nbsp;</span></div></div>';
    echo '</div>';

echo "<script>
function fetchModalidad() {
    const codmod = document.getElementById('codmod').value;
    if (codmod) {
        fetch('buscar_por_codigo.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'codmod=' + codmod
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const modalidadSelect = document.getElementById('modalidad');
                modalidadSelect.innerHTML = '';
                const option = document.createElement('option');
                option.value = data.nommod;
                option.text = data.nommod;
                modalidadSelect.appendChild(option);
            } else {
                juntaError('Error', data.error);
            }
        })
        .catch(error => { console.error('Error en la solicitud:', error); });
    }
}
</script>";

}

    
?>

<script>
jQuery(document).ready(function($) {
  $('.btn-danger').click(function(e) {
      e.preventDefault();
      
      var id2 = $(this).data('id2');
      
      juntaConfirmDanger('¿Desea eliminar el movimiento?', function() {
          jQuery.ajax({
              type: 'POST',
              url: 'eliminar_movimiento.php',
              data: { id2: id2 },
              success: function(response) {
                  juntaSuccess('Eliminado', 'El movimiento ha sido eliminado exitosamente.');
                  location.reload();
              },
              error: function(xhr, status, error) {
                  juntaError('Error', 'Error al intentar eliminar el movimiento. Por favor, inténtalo de nuevo.');
                  console.error(xhr.responseText);
              }
          });
      });
  });
});
</script>
<?php

if (!empty($fecha)) {
    $fecha = date('Y-m-d', strtotime($fecha));
} else {
    $fecha = '';
}

echo "<div class=\"row\" id=\"fechaRow\" style=\"display: none;\">";
echo "<div class=\"col-sm-4\"><div class=\"form-group\"><label class=\"mov-field-label\" for=\"fechaMov\">Fecha</label>";
echo "<input type=\"date\" class=\"form-control\" name=\"fecha\" id=\"fechaMov\" value=\"" . htmlspecialchars($fecha, ENT_QUOTES, 'UTF-8') . "\"></div></div></div>";

$serverName = "10.1.9.113";
$connectionInfo = array(
    "Database" => "junta",
    "Uid" => "SA",
    "PWD" => 'Davinci2024#',
    "CharacterSet" => "UTF-8",
    "TrustServerCertificate" => true
);
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn) {
    echo "";
} else {
    echo "Error en la conexión.<br>";
    $errors = sqlsrv_errors();
    foreach ($errors as $error) {
        echo "SQLSTATE: " . $error['SQLSTATE'] . "<br>";
        echo "Code: " . $error['code'] . "<br>";
        echo "Message: " . $error['message'] . "<br>";
    }
}

$excluidoSeleccionado = isset($_GET['excluido']) ? $_GET['excluido'] : null;
$excluirChecked = ($excluidoSeleccionado !== "23" && $excluidoSeleccionado !== "no") ? "checked" : "";

$queryMotivos = "SELECT idexclu, motivo FROM _junta_motivosexclusion";
$resultMotivos = sqlsrv_query($conn, $queryMotivos);

if ($resultMotivos && sqlsrv_has_rows($resultMotivos)) {
    echo "<div class='row mov-excluir-row'><div class='col-sm-12'><div class='form-group'>";
    echo "<label class='mov-field-label' for='excluir'>Excluir inscripción</label>";
    echo "<div style='display:flex;flex-wrap:wrap;align-items:center;gap:10px;'>";
    echo "<input type='checkbox' id='excluir' name='excluido_checkbox' onchange='toggleMotivosExclusion()' $excluirChecked>";
    $display = ($excluidoSeleccionado !== "23" && $excluidoSeleccionado !== "no") ? "block" : "none";
    echo "<select id='motivosExclusion' name='excluido' class='form-control mov-motivos-select' style='display: $display; max-width:100%;'>";
    echo "<option value=''>Seleccione un motivo de exclusión</option>";
    while ($rowMotivo = sqlsrv_fetch_array($resultMotivos, SQLSRV_FETCH_ASSOC)) {
        $selected = ($rowMotivo['idexclu'] == $excluidoSeleccionado) ? "selected" : "";
        echo "<option value='" . $rowMotivo['idexclu'] . "' $selected>" . htmlspecialchars((string) $rowMotivo['motivo'], ENT_QUOTES, 'UTF-8') . "</option>";
    }
    echo "</select></div></div></div></div>";
    echo "<script>
    function toggleMotivosExclusion() {
        var select = document.getElementById('motivosExclusion');
        var checkbox = document.getElementById('excluir');
        if (checkbox.checked) {
            select.style.display = 'block';
        } else {
            select.style.display = 'none';
            select.selectedIndex = 0;
        }
    }
    window.addEventListener('load', function() {
        var checkbox = document.getElementById('excluir');
        if (checkbox && checkbox.checked && document.getElementById('motivosExclusion')) {
            document.getElementById('motivosExclusion').style.display = 'block';
        }
    });
    </script>";
} else {
    echo "<p class='text-muted'>No se encontraron motivos de exclusión en la base de datos.</p>";
}

$queryEstablecimientos = "   SELECT iddep, nomdep, coddep
FROM _junta_dependencias
ORDER BY 
    CASE 
        WHEN nomdep COLLATE Latin1_General_CI_AI LIKE '%jardín%' THEN 1
        WHEN nomdep COLLATE Latin1_General_CI_AI LIKE '%escuela%' THEN 2
        ELSE 3
    END,
    TRY_CAST(
        TRIM(REPLACE(REPLACE(REPLACE(REPLACE(
            SUBSTRING(nomdep, PATINDEX('%[0-9]%', nomdep), LEN(nomdep)),
            '-', ''), 'TOLHUIN', ''), 'ALMANZA', ''), 'N°', ''))
        AS INT
    ),
    coddep;
";
$resultEstablecimientos = sqlsrv_query($conn, $queryEstablecimientos);

echo "<div id='titularesRow' class='row' style='display: none;'>";
echo "<div class='col-sm-4'><div class='form-group'><label class='mov-field-label' for='establecimiento'>Establecimiento</label>";
echo "<select class='form-control' name='establecimiento' id='establecimiento'>";
if ($resultEstablecimientos) {
    while ($rowEstablecimiento = sqlsrv_fetch_array($resultEstablecimientos, SQLSRV_FETCH_ASSOC)) {
        $nombreEstablecimiento = $rowEstablecimiento['nomdep'];
        $codEstablecimiento = $rowEstablecimiento['coddep'];
        $selected = ($nombreEstablecimiento === $receivedNomdep) ? "selected" : "";
        echo "<option value='" . htmlspecialchars((string) $codEstablecimiento, ENT_QUOTES, 'UTF-8') . "' $selected>" . htmlspecialchars((string) $nombreEstablecimiento, ENT_QUOTES, 'UTF-8') . "</option>";
    }
}
echo "</select></div></div>";
echo "<div class='col-sm-6'><div class='form-group'><label class='mov-field-label' for='obs'>Observación</label>";
echo "<input type='text' class='form-control' id='obs' name='obs' value='" . htmlspecialchars($obs, ENT_QUOTES, 'UTF-8') . "'></div></div>";
echo "<div class='col-sm-2'><div class='form-group'><label class='mov-field-label' for='horas'>Horas</label>";
echo "<input type='number' class='form-control mov-input-num' name='horas' id='horas' value='" . htmlspecialchars((string) $horas, ENT_QUOTES, 'UTF-8') . "'></div></div>";
echo "</div>";

echo "</div></div>";

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


echo "<h2 class=\"mov-section-title\">Carga de puntajes</h2>";
echo "<div id=\"tablaComun\" style=\"display:none\"></div>";
echo "<div id='tablaPermanenteConcursoInterino' class='mov-puntajes-panel' style='display:none;'>";
echo "<div class='mov-puntajes-inner container-fluid'>";
echo "<h3 class='mov-puntajes-heading'>Carga común</h3>";
echo "<div class='mov-puntajes-grid2'>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='puntajetotal2'>Puntaje total</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='puntajetotal2' name='puntajetotal2' class='form-control mov-input-num' value='" . htmlspecialchars($row['puntajetotal']) . "' step='0.01' readonly></div></div>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='titulo2'>1.- Título</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='titulo2' name='titulo2' class='form-control mov-input-num' value='" . htmlspecialchars($row['titulo']) . "' step='0.01' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'></div></div>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='otitulo2'>2.- Otros título</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='otitulo2' name='otitulo2' class='form-control mov-input-num' value='" . htmlspecialchars($row['otitulo']) . "' step='0.01' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'></div></div>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='promedio2'>3.- Promedio</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='promedio2' name='promedio2' class='form-control mov-input-num' value='" . htmlspecialchars($row['promedio']) . "' step='0.01' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'></div></div>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='antiguedadgestion2'>4.- Antigüedad gestión</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='antiguedadgestion2' name='antiguedadgestion2' class='form-control mov-input-num' value='" . htmlspecialchars($row['antiguedadgestion']) . "' step='0.01' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'></div></div>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='antiguedadtitulo2'>5.- Antigüedad título</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='antiguedadtitulo2' name='antiguedadtitulo2' class='form-control mov-input-num' value='" . htmlspecialchars($row['antiguedadtitulo']) . "' step='0.01' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'></div></div>";
echo "<div class='mov-puntajes-servicios-head'><span class='mov-field-label'>6.- Servicios</span></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='serviciosprovincia2'>6.1- En la provincia</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='serviciosprovincia2' name='serviciosprovincia2' class='form-control mov-input-num' value='" . htmlspecialchars($row['serviciosprovincia']) . "' step='0.01' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='otrosservicios2'>6.2- Otros servicios</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='otrosservicios2' name='otrosservicios2' class='form-control mov-input-num' value='" . htmlspecialchars($row['otrosservicios']) . "' step='0.01' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'></div></div>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='residencia2'>7.- Residencia</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='residencia2' name='residencia2' class='form-control mov-input-num' value='" . htmlspecialchars($row['residencia']) . "' step='0.01' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'></div></div>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='publicaciones2'>8.- Publicaciones</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='publicaciones2' name='publicaciones2' class='form-control mov-input-num' value='" . htmlspecialchars($row['publicaciones']) . "' step='0.01' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'></div></div>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='otrosantecedentes2'>9.- Otros antecedentes</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='otrosantecedentes2' name='otrosantecedentes2' class='form-control mov-input-num' value='" . htmlspecialchars($row['otrosantecedentes']) . "' step='0.01' onchange='calcularPuntajeTotal()' onkeyup='calcularPuntajeTotal()'></div></div>";
echo "</div></div></div>";



echo "<script>
function calcularPuntajeTotal2() { 
    try {
        var getFieldValue = function(id) {
            var element = document.getElementById(id);
            var value = element ? element.value : '';
            // Reemplazar la coma por punto y convertir a número
            value = value.replace(',', '.');
            // Validar si es un número válido, si no devolver 0
            return !isNaN(parseFloat(value)) && value.trim() !== '' ? parseFloat(value) : 0;
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
echo "<div id='tablaTitular' class='mov-puntajes-panel' style='display:none;'>";
echo "<div class='mov-puntajes-inner container-fluid'>";
echo "<h3 class='mov-puntajes-heading'>Carga titular</h3>";
echo "<div class='mov-puntajes-grid2'>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='puntajetotal'>Puntaje total</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='puntajetotal' name='puntajetotal' class='form-control mov-input-num' value='" . htmlspecialchars($row['puntajetotal']) . "' readonly></div></div>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='titulo'>1.- Título</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='titulo' name='titulo' class='form-control mov-input-num' value='" . htmlspecialchars($row['titulo']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='otrostit'>2.- Otros título</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='otrostit' name='otitulo' class='form-control mov-input-num' value='" . htmlspecialchars($row['otitulo']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='concepto'>3.- Conceptos</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='concepto' name='concepto' class='form-control mov-input-num' value='" . htmlspecialchars($row['concepto']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='promedio'>4.- Promedio</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='promedio' name='promedio' class='form-control mov-input-num' value='" . htmlspecialchars($row['promedio']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='antiguedadgestion'>5.- Antigüedad gestión</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='antiguedadgestion' name='antiguedadgestion' class='form-control mov-input-num' value='" . htmlspecialchars($row['antiguedadgestion']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='antiguedadtitulo'>6.- Antigüedad título</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='antiguedadtitulo' name='antiguedadtitulo' class='form-control mov-input-num' value='" . htmlspecialchars($row['antiguedadtitulo']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-servicios-head'><span class='mov-field-label'>7.- Servicios</span></div>";
echo "<p class='mov-puntajes-subsec'>Docencia — cargos en establecimientos</p>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='serviciosprovincia'>7.1- En la provincia</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='text' id='serviciosprovincia' name='serviciosprovincia' class='form-control mov-input-num' value='" . htmlspecialchars($row['serviciosprovincia']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_m_seccion'>Maestro de sección</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_m_seccion' name='t_m_seccion' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_m_seccion']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_m_anio'>Maestro de año</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_m_anio' name='t_m_anio' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_m_anio']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_m_grupo'>Maestro de grupo</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_m_grupo' name='t_m_grupo' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_m_grupo']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_m_ciclo'>Maestro de ciclo</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_m_ciclo' name='t_m_ciclo' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_m_ciclo']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_m_recupera'>Maestro recuperador</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_m_recupera' name='t_m_recupera' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_m_recupera']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_m_comple'>Maestro complementario</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_m_comple' name='t_m_comple' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_m_comple']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_m_biblio'>Maestro bibliotecario</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_m_biblio' name='t_m_biblio' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_m_biblio']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_m_gabinete'>Gabinete</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_m_gabinete' name='t_m_gabinete' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_m_gabinete']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<hr class='mov-puntajes-sep'>";
echo "<p class='mov-puntajes-subsec'>Secretaría y vice</p>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_m_sec1'>Secretaría 1º</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_m_sec1' name='t_m_sec1' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_m_sec1']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_m_sec2'>Secretaría 2º</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_m_sec2' name='t_m_sec2' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_m_sec2']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_m_viced'>Vice-director</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_m_viced' name='t_m_viced' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_m_viced']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<hr class='mov-puntajes-sep'>";
echo "<p class='mov-puntajes-subsec'>Dirección</p>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_d_pu'>Director personal único</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_d_pu' name='t_d_pu' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_d_pu']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_d_3'>Director de 3º</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_d_3' name='t_d_3' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_d_3']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_d_2'>Director de 2º</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_d_2' name='t_d_2' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_d_2']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_d_1'>Director de 1º</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_d_1' name='t_d_1' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_d_1']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_d_biblio'>Director de biblioteca</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_d_biblio' name='t_d_biblio' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_d_biblio']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_d_gabi'>Director de gabinete</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_d_gabi' name='t_d_gabi' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_d_gabi']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<hr class='mov-puntajes-sep'>";
echo "<p class='mov-puntajes-subsec'>Supervisión</p>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_d_seccoortec'>Secretario coord. tec.</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_d_seccoortec' name='t_d_seccoortec' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_d_seccoortec']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_d_supsectec'>Sup. sec. tec.</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_d_supsectec' name='t_d_supsectec' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_d_supsectec']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_d_supesc'>Sup. escolar</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_d_supesc' name='t_d_supesc' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_d_supesc']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_d_supgral'>Sup. general</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_d_supgral' name='t_d_supgral' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_d_supgral']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='t_d_adic'>Adic.</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='t_d_adic' name='t_d_adic' class='form-control mov-input-num' value='" . htmlspecialchars($row['t_d_adic']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<hr class='mov-puntajes-sep'>";
echo "<p class='mov-puntajes-subsec'>Otros servicios (grupos A–D)</p>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='otrosservicios'>7.2- Otros servicios</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='text' id='otrosservicios' name='otrosservicios' class='form-control mov-input-num' value='" . htmlspecialchars($row['otrosservicios']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='o_g_a'>Grupo A</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='o_g_a' name='o_g_a' class='form-control mov-input-num' value='" . htmlspecialchars($row['o_g_a']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='o_g_b'>Grupo B</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='o_g_b' name='o_g_b' class='form-control mov-input-num' value='" . htmlspecialchars($row['o_g_b']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='o_g_c'>Grupo C</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='o_g_c' name='o_g_c' class='form-control mov-input-num' value='" . htmlspecialchars($row['o_g_c']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row mov-puntajes-field-row--indent'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label mov-field-label-sec' for='o_g_d'>Grupo D</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='o_g_d' name='o_g_d' class='form-control mov-input-num' value='" . htmlspecialchars($row['o_g_d']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='residencia'>8.- Residencia</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='residencia' name='residencia' class='form-control mov-input-num' value='" . htmlspecialchars($row['residencia']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='publicaciones'>9.- Publicaciones</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='publicaciones' name='publicaciones' class='form-control mov-input-num' value='" . htmlspecialchars($row['publicaciones']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "<div class='mov-puntajes-field-row'><div class='mov-puntajes-label-col'><label class='mov-puntajes-inline-label' for='otrosantecedentes'>10.- Otros antecedentes</label></div>";
echo "<div class='mov-puntajes-input-col'><input type='number' id='otrosantecedentes' name='otrosantecedentes' class='form-control mov-input-num' value='" . htmlspecialchars($row['otrosantecedentes']) . "' onchange='calcularPuntajeTotal2()' onkeyup='calcularPuntajeTotal2()'></div></div>";
echo "</div></div></div>";

echo "<br>";

// JavaScript para mostrar u ocultar las tablas según el tipo seleccionado
echo "<script>";
echo "function mostrarCamposAdicionales() {";
echo "    var select = document.getElementById('tipo');";
echo "    var titularesRow = document.getElementById('titularesRow');";
echo "    var fechaRow = document.getElementById('fechaRow');";
echo "    if (!select || !titularesRow || !fechaRow) return;";
echo "    var v = (select.value || '').toLowerCase();";
echo "    if (v === 'titulares') {";
echo "        titularesRow.style.display = 'block';";
echo "        fechaRow.style.display = 'none';";
echo "    } else {";
echo "        titularesRow.style.display = 'none';";
echo "        fechaRow.style.display = (v === 'permanente') ? 'block' : 'none';";
echo "    }";
echo "}";
echo "function mostrarTablaSegunTipo() {";
echo "    var tipoSelect = document.getElementById('tipo');";
echo "    var tablaPermanenteConcursoInterino = document.getElementById('tablaPermanenteConcursoInterino');";
echo "    var tablaTitular = document.getElementById('tablaTitular');";
echo "    var tablaComun = document.getElementById('tablaComun');";
echo "    if (!tipoSelect) return;";
echo "    var v = (tipoSelect.value || '').toLowerCase();";
echo "    var perm = (v === 'permanente' || v === 'concurso' || v === 'transitorio');";
echo "    if (tablaPermanenteConcursoInterino) tablaPermanenteConcursoInterino.style.display = perm ? 'block' : 'none';";
echo "    if (tablaTitular) tablaTitular.style.display = (v === 'titulares') ? 'block' : 'none';";
echo "    if (tablaComun) tablaComun.style.display = (!perm && v !== 'titulares') ? 'block' : 'none';";
echo "}";
echo "function showTableBasedOnType() { mostrarTablaSegunTipo(); }";
echo "document.addEventListener('DOMContentLoaded', function() {";
echo "    var tipoSelect = document.getElementById('tipo');";
echo "    if (tipoSelect) {";
echo "        tipoSelect.addEventListener('change', function() {";
echo "            mostrarCamposAdicionales();";
echo "            mostrarTablaSegunTipo();";
echo "        });";
echo "    }";
echo "    mostrarCamposAdicionales();";
echo "    mostrarTablaSegunTipo();";
echo "});";
echo "</script>";
?>

<?php
$resultLeg = sqlsrv_query($conn, $queryData);
$legdocVal = '';
if ($resultLeg && ($rLeg = sqlsrv_fetch_array($resultLeg, SQLSRV_FETCH_ASSOC))) {
    $legdocVal = isset($rLeg['legdoc']) ? (string) $rLeg['legdoc'] : '';
}
echo '<input type="hidden" id="legdoc" name="legdoc" value="' . htmlspecialchars($legdocVal, ENT_QUOTES, 'UTF-8') . '">';
echo "<div class=\"mov-form-actions mov-form-actions--footer\">";
echo "<button class=\"btn btn-warning\" title=\"Duplicar registro\" type=\"submit\"><i class=\"glyphicon glyphicon-copy\"></i> Duplicar</button>";
echo "<a href=\"javascript:history.back()\" class=\"btn btn-default\" title=\"Volver atrás\"><i class=\"glyphicon glyphicon-arrow-left\"></i> Volver atrás</a>";
echo "</div>";
echo "</form>";
?>
                <?php $JUNTA_PIE_SESION_DIRECT = true; ?>
                <?php include('footer2.php');?>
          

<script>
function myConfirmMov() {
  event.preventDefault();
  var form = document.getElementById('formDuplicarMov');
  juntaConfirm('¿Desea actualizar el MOVIMIENTO?', function() {
    form.submit();
  });
  return false;
}
</script>
