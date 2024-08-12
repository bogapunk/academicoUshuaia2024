<?php 
require_once 'dependencias.entidad.php';
require_once 'dependencias.model.php';
include('header2.php');


// Logica
$dep = new Dependencia();
$model = new DependenciasModel();

if(isset($_REQUEST['action']))
{
  switch($_REQUEST['action'])
  {
    case 'actualizar':
     $dep->__SET('iddep',              $_REQUEST['iddep']);
     $dep->__SET('codniv',          $_REQUEST['codniv']);
      $dep->__SET('nomdep',          $_REQUEST['nomdep']);
      $dep->__SET('coddep',          $_REQUEST['coddep']);
      $dep->__SET('domicilio',        $_REQUEST['domicilio']);
      $dep->__SET('interno',        $_REQUEST['interno']);
      $dep->__SET('codloc',            $_REQUEST['codloc']);
      $dep->__SET('directo',           $_REQUEST['directo']);
      
      
         

      $model->ActualizarDependencia($dep);
     // header('Location: index.php');
      break;

    case 'registrar':
          $dep->__SET('iddep',         $_REQUEST['iddep']);
          $dep->__SET('codniv',          $_REQUEST['codniv']);
          $dep->__SET('nomdep',        $_REQUEST['nomdep']);
          $dep->__SET('coddep',        $_REQUEST['coddep']);
          $dep->__SET('domicilio',     $_REQUEST['domicilio']);
          $dep->__SET('codloc',        $_REQUEST['codloc']);
          $dep->__SET('directo',       $_REQUEST['directo']);
          $dep->__SET('interno',       $_REQUEST['interno']);
          
          

      $model->RegistrarDependencia($dep);
      //header('Location:ListarModalidades.php');
      break;

    case 'eliminar':
      $model->EliminarDependencia($_REQUEST['id']);
      //header('Location:ListarModalidades.php');
      break;

    case 'editar':
      $dep = $model->ObtenerDependencia($_REQUEST['id']);
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




</style>
<link rel="icon" type="./image/png" href="./imagenes/escudo-32x32.png">
<!DOCTYPE html>
<html lang="es">
<head>
   <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Ministerio de Educacion</title>

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
  <div class="container"> <center><h1><u><font face="
    font-family: 'Roboto', sans-serif;" COLOR="black">Dependencias</font></u></h1></center>
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
$link = new PDO('mysql:host=db;dbname=junta', 'root', ''); // el campo vaciío es para la password.
*/

define('DB_HOST', '192.168.18.207,1433');
define('DB_USER', 'SA');
define('DB_PASS', '"asd123"');
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
<center>
 <form action="?action=<?php echo $dep->iddep > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" id="formulario_transaccion"  >
                    <input type="hidden" name="iddep" value="<?php echo $dep->__GET('iddep'); ?>" />
                    
                    <table style="width:750px;" id="seleccion">
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="nomdep" value="<?php echo $dep->__GET('nomdep'); ?>"class="form-control"/></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Codigo</th>
                            <td><input type="number" name="coddep" value="<?php echo number_format($dep->__GET('coddep'), 0, '', ''); ?>" class="form-control" /></td>
                        </tr>
                         <tr>
                            <th style="text-align:left;">Domicilio</th>
                            <td><input type="text" name="domicilio" value="<?php echo $dep->__GET('domicilio'); ?>" class="form-control" /></td>
                        </tr>

                         <tr>
                            <th style="text-align:left;">Ciudad</th>
                            <td><input type="text" name="codloc" value="<?php echo $dep->__GET('codloc'); ?>" class="form-control" /></td>
                        </tr>

                         <tr>
                            <th style="text-align:left;">Directo</th>
                            <td><input type="text" name="directo" value="<?php echo $dep->__GET('directo'); ?>" class="form-control" /></td>
                        </tr>
                         <tr>
                            <th style="text-align:left;">Interno</th>
                            <td><input type="text" name="interno" value="<?php echo $dep->__GET('interno'); ?>" class="form-control" /></td>
                        </tr>
                        <tr>
    <th style="text-align:left;">Estado</th>
    <td>
        <select name="codniv" class="form-control">
            <option value="0" <?php echo $dep->__GET('codniv') == 0 ? 'selected' : ''; ?>>Activo</option>
            <option value="1" <?php echo $dep->__GET('codniv') == 1 ? 'selected' : ''; ?>>Inactivo</option>
        </select>
    </td>
</tr>
                     
                    


                        <tr>

                            <td colspan="2">
<br>
                             <center>  <button type="submit" class="btn btn-success" onclick="return myConfirm();">Cargar</button>&nbsp&nbsp&nbsp&nbsp
                                

                                <button class="btn btn-danger" name="vaciar" id="vaciar" value="VACIAR">Limpiar Formulario</button>
                              &nbsp&nbsp&nbsp&nbsp
                              <button class="btn btn-info">
                                <a href="javascript:imprSelec('seleccion')" style="color: white;" >Imprimir Dependencia</a></button>

                            </td>


                        </tr>
                    </table>
                </form>
              </center>

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


<div class="container-fluid">
<div class="input-group">
  <b>Buscar:&nbsp</b> <div class="form-group pull-right">
    <input type="text" class="search form-control" placeholder="¿Buscar Dependencia?">
</div>
</div>
<a href="RegistroDependencia.php" class="btn btn-primary" > <span class="glyphicon glyphicon-plus"></span> Nueva Dependencia</a>&nbsp&nbsp
 <a href="../../controller/exportar_dependencias.php" class="btn btn-info btn-sm" onclick="return myConfirm3();" >
          <span class="glyphicon glyphicon-download-alt"></span>  Descargar
        </a>
</div>


    <script>
      $(document).ready(function(){
  $("#example").DataTable({
    // "sPaginationType": "bootstrap",
  });
});
    </script>
<div class="container-fluid">
<table class="table table-hover table-bordered results" id="example">

    <thead class="thead-dark" >
        <thead class="buscar">
        <tr>
            
            <th><center style="font-size:1.3em"; onclick="sortTable(3)" >CODIGO DE DEPENDENCIA</center></th>
            <th><center style="font-size:2.0em";>DEPENDENCIA</center></th>
            <th><center style="font-size:2.0em";  onclick="sortTable(4)">DOMICILIO</center></th>
            <th><center style="font-size:2.0em";>CIUDAD</center></th>
            <th><center style="font-size:2.3em";>ACCIONES</center></th>
        </tr>

    </thead>
  </thead>

<tbody>
 
 <?php foreach($model->Listar3() as $r): ?>
                        <tr>
                        <td><center style="font-size:1.3em"><?php echo number_format($r->__GET('coddep'), 0, '', ''); ?></center></td>
                            <td><center style="font-size:1.3em"><?php echo $r->__GET('nomdep'); ?></center></td>
                            <td><center style="font-size:1.3em"><?php echo $r->__GET('domicilio'); ?></center></td>
                            <td><center style="font-size:1.3em"><?php echo $r->__GET('codloc'); ?></center></td>
                            <td>
                          
                             <center>
                                  <a class="btn btn-sm btn-success" id="dependencias"  href="?action=editar&id=<?php echo $r->iddep; ?>" title="Editar"  data-id="<?php echo $iddep; ?>"><i class="glyphicon glyphicon-edit"></i> Editar</a>

                                <a class="btn btn-sm btn-danger" id="dependenciassBorrado"  href="?action=eliminar&id=<?php echo $r->iddep; ?>" title="Borrar" onclick="return myConfirm4();"><i class="glyphicon glyphicon-trash" ></i> Borrar</a>

                                 </center>
                            </td>
                        </tr>
                    <?php endforeach; ?>

</tbody>
</div>
</div>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

  // borrar datos de la dependencia
 function myConfirm() {
  var result = confirm("¿Desea Actulizar la dependecia?");
  if (result==true) {
   return true;

  } else {
   return false;
  }
}

//funcion de guardar datos
function myConfirm2() {
  var result = confirm("¿Desea Guardar Modificacion Dependencia?");
  if (result==true) {
   return true;

  } else {
   return false;
  }
}
//funcion descargar excel 
function myConfirm3() {
  var result = confirm("¿Desea descargar a excel las dependencia?");
  if (result==true) {
   return true;

  } else {
   return false;
  }
}
//funcion eliminar dependencia 
function myConfirm4() {
  var result = confirm("¿Desea borrar la  dependencia?");
  if (result==true) {
   return true;

  } else {
   return false;
  }
}





  //*/
</script>
<ul class="pager">
  <li class="previous disabled"><a href="#">&larr; Anterior</a></li>
  <li class="next"><a href="#">Siguiente &rarr;</a></li>
</ul>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../Assets/swal2/sweetalert2.min.js"></script>
   <script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

$(document).ready(function() {
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
      });
});




</script>
</body>
</html>
<!-- < ?php include('AgregarModal.php'); ?>-->
<script src="../js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<?php include('footer2.php');?>

<!--modal de Modalidades->
