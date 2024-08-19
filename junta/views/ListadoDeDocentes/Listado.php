<?php 

header('Content-Type: text/html; charset=UTF-8');
require_once '../modalidades/modalidades.entidad.php';
require_once '../modalidades/modalidades.model.php';

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
  width: 725px;
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
  width: %; /* Make the select element fill the container */
  cursor: pointer; /* Indicate interactivity on hover */
}


.materialize-select2 {
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 0px 0; /* Adjust padding for a comfortable fit */
  font-size: 15px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 100%; /* Make the select element fill the container */
  cursor: pointer; /* Indicate interactivity on hover */
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


    <!-- script pdf -->

     <script type="text/javascript" src="../../scripts/jspdf.min.js"></script>

</head>
 <center><h1><u><font face="
    font-family: 'Open Sans', 'Sans-serif'" >Configuracion de Listado </font></u></h1></center>

<body>
  
<form action="Listados_Antartida.php" method="POST" accept-charset="UTF-8">

  <div class="page-content bg-light"  >



  <div class="container">
    <center>
        <h1><u><font face="font-family: 'Open Sans', 'Sans-serif'"></font></u></h1>
    </center>
    <br>
    <center>
        <span id="selected_codmod" class="selected-codmod"></span>
        <br>
        <select name="selected_codmod" id="modalidad_select" class="materialize-select2">
            <option value="" style="width: 500px;">Seleccione</option>
            <?php
            // Database connection (assuming you have a separate connection file)
            $conn = new mysqli("10.1.9.113", "sa", "", "junta"); // Replace with your connection file path

            // SQL query to retrieve modalities
            $sql_modality = "SELECT codmod, nommod FROM _junta_modalidades order by nommod";
             
            // Execute query and check result
            $result_modality = $conn->query($sql_modality);
            if (!$result_modality) {
                die("Error executing query: " . $conn->error);
            }

            // Loop through modalities and create options
            while ($row_modality = $result_modality->fetch_assoc()) {
                $codmod = $row_modality['codmod'];
                $nommod = $row_modality['nommod'];

                echo "<option value='$codmod'>$nommod</option>";
              
                
            }
         
            ?>
        </select>
        <!-- Este campo oculto enviará el valor seleccionado -->
        <input type='hidden' name='nommod' id='nommod' value=''>
        <input type="hidden" name="selected-codmod" id="selected-codmod-input">
    </center>

    <script>
    document.getElementById('modalidad_select').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        document.getElementById('nommod').value = selectedOption.text;
    });
</script>



   
</div>

    <br>
    <br>
    <br>
    <table class="responsive-table">
    	
 <tr>

 	<td>
   <?php
// Consulta SQL para obtener los valores únicos de codloc desde _junta_movimientos
$queryLocalidades = "SELECT DISTINCT codloc FROM _junta_movimientos ORDER BY codloc DESC";

$resultLocalidades = $conn->query($queryLocalidades);

$localidades = array(); // Almacenar los nombres de las localidades

if ($resultLocalidades->num_rows > 0) {
    // Guardar los nombres de las localidades en un array
    while($rowLocalidad = $resultLocalidades->fetch_assoc()) {
        $localidades[] = $rowLocalidad['codloc'];
    }
}
$nombreLocalidades = array(
  'USH' => 'Ushuaia',
  'RGD' => 'Rio Grande',
  'TOL' => 'Tolhuin',
  'ANT' => 'Antartida'
);



?>
   <th>Localidad: &nbsp;
                <select name='codloc' class="materialize-select3" style='width: 200px;'>
                    <option value="">Seleccione</option>
                    <?php 
                    foreach ($localidades as $localidad) {
                        if (array_key_exists($localidad, $nombreLocalidades)) {
                            $nombreLocalidad = $nombreLocalidades[$localidad];
                            echo "<option value='$localidad'>$nombreLocalidad</option>";
                        } else {
                            echo "<option value='$localidad'>$localidad</option>";
                        }
                    }
                    ?>
                </select>
 
 	</td>
    

    <td align="left"><b>Año:</b>
    <input type="number" size="10" name="anio" id="anio"  class="materialize-input1" align="left" >
     <b>Nota Nº:</b>
    <input type="text" size="20" name="nota"  id="nota"class="materialize-input2" align="left">
     <input type="checkbox" id="chkexclu" class="form-check-input" align="left">
    <label for="chkexclu" class="form-check-label" >Excluidos</label>
  </td>


  <td> <b>Tipo de Listado:</b>
    <select name="tipoc" id="tipoc" class="materialize-select3" onchange="habilitarEstablecimiento(this.value)">
       <option value="">Selecione</option>
      <option value="Permanente">Permanente</option>
      <option value="titulares">Titulares</option>
      <option value="transitorio">Interinatos y Suplencias</option>
      <option value="Concurso de Titularidad">Concurso de Titularidad</option>
    </select>
  
  </td>

