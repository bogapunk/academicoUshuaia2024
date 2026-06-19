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
.panel-main-actions {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 14px;
}

.panel-main-actions .send-button {
    margin: 0;
}

.panel-main-actions .send-button form {
    margin: 0;
}

.panel-main-actions .send-button input[type="submit"] {
    min-width: 260px;
    min-height: 52px;
    padding: 12px 20px;
    font-family: 'Roboto', sans-serif;
    font-size: 21px;
    font-weight: 500;
    border: 1px solid rgba(0, 0, 0, 0.08);
    outline: none;
    color: #FFF;
    background-color: #2196F3;
    cursor: pointer;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    transition: background-color 0.2s ease, box-shadow 0.2s ease;
}

.panel-main-actions .send-button input[type="submit"]:hover,
.panel-main-actions .send-button input[type="submit"]:focus {
    background-color: #e55916;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.16);
}
.nav>li>a {
    position: relative;
    display: block;
    padding: 7px 15px;
}

@media (max-width: 640px) {
    .panel-main-actions {
        gap: 10px;
    }

    .panel-main-actions .send-button input[type="submit"] {
        min-width: 220px;
        width: 100%;
        font-size: 19px;
    }
}
</style>

<div class="col-sm-3 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;"></div>

<div class="col-sm-6 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
                    
   <center><h1><b><u>Sistemas De Juntas </u></b></h1></center>
   
    <?php
			if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
				if (!class_exists('User', false)) {
					require_once 'Usuarios.php';
				}
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
        <div class="panel-main-actions">
            <div class="send-button">
                 <form id="myForm" action="ListadoDeDocentes/ListarListadosDeDocentes.php" method="get">
                    <input type="submit" name="loginSubmit" value="Listado de Docentes">
                 </form>
            </div>
            <div class="send-button">
                <form id="myForm" action="Docentes/ListarDocentes.php" method="get">
                    <input type="submit" name="loginSubmit" value="Docentes">
                </form>
            </div>
        </div>

			</center>
			
		</div>
  
 

</div>   
<!--Inicia columna 7-->
<div class="col-sm-3 text wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
</div>
<?php include('footer2.php');?>