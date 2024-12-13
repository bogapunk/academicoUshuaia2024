<?php 


require_once '../Modalidades/modalidades.entidad.php';
require_once '../Modalidades/modalidades.model.php';


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
    border: none;
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
.select-container {
  display: flex;
  justify-content: center; /* Center the select element horizontally */
}

#modalidad_select {
  border-width: 1px; /* Adjust border width as desired */
  height: 25px;
  width: 530px;
}

#modalidad_select option {
  font-size: 1em; /* Adjust font size as desired */
}

   select#modalidad_select option {
    white-space: nowrap; /* Prevent wrapping of text */
    overflow: hidden; /* Hide overflowing text */
    text-overflow: ellipsis; /* Add ellipsis (...) for truncation */
    width: 300px; /* Adjust width as needed */
  }



.titulo, .subtitulo {
    text-align: left; /* Cambia 'center' por la alineación deseada */
  }

span {
  background-color: yellow; /* Set background color to yellow */
}
 



.materialize-input1 {
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 0px 0px; /* Adjust padding for a comfortable fit */
  font-size: 15px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 15%; /* Make the input element fill the container */
  cursor: pointer;
  /* Add the focus styling here */
  &:focus {
    border-color: #42a5f5; /* Change border color to blue on focus */
  }
}
.materialize-input2 {
  border: none; /* Remove default border */
  border-bottom:1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 0px 0px; /* Adjust padding for a comfortable fit */
  font-size: 15px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 25%; /* Make the input element fill the container */
  cursor: pointer;
  /* Add the focus styling here */
  &:focus {
    border-color: #42a5f5; /* Change border color to blue on focus */
  }
}

.materialize-input3 {
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 0px 0px; /* Adjust padding for a comfortable fit */
  font-size: 15px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 50%; /* Make the input element fill the container */
  cursor: pointer;
&:focus {
    border-color: #42a5f5; /* Change border color to blue on focus */
  }

}
.materialize-input:focus {
  border-bottom: 2px solid #42a5f5; /* Thicker and blue border on focus */
}

.materialize-input:focus + label {
  color: #42a5f5; /* Change label color to blue on focus */
}

.materialize-input + label {
  color: #9e9e9e; /* Set label color to a light gray */
  position: absolute; /* Position label above the input */
  top: 15px; /* Adjust label position to match padding */
  left: 10px; /* Adjust label position to match padding */
  transition: color 0.3s ease-in-out; /* Smooth transition for label color change */
}




.select-wrapper {
  position: relative; /* Enable absolute positioning for the label and arrow */
  display: block; /* Ensure proper display within the layout */
  margin-bottom: 10px; /* Add some margin for spacing */
}

.materialize-select {
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 10px 0; /* Adjust padding for a comfortable fit */
  font-size: 16px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 30%; /* Make the select element fill the container */
  cursor: pointer; /* Indicate interactivity on hover */
}

.materialize-select:focus {
  border-bottom: 2px solid #42a5f5; /* Thicker and blue border on focus */
}

.materialize-select + label {
  color: #9e9e9e; /* Set label color to a light gray */
  position: absolute; /* Position label above the select element */
  top: 0; /* Align label to the top of the select */
  left: 0; /* Align label to the left of the select */
  pointer-events: none; /* Disable click interaction on the label */
  transition: color 0.3s ease-in-out; /* Smooth transition for label color change */
}

.materialize-select:focus + label {
  color: #42a5f5; /* Change label color to blue on focus */
}

/* Style the dropdown options (optional) */
.materialize-select option {
  padding: 10px 0; /* Match padding of the select element */
}

.materialize-select option:hover {
  background-color: #f5f5f5; /* Light gray background on hover */
}


.materialize-select33 {
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 10px 0; /* Adjust padding for a comfortable fit */
  font-size: 16px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 50%; /* Make the select element fill the container */
  cursor: pointer; /* Indicate interactivity on hover */
}


.materialize-select2 {
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 0px 10px; /* Adjust padding for a comfortable fit */
  font-size: 15px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 300px; /* Adjust width as needed */
  cursor: pointer; /* Indicate interactivity on hover */
  text-align: center; /* Center text inside the select */
  display: block; /* Ensure the select is treated as a block element */
  margin: 0 auto; /* Center the select horizontally */
}
.materialize-select3 {
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 0px 0; /* Adjust padding for a comfortable fit */
  font-size: 16px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 50%; /* Make the select element fill the container */
  cursor: pointer; /* Indicate interactivity on hover */
  &:focus {
    border-color: #42a5f5; /* Change border color to blue on focus */
  }
}

