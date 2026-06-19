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
      $doc->__SET('id2', $_REQUEST['id2']);
      $doc->__SET('legajo', $_REQUEST['legajo']);
      $doc->__SET('apellidoynombre', $_REQUEST['apellidoynombre']);
      $doc->__SET('dni', $_REQUEST['dni']);
      $doc->__SET('domicilio', $_REQUEST['domicilio']);
      $doc->__SET('lugarinsc', $_REQUEST['lugarinsc']);
      
      // Manejo de la fecha de nacimiento
  
      $fechanacim = !empty($_REQUEST['fechanacim']) ? date('Y-m-d H:i:s.000', strtotime($_REQUEST['fechanacim'])) : null;
      $doc->__SET('fechanacim', $fechanacim);
     
      $doc->__SET('promedioT', $_REQUEST['promedioT']);
      $doc->__SET('telefonos', $_REQUEST['telefonos']);
      $doc->__SET('Titulobas', $_REQUEST['Titulobas']);
      
      $fechatit = !empty($_REQUEST['fechatit']) ? date('Y-m-d H:i:s.000', strtotime($_REQUEST['fechatit'])) : null;
      $doc->__SET('fechatit', $fechatit);
        
      $doc->__SET('otorgadopor', $_REQUEST['otorgadopor']);
    
      $finicio = !empty($_REQUEST['finicio']) ? date('Y-m-d H:i:s.000', strtotime($_REQUEST['finicio'])) : null;
      $doc->__SET('finicio', $finicio);
        
      $doc->__SET('otrostit', $_REQUEST['otrostit']);
     
      $fingreso = !empty($_REQUEST['fingreso']) ? date('Y-m-d H:i:s.000', strtotime($_REQUEST['fingreso'])) : null;
      $doc->__SET('fingreso', $fingreso);
        
      $doc->__SET('cargosdocentes', $_REQUEST['cargosdocentes']);
       
      $faperturaleg = !empty($_REQUEST['faperturaleg']) ? date('Y-m-d H:i:s.000', strtotime($_REQUEST['faperturaleg'])) : null;
      $doc->__SET('faperturaleg', $faperturaleg);
      
      $doc->__SET('Nacionalidad', $_REQUEST['Nacionalidad']);
      $doc->__SET('email', $_REQUEST['email']);
      $doc->__SET('obsdoc', $_REQUEST['obsdoc']);
      
      $model->ActualizarDocente($doc);
      break;

    case 'registrar':
      $doc->__SET('id2', $_REQUEST['id2']);
      $doc->__SET('legajo', $_REQUEST['legajo']);
      $doc->__SET('apellidoynombre', $_REQUEST['apellidoynombre']);
      $doc->__SET('dni', $_REQUEST['dni']);
      $doc->__SET('domicilio', $_REQUEST['domicilio']);
      $doc->__SET('lugarinsc', $_REQUEST['lugarinsc']);
      
      $fechanacim = !empty($_REQUEST['fechanacim']) ? date('Y-d-m H:i:s.000', strtotime($_REQUEST['fechanacim'])) : null;
      $doc->__SET('fechanacim', $fechanacim);
      
      $doc->__SET('promedioT', $_REQUEST['promedioT']);
      $doc->__SET('telefonos', $_REQUEST['telefonos']);
      $doc->__SET('Titulobas', $_REQUEST['Titulobas']);

      $fechatit = !empty($_REQUEST['fechatit']) ? date('Y-m-d H:i:s.000', strtotime($_REQUEST['fechatit'])) : null;
      $doc->__SET('fechatit', $fechatit);

      $doc->__SET('otorgadopor', $_REQUEST['otorgadopor']);

      $finicio = !empty($_REQUEST['finicio']) ? date('Y-m-d H:i:s.000', strtotime($_REQUEST['finicio'])) : null;
      $doc->__SET('finicio', $finicio);

      $doc->__SET('otrostit', $_REQUEST['otrostit']);

      $fingreso = !empty($_REQUEST['fingreso']) ? date('Y-m-d H:i:s.000', strtotime($_REQUEST['fingreso'])) : null;
      $doc->__SET('fingreso', $fingreso);

      $doc->__SET('cargosdocentes', $_REQUEST['cargosdocentes']);
      
      $faperturaleg = !empty($_REQUEST['faperturaleg']) ? date('Y-m-d H:i:s.000', strtotime($_REQUEST['faperturaleg'])) : null;
      $doc->__SET('faperturaleg', $faperturaleg);
      
      $doc->__SET('Nacionalidad', $_REQUEST['Nacionalidad']);
      $doc->__SET('email', $_REQUEST['email']);
      $doc->__SET('obsdoc', $_REQUEST['obsdoc']);
      
      $model->RegistrarDocente($doc);
      break;

    case 'eliminar':
      $model->EliminarDocente($_REQUEST['id2']);
      break;

    case 'editar':
      $doc = $model->ObtenerDocente($_REQUEST['id2']);
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
  padding: 10px 25px; /* Relleno del boton */
  position: fixed;
  bottom: 50px;
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




