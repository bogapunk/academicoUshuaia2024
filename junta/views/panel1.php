<?php

session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['estado']['msg'])){
    $statusMsg = $sessData['estado']['msg'];
    $statusMsgType = $sessData['estado']['type'];
    unset($_SESSION['sessData']['estado']);
}
include('header1.php');
?>
<style type="text/css">
	
	
    .send-button input[type="submit"] {
    padding: 10px 0;
    width: 60%;
    font-family: 'Roboto', sans-serif;
    font-size: 25px;
    font-weight: 500;
    border: none;
    outline: none;
    color: #FFF;
    background-color: #2196F3;
    cursor: pointer;
    border-radius: 8px;
}

	.send-button input[type="submit"] {
    padding: 10px 0;
    width: 60%;
    font-family: 'Roboto', sans-serif;
    font-size: 25px;
    font-weight: 500;
    border: none;
    outline: none;
    color: #FFF;
    background-color: #2196F3;
    cursor: pointer;
    border-radius: 8px;
}

.send-button input[type="submit"]:hover {
    background-color: #e55916;
}
.nav>li>a {
    position: relative;
    display: block;
    padding: 7px 15px;
}

</style>
 
<div class="col-sm-3 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;"></div>

<div class="col-sm-6 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
                
<center><h1><b><u>Sistemas De Juntas </u></b></h1></center>
   
   <?php
           if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
               include 'Usuarios.php';
               $user = new User();
               
               $conditions['where'] = array(
                   'id' => $sessData['userID'],
               );
               $conditions['return_type'] = 'single';
               $userData = $user->getRows($conditions);
       ?>

 <center> <h2>Bienvenido: <?php echo $userData['apellidos'] . ', ' . $userData['nombres']; ?>!</h2>


         <?php ?>
            
       <?php } ?>
       <br>
<br>
       
<center>
            <div class="send-button">
					
                    <form id="myForm" action="ListadoDeDocentes/ListarListadosDeDocentes.php">
                       <input type="submit" name="loginSubmit" value="Listado de Docentes">
                    </form>
                   </div>
                     <br>
                     <div class="send-button">
                       <form  id="myForm"  action= "Docentes/ListarDocentes.php" >
                         <input type="submit" name="loginSubmit" value="Docentes">
   
                       </form>
                   </div>

			</center>
			
		</div>

</div>   
<!--Inicia columna 7-->
<div class="col-sm-3 text wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
</div>
<?php include('footer1.php');?>