<?php
include('./Usuarios_Conexion_Sqlserver.php');
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['estado']['msg'])){
    $statusMsg = $sessData['estado']['msg'];
    $statusMsgType = $sessData['estado']['type'];
    unset($_SESSION['sessData']['estado']);
}

include('header.php');
?>
<style>
.btn-block {
    width: auto; /* Ajusta el ancho según el contenido */
    padding: 5px 10px; /* Ajusta el relleno interno */
    font-size: 14px; /* Ajusta el tamaño del texto */
    background-color: #007bff; /* Color de fondo predeterminado */
    color: #fff; /* Color de texto predeterminado */
    border: none; /* Quita el borde */
    cursor: pointer; /* Cambia el cursor al pasar el mouse */

    /* Transiciones para animaciones suaves */
    transition: background-color 0.3s ease;
}

.btn-block:hover {
    background-color: #e55916; /* Cambia el color de fondo al pasar el mouse */
}

</style>

<div class="col-sm-3 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;"></div>

<div class="col-sm-6 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
                    
    <h2><b><u>Sistemas De Juntas </u></b></h2>
    <?php
        if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
            
            $user = new User();
            $conditions['where'] = array(
                'id' => $sessData['userID'],
                
            );
            $conditions['return_type'] = 'single';
            $userData = $user->getRows($conditions);
            if ($userData['rol']=='admin'){
                header("Location: views/panel2.php");
            }else if ($userData['rol']=='otro'){
                header("Location: views/panel1.php");
            }elseif ($userData['rol']=='comun') {
                header("Location: views/panel1.php");
            }
    ?>
    <h2>Bienvenido <?php echo $userData['nombres']; ?></h2>
    <p><b>Nombres: </b><?php echo $userData['nombres'].' '.$userData['apellidos']; ?></p>
    <p><b>Email: </b><?php echo $userData['email']; ?></p>
    <p><b>Telefono: </b><?php echo $userData['telefono']; ?></p>
</div>

<?php }else{ ?>
    <h2>Acceder</h2>
    <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
   <center> <div class="login-form">
        <form id="loginForm" action="MiCuenta.php" method="post">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Ingrese usuario" required="">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Ingrese Password" required="">
            </div>
            <div class="form-group">
			<button type="submit" name="loginSubmit" class="btn btn-primary btn-block btn-sm" onclick="showPreload()">Iniciar Sesión</button>
            </div>
        </form></center>
        <div class="mt-3 text-center">
            <a href="EnviarPassword.php">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
<?php } ?>

</div>   
<!--Inicia columna 7-->
<div class="col-sm-3 text wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;"></div>
<br>

<?php include('footer.php'); ?>

<script>
    function showPreload() {
        document.getElementById('preload').style.display = 'block';
    }
</script>