/* Buscador + tabla de resultados: mismo ancho máximo y centrado */
.listado-docentes-busqueda {
  max-width: 1100px;
  margin-left: auto;
  margin-right: auto;
  padding: 0 12px 24px;
  box-sizing: border-box;
}

.listado-docentes-busqueda #busquedaForm .form-group {
  margin-bottom: 0;
}

.listado-docentes-busqueda #busquedaForm .form-control {
  min-height: 42px;
  padding: 8px 12px;
  line-height: 1.35;
  box-sizing: border-box;
}

.listado-docentes-busqueda .filtro-tabla-wrap {
  width: 88%;
  max-width: 900px;
  margin: 14px auto 10px;
}

.listado-docentes-busqueda .filtro-tabla-wrap .form-control {
  width: 100%;
  max-width: 100%;
}

.listado-docentes-busqueda .container.mt-4 {
  width: 100%;
  max-width: 100%;
  margin-left: auto;
  margin-right: auto;
  padding-left: 0;
  padding-right: 0;
}

.listado-docentes-busqueda #resultTable {
  width: 100% !important;
  table-layout: auto;
}

.listado-docentes-busqueda .dataTables_wrapper {
  width: 100% !important;
  overflow-x: auto;
}

/* --- Formulario Datos Docente: layout claro, secciones y campos proporcionados --- */
.docente-form-shell {
  max-width: 920px;
  margin: 0 auto 28px;
  padding: 0 12px;
  box-sizing: border-box;
}

.docente-form-title {
  text-align: center;
  font-family: 'Roboto', 'Open Sans', sans-serif;
  font-size: 30px;
  font-weight: 600;
  color: #1f2937;
  margin: 0 0 18px;
  padding-bottom: 8px;
  border-bottom: 2px solid rgba(38, 152, 243, 0.35);
}

.docente-form-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  background: #fff;
  border: 1px solid rgba(0, 0, 0, 0.08);
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
}

.docente-form-table th {
  width: 34%;
  max-width: 260px;
  font-weight: 600;
  font-size: 14px;
  color: #374151;
  text-align: left !important;
  vertical-align: middle !important;
  padding: 12px 14px !important;
  background: #f3f4f6;
  border-bottom: 1px solid #e5e7eb;
}

.docente-form-table td {
  vertical-align: middle !important;
  padding: 12px 14px !important;
  border-bottom: 1px solid #e5e7eb;
  background: #fff;
}

.docente-form-table tr:last-child th,
.docente-form-table tr:last-child td {
  border-bottom: none;
}

.docente-form-table .form-control {
  display: inline-block;
  width: 100%;
  max-width: 420px;
  min-height: 40px;
  padding: 8px 12px;
  border-radius: 6px;
  box-sizing: border-box;
}

