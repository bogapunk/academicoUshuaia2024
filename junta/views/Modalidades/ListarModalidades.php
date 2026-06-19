<?php 
require_once 'modalidades.entidad.php';
require_once 'modalidades.model.php';
include('header2.php');

// Logica
$mod = new Modalidad();
$model = new ModalidadesModel();

if(isset($_REQUEST['action']))
{
  switch($_REQUEST['action'])
  {
    case 'actualizar':
      $mod->__SET('id',              $_REQUEST['id']);
      $mod->__SET('codmod',          $_REQUEST['codmod']);
      $mod->__SET('nommod',        $_REQUEST['nommod']);
      $mod->__SET('titulo',            $_REQUEST['titulo']);
      $mod->__SET('tope', $_REQUEST['tope']);
          

      $model->Actualizar($mod);
     // header('Location: index.php');
      break;

    case 'registrar':
          $mod->__SET('id',              $_REQUEST['id']);
            $mod->__SET('codmod',          $_REQUEST['codmod']);
            $mod->__SET('nommod',        $_REQUEST['nommod']);
            $mod->__SET('titulo',            $_REQUEST['titulo']);
            $mod->__SET('tope', $_REQUEST['tope']);
      
      $model->Registrar($mod);
      //header('Location:ListarModalidades.php');
      break;

    case 'eliminar':
      $model->Eliminar($_REQUEST['id']);
      //header('Location:ListarModalidades.php');
      break;

    case 'editar':
      $mod = $model->Obtener($_REQUEST['id']);
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
  bottom: 20px;
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






<?php readfile(__DIR__ . '/../css/junta-panel-polish.css'); ?>

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

      <!--aca esta las extensiones para el paginado de la las tablas --->
  
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">

  
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
<button class="btn-flotante" onclick="topFunction()" title='Subir'>Subir</button>
  <div class="page-content bg-light">
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
<div class="cfg-listados-polish">
  <div class="container">
    <h1 class="cfg-page-title">Modalidades</h1>
    <br>
    <br>
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
// Te recomiendo utilizar esta conección, la que utilizas ya no es la recomendada. 
/* conexion anterior
$link = new PDO('mysql:host=localhost;dbname=junta', 'root', ''); // el campo vaciío es para la password. 
*/
// Definir las credenciales de la base de datos
define('DB_HOST', '10.1.9.113');
define('DB_USER', 'SA');
define('DB_PASS', 'Davinci2024#');
define('DB_NAME', 'junta');

try {
    // Construir la cadena de conexión para SQL Server con TrustServerCertificate=true
    $dsn = "sqlsrv:Server=" . DB_HOST . ";Database=" . DB_NAME . ";TrustServerCertificate=true";
    $link = new PDO($dsn, DB_USER, DB_PASS);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
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
<script type="text/javascript">
  
</script>
<div class="cfg-card">
<center>
 <form action="?action=<?php echo $mod->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:0;" id="formulario_transaccion"  >
                    <input type="hidden" name="id" value="<?php echo $mod->__GET('id'); ?>" />
                    
                    <table class="cfg-form-table" style="max-width:760px;" id="seleccion">
                        <tr>
                            <th style="text-align:left;">Modalidad</th>
                            <td><input type="text" name="codmod" value="<?php echo $mod->__GET('codmod'); ?>"class="form-control" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Descripcion</th>
                            <td><input type="text" name="nommod" value="<?php echo $mod->__GET('nommod'); ?>" class="form-control" /></td>
                        </tr>
                      

                        <tr>
                            <th style="text-align:left;">Titulo</th>
                            <td>
                                <select name="titulo" class="form-control">
                                    <option value="DOCENTE" <?php echo $mod->__GET('titulo') == 1 ? 'selected' : ''; ?>>DOCENTE</option>
                                    <option value="HABILITANTE" <?php echo $mod->__GET('titulo') == 2 ? 'selected' : ''; ?>>HABILITANTE</option>
                                    <option value="SUPLETARIO" <?php echo $mod->__GET('titulo') == 3 ? 'selected' : ''; ?>>SUPLETARIO</option>
                                </select>
                            </td>
                        </tr>


                        <tr>
                            <th style="text-align:left;">Tope</th>
                            <td><input type="text" name="tope" value="<?php echo $mod->__GET('tope'); ?>" class="form-control" /></td>
                        </tr>

                        <tr>

                            <td colspan="2" class="cfg-actions-cell">
                             <div class="junta-btn-group">
                             <button type="submit" class="btn btn-success" id="btnGuardarMod"><i class="glyphicon glyphicon-floppy-saved"></i> Guardar</button>
                                <button type="button" class="btn btn-danger" name="vaciar" id="vaciar" value="VACIAR"><i class="glyphicon glyphicon-erase"></i> Limpiar Formulario</button>
                                <button type="button" class="btn btn-info" onclick="imprSelec('seleccion')"><i class="glyphicon glyphicon-print"></i> Imprimir Modalidad</button>
                             </div>
                            </td>


                        </tr>
                    </table>
                </form>
              </center>
              </div>

              <!--Script para la impresion de modalidad -->
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


<div class="container-fluid cfg-card">
<div class="cfg-toolbar">
  <div class="cfg-search-wrap">
    <b>Buscar:</b>
    <input type="text" class="search form-control" placeholder="¿Qué desea buscar?">
  </div>
  <div>
    <a href="RegistroModalidad.php" class="btn btn-primary" > <span class="glyphicon glyphicon-plus"></span> Nueva Modalidad</a>
    <a href="../../controller/exportar_modalidades.php" class="btn btn-info btn-sm" id="btnDescargarMod">
      <span class="glyphicon glyphicon-download-alt"></span>  Descargar
    </a>
  </div>
</div>


<div class="container-fluid cfg-card cfg-table-wrap">
<table class="table table-hover table-bordered results" id="example">
    <thead class="thead-dark">
        <tr>
            <th><center>MODALIDAD</center></th>
            <th><center>DESCRIPCION</center></th>
            <th><center>TITULO</center></th>
            <th><center>TOPE</center></th>
            <th><center>ACCIONES</center></th>
        </tr>
    </thead>
    <tbody>
 <?php foreach($model->Listar2() as $r): ?>
                        <tr>
                            <td><center><?php echo $r->__GET('codmod'); ?></center></td>
                            <td><center><?php echo $r->__GET('nommod'); ?></center></td>
                            <td><center><?php echo $r->__GET('titulo'); ?></center></td>
                            <td><center><?php echo $r->__GET('tope'); ?></center></td>
                            <td>
                              <center>
                              <div class="junta-acciones">
                              <a class="btn btn-sm btn-success" id="modalidades"  href="?action=editar&id=<?php echo $r->id; ?>" title="Editar" data-id="<?php echo $id; ?>"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                                 <a class="btn btn-sm btn-danger btn-eliminar-mod" href="?action=eliminar&id=<?php echo $r->id; ?>" title="Eliminar"><i class="glyphicon glyphicon-trash" ></i> Eliminar</a>
                              </div>
                               </center>
                            </td>
                        </tr>
                    <?php endforeach; ?>
    </tbody>
</table>
</div>

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>

<script>
  $("#limpiar").click(function(event) {
    $("#formulario_transaccion")[0].reset();
  });

  $("#vaciar").on("click", function(event) {
    event.preventDefault();
    $("#formulario_transaccion")
      .find("input[type=text], textarea")
      .val("");
  });

  document.getElementById('btnGuardarMod').addEventListener('click', function(e) {
    e.preventDefault();
    var form = document.getElementById('formulario_transaccion');
    juntaConfirm('¿Desea guardar la modalidad?', function() {
      form.submit();
    });
  });

  document.getElementById('btnDescargarMod').addEventListener('click', function(e) {
    e.preventDefault();
    var href = this.getAttribute('href');
    juntaConfirm('¿Desea descargar a Excel las modalidades?', function() {
      window.location.href = href;
    });
  });

  document.querySelectorAll('.btn-eliminar-mod').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      var href = this.getAttribute('href');
      juntaConfirmDanger('¿Desea eliminar la modalidad?', function() {
        window.location.href = href;
      });
    });
  });





  //*/
</script>

<script>
$(document).ready(function() {
  var modalidadesTable = $("#example").DataTable({
    dom: 'lrtip',
    pageLength: 25,
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
    language: {
      search: "Buscar:",
      lengthMenu: "Mostrar _MENU_ registros",
      info: "Mostrando _START_ a _END_ de _TOTAL_ modalidades",
      paginate: { first: "Primero", last: "Ultimo", next: "Siguiente", previous: "Anterior" },
      zeroRecords: "No se encontraron resultados",
      emptyTable: "No hay modalidades registradas"
    }
  });

  $(".search").on("keyup", function () {
    modalidadesTable.search(this.value).draw();
  });
});




</script>
</div><!-- .cfg-listados-polish -->
<?php include('footer2.php');?>

<!--modal de Modalidades->
