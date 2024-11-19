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


/* Fondo predeterminado para el botón Ver y otros botones */
.btn-custom {
    background-color: #17a2b8; /* Color predeterminado del botón Ver */
    border-color: #17a2b8;
    color: white;
}

/* Cambiar a color negro al pasar el cursor sobre los botones */
.btn-custom:hover, .btn-success:hover, .btn-danger:hover, .btn-primary:hover {
    background-color: #000000 !important;
    border-color: #000000 !important;
    color: #ffffff !important;
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
                            <td><input type="number" name="legajo" value="<?php echo $doc->__GET('legajo'); ?>" class="form-control" required /></td>
                        </tr>

                         <tr>
                            <th style="text-align:left;">Apellido y Nombre</th>
                            <td><input type="text" name="apellidoynombre" value="<?php echo $doc->__GET('apellidoynombre'); ?>" class="form-control" required /></td>
                        </tr>


                        <tr>
                            <th style="text-align:left;">dni</th>
                            <td><input type="number" name="dni" value="<?php echo $doc->__GET('dni'); ?>" class="form-control" required/></td>
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
                            <th style="text-align:left;">Email</th>
                            <td><input type="email" name="email" value="<?php echo $doc->__GET('email'); ?>" class="form-control" /></td>
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
                             <center><button type="submit" class="btn btn-primary" onclick="return myConfirm();" title="Cagar Docente"><i class="glyphicon glyphicon-floppy-saved"> Cargar</i></button>&nbsp;&nbsp;
                            
                                <button class="btn btn-danger" name="vaciar" id="vaciar" value="VACIAR" title="Limapiar Datos"><i class="glyphicon glyphicon-erase"> Limpiar</i></button>
                            
                            <center><b>Numero de Legajo:</b><?php echo $doc->__GET('legajo');// aca te faltaba poner los echo para que se muestre el valor de la variable.  ?></center>
                            <a href="VerInscripciones.php?legajo=<?php echo $doc->__GET('legajo'); ?>" class="btn btn-success btn-sm" title="Ver Inscripcion Docente"><span class="glyphicon glyphicon-edit" ></span>  Ver Inscripciones</a>

                        
                            </td>
                        
                        </tr>

                          
 

                    </table>
                </form>






                <form method="GET" action="generate_pdf.php">
    <input type="hidden" name="legajo" value="<?php echo $doc->__GET('legajo'); ?>" />
    <input type="hidden" name="apellidoynombre" value="<?php echo $doc->__GET('apellidoynombre'); ?>" />
    <input type="hidden" name="dni" value="<?php echo $doc->__GET('dni'); ?>" />
    <input type="hidden" name="domicilio" value="<?php echo $doc->__GET('domicilio'); ?>" />
    <input type="hidden" name="lugarinsc" value="<?php echo $doc->__GET('lugarinsc'); ?>" />
    <input type="hidden" name="fechanacim" value="<?php echo $doc->__GET('fechanacim'); ?>" />
    <input type="hidden" name="promedioT" value="<?php echo number_format($doc->__GET('promedioT'), 2, '.', ''); ?>" />
    <input type="hidden" name="telefonos" value="<?php echo $doc->__GET('telefonos'); ?>" />
    <input type="hidden" name="Titulobas" value="<?php echo $doc->__GET('Titulobas'); ?>" />
    <input type="hidden" name="fechatit" value="<?php echo !empty($doc->__GET('fechatit')) ? date('Y-m-d', strtotime($doc->__GET('fechatit'))) : ''; ?>" />
    <input type="hidden" name="otorgadopor" value="<?php echo $doc->__GET('otorgadopor'); ?>" />
    <input type="hidden" name="finicio" value="<?php echo !empty($doc->__GET('finicio')) ? date('Y-m-d', strtotime($doc->__GET('finicio'))) : ''; ?>" />
    <input type="hidden" name="otrostit" value="<?php echo $doc->__GET('otrostit'); ?>" />
    <input type="hidden" name="fingreso" value="<?php echo !empty($doc->__GET('fingreso')) ? date('Y-m-d', strtotime($doc->__GET('fingreso'))) : ''; ?>" />
    <input type="hidden" name="cargosdocentes" value="<?php echo $doc->__GET('cargosdocentes'); ?>" />
    <input type="hidden" name="faperturaleg" value="<?php echo !empty($doc->__GET('faperturaleg')) ? date('Y-m-d', strtotime($doc->__GET('faperturaleg'))) : ''; ?>" />
    <input type="hidden" name="Nacionalidad" value="<?php echo $doc->__GET('Nacionalidad'); ?>" />
    <input type="hidden" name="email" value="<?php echo $doc->__GET('email'); ?>" />
    <input type="hidden" name="obsdoc" value="<?php echo $doc->__GET('obsdoc'); ?>" />

    <!-- Resto del formulario aquí -->
    <a href="generate_pdf.php?legajo=<?php echo urlencode($doc->__GET('legajo')); ?>&apellidoynombre=<?php echo urlencode($doc->__GET('apellidoynombre')); ?>&dni=<?php echo urlencode($doc->__GET('dni')); ?>&domicilio=<?php echo urlencode($doc->__GET('domicilio')); ?>&lugarinsc=<?php echo urlencode($doc->__GET('lugarinsc')); ?>&fechanacim=<?php echo urlencode($doc->__GET('fechanacim')); ?>&promedioT=<?php echo urlencode($doc->__GET('promedioT')); ?>&telefonos=<?php echo urlencode($doc->__GET('telefonos')); ?>&Titulobas=<?php echo urlencode($doc->__GET('Titulobas')); ?>&fechatit=<?php echo urlencode($doc->__GET('fechatit')); ?>&otorgadopor=<?php echo urlencode($doc->__GET('otorgadopor')); ?>&finicio=<?php echo urlencode($doc->__GET('finicio')); ?>&otrostit=<?php echo urlencode($doc->__GET('otrostit')); ?>&fingreso=<?php echo urlencode($doc->__GET('fingreso')); ?>&cargosdocentes=<?php echo urlencode($doc->__GET('cargosdocentes')); ?>&faperturaleg=<?php echo urlencode($doc->__GET('faperturaleg')); ?>&Nacionalidad=<?php echo urlencode($doc->__GET('Nacionalidad')); ?>&email=<?php echo urlencode($doc->__GET('email')); ?>&obsdoc=<?php echo urlencode($doc->__GET('obsdoc')); ?>" class="btn btn-info" title="Descargar PDF">
    <i class="glyphicon glyphicon-save"> Información Docente PDF</i> 
</a>
</form>
<script language="Javascript">
    function myConfirm() {
    // Obtener todos los campos obligatorios
    const legajo = document.querySelector('input[name="legajo"]').value.trim();
    const apellidoynombre = document.querySelector('input[name="apellidoynombre"]').value.trim();
    const dni = document.querySelector('input[name="dni"]').value.trim();

    // Verificar si algún campo está vacío
    if (!legajo || !apellidoynombre || !dni) {
        alert("Debe completar todos los campos obligatorios.");
        return false; // Evita el envío del formulario
    }

    // Si todo está completo, muestra el mensaje de éxito
    alert("Carga realizada con éxito!!!!!");
    return true; // Permite el envío del formulario
}
    </script>
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
       <div>
         <a href="RegistroDocente.php" class="btn btn-primary" title="Ingrese Nuevo Docente">
                          <span class="glyphicon glyphicon-plus"></span> Nuevo Docente
                      </a>
              </div>              
<div class="container-fluid">
<div class="input-group">
<div class="container mt-4">
    <h2><u>Buscador de Datos</u></h2>
    <form method="GET" action="">
        <div class="form-row">
        <div class="form-group col-md-4">
                <label for="legajo">Legajo</label>
                <input type="number" 
                   class="form-control" 
                   id="legajo" 
                   name="legajo" 
                   placeholder="Ingrese Legajo" 
                   onpaste="return false;">
        </div>
            </div>
            <div class="form-group col-md-4">
                <label for="dni">DNI</label>
             
                  <input type="number" 
                   class="form-control" 
                   id="dni" 
                   name="dni" 
                   placeholder="Ingrese DNI" 
                   onpaste="return false;">

            </div>
            <div class="form-group col-md-4">
                <label for="apellido">Apellido y Nombre</label>
                <input type="text" class="form-control" id="apellido" name="ApellidoyNombre" 
           placeholder="Ingrese Apellido y Nombre"
           oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s'-]/g, '')"
           title="Solo se permiten letras, espacios, apóstrofes y guiones.">
            </div>
        </div>
      <center>
                  <div class="container mt-4">
                  <div class="header-buttons">
                      <form method="GET" action="" class="form-inline">
                          <div class="form-group">
                              <button type="submit" class="btn btn-warning" title="Buscar Docente">
                                  <i class="glyphicon glyphicon-search"></i>  Buscar
                              </button>
                               
                          </div>
                      </form>
                     
                  </div>
              </form>
</div></center>

 <!--<a href="../../controller/exportar_docentes.php" class="btn btn-info btn-sm" onclick="return myConfirm3();" >
          <span class="glyphicon glyphicon-download-alt"></span> Descargar
        </a>
</div>-->


    <script>
      $(document).ready(function(){
  $("#example").DataTable({
    // "sPaginationType": "bootstrap",
  });
});
    </script>

<script>
    document.getElementById('legajo').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^0-9]/g, ''); // Elimina todo excepto números
    });

    document.getElementById('dni').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^0-9]/g, ''); // Elimina todo excepto números
    });