.docente-form-table textarea.form-control {
  max-width: 100%;
  min-height: 120px;
  resize: vertical;
}

.docente-form-table .docente-input-sm {
  max-width: 220px;
}

.docente-form-table .docente-input-md {
  max-width: 320px;
}

.docente-sec-row td {
  padding: 10px 14px !important;
  background: #e8f4fe !important;
  border-bottom: 1px solid #dbeafe;
}

.docente-sec-title {
  font-size: 13px;
  font-weight: 700;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  color: #1e40af;
}

.docente-form-table tr:last-child td {
  text-align: center !important;
  vertical-align: middle !important;
}

.docente-legajo-resumen {
  width: 100%;
  margin-top: 6px;
  font-size: 14px;
  color: #374151;
}

@media (max-width: 768px) {
  .docente-form-table th,
  .docente-form-table td {
    display: block;
    width: 100% !important;
    max-width: none !important;
  }

  .docente-form-table .form-control {
    max-width: 100% !important;
  }
}

/* Barra superior de acciones (Nuevo Docente + PDF) alineada */
.listado-docentes-toolbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 10px;
  margin: 0 0 16px;
  padding: 10px 12px;
  background: #fff;
  border: 1px solid rgba(0, 0, 0, 0.08);
  border-radius: 8px;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
}

.listado-docentes-busqueda-titulo {
  text-align: center;
  font-family: 'Roboto', 'Open Sans', sans-serif;
  font-size: 28px;
  font-weight: 600;
  color: #1f2937;
  margin: 0 0 8px;
  padding-bottom: 6px;
  border-bottom: 2px solid rgba(38, 152, 243, 0.35);
}

.listado-docentes-busqueda-acciones {
  display: flex;
  justify-content: center;
  gap: 12px;
  flex-wrap: wrap;
  margin-top: 14px;
}

<?php readfile(__DIR__ . '/../css/junta-panel-polish.css'); ?>
<?php readfile(__DIR__ . '/../css/junta-acciones-polish.css'); ?>
<?php readfile(__DIR__ . '/../css/docentes-list-polish.css'); ?>

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

      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
      <!-- SweetAlert2 ahora se carga globalmente via header -->

      <!--aca esta las extensiones para el paginado de la las tablas --->
  
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

  
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>




</head>
<body>
<button class="btn-flotante" onclick="topFunction()" title='subir'>Subir</button>

  <div class="page-content bg-light">
  <script>
        // Obtener el botón
        let myButton = document.querySelector(".btn-flotante");

      // Mostrar u ocultar el botón basado en la posición de desplazamiento
      window.onscroll = function() {
          scrollFunction();
      };

      function scrollFunction() {
          let scrollPosition = document.documentElement.scrollTop || document.body.scrollTop;
          let documentHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
          let scrollThreshold = documentHeight * 0.30; // 35% de la altura total del documento

          if (scrollPosition > scrollThreshold) {
              myButton.style.display = "block";
          } else {
              myButton.style.display = "none";
          }
      }

      // Cuando el usuario hace clic en el botón, desplázate hasta la parte superior del documento
      function topFunction() {
          document.body.scrollTop = 0;
          document.documentElement.scrollTop = 0;
      }
    </script>

  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 