.materialize-select4 {
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 0px 0; /* Adjust padding for a comfortable fit */
  font-size: 16px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 50%; /* Make the select element fill the container */
  cursor: pointer; /* Indicate interactivity on hover */
  &:focus {
    border-color: #42a5f5; /* Change border color to blue on focus */
  }
}

.checkbox-container {
  text-align: center;
  display: inline-block; /* Ensures inline behavior */
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


    <!-- script pdf -->

     <script type="text/javascript" src="../../scripts/jspdf.min.js"></script>



     <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


</head>
 <center><h1><u><font face="
    font-family: 'Open Sans', 'Sans-serif'" >Configuracion de Listado </font></u></h1></center>

<body>
  
<!--<form action="Listados_Normales.php" method="POST" accept-charset="UTF-8">-->
<style>
  /* Estilo para centrar el campo de entrada */
  .centered-input {
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 0px 0px; /* Adjust padding for a comfortable fit */
  font-size: 15px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 17%; /* Make the input element fill the container */
  cursor: pointer;
  /* Add the focus styling here */
  &:focus {
    border-color: #42a5f5; /* Change border color to blue on focus */
  }


  
</style>
<form class="form" style="max-width:"  >
  <div class="page-content bg-light"  >



  <div class="container" > <center><h1><u><font face="
    font-family: 'Open Sans', 'Sans-serif'" ></font></u></h1></center>
    <br>

      <center> 
		      
	<!-- Campo para ingresar el código de modalidad -->
  <center>
  <input type="text" id="codmod_input" class="centered-input" placeholder="Ingrese Codigo Modalidad" title="Ingrese el código de la modalidad aquí" />
</center>
    

<br>
<br>
<!-- Select para modalidades -->
 
<select name="nommod"  id="modalidad_select" class="materialize-select2">
    <option value="" style="width: 300px;">Nombre De Modalidad</option>
</select>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Cuando el usuario deja de escribir en el campo de código de modalidad
    $('#codmod_input').on('input', function() {
        var codmod = $(this).val(); // Obtener el valor ingresado

        if (codmod.length > 0) {  // Solo buscar si hay algo ingresado
            $.ajax({
                url: 'buscar_modalidad_por_codigo.php',  // Archivo PHP para buscar el nombre de la modalidad
                type: 'POST',
                dataType: 'json',
                data: { codmod: codmod },  // Enviar el código de modalidad ingresado
                success: function(response) {
                    if (response.success) {
                        // Actualizar el campo con el nombre de la modalidad
                        $('#nommod_input').val(response.nommod);
                        
                        // Actualizar el select con la modalidad encontrada
                        var select = $('#modalidad_select');
                        select.empty(); // Limpiar opciones actuales
                        select.append('<option value="' + response.codmod + '">' + response.codmod + '-' + response.nommod + '</option>');
                        select.val(response.codmod); // Seleccionar la opción encontrada
                        
                        // Reinitialize select2 if you use it
                        if (typeof $.fn.select2 === 'function') {
                            select.select2(); // Reinitialize select2 if necessary
                        }
                    } else {
                        $('#nommod_input').val('No encontrado');  // Mostrar mensaje si no se encuentra
                        $('#modalidad_select').empty(); // Limpiar opciones del select
                    }
                },
                error: function() {
                    $('#nommod_input').val('Error en la búsqueda');
                }
            });
        } else {
            $('#nommod_input').val('');  // Limpiar el campo si no hay código ingresado
            $('#modalidad_select').empty(); // Limpiar opciones del select
        }
    });
});
</script>

