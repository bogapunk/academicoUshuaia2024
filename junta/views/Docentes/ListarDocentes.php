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
    font-family: 'Open Sans', 'Sans-serif' COLOR="black">Datos Docentes</font></u></h1></center>
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
<script type="text/javascript">
  
</script>

<center>
 <form action="?action=<?php echo $doc->id2 > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" id="formulario_transaccion">
               
                    <input type="hidden" name="id2" value="<?php echo $doc->__GET('id2'); ?>" />


                    <table style="width:100%" id="seleccion">
               
                        <tr>
                            <th style="text-align:left;font-size:1.2em;">Legajo</th>
                            <td><input type="number" name="legajo" value="<?php echo $doc->__GET('legajo'); ?>" class="form-control" /></td>
                        </tr>

                         <tr>
                            <th style="text-align:left;">Apellido y Nombre</th>
                            <td><input type="text" name="apellidoynombre" value="<?php echo $doc->__GET('apellidoynombre'); ?>" class="form-control"/></td>
                        </tr>


                        <tr>
                            <th style="text-align:left;">dni</th>
                            <td><input type="number" name="dni" value="<?php echo $doc->__GET('dni'); ?>" class="form-control"/></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">domicilio</th>
                            <td><input type="text" name="domicilio" value="<?php echo $doc->__GET('domicilio'); ?>" class="form-control" /></td>
                        </tr>
                         <tr>
                            <th style="text-align:left;">Lugar Inscripcion</th>
                           
                            <td><input type="text" name="lugarinsc" value="<?php
                                  if ($doc->__GET('lugarinsc') == 'RG' or $doc->__GET('lugarinsc') == 'RGD') {
                                      echo 'Rio Grande';
                                  } elseif ($doc->__GET('lugarinsc') == 'USH') {
                                      echo 'Ushuaia';
                                  } elseif ($doc->__GET('lugarinsc') == 'TOL') {
                                      echo 'Tolhuin';
                                  } else {
                                      echo $doc->__GET('lugarinsc'); // Display original value if not matched
                                                  }
                                              ?>"class="form-control" /></td>
                        </tr>

                         <tr>
                         <th style="text-align:left;">Fecha Nacimiento</th>
                         <td> <input type="date" name="fechanacim" value="<?php echo !empty($doc->__GET('fechanacim')) ? date('Y-m-d', strtotime($doc->__GET('fechanacim'))) : ''; ?>" class="form-control" /></td>

                        </tr>

                         <tr>
                            <th style="text-align:left;">Promedio</th>
                            <td>
                                <input type="number" name="promedioT" value="<?php echo number_format($doc->__GET('promedioT'), 2, '.', ''); ?>" step="0.01" class="form-control" />
                            </td>
                        </tr>
                         <tr>
                            <th style="text-align:left;">telefono</th>
                            <td><input type="text" name="telefonos" value="<?php echo $doc->__GET('telefonos'); ?>" class="form-control"/></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Titulo Basico</th>
                            <td><input type="text" name="Titulobas" value="<?php echo $doc->__GET('Titulobas') ?>" class="form-control" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Fecha Titulo</th>
                            
                            <td><input type="date" name="fechatit" value="<?php echo !empty($doc->__GET('fechatit')) ? date('Y-m-d', strtotime($doc->__GET('fechatit'))) : ''; ?>" class="form-control" /></td>         
                          </tr>
                        <tr>
                            <th style="text-align:left;">Otorgando Por</th>
                            <td><input type="text" name="otorgadopor" value="<?php echo $doc->__GET('otorgadopor'); ?>" class="form-control" /></td>
                        </tr>
                        <tr>
                           <tr>
                                  <th style="text-align: left;">Fecha Inicio Docencia</th>
                                
                                  <td><input type="date" name="finicio" value="<?php echo !empty($doc->__GET('finicio')) ? date('Y-m-d', strtotime($doc->__GET('finicio'))) : ''; ?>" class="form-control" /></td>

                                </tr>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Otros Titulos</th>
                            <td><input type="text" name="otrostit" value="<?php echo $doc->__GET('otrostit'); ?>" class="form-control" /></td>
                        </tr>
                     
                         <tr>
                            <th style="text-align:left;">Fecha ingreso</th>
                            <td><input type="date" name="fingreso" value="<?php echo !empty($doc->__GET('fingreso')) ? date('Y-m-d', strtotime($doc->__GET('fingreso'))) : ''; ?>" class="form-control" /></td>

                          </tr>

                         <tr>
                            <th style="text-align:left;">Cargo Docente</th>
                            <td><input type="text" name="cargosdocentes" value="<?php echo $doc->__GET('cargosdocentes'); ?>" class="form-control" /></td>
                        </tr>

                         <tr>
                            <th style="text-align:left;">fecha Apertura Legajo</th>
                            <td><input type="date" name="faperturaleg" value="<?php echo !empty($doc->__GET('faperturaleg')) ? date('Y-m-d', strtotime($doc->__GET('faperturaleg'))) : ''; ?>" class="form-control" /></td>

                          </tr>


                         <tr>
                            <th style="text-align:left;">Nacionalidad</th>
                            <td><input type="text" name="Nacionalidad" value="<?php echo $doc->__GET('Nacionalidad'); ?>" class="form-control" /></td>
                        </tr>


                         <tr>
                            <th style="text-align:left;">Observaciones</th>
              
                            <td>
                              <textarea name="obsdoc" rows="5" class="form-control"><?php echo $doc->__GET('obsdoc'); ?></textarea>
                            </td>
                        </tr>
                        </tr>




                        <tr>

                            <td colspan="2">