<?php
// Te recomiendo utilizar esta conexión, la que utilizas ya no es la recomendada. 
//$link = new PDO('mysql:host=localhost;dbname=junta', 'root', ''); // el campo vaciío es para la password. 
try {
  $dsn = "sqlsrv:server=10.1.9.113;database=junta;TrustServerCertificate=yes";
  $username = "SA";
  $password = 'Davinci2024#';
  
  // Crear la conexión PDO
  $link = new PDO($dsn, $username, $password);

  // Establecer el modo de error de PDO para que lance excepciones
  $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
  echo "Error en la conexión a SQL Server: " . $e->getMessage();
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

<div class="listado-docentes-busqueda">
<?php
$juntaPdfDocenteUrl = 'generate_pdf.php?legajo=' . urlencode((string) $doc->__GET('legajo'))
    . '&apellidoynombre=' . urlencode((string) $doc->__GET('apellidoynombre'))
    . '&dni=' . urlencode((string) $doc->__GET('dni'))
    . '&domicilio=' . urlencode((string) $doc->__GET('domicilio'))
    . '&lugarinsc=' . urlencode((string) $doc->__GET('lugarinsc'))
    . '&fechanacim=' . urlencode((string) $doc->__GET('fechanacim'))
    . '&promedioT=' . urlencode((string) $doc->__GET('promedioT'))
    . '&telefonos=' . urlencode((string) $doc->__GET('telefonos'))
    . '&Titulobas=' . urlencode((string) $doc->__GET('Titulobas'))
    . '&fechatit=' . urlencode((string) $doc->__GET('fechatit'))
    . '&otorgadopor=' . urlencode((string) $doc->__GET('otorgadopor'))
    . '&finicio=' . urlencode((string) $doc->__GET('finicio'))
    . '&otrostit=' . urlencode((string) $doc->__GET('otrostit'))
    . '&fingreso=' . urlencode((string) $doc->__GET('fingreso'))
    . '&cargosdocentes=' . urlencode((string) $doc->__GET('cargosdocentes'))
    . '&faperturaleg=' . urlencode((string) $doc->__GET('faperturaleg'))
    . '&Nacionalidad=' . urlencode((string) $doc->__GET('Nacionalidad'))
    . '&email=' . urlencode((string) $doc->__GET('email'))
    . '&obsdoc=' . urlencode((string) $doc->__GET('obsdoc'));
?>
<div class="listado-docentes-toolbar">
  <a href="RegistroDocente.php" class="btn btn-primary" title="Ingrese Nuevo Docente">
    <span class="glyphicon glyphicon-plus"></span> Nuevo Docente
  </a>
  <a href="<?php echo htmlspecialchars($juntaPdfDocenteUrl, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-info" title="Descargar PDF" target="_blank" rel="noopener noreferrer">
    <i class="glyphicon glyphicon-save"></i> Información Docente PDF
  </a>
</div>
<h1 class="listado-docentes-busqueda-titulo">Buscar Docente</h1>
<form id="busquedaForm">
    <div class="listado-docentes-busqueda-filtros">
        <div class="form-group doc-busq-field doc-busq-field-legajo">
            <label for="legajo">Legajo</label>
            <input type="number" class="form-control docente-input-sm" id="legajo" name="legajo" placeholder="Ingrese Legajo">
        </div>
        <div class="form-group doc-busq-field doc-busq-field-dni">
            <label for="dni">DNI</label>
            <input type="number" class="form-control docente-input-sm" id="dni" name="dni" placeholder="Ingrese DNI">
        </div>
        <div class="form-group doc-busq-field doc-busq-field-nombre">
            <label for="apellido">Apellido y Nombre</label>
            <input type="text" class="form-control" id="apellido" name="ApellidoyNombre" placeholder="Ingrese Apellido y Nombre" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s'-]/g, '')">
        </div>
    </div>
    <div class="listado-docentes-busqueda-acciones">
    <button type="submit" class="btn btn-warning" id="buscarBtn">
        <i class="glyphicon glyphicon-search"></i> Buscar
    </button>
    </div>
    <div id="busquedaResultadoOk" class="listado-docentes-busqueda-ok alert alert-success" role="status" aria-live="polite" style="display: none;">
        <i class="glyphicon glyphicon-ok-sign" aria-hidden="true"></i>
        <span>Resultados encontrados correctamente.</span>
    </div>
</form>

<script>
    document.getElementById('legajo').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    document.getElementById('dni').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>

<div class="filtro-tabla-wrap">
        <input type="text" id="searchTable" class="form-control" placeholder="Filtrar resultados por Legajo, DNI o Apellido..." style="display: none;">
</div>


<div class="container-fluid cfg-card cfg-table-wrap" style="overflow-x:auto;">
    <table id="resultTable" class="display table table-hover table-bordered results" style="display: none;">
        <thead>
            <tr>
                <th>Legajo</th>
                <th>DNI</th>
                <th>Apellido y Nombre</th>
                <th>Localidad de Inscripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="resultBody">
            <!-- Mensaje "No hay datos" por defecto -->
            <tr class="no-data"><td colspan="5" class="text-center">No hay datos</td></tr>
        </tbody>
    </table>
</div>
</div>

<script>
$(document).ready(function () {
    function ejecutarBusquedaDocentes() {
        var legajo = $('#legajo').val().trim();
        var dni = $('#dni').val().trim();
        var apellido = $('#apellido').val().trim();

        if (legajo === '' && dni === '' && apellido === '') {
            juntaAlert('Debe ingresar al menos un dato para realizar la búsqueda.', 'warning');
            return;
        }

        var formData = $('#busquedaForm').serialize();

        $.ajax({
            url: 'buscar_docente.php',
            type: 'GET',
            data: formData,

            beforeSend: function () {
                juntaSpinnerShow('Buscando docentes\u2026');
                $('#resultTable').hide();
                $('#resultBody').empty();
                $('#busquedaResultadoOk').hide();
            },

            success: function (data) {
                $('#resultBody').html(data);

                var rowCount = $('#resultBody tr').not('.no-data').length;

                if (rowCount > 0) {
                    $('#resultTable').show();
                    $('#searchTable').show();
                    $('#busquedaResultadoOk').show();
                    $('.no-data').remove();
                } else {
                    $('#resultTable').show();
                    $('#searchTable').hide();
                    $('#busquedaResultadoOk').hide();
                    $('#resultBody').html('<tr class="no-data"><td colspan="5" class="text-center" style="color:red;">No se encontraron resultados</td></tr>');
                }
            },

            error: function () {
                juntaError('Error', 'Hubo un error al realizar la búsqueda. Por favor, inténtelo de nuevo.');
            },

            complete: function () {
                juntaSpinnerHide();
            }
        });
    }

    $('#buscarBtn').click(function (e) {
        e.preventDefault();
        ejecutarBusquedaDocentes();
    });

    $('#busquedaForm').on('submit', function (e) {
        e.preventDefault();
        ejecutarBusquedaDocentes();
    });

    // Filtro en tiempo real dentro de la tabla
    $("#searchTable").on("keyup", function () {
        var value = $(this).val().toLowerCase();

        $("#resultBody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });

        if ($("#resultBody tr:visible").length === 0) {
            if ($("#resultBody .no-data").length === 0) {
                $("#resultBody").append('<tr class="no-data"><td colspan="5" class="text-center">No hay coincidencias</td></tr>');
            }
        } else {
            $("#resultBody .no-data").remove();
        }
    });
});
</script>

<script>
    function myConfirm4() {
        juntaConfirmDanger('¿Desea borrar al docente?');
        return false;
    }
</script>
<script>
    function clearResults() {
        document.getElementById("resultBody").innerHTML = '';
    }
</script>

<div class="cfg-listados-polish docentes-page docente-datos-panel">
<div class="docente-form-shell cfg-card">
<h1 class="docente-form-title cfg-page-title">Datos Docente</h1>
 <form action="?action=<?php echo $doc->id2 > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:0;" id="formulario_transaccion">
                    <input type="hidden" name="id2" value="<?php echo $doc->__GET('id2'); ?>" />
                    <table class="docente-form-table" id="seleccion">
                        <tr class="docente-sec-row">
                            <td colspan="2" class="docente-sec-title">Datos personales y de contacto</td>
                        </tr>
                        <tr>
                            <th>Legajo</th>
                            <td><input type="number" name="legajo" value="<?php echo $doc->__GET('legajo'); ?>" class="form-control docente-input-sm" required /></td>
                        </tr>
                         <tr>
                            <th>Apellido y Nombre</th>
                            <td><input type="text" name="apellidoynombre" value="<?php echo $doc->__GET('apellidoynombre'); ?>" class="form-control" required /></td>
                        </tr>
                        <tr>
                            <th>DNI</th>
                            <td><input type="number" name="dni" value="<?php echo $doc->__GET('dni'); ?>" class="form-control docente-input-sm" required/></td>
                        </tr>
                        <tr>
                            <th>Domicilio</th>
                            <td><input type="text" name="domicilio" value="<?php echo $doc->__GET('domicilio'); ?>" class="form-control" /></td>
                        </tr>
                         <tr>
                            <th>Lugar inscripción</th>
                            <td><input type="text" name="lugarinsc" value="<?php
                                  if ($doc->__GET('lugarinsc') == 'RG' or $doc->__GET('lugarinsc') == 'RGD') {
                                      echo 'Rio Grande';
                                  } elseif ($doc->__GET('lugarinsc') == 'USH') {
                                      echo 'Ushuaia';
                                  } elseif ($doc->__GET('lugarinsc') == 'TOL') {
                                      echo 'Tolhuin';
                                  } else {
                                      echo $doc->__GET('lugarinsc');
                                  }
                                              ?>" class="form-control docente-input-md" /></td>
                        </tr>
                         <tr>
                         <th>Fecha nacimiento</th>
                         <td><input type="date" name="fechanacim" value="<?php echo !empty($doc->__GET('fechanacim')) ? date('Y-m-d', strtotime($doc->__GET('fechanacim'))) : ''; ?>" class="form-control docente-input-sm" /></td>
                        </tr>
                         <tr>
                            <th>Teléfono</th>
                            <td><input type="text" name="telefonos" value="<?php echo $doc->__GET('telefonos'); ?>" class="form-control docente-input-md"/></td>
                        </tr>
                         <tr>
                            <th>Nacionalidad</th>
                            <td><input type="text" name="Nacionalidad" value="<?php echo $doc->__GET('Nacionalidad'); ?>" class="form-control docente-input-md" /></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><input type="email" name="email" value="<?php echo $doc->__GET('email'); ?>" class="form-control" /></td>
                        </tr>
                        <tr class="docente-sec-row">
                            <td colspan="2" class="docente-sec-title">Formación y calificación</td>
                        </tr>
                         <tr>
                            <th>Promedio</th>
                            <td>
                                <input type="number" name="promedioT" value="<?php echo number_format($doc->__GET('promedioT'), 2, '.', ''); ?>" step="0.01" class="form-control docente-input-sm" />
                            </td>
                        </tr>
                        <tr>
                            <th>Título básico</th>
                            <td><input type="text" name="Titulobas" value="<?php echo $doc->__GET('Titulobas') ?>" class="form-control" /></td>
                        </tr>
                        <tr>
                            <th>Fecha título</th>
                            <td><input type="date" name="fechatit" value="<?php echo !empty($doc->__GET('fechatit')) ? date('Y-m-d', strtotime($doc->__GET('fechatit'))) : ''; ?>" class="form-control docente-input-sm" /></td>
                          </tr>
                        <tr>
                            <th>Otorgado por</th>
                            <td><input type="text" name="otorgadopor" value="<?php echo $doc->__GET('otorgadopor'); ?>" class="form-control" /></td>
                        </tr>
                        <tr>
                            <th>Otros títulos</th>
                            <td><input type="text" name="otrostit" value="<?php echo $doc->__GET('otrostit'); ?>" class="form-control" /></td>
                        </tr>
                        <tr class="docente-sec-row">
                            <td colspan="2" class="docente-sec-title">Antecedentes laborales y legajo</td>
                        </tr>
                        <tr>
                                  <th>Fecha inicio docencia</th>
                                  <td><input type="date" name="finicio" value="<?php echo !empty($doc->__GET('finicio')) ? date('Y-m-d', strtotime($doc->__GET('finicio'))) : ''; ?>" class="form-control docente-input-sm" /></td>
                        </tr>
                         <tr>
                            <th>Fecha ingreso</th>
                            <td><input type="date" name="fingreso" value="<?php echo !empty($doc->__GET('fingreso')) ? date('Y-m-d', strtotime($doc->__GET('fingreso'))) : ''; ?>" class="form-control docente-input-sm" /></td>
                          </tr>
                         <tr>
                            <th>Cargo docente</th>
                            <td><input type="text" name="cargosdocentes" value="<?php echo $doc->__GET('cargosdocentes'); ?>" class="form-control" /></td>
                        </tr>
                         <tr>
                            <th>Fecha apertura legajo</th>
                            <td><input type="date" name="faperturaleg" value="<?php echo !empty($doc->__GET('faperturaleg')) ? date('Y-m-d', strtotime($doc->__GET('faperturaleg'))) : ''; ?>" class="form-control docente-input-sm" /></td>
                          </tr>
                        <tr class="docente-sec-row">
                            <td colspan="2" class="docente-sec-title">Observaciones</td>
                        </tr>
                         <tr>
                            <th>Observaciones</th>
                            <td>
                              <textarea name="obsdoc" rows="5" class="form-control"><?php echo $doc->__GET('obsdoc'); ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                             <div class="docente-form-actions cfg-actions">
                                <button type="submit" class="btn btn-primary" onclick="return myConfirm();" title="Cagar Docente"><i class="glyphicon glyphicon-floppy-saved"></i> Cargar</button>
                                <button type="button" class="btn btn-danger" name="vaciar" id="vaciar" value="VACIAR" title="Limapiar Datos"><i class="glyphicon glyphicon-erase"></i> Limpiar</button>
                                <a href="VerInscripciones.php?legajo=<?php echo $doc->__GET('legajo'); ?>" class="btn btn-success" title="Ver Inscripcion Docente"><span class="glyphicon glyphicon-list-alt"></span> Ver inscripciones</a>
                             </div>
                             <div class="docente-legajo-resumen"><strong>Número de legajo:</strong> <?php echo $doc->__GET('legajo'); ?></div>
                            </td>
                        </tr>
                    </table>
                </form>
</div>
</div><!-- .docente-datos-panel -->

<script>
    function myConfirm() {
    var form = document.getElementById('formulario_transaccion');
    var legajo = form.querySelector('input[name="legajo"]').value.trim();
    var apellidoynombre = form.querySelector('input[name="apellidoynombre"]').value.trim();
    var dni = form.querySelector('input[name="dni"]').value.trim();

    if (!legajo || !apellidoynombre || !dni) {
        juntaAlert('Debe completar todos los campos obligatorios.', 'warning');
        return false;
    }

    Swal.fire({
      title: '¿Desea cargar los datos?',
      text: 'Se guardarán los datos del docente.',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sí, cargar',
      cancelButtonText: 'Cancelar',
      confirmButtonColor: '#2698f3',
      cancelButtonColor: '#6c757d',
      reverseButtons: true
    }).then(function(result) {
      if (result.isConfirmed) {
        form._juntaConfirmed = true;
        form.submit();
      }
    });
    return false;
}
</script>

<script language="Javascript">
    function imprSelec(nombre) {
      var ficha = document.getElementById(nombre);
      var ventimp = window.open(' ', 'popimpr');
      ventimp.document.write( ficha.innerHTML );
      ventimp.document.close();
      ventimp.print( );
      ventimp.close();
    }
</script>

<script>
  $("#vaciar").on("click", function(event) {
    event.preventDefault();
    $("#formulario_transaccion")
      .find("input[type=text], input[type=number],input[type=email], input[type=date],textarea")
      .val("");
  });
</script>

<?php $JUNTA_PIE_SESION_DIRECT = true; ?>
<?php include('footer2.php');?>