</div>

    <br>
    <br>
    <br>
    <table class="responsive-table">
    	
 <tr>

 	<td>
 		
 		<label for="localidad">Localidad:</label>
				<select id="localidad" name="localidad1" class="materialize-select33">
				  <option value="">Seleccione</option>
				  <option value="USH">Ushuaia</option>
				  <option value="RGD">Río Grande</option>
				  <option value="TOL">Tolhuin</option>
				  <option value="ANT">Antártida</option>
				</select>
 
 	</td>
    

    <td align="left"><b>Año:</b>
    <input type="num" size="10" name="name" id='year'  class="materialize-input1" align="left" >
     <b>Nota Nº:</b>
    <input type="text" size="20" name="name2" id='nota' class="materialize-input1" align="left">
     <input type="checkbox" id="chkexclu" class="form-check-input" align="left">
    <label for="chkexclu" class="form-check-label" >Excluidos</label>
  </td>


  <td> <b>Tipo de Listado:</b>
    <select name="tipoc" id="tipoc" class="materialize-select3" onchange="habilitarEstablecimiento(this.value)">
       <option value="">Selecione</option>
      <option value="permanente">Permanente</option>
      <option value="titulares">Titulares</option>
      <option value="transitorio">Interinatos y Suplencias</option>
      <option value="Concurso">Concurso de Titularidad</option>
    </select>
  
  </td>

</tr>

<td colspan="3">&nbsp;

<br>
<tr>
  <td colspan="2"><b>&nbsp;&nbsp;Título :</b>
    <input type="text" size="50" name="name3" id='titulo' class="materialize-input3">
  </td>
  
</tr>
<td>&nbsp;</td>
<td colspan="3">&nbsp;</td>
<tr>
  <td colspan="2"><b>Subtítulo:</b>
    <input type="text" size="50" name="name4"  id='subtitulo' class="materialize-input3">
  </td>
</tr>
<td colspan="3">&nbsp;</td>

<tr id="establecimiento_row"   colspan="3" style="display: none;">
  <th class="text-center">

<tr id="establecimiento_data"  style="display: none;">
  <td><b>Establecimiento:</b>
  
<?php
      $serverName = "10.1.9.113"; // Replace with your SQL Server hostname
      $connectionOptions = array(
          "Database" => "junta", // Replace with your database name
          "UID" => "SA", // Replace with your SQL Server username
          "PWD" => 'Davinci2024#', // Replace with your SQL Server password
          "CharacterSet" => "UTF-8", // Ensures UTF-8 character set
          "TrustServerCertificate"=>true
      );

      $conn = sqlsrv_connect($serverName, $connectionOptions);

      if ($conn === false) {
          die(print_r(sqlsrv_errors(), true));
      }

      // SQL query to retrieve dependencies
      $sql = "
    SELECT iddep, nomdep, coddep
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

      // Execute query
      $result = sqlsrv_query($conn, $sql);

      if ($result === false) {
          die(print_r(sqlsrv_errors(), true));
      }

      // Check if any data found
      if (sqlsrv_has_rows($result)) {
          echo "<select name='nomdep2' id='item_select' class='materialize-select4'>";
          echo "<option value=''>Seleccione</option>";

          // Loop through results and create options
          while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
              $itemName = $row['nomdep'];
              $itemCode = $row['coddep'];  // Get codep
             
              echo "<option value='" . htmlspecialchars($itemCode, ENT_QUOTES | ENT_XML1, 'UTF-8') . "'>" . htmlspecialchars($itemName, ENT_QUOTES | ENT_XML1, 'UTF-8') . "</option>";
            }

          echo "</select>";
      } else {
          echo "No data found";
      }

      // Free statement and close the connection
      sqlsrv_free_stmt($result);
      sqlsrv_close($conn);
 ?></td>
 </tr>
 <td colspan="3">&nbsp;</td> 
  
<tr id="disposicion_row" style="display: none;">
  <th colspan="2" class="text-center"></th>
</tr>
<tr id="disposicion_data" style="display: none;">
  <td colspan="1" style="text-align: left;"><b>Disposición:</b>
    <input type="text" name="name5" id="disposicion" class="materialize-input3">
  </td>
</tr>


  <td>&nbsp;</td>
  <td colspan="3">&nbsp;</td>

<tr id="anexo_row" style="display: none;">
  <th   class="text-center"></th>
</tr>
<tr id="anexo_data" style="display: none;">
  <td style="text-align: left;" ><b>&nbsp;&nbsp;&nbsp;&nbsp;Anexo :</b>
    <input type="text" name="name6" class="materialize-input3"  id="anexo">
  </td>
  </tr>
</th>
  </table>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