<br>
                             <center>  <button type="submit" class="btn btn-success" onclick="return myConfirm();">Cargar</button>&nbsp&nbsp&nbsp&nbsp
                              
                                <button class="btn btn-danger" name="vaciar" id="vaciar" value="VACIAR">Limpiar Formulario</button>
                              &nbsp&nbsp&nbsp&nbsp
                              <button class="btn btn-info">
                                <a href="javascript:imprSelec('seleccion')" style="color: white;" >Imprimir Docente</a></button>


                            <center><?php echo $doc->__GET('legajo');// aca te faltaba poner los echo para que se muestre el valor de la variable.  ?></center>
                            <a href="VerInscripciones.php?legajo=<?php echo $doc->__GET('legajo'); ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span> Ver Inscripciones</a>

                        
                            </td>
                        
                        </tr>

                          
 

                    </table>
                </form>

              </center>

              <!--Script para la impresion de docente -->
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
    <input type="text" class="search form-control" placeholder="¿Buscar Docente?">
</div>
</div>
<a href="RegistroDocente.php" class="btn btn-primary" > <span class="glyphicon glyphicon-plus"></span> Nuevo Docente</a>&nbsp&nbsp
 <a href="../../controller/exportar_docentes.php" class="btn btn-info btn-sm" onclick="return myConfirm3();" >
          <span class="glyphicon glyphicon-download-alt"></span> Descargar
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
            
            <th><center style="font-size:1em"; onclick="sortTable(3)" >LEGAJO</center></th>
            <th><center style="font-size:1em";>APELLIDO Y NOMBRE </center></th>
            <th><center style="font-size:1em"; onclick="sortTable(4)">FECHA DE NAC.</center></th>
            <th><center style="font-size:1em";>TELEFONO</center></th>
            <th><center style="font-size:1em";>LOCALIDAD </center></th>
            <th><center style="font-size:1em";>DNI</center></th>
            <th style="text-align: center; padding: 10px 140px;">ACCIONES</th>
        </tr>

    </thead>
  </thead>

<tbody>
<?php
// Parámetros de paginación
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 1000; // Cantidad de registros por página
$offset = ($page - 1) * $limit; // Cálculo del desplazamiento

// Llamada a la función Listar_docentes con los parámetros de paginación
$docentes = $model->Listar_docentes($offset, $limit);

foreach ($docentes as $r) {
    if ($r instanceof Docente) {
        ?>
        <tr>
            <td><center style="font-size:1em"><?php echo $r->legajo; ?></center></td>
            <td><center style="font-size:1em"><?php echo $r->apellidoynombre; ?></center></td>
            <td><center style="font-size:1em"><?php echo $r->fechanacim; ?></center></td>
            <td><center style="font-size:1em"><?php echo $r->telefonos; ?></center></td>
            <td><center style="font-size:1em"><?php echo $r->lugarinsc; ?></center></td>
            <td><center style="font-size:1em"><?php echo $r->dni; ?></center></td>
            <td>
                <center>
                    <a class="btn btn-sm btn-success" id="Docentes" href="?action=editar&id2=<?php echo $r->id2; ?>" title="Editar" data-id="<?php echo $r->id2; ?>"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    <a class="btn btn-sm btn-danger" id="docentes" href="?action=eliminar&id2=<?php echo $r->id2; ?>" title="Borrar" onclick="return myConfirm4();"><i class="glyphicon glyphicon-trash"></i> Borrar</a>
                </center>
            </td>
        </tr>
        <?php
    } else {
        // Manejo de casos donde $r no es un objeto Docente
        echo "<pre>";
        var_dump($r);
        echo "</pre>";
    }
}

?>

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
      .find("input[type=text], input[type=number], input[type=date],textarea")
      .val("");
  });

  // borrar datos de los docentes
 function myConfirm() {
  var result = confirm("¿Desea Actulizar el docente?");
  if (result==true) {
   return true;

  } else {
   return false;
  }
}

//funcion de guardar datos de docentes
function myConfirm2() {
  var result = confirm("¿Desea Guardar Modificacion Del Docente?");
  if (result==true) {
   return true;

  } else {
   return false;
  }
}
//funcion descargar excel  de decoentes
function myConfirm3() {
  var result = confirm("¿Desea descargar a excel de los docentes?");
  if (result==true) {
   return true;

  } else {
   return false;
  }
}
//funcion eliminar docnetes
function myConfirm4() {
  var result = confirm("¿Desea borrar al docente?");
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

</script>
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

<?php
// Enlaces de paginación
$total_records = 10000; // Supón que tienes una forma de obtener el número total de registros.
$total_pages = ceil($total_records / $limit);

echo '<nav>';
echo '<ul class="pagination">';
if ($page > 1) {
    echo '<li><a href="?page=' . ($page - 1) . '">&laquo; Anterior</a></li>';
}

for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
        echo '<li class="active"><a href="?page=' . $i . '">' . $i . '</a></li>';
    } else {
        echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
    }
}

if ($page < $total_pages) {
    echo '<li><a href="?page=' . ($page + 1) . '">Siguiente &raquo;</a></li>';
}
echo '</ul>';

echo '</nav>';
?>





</body>
</html>
<!-- < ?php include('AgregarModal.php'); ?>-->

<script src="../js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<?php include('footer2.php');?>