</script>

<script>
    // Función para limpiar la tabla
    function clearResults() {
        document.getElementById("resultBody").innerHTML = '';  // Limpia el contenido de la tabla
    }
</script>

<!--
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
-->
<tbody>
<?php
// Incluye la conexión a la base de datos aquí
$serverName = "10.1.9.113";
$connectionOptions = array(
    "Database" => "Junta",
    "Uid" => "SA",
    "PWD" => "Davinci2024#",
    "TrustServerCertificate" => true,
    "CharacterSet" => "UTF-8" // Para caracteres especiales
);

// Conexión con SQL Server
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

$legajo = isset($_GET['legajo']) ? $_GET['legajo'] : '';
$dni = isset($_GET['dni']) ? $_GET['dni'] : '';
$ApellidoyNombre = isset($_GET['ApellidoyNombre']) ? $_GET['ApellidoyNombre'] : '';

// Solo ejecutar la consulta si alguno de los campos tiene un valor
if ($legajo != '' || $dni != '' || $ApellidoyNombre != '') {
    $params = [];
    // Incluir id2 en la selección
    $sql = "SELECT id2, Legajo, dni, ApellidoyNombre,lugarinsc FROM _junta_docentes WHERE 1=1";

    if ($legajo != '') {
        $sql .= " AND Legajo = ?";
        $params[] = $legajo;
    }
    if ($dni != '') {
        $sql .= " AND dni = ?";
        $params[] = $dni;
    }
    if ($ApellidoyNombre != '') {
        $sql .= " AND ApellidoyNombre LIKE ?";
        $params[] = "%$ApellidoyNombre%";
    }

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
?>
<div class="container mt-4">
    <h2>Resultados de la Búsqueda</h2>
    <table id="resultTable" class="display table table-bordered">
        <thead>
            <tr>
                <th><center style="font-size:1em">Legajo</center></th>
                <th><center style="font-size:1em">DNI</center></th>
                <th><center style="font-size:1em">Apellido y Nombre</center></th>
                <th><center style="font-size:1em">Localidad de Inscripcion</center></th>
                <th><center style="font-size:1em">Acciones</center></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)): ?>
                <tr>
                    <td><center style="font-size:1em"><?= htmlspecialchars($row['Legajo']) ?></center></td>
                    <td><center style="font-size:1em"><?= htmlspecialchars($row['dni']) ?></center></td>
                    <td><center style="font-size:1em"><?= htmlspecialchars($row['ApellidoyNombre']) ?></center></td>
                    <td>
                        <center style="font-size:1em">
                            <?php 
                            if (is_null($row['lugarinsc']) || trim($row['lugarinsc']) === '') {
                                echo "<span style='color: red;'>Localidad de Inscripción no disponible</span>";
                            } else {
                                echo htmlspecialchars($row['lugarinsc']);
                            }
                            ?>
                        </center>
                    </td>
                    
                    <td>
                        <center>
                       
                                <a class="btn btn-sm btn-success" href="?action=editar&id2=<?= htmlspecialchars($row['id2']) ?>" title="Editar legajos">
                                    <i class="glyphicon glyphicon-edit"></i> Editar
                                </a>
                                <a class="btn btn-sm btn-danger" href="?action=eliminar&id2=<?= htmlspecialchars($row['id2']) ?>" title="Borrar legajo" onclick="return myConfirm4();">
                                    <i class="glyphicon glyphicon-trash"></i> Borrar
                                </a>
                                <a href="VerInscripciones.php?legajo=<?= htmlspecialchars($row['Legajo']) ?>" title="Ver Inscripcion legajos" class="btn btn-custom btn-sm">
                                    <span class="glyphicon glyphicon-eye-open"></span> Ver 
                                </a>
                                <a href="RegistroMovimiento.php?legajo=<?= htmlspecialchars($row['Legajo']) ?>" title="Agregar Inscripcion" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-plus"></span> Agregar 
                                </a>


                        </center>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php
}
?>

<!-- Include jQuery, DataTables, and other necessary scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#resultTable').DataTable();
    });

    function myConfirm4() {
        return confirm("¿Desea borrar al docente?");
    }


  $("#limpiar").click(function(event) {
    $("#formulario_transaccion")[0].reset();
  });

  $("#vaciar").on("click", function(event) {
    event.preventDefault();
    $("#formulario_transaccion")
      .find("input[type=text], input[type=number],input[type=email], input[type=date],textarea")
      .val("");
  });
</script>
<script>
    // Función para limpiar la tabla
    function clearResults() {
        document.getElementById("resultBody").innerHTML = '';  // Limpia el contenido de la tabla
    }
</script>
<?php include('footer2.php');?>