</tr>

<td colspan="3">&nbsp;

<br>
<tr>
  <td colspan="2"><b>&nbsp;&nbsp;Título :</b>
    <input type="text" size="50" name="titulos" id="titulos" class="materialize-input3">
  </td>
  
</tr>
<td>&nbsp;</td>
<td colspan="3">&nbsp;</td>
<tr>
  <td colspan="2"><b>Subtítulo:</b>
    <input type="text" size="50" name="subtitulo"  id="subtitulo" class="materialize-input3">
  </td>
</tr>
<td colspan="3">&nbsp;</td>

<tr id="establecimiento_row"   colspan="3" style="display: none;">
  <th class="text-center">

<tr id="establecimiento_data"  style="display: none;">
  <td><b>Establecimiento:</b>
  
  <?php
// Database connection para traer datos de la base de datos de los establecimientos
$conn = new mysqli("db", "root", "", "junta");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT  nomdep,coddep FROM _junta_dependencias order by nomdep";
$result = $conn->query($sql);

// Check if any data found
if ($result->num_rows > 0) {
    echo "<select name='itemCode' id='item_select' class='materialize-select4'>";
    echo "<option value=''>Seleccione</option>";

    // Loop through results and create options
    while ($row = $result->fetch_assoc()) {
        $itemName = $row["nomdep"];
        $itemCode = $row["coddep"];
        echo "<option value='$itemCode'>$itemName</option>";
    }

    echo "</select>";
   
} else {
    echo "No data found";
}

// Close connection
$conn->close();
?>
 </td>
 </tr>
 <td colspan="3">&nbsp;</td> 
  
<tr id="disposicion_row" style="display: none;">
  <th colspan="2" class="text-center"></th>
</tr>
<tr id="disposicion_data" style="display: none;">
  <td colspan="1" style="text-align: left;"><b>Disposición:</b>
    <input type="text"  name="disposicion" id="disposicion"  class="materialize-input3">
  </td>
</tr>


  <td>&nbsp;</td>
  <td colspan="3">&nbsp;</td>

<tr id="anexo_row" style="display: none;">
  <th class="text-center"></th>
</tr>
<tr id="anexo_data" style="display: none;">
  <td style="text-align: left;" ><b>&nbsp;&nbsp;&nbsp;&nbsp;Anexo :</b>
    <input type="text" name="anexo" class="materialize-input3"  id="anexo">
  </td>
  </tr>
</th>
  </table>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
<table>
	<div class="form-check-group" align="left">
  <label class="form-check-label">
    <input type="checkbox" id="chkTodasEscuelasTitulares" class="filled-in" id="checkbox1"  name="agree1">
    Normal
  </label>
</div>
<div class="form-check-group" align="left">
  <label class="form-check-label"align="left">
    <input type="checkbox" id="chkTodasEscuelasTitulares" class="form-check-input">
    Todas las modalidades por escuela (Solo titulares)
  </label>
</div>
<div class="form-check-group" align="left">
  <label class="form-check-label">
    <input type="checkbox" id="chkModalidadCiudadUnificada" class="form-check-input">
    Por Modalidad (ciudad unificada)
  </label>
</div>
<div class="form-check-group"align="left">
  <label class="form-check-label" >
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
// Database connection aca me conecto para trer datos de los listados generales
 $conn = new mysqli("db", "root", "", "junta");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT  *  FROM _junta_listadosgenerales order by listado asc";

// Execute query and check result
$result = $conn->query($sql);
if (!$result) {
  die("Error executing query: " . $conn->error);
}

// Check if any data found
if ($result->num_rows > 0) {
  echo "<select name='prov' id='item_select2' class='materialize-select'>";
  echo "<option value=''>Seleccione</option>";

  // Loop through results and create options
  while ($row = $result->fetch_assoc()) {
    $itemName = $row["listado"];
    $itemCiudad = $row["ciudad"];
    $itemId = $row["id"];
    // Create a single option element with combined value and formatted text
    echo "<option value='$itemId'>$itemName ($itemCiudad)</option>";
  }

  echo "</select>";
} else {
  echo "No data found";
}
// Close connection (optional, recommended for production)
$conn->close();
 ?>



</div>

</table>


<script>
    $(document).ready(function() {
        $('#item_select').on('change', function() {
            var selectedCoddep = $(this).val(); // Obtener el valor seleccionado
            $('#selected_coddep').text('Código de Departamento: ' + selectedCoddep); // Mostrar el valor seleccionado
        });
    });
</script>

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
    <input type="submit" value="Generar PDF">
    </form>


       


 
   

    
<?php
// Te recomiendo utilizar esta conección, la que utilizas ya no es la recomendada. 
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

</body>
</html>
<!-- < ?php include('AgregarModal.php'); ?>-->
<script src="../js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<?php include('footer2.php');?>

<!--modal de Modalidades->