<table>
<div class="form-check-group" align="left">
        <label class="form-check-label">
          <input type="checkbox" id="chkNormal" class="form-check-input">
          Normal
        </label>
      </div>
      <div class="form-check-group" align="left">
        <label class="form-check-label">
          <input type="checkbox" id="chkTodasModalidadesTitulares" class="form-check-input">
          Todas las modalidades por escuela (Solo titulares)
        </label>
      </div>
      <div class="form-check-group" align="left">
        <label class="form-check-label">
          <input type="checkbox" id="chkModalidadCiudadUnificada" class="form-check-input">
          Por Modalidad (ciudad unificada)
        </label>
      </div>
      <div class="form-check-group" align="left">
        <label class="form-check-label">
          <input type="checkbox" id="chkTitularesModalidadCiudadSinEstablecimiento" class="form-check-input">
          Titulares por modalidad, por ciudad y sin establecimiento
        </label>
      </div>
      <div class="form-check-group" align="left">
        <label class="form-check-label">
          <input type="checkbox" id="chkComplementariosCiudadSinEstablecimientoTitulares" class="form-check-input">
          Complementarios, por ciudad y sin establecimiento (titulares), una abajo de otra
        </label>
      </div>

<hr>
<div class="form-check-group" align="left">
<b>Listado Provinciales:</b>
<?php
$serverName = "10.1.9.113"; // Nombre del servidor SQL Server
$connectionOptions = array(
    "Database" => "junta", // Nombre de la base de datos
    "UID" => "SA", // Nombre de usuario de SQL Server
    "PWD" => 'Davinci2024#', // Contraseña de SQL Server
    "CharacterSet" => "UTF-8", // Ensures UTF-8 character set
    "TrustServerCertificate"=>true
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Primera consulta: SQL query para recuperar los listados generales
$sqlListados = "SELECT Listado, ciudad FROM _junta_listadosgenerales";

// Execute query
$resultListados = sqlsrv_query($conn, $sqlListados);

if ($resultListados === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Check if any data found
if (sqlsrv_has_rows($resultListados)) {
    echo "<select name='nomdep' id='item_select' class='materialize-select'>";
    echo "<option value=''>Seleccione</option>";

    // Loop through results and create options
    while ($row = sqlsrv_fetch_array($resultListados, SQLSRV_FETCH_ASSOC)) {
        $itemName = $row["Listado"];
        $itemCiudad = $row["ciudad"];

        // Concatenar itemName y itemCiudad con un separador (por ejemplo, coma)
        $combinedValue = "$itemName, $itemCiudad";

        // Crear un elemento option con el valor combinado y el texto formateado
        echo "<option value='" . htmlspecialchars($combinedValue, ENT_QUOTES | ENT_XML1, 'UTF-8') . "'>$itemName ($itemCiudad)</option>";
    }
    echo "</select>";
} else {
    echo "No se encontraron datos";
}

// Free statement for the first query
sqlsrv_free_stmt($resultListados);
sqlsrv_close($conn);
?>





</div>

</table>


  <script>
    $(document).ready(function() {
      $('#modalidad_select').on('change', function() {
        var selectedCodmod = $(this).val();
        $('#selected_codmod').text('Modalidad: ' + selectedCodmod);
      });
    });



  </script>
<script type="text/javascript">
	
function habilitarEstablecimiento(selectedValue) {
  const establecimientoRow = document.getElementById('establecimiento_row');
  const establecimientoData = document.getElementById('establecimiento_data');
  const disposicionRow = document.getElementById('disposicion_row');
  const disposicionData = document.getElementById('disposicion_data');
  const anexoRow = document.getElementById('anexo_row');
  const anexoData = document.getElementById('anexo_data');

  if (selectedValue === 'titulares') {
    establecimientoRow.style.display = 'table-row';
    establecimientoData.style.display = 'table-row';
    disposicionRow.style.display = 'table-row';
    disposicionData.style.display = 'table-row';
    anexoRow.style.display = 'table-row';
    anexoData.style.display = 'table-row';
  } else {
    establecimientoRow.style.display = 'none';
    establecimientoData.style.display = 'none';
    disposicionRow.style.display = 'none';
    disposicionData.style.display = 'none';
    anexoRow.style.display = 'none';
    anexoData.style.display = 'none';
  }
}
    
</script>
  
 


    
          </div>

</center>
 <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>  
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>  

<br>
<br>
    <!-- <center> <input type="button" id="create_pdf" value="Generar Informe" class="btn btn-info""> </center>-->
        
   <center> <input type="submit" class="btn btn-info" value="Generar PDF" onclick="procesarFormulario(event)" title="Generar PDF"></center>





    </form>





       
    
<script>  
    (function () {
  var
    form = $('.form'),
    cache_width = form.width(),
    a4Landscape = [841.89 , 595.28 ]; // A4 size paper width and height (landscape)

  $('#create_pdf').on('click', function () {
    $('body').scrollTop(0);
    createPDF();
  });

  // Create PDF function
  function createPDF() {
    getCanvas().then(function (canvas) {
      var
        img = canvas.toDataURL("image/png"),
        doc = new jsPDF({
          unit: 'px',
          format: a4Landscape, // Set format to A4 landscape
          orientation: 'l' // Set orientation to landscape
        });

     doc.addImage(img, 'JPEG', 20,20 ); 
      // Add header text with positioning and styling
    doc.setFontSize(12); // Set font size for the header text
    doc.setFontStyle('bold'); // Set font style to bold for emphasis
    doc.text(270, 20, "JUNTA DE CLASIFICACIÓN Y DISCIPLINA"); // Add text at coordinates (270, 20)
    doc.setFontStyle('normal'); // Reset font style to normal
    doc.text(270, 30, "NIVEL INICIAL, PRIMARIO, MODALIDAD Y GABINETE"); // Add text below the previous line
    doc.text(270, 40, "Gdor. Campos Nº 1443 - Casa 56/57 Tira 11(9410) Ushuaia"); // Add final line of text
      doc.save('listado-html-to-pdf.pdf');
      form.width(cache_width);
    });
  }

  // Create canvas object function
  function getCanvas() {
    // Adjust width based on A4 landscape dimensions (consider margins)
    form.width((a4Landscape[0] * 1.2) - 80).css('max-width', 'none');
    return html2canvas(form, {
      imageTimeout: 2000,
      removeContainer: true
    });
  }

})(); 

</script>  
<script>  
    /* 
 * jQuery helper plugin for examples and tests 
 */  
    (function ($) {  
        $.fn.html2canvas = function (options) {  
            var date = new Date(),  
            $message = null,  
            timeoutTimer = false,  
            timer = date.getTime();  
            html2canvas.logging = options && options.logging;  
            html2canvas.Preload(this[0], $.extend({  
                complete: function (images) {  
                    var queue = html2canvas.Parse(this[0], images, options),  
                    $canvas = $(html2canvas.Renderer(queue, options)),  
                    finishTime = new Date();  
  
                    $canvas.css({ position: 'absolute', left: 0, top: 0 }).appendTo(document.body);  
                    $canvas.siblings().toggle();  
  
                    $(window).click(function () {  
                        if (!$canvas.is(':visible')) {  
                            $canvas.toggle().siblings().toggle();  
                            throwMessage("Canvas Render visible");  
                        } else {  
                            $canvas.siblings().toggle();  
                            $canvas.toggle();  
                            throwMessage("Canvas Render hidden");  
                        }  
                    });  
                    throwMessage('Screenshot created in ' + ((finishTime.getTime() - timer) / 1000) + " seconds<br />", 4000);  
                }  
            }, options));  
  
            function throwMessage(msg, duration) {  
                window.clearTimeout(timeoutTimer);  
                timeoutTimer = window.setTimeout(function () {  
                    $message.fadeOut(function () {  
                        $message.remove();  
                    });  
                }, duration || 2000);  
                if ($message)  
                    $message.remove();  
                $message = $('<div ></div>').html(msg).css({  
                    margin: 0,  
                    padding: 10,  
                    background: "#000",  
                    opacity: 0.7,  
                    position: "fixed",  
                    top: 10,  
                    right: 10,  
                    fontFamily: 'Tahoma',  
                    color: '#fff',  
                    fontSize: 12,  
                    borderRadius: 12,  
                    width: 'auto',  
                    height: 'auto',  
                    textAlign: 'center',  
                    textDecoration: 'none'  
                }).hide().fadeIn().appendTo('body');  
            }  
        };  
    })(jQuery);  
  
</script>  


 
   


    

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







  <script language="Javascript">
               
  <script type="text/javascript" src="jspdf.min.js"></script>
    <script type="text/javascript">
        function genPDF(){
            var doc=new jsPDF();
            let mensaje=document.getElementById('esc').value;
            doc.text(20,20,mensaje);
            doc.addPage();
            doc.text(20,20,'doc');
            doc.save('Test.pdf');
        }
    </script>

                     </script>
                    
     

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js">
	

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



<!-- esto para precesar el formulario dependiendo la seleccion --->

<script>
function procesarFormulario(event) {
  event.preventDefault(); // Previene el comportamiento por defecto del formulario

  const chkExcluidos = document.getElementById('chkexclu').checked;
  const chkNormal = document.getElementById('chkNormal').checked;
  const chkTodasModalidadesTitulares = document.getElementById('chkTodasModalidadesTitulares').checked;
  const chkModalidadCiudadUnificada = document.getElementById('chkModalidadCiudadUnificada').checked;
  const chkTitularesModalidadCiudadSinEstablecimiento = document.getElementById('chkTitularesModalidadCiudadSinEstablecimiento').checked;
  const chkComplementariosCiudadSinEstablecimientoTitulares = document.getElementById('chkComplementariosCiudadSinEstablecimientoTitulares').checked;

  const selectProvinciales = document.querySelector("select[name='nomdep']").value;
  const selectLocalidad = document.getElementById('localidad').value;

  // Selección del <select> con name="nomdep2"
  const selectEstablecimiento = document.querySelector("select[name='nomdep2']").value;
  
  let url = 'ListarListadosDeDocentes.php'; // URL por defecto

  if (!chkExcluidos && chkNormal && selectProvinciales === '' && selectLocalidad !== '' && selectLocalidad !== 'Antartida') {
    url = 'Listados_Normales.php';
  } else if (!chkExcluidos && chkNormal && selectProvinciales === '' && selectLocalidad === 'Antartida') {
    url = 'Listados_Antartida.php';
  } else if (!chkExcluidos && chkTodasModalidadesTitulares && selectProvinciales === '') {
    url = 'Listados_Titulares_por_Todas_Modalidades.php';
  } else if (!chkExcluidos && chkModalidadCiudadUnificada && selectProvinciales === '') {
    url = 'Listado_4.php';
  } else if (!chkExcluidos && chkTitularesModalidadCiudadSinEstablecimiento && selectProvinciales === '') {
    url = 'Listado_4.php';
  } else if (!chkExcluidos && chkComplementariosCiudadSinEstablecimientoTitulares && selectProvinciales === '') {
    url = 'Listado_4.php';
  } else if (!chkExcluidos && chkNormal && selectProvinciales !== '') {
    url = 'Listados_Provinciales.php';
  } else if (chkExcluidos && selectProvinciales === '' && selectLocalidad === 'Antartida') {
    url = 'Listado_Antartida_Excluido.php';
  } else if (chkExcluidos) {
    url = 'Listados_Excluidos.php';
  }

  const modalidadSelecionada = document.getElementById('modalidad_select');
  const codmod = modalidadSelecionada.value;
  const modalidadSelecionadaIndex = modalidadSelecionada.selectedIndex;
  const modalidadSelecionadaText = modalidadSelecionada.options[modalidadSelecionadaIndex].text;

  let localidad = document.getElementById('localidad').value;
  let year = document.getElementById('year').value;
  let nota = document.getElementById('nota').value;
  let titulo = document.getElementById('titulo').value;
  let subtitulo = document.getElementById('subtitulo').value;
  let tipoc = document.getElementById('tipoc').value;
  let disposicion = document.getElementById('disposicion').value;
  let anexo = document.getElementById('anexo').value;

  // Obtener el valor de "item_select" (coddep)
  const item_select = document.querySelector("select[name='nomdep2']").value;

  // Redirigir a la URL con los parámetros
  window.location.href = url + '?modalidad=' + modalidadSelecionadaText + 
                       '&codmod=' + codmod + 
                       '&year=' + year + 
                       '&localidad=' + localidad + 
                       '&nota=' + nota + 
                       '&titulo=' + titulo + 
                       '&subtitulo=' + subtitulo +
                       '&disposicion=' + disposicion +
                       '&anexo=' + anexo +
                       '&item_select=' + item_select + 
                       '&tipoc=' + tipoc;
}


</script>























</body>
</html>
<!-- < ?php include('AgregarModal.php'); ?>-->
<script src="../js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<?php include('footer2.php');?>

<!--modal de Modalidades->

