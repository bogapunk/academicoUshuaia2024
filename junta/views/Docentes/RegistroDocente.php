<?php
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['estado']['msg'])){
    $statusMsg = $sessData['estado']['msg'];
    $statusMsgType = $sessData['estado']['type'];
    unset($_SESSION['sessData']['estado']);
}
include('header2.php');
?>
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
.regisFrm input[type="text"], .regisFrm input[type="email"] {
    width: 94.5%;
    padding: 10px;
    margin: 10px 0;
    outline: none;
    color: #000;
    font-weight: 500;
    font-family: 'Roboto', sans-serif;
}
h2 {
            font-size: 25px;
            text-align: center;
        }
        h4 {
            font-size: 20px;
            text-align: center;
        }

.regisFrm textarea {
    height: 100px;
}

.regisFrm ::-webkit-input-placeholder {
    color: #666;
}

.regisFrm ::-moz-placeholder {
    color: #666;
}

.regisFrm ::-moz-placeholder {
    color: #666;
}

.regisFrm ::-ms-input-placeholder {
    color: #666;
}

.send-button {
    text-align: center;
    margin-top: 20px;
}

.send-button input[type="submit"] {
    padding: 10px 0;
    width: 60%;
    font-family: 'Roboto', sans-serif;
    font-size: 18px;
    font-weight: 500;
    border: none;
    outline: none;
    color: #FFF;
    background-color: #2196F3;
    cursor: pointer;
}

.send-button input[type="submit"]:hover {
    background-color: #055d54;
}

