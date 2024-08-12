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
body {
    background-color: #FFFFFF;
    color: #757575;
    font-family: 'Roboto', sans-serif;
    text-align: center;
}

body a {
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
    text-decoration: none;
}

input[type="button"], input[type="submit"] {
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
}

h1 {
    font-size: 40px;
    margin: 50px auto;
    letter-spacing: 3px;
}

.container {
    width: 40%;
    margin: 0 auto;
    background-color: #f7f7f7;
    color: #757575;
    font-family: 'Raleway', sans-serif;
    text-align: left;
    padding: 30px;
}

h2 {
    font-size: 30px;
    font-weight: 600;
    margin-bottom: 10px;
}

.container p {
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 20px;
}
.regisFrm input[type="text"], .regisFrm input[type="email"], .regisFrm input[type="password"] {
    width: 94.5%;
    padding: 10px;
    margin: 10px 0;
    outline: none;
    color: #000;
    font-weight: 500;
    font-family: 'Roboto', sans-serif;
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
        font-size: 20px;
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
</style>
<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
<div class="col-sm-3 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;"></div>

<div class="col-sm-6 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
    <h2><b><u><FONT COLOR="Black">CREAR DEPENDENCIA</FONT></u></b></h2>
		<h4>Nueva Dependencia</h4>
		<?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
		<div class="regisFrm">
			<form action="MiDepedencia.php" method="post">
             <center>   
				<input type="text" name="nomdep" placeholder="Nombre de dependencia" required=""  class="form-control">
				<input type="number" name="coddep" placeholder="Codigo de Dependencia" required=""  class="form-control">
                <input type="text" name="domicilio" placeholder="Domicilio de Dependencia" required=""  class="form-control">
                <input type="text" name="codloc" placeholder="Ciudad de Dependencia" required=""  class="form-control">
                <input type="text" name="directo" placeholder="Directo" required=""  class="form-control">
                <input type="text" name="interno" placeholder="Interno" required=""  class="form-control">
                 <?php 

                            include 'Dependencias.php';
                        $dependencia = new Dependencia();
                        
                        $conditions['return_type'] = 'single';

                    $dependenciaData = $dependencia->getRows3($conditions);  

                                    // Definir variables predeterminadas para evitar errores
                                    $codnivActivo = '';
                                    $codnivInactivo = '';

                                    // Verificar si $dependenciaData contiene 'codniv'
                                    if (isset($dependenciaData['codniv'])) {
                                        if ($dependenciaData['codniv'] == "activo") {
                                            $codnivActivo = "selected";
                                        } elseif ($dependenciaData['codniv'] == "inactivo") {
                                            $codnivInactivo = "selected";
                                        }
                                    }?>
                             
                                 <select id="codniv" class="form-control" name="codniv"  class="form-control">
                                                    <option value="1" <?php echo $codnivActivo; ?>>Activo</option>
                                                    <option value="0" <?php echo $codnivInactivo; ?>>Inactivo</option>
                                </select>
                          

            



          <!--
                <div class="form-check">
                      <input class="form-check-input" type="checkbox"  id="flexCheckIndeterminate" name="comp">
                      <label class="form-check-label" for="flexCheckIndeterminate">
                        Es complemetario
                      </label>
                    </div>
                   
        -->
				<div class="send-button">
					<button name="insertar" type="submit"  onclick="return myConfirm();">Guardar</button>
				</div>

                                </center>

			</form>
            <center><a href="http://localhost:8009/views/Dependencias/ListarDependencias.php"> <button type="submit"  class="btn btn-success"><i class="fas fa-arrow-alt-circle-left"></i>Volver</button></a></center>
		</div>
	</div>
    
    
<!--Inicia columna 7-->
<div class="col-sm-3 text wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript">
 function myConfirm() {
  var result = confirm("¿Desea Cargar Los datos ?");
  if (result==true) {
   return true;

  } else {
   return false;
  }
}

</script>
<?php include('footer2.php');?>