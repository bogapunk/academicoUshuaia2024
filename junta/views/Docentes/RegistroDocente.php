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
                            echo "<div style='text-align: center; font-size: 20px;'>Próximo legajo: $next_legajo</div>";




                        $docenteData = $docente->getRowsDocente($conditions); ?>
 <div class="row">
       <div class="row" class="col-12" >
                  <div class="col col-sm-6">
                    <input type="text" name="legajo" placeholder="Legajo" required="" class="materialize-input1">
           
                  </div>

                  <div class="col col-sm-6">
                    <input type="text" name="apellidoynombre" placeholder="Apellido y Nombre" required="" class="materialize-input1">
                 
                  </div>
            </div>
</div>      


<div class="row">
       <div class="row"  class="col-12">
                <div class="col col-sm-3">
                <input type="text" name="dni" placeholder="DNI" required="" class="materialize-input1">

                 </div>
            <div class="col col-sm-4">
                   <input type="text" name="Domicilio" placeholder="Domicilio" required="" class="materialize-input2">
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

     
<div class="row">
   
        <div class="row" class="col-12" >
            <div class="col col-sm-5">
            
                <br>
                <label><strong>Fecha de nacimiento:<strong></label>
                 <input type="date" name="fechanacim" placeholder="Fecha de nacimiento" required="" class="materialize-date">
                 </div>
            <div class="col col-sm-7">
                 <input type="text" name="promedioT" placeholder="Promedio" required="" class="materialize-input1">
            </div>
   </div>
 </div>
 <div class="row">
     <div class="row" class="col-12" >
               <div class="col col-sm-6">
                 <input type="text" name="telefonos" placeholder="Telefonos" required="" class="materialize-input1">
              </div>
              <div class="col col-sm-6">
                 <input type="text" name="Titulobas" placeholder="Titulo Basico" required="" class="materialize-input1">
             </div>
     </div>
 </div>

<div class="row">
     <div class="row" class="col-12" >
               <div class="col col-sm-5">
                <br>

             <label><strong>Fecha Titular:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong></label></strong>
                 <input type="date" name="fechatit" placeholder="Fecha de Titular" required="" class="materialize-date">
             </div>
           <div class="col col-sm-7">
                 <input type="text" name="otorgadopor" placeholder="Otorgado por" required="" class="materialize-input1">
          </div>
      </div>
</div>
<div class="row">
     <div class="row" class="col-12" >
               <div class="col col-sm-5">
                <br>
            
             <label><strong>Fecha Inicio Docencia:<strong></label></strong>

                 <input type="date" name="finicio" placeholder="Fec Ini. Docencia" required="" class="materialize-date">
              </div>

              <div class="col col-sm-7">
                <input type="text" name="otrostit" placeholder="Otros Titulos" required="" class="materialize-input1">
              </div>
        </div>
</div>

<div class="row">
     <div class="row" class="col-12" >
               <div class="col col-sm-5">
                  <br>

            
                 <label><strong>Residencia:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong></label></strong>

                 <input type="date" name="fingreso" placeholder="Residencia" required="" class="materialize-date">
               </div>
               <div class="col col-sm-7">
                 <input type="text" name="cargosdocentes" placeholder="Cargos Docentes" required="" class="materialize-input1">
             </div>
         </div>
</div>
<div class="row">
     <div class="row" class="col-12" >
               <div class="col col-sm-5">
 
                 <br>
                  <label><strong>Fecha apertura Legajo:<strong></label></strong>

                 <input type="date" name="faperturaleg" placeholder="Fec. apertura Leg." required="" class="materialize-date">

             </div>
             <div class="col col-sm-6">
                 <input type="text" name="Nacionalidad" placeholder="Nacionalidad" required="" class="materialize-input1">
             </div>
      </div>
</div>

 <div class="row" >
               <div class="col col-sm-19">
                 <input type="text" name="obsdoc" placeholder="Observaciones" required="" class="materialize-input1">
            </div>
        </div>
     </div>
        
                <div class="send-button">
                    <button name="insertar" type="submit"  onclick="return myConfirm();">Guardar</button>
                </div>

 

            </form>
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