a.logout{float: right;}
p.success{color:#34A853;}
p.error{color:#EA4335;}
/* Responsive Code */

@media screen and (max-width: 1920px) {
    h1 {
        margin: 75px auto;
    }
    .container {
        width: 25%;
    }
}

@media screen and (max-width: 1680px) {
    .container {
        width: 30%;
    }
}

@media screen and (max-width: 1600px) {
    h1 {
        margin: 50px auto;
    }
}

@media screen and (max-width: 1367px) {
    .container {
        width: 35%;
    }
}

@media screen and (max-width: 1024px) {
    .container {
        width: 45%;
    }
}

@media screen and (max-width: 966px) {
    h1 {
        letter-spacing: 2px;
    }
}

@media screen and (max-width: 853px) {
    .container {
        width: 50%;
    }
}

@media screen and (max-width: 800px) {
    .container {
        width: 55%;
    }
}

@media screen and (max-width: 768px) {
    .container {
        width: 60%;
    }
}

@media screen and (max-width: 736px) {
    h1 {
        letter-spacing: 0;
    }
}

@media screen and (max-width: 667px) {
    .container {
        width: 65%;
    }
}

@media screen and (max-width: 603px) {
    h1 {
        font-size: 35px;
    }
    .container {
        width: 70%;
    }
}

@media screen and (max-width: 568px) {
    .container {
        width: 75%;
    }
    h1 {
        font-size: 30px;
    }
}

@media screen and (max-width: 533px) {
    h1 {
        font-size: 30px;
    }
    .container {
        width: 80%;
    }
}

@media screen and (max-width: 480px) {
    h1 {
        margin: 40px 0;
    }
    .container {
        width: 85%;
        padding: 20px;
    }
    h2 {

        font-size: 25px;
        text-align: center;
    }
    .regisFrm input[type="text"], .regisFrm input[type="email"], .regisFrm input[type="password"] {
        width: 93%;
    }
}

@media screen and (max-width: 414px) {
    h1 {
        margin: 30px 0;
    }
    .social-icons ul li span.icons {
        width: 30px;
        height: 30px;
    }
    .regisFrm label {
        font-size: 13px;
    }
    .regisFrm input[type="text"], .regisFrm input[type="email"], .regisFrm input[type="password"] {
        width: 91.5%;
        font-size: 12px;
        margin: 5px 0 15px;
    }
}

@media screen and (max-width: 384px) {
    h1 {
        font-size: 25px;
        line-height: 35px;
    }
    .container {
        width: 90%;
        padding: 20px 10px;
    }
    .container p {
        font-size: 16px;
        margin-bottom: 15px;
        line-height: 22px;
    }
    h2 {
            font-size: 25px;
            text-align: center;
        }
}

@media screen and (max-width: 360px) {
    .send-button input[type="submit"] {
        width: 75%;
        font-size: 16px;
    }
}


.form-control {
    display: block;
    width: 94%;
    height: 34px
px
;
    padding: 6px 12px;

    }

button {
  background: cornflowerblue;
  color: white;
  border: none;
  padding: 10px;
  border-radius: 8px;
  font-family: 'Lato';
  margin: 5px;
  text-transform: uppercase;
  cursor: pointer;
  outline: none;
}

button:hover {
  background: orange;
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
.materialize-input-titulobasico {
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

.materialize-input_number{
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 0px 0px; /* Adjust padding for a comfortable fit */
  font-size: 15px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 50%; /* Make the input element fill the container */
  cursor: pointer;
  /* Add the focus styling here */
  &:focus {
    border-color: #42a5f5; /* Change border color to blue on focus */
  }
}


.materialize-select {
  border: none; /* Remove default border */
  border-bottom: 1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 16px 0; /* Adjust padding for a comfortable fit */
  font-size: 16px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 30%; /* Make the select element fill the container */
  cursor: pointer; /* Indicate interactivity on hover */
}
.materialize-input2 {
  border: none; /* Remove default border */
  border-bottom:1px solid #ccc; /* Add underline border */
  background-color: transparent; /* Transparent background */
  padding: 0px 0px; /* Adjust padding for a comfortable fit */
  font-size: 15px; /* Adjust font size if needed */
  outline: none; /* Remove default outline */
  width: 30%; /* Make the input element fill the container */
  cursor: pointer;
  /* Add the focus styling here */
  &:focus {
    border-color: #42a5f5; /* Change border color to blue on focus */
  }
}


.my-custom-textarea {
    height: 150px; /* Adjust height as needed */
  }


  .form-container {
  background-color: #f5f5f5; /* Example background color */
  padding: 20px;
  border-radius: 5px;
}



materialize-date{
    border: none;
    border-bottom: 1px solid #ccc;
    background-color: transparent;
    padding: 0px 0px;
    font-size: 15px;
    outline: none;
    height: 25px;
    width: 15%;
    cursor: pointer;
</style>
<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
 <!-- Compiled and minified CSS -->
 




<div class="col-sm-3 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;"></div>

<div class="col-sm-6 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">

 
    <h2><b><u><FONT COLOR="Black">CREAR DOCENTE</FONT></u></b></h2>
        <h4>Nueva Docente</h4>
        <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
        <div class="regisFrm">
<div class="card" >
  <div class="form-container">
       <form action="MiDocente.php" method="post" class="bs-example-navbar-collapse-1">
                
                 <?php 

                        include 'Docentes.php';
                        $docente = new Docente();
                        
                        $conditions['return_type'] = 'single';
                      
                       
                            // Obtener el próximo legajo disponible
                            $next_legajo = $docente->getNextLegajo();

                            // Usar $next_legajo en tu formulario o aplicación
                         //  echo "<div style='text-align: center; font-size: 20px;'> Legajo a Cargar---> $next_legajo</div>";




                        $docenteData = $docente->getRowsDocente($conditions); ?>
 <div class="row">
       <div class="row" class="col-12" >
                  <div class="col col-sm-4">
                  <label for="legajo">Legajo:</label>
                    <input type="text" name="legajo" id="legajo" placeholder="Legajo" required="" class="materialize-input1"  style="width: 50%;">
                  
           
                  </div>

                  <div class="col col-sm-8">
                    <input type="text" name="apellidoynombre" id="apellidoynombre" placeholder="Apellido y Nombre" required="" class="materialize-input1">
                 
                  </div>
            </div>
</div>      
<button type="button" id="checkLegajo" class="btn btn-info">Verificar Legajo</button>
<span id="legajoStatus" style="margin-left: 10px; max-width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"></span>

<div class="row">
       <div class="row"  class="col-12">
                <div class="col col-sm-3">
                <input 
    type="text" 
    name="dni" 
    id="dni" 
    placeholder="DNI" 
    required 
    class="materialize-input1" 
    maxlength="10" 
    pattern="\d{1,10}" 
    title="DNI debe tener hasta 10 dígitos" 
    oninput="this.value = this.value.slice(0, 10);" 
>

                 </div>
            <div class="col col-sm-5">
                   <input type="text" name="Domicilio" id="Domicilio" placeholder="Domicilio" required="" class="materialize-input2">
            </div>
     
                  
                                    <select id="lugarinsc" name="lugarinsc" class="materialize-select">
                                      <option value="">Seleccione</option>
                                      <option value="USH">Ushuaia</option>
                                      <option value="RGD">Río Grande</option>
                                      <option value="TOL">Tolhuin</option>
                                      <option value="Ant">Antártida</option>
                    </select>  
          </div>    
         
</div>
<br>
     
<div class="row">
   
  <div class="row col-12">
    <div class="col col-sm-7">
        <label for="fechanacim"><strong>Fecha de nacimiento:</strong></label>
        <input type="date" id="fechanacim" name="fechanacim" placeholder="Fecha de nacimiento" required class="materialize-date">
    </div>
    
    <div class="col col-sm-5">
            
                <label for="promedioT"><strong>Promedio:</strong></label>
                <input type="number" id="promedioT" name="promedioT" placeholder="Promedio" required class="materialize-input1"  style="width: 50%;" step="0.01">
            </div>
     </div>

 </div>
 <div class="row">
     <div class="row" class="col-12" >
               <div class="col col-sm-3">
                 <input type="text" name="telefonos" id="telefonos" placeholder="Telefonos" required="" class="materialize-input1">
              </div>
              <div class="col col-sm-9">
              <input type="text" name="Titulobas" id="Titulobas" placeholder="Titulo Basico" required="" class="materialize-input-titulobasico" maxlength="200">
             </div>
     </div>
 </div>
<div class="row">
     <div class="row" class="col-12" >
               <div class="col col-sm-6">
                 <input type="text" name="otorgadopor" id="otorgadopor" placeholder="Otorgado por" required="" class="materialize-input1">
               </div>
          <div class="col col-sm-6">
                <input type="text" name="otrostit"  id="otrostit" placeholder="Otros Titulos" required="" class="materialize-input1">
              </div>
      </div>
</div>
<br>
<div class="row">
     <div class="row" class="col-12" >
               <div class="col col-sm-7">
               <br>
                 <label><strong>Residencia:&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong></label></strong>
                 <input type="date" name="fingreso" id="fingreso" placeholder="Residencia" required="" class="materialize-date">
               </div>
               <div class="col col-sm-5">
                 <input type="text" name="cargosdocentes" id="cargosdocentes" placeholder="Cargos Docentes" required="" class="materialize-input1">
             </div>
         </div>
</div>
<div class="row">
     <div class="row" class="col-12" >
               <div class="col col-sm-7">
                 <br>
                  <label><strong>Fecha apertura Legajo:<strong></label></strong>
                 <input type="date" name="faperturaleg" id="faperturaleg" placeholder="Fec. apertura Leg." required="" class="materialize-date">
             </div>
             <div class="col col-sm-5">
                 <input type="text" name="Nacionalidad" id="Nacionalidad" placeholder="Nacionalidad" required="" class="materialize-input1">
             </div>
      </div>
</div>


<div class="row">
     <div class="row" class="col-12" >
               <div class="col col-sm-6">
                 <input type="email" name="email" id="email" placeholder="Ingrese email"  class="materialize-input1">
               </div>
          <div class="col col-sm-6">
                <input type="text" name="obsdoc"  id="obsdoc" placeholder="Observaciones" required="" class="materialize-input1">
              </div>
      </div>
</div>
 
        
                <div class="send-button">
                    <button name="insertar" type="submit"  onclick="return myConfirm();">Guardar</button>
                </div>

 

            </form>
            <script>
            $(document).ready(function() {
            // Función para formatear la fecha de año-mes-día a día-mes-año
            function formatDate(dateString) {
                    if (!dateString) return ''; // Si dateString es nulo o vacío, devolver una cadena vacía
                    
                    // Divide la cadena por espacio para separar la fecha de la hora
                    var datePart = dateString.split(' ')[0];
                    
                    // Divide la parte de la fecha por guiones
                    var parts = datePart.split('-');
                    
                    if (parts.length === 3) {
                        return parts[2] + '-' + parts[1] + '-' + parts[0]; // Cambia a día-mes-año
                    }
                    
                    return datePart; // Devuelve la fecha sin cambios si no está en el formato esperado
                }

            // Función para formatear el número a dos decimales
            function formatNumber(number) {
                return parseFloat(number).toFixed(2);
            }

            // Función para limpiar los campos del formulario
            function clearFormFields() {
                $('#apellidoynombre').val('');
                $('#dni').val('');
                $('#Domicilio').val('');
                $('#lugarinsc').val('');
                $('#fechanacim').val('');
                $('#promedioT').val('');
                $('#telefonos').val('');
                $('#Titulobas').val('');
                $('#otorgadopor').val('');
                $('#otrostit').val('');
                $('#fingreso').val('');
                $('#cargosdocentes').val('');
                $('#faperturaleg').val('');
                $('#Nacionalidad').val('');
                $('#email').val('');
                $('#obsdoc').val('');
            }

            // Función para deshabilitar los campos del formulario
            function disableFormFields() {
                $('#apellidoynombre').prop('disabled', true);
                $('#dni').prop('disabled', true);
                $('#Domicilio').prop('disabled', true);
                $('#lugarinsc').prop('disabled', true);
                $('#fechanacim').prop('disabled', true);
                $('#promedioT').prop('disabled', true);
                $('#telefonos').prop('disabled', true);
                $('#Titulobas').prop('disabled', true);
                $('#otorgadopor').prop('disabled', true);
                $('#otrostit').prop('disabled', true);
                $('#fingreso').prop('disabled', true);
                $('#cargosdocentes').prop('disabled', true);
                $('#faperturaleg').prop('disabled', true);
                $('#Nacionalidad').prop('disabled', true);
                $('#email').prop('disabled', true);
                $('#obsdoc').prop('disabled', true);

            }

            // Función para habilitar los campos del formulario
            function enableFormFields() {
                $('#apellidoynombre').prop('disabled', false);
                $('#dni').prop('disabled', false);
                $('#Domicilio').prop('disabled', false);
                $('#lugarinsc').prop('disabled', false);
                $('#fechanacim').prop('disabled', false);
                $('#promedioT').prop('disabled', false);
                $('#telefonos').prop('disabled', false);
                $('#Titulobas').prop('disabled', false);
                $('#otorgadopor').prop('disabled', false);
                $('#otrostit').prop('disabled', false);
                $('#fingreso').prop('disabled', false);
                $('#cargosdocentes').prop('disabled', false);
                $('#faperturaleg').prop('disabled', false);
                $('#Nacionalidad').prop('disabled', false);
                $('#email').prop('disabled', false);
                $('#obsdoc').prop('disabled', false);
            }

            // Función para verificar si el legajo ya existe
            $('#checkLegajo').click(function() {
                var legajo = $('#legajo').val();

                if (legajo === '') {
                    $('#legajoStatus').html('<span style="color: red;">Por favor, ingrese un legajo.</span>');
                    return;
                }

               
                $.ajax({
            url: 'check_legajo.php',
            type: 'POST',
            dataType: 'json',
            data: { legajo: legajo },
            success: function(response) {
                if (response.status === 'exists') {
                    $('#legajoStatus').html('<span style="color: red;">El legajo ya existe,El botón de guardar esta deshabilitado!</span>');

                    // Mostrar y completar los datos del docente si el legajo ya existe
                    $('#docenteInfo').show();
                    
                    // Actualiza todos los campos con la información del docente
                    $('#apellidoynombre').val(response.docente.ApellidoyNombre);
                    $('#dni').val(response.docente.dni);
                    $('#Domicilio').val(response.docente.Domicilio);
                    $('#lugarinsc').val(response.docente.lugarinsc);

                    var formattedDate = formatDate(response.docente.fechanacim);
                    $('#fechanacim').val(formattedDate.split('-').reverse().join('-')); // Convierte de dd-MM-yyyy a yyyy-MM-dd
                    $('#promedioT').val(formatNumber(response.docente.promedioT));
                    $('#telefonos').val(response.docente.telefonos);
                    $('#Titulobas').val(response.docente.Titulobas);

                    formattedDate = formatDate(response.docente.fechatit);
                    $('#otorgadopor').val(response.docente.otorgadopor);

                    formattedDate = formatDate(response.docente.finicio);
                    $('#otrostit').val(response.docente.otrostit);

                    formattedDate = formatDate(response.docente.fingreso);
                    $('#fingreso').val(formattedDate.split('-').reverse().join('-')); // Convierte de dd-MM-yyyy a yyyy-MM-dd
                    $('#cargosdocentes').val(response.docente.cargosdocentes);

                    formattedDate = formatDate(response.docente.faperturaleg);
                    $('#faperturaleg').val(formattedDate.split('-').reverse().join('-')); // Convierte de dd-MM-yyyy a yyyy-MM-dd
                    $('#Nacionalidad').val(response.docente.Nacionalidad);
                    $('#email').val(response.docente.email);
                    $('#obsdoc').val(response.docente.obsdoc);

                    // Deshabilita los campos para que no se puedan editar
                    disableFormFields();

                    // Deshabilita el botón de guardar
                    disableSaveButton();
                    showMessage('El legajo ya existe. El botón de guardar está deshabilitado.');
                } else if (response.status === 'available') {
                    $('#legajoStatus').html('<span style="color: green;">El legajo está disponible!!!.</span>');
                    $('#docenteInfo').hide();
                    
                    // Limpia y habilita los campos si el legajo está disponible
                    clearFormFields();
                    enableFormFields();

                    // Habilita el botón de guardar
                    enableSaveButton();
                    hideMessage();
                } else {
                    $('#legajoStatus').html('<span style="color: red;">Error al verificar el legajo.</span>');
                }
            },
            error: function() {
                $('#legajoStatus').html('<span style="color: red;">Error en la solicitud.</span>');
            }
        });
    });

    // Función para deshabilitar el botón de guardar
    function disableSaveButton() {
        $('button[name="insertar"]').prop('disabled', true);
    }

    // Función para habilitar el botón de guardar
    function enableSaveButton() {
        $('button[name="insertar"]').prop('disabled', false);
    }

    // Función para mostrar el mensaje
    function showMessage(message) {
        $('#messageText').text(message);
        $('#messageContainer').show();
    }

    // Función para ocultar el mensaje
    function hideMessage() {
        $('#messageContainer').hide();
    }

    // Validación del formulario antes de enviarlo
    $('#registroForm').submit(function(event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    // Función para validar el formulario
    function validateForm() {
        var legajoStatus = $('#legajoStatus').text();

        if (legajoStatus.includes('El legajo ya existe')) {
            alert('El legajo ingresado ya existe. Por favor, elija otro.');
            return false;
        }
        return true;
    }
});
    </script>



   </div>
</div>
           <center><a href="./ListarDocentes.php"> <button type="submit"  class="btn btn-success"><i class="fas fa-arrow-alt-circle-left"></i>Volver</button></a></center>



        </div>
    </div>
    
    
<!--Inicia columna 7-->
<div class="col-sm-3 text wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
                <script type="text/javascript">
                function myConfirm() {
                var result = confirm("¿Desea Cargar Los datos?");
                if (result==true) {
                return true;

                } else {
                return false;
                }
                }

</script>

</div>
<?php include('footer2.php');?>


