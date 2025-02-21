<?php
ob_start();
include('./Usuarios_Conexion_Sqlserver.php');
ob_end_flush();
session_start();
$sessData = !empty($_SESSION['sessData']) ? $_SESSION['sessData'] : '';
if (!empty($sessData['estado']['msg'])) {
    $statusMsg = $sessData['estado']['msg'];
    $statusMsgType = $sessData['estado']['type'];
    unset($_SESSION['sessData']['estado']);
}

ob_start();
include('header.php');
?>

<style>
    /* General Reset */
    * {
        margin: 0;
        padding: 0;
        border: none;
        box-sizing: border-box;
    }

    /* Body */
    body {
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
    }

    /* Main form container */
    .form-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        max-width: 600px; /* Limit max width for large screens */
        margin: 20px auto;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        width: 100%;
        margin-bottom: 1em;
    }

    /* Input fields styling */
    .form-control {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: transparent;
        text-align: center;
    }

    .form-control:focus {
        border-color: #007bff;
    }

    /* Button Styling */
    .btn-block {
        width: 20%;
        padding: 10px 15px;
        font-size: 14px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
        border-radius: 4px;
    }

    .btn-block:hover {
        background-color: #e55916;
    }

    /* Text and headings */
    h2, h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        text-align: center;
    }

    .login-form p {
        font-size: 1rem;
        text-align: center;
        margin-bottom: 10px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        /* Stack the form fields on smaller screens */
        .form-container {
            width: 90%;
            padding: 15px;
        }

        h2, h3 {
            font-size: 1.2rem;
        }
    }

    @media (max-width: 480px) {
        /* Further adjustments for small screens */
        .form-control {
            font-size: 14px;
        }

        .btn-block {
            font-size: 13px;
            padding: 8px 12px;
        }

        h2, h3 {
            font-size: 1rem;
        }
    }



    .subrayado {
        border-bottom: 3px solid black; /* Subrayado de 3px de grosor y color negro */
        display: inline-block; /* Asegura que el subrayado esté solo en el texto */
    }

</style>

<div class="col-sm-3 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;"></div>

<div class="col-sm-6 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
<h1 class="subrayado"><b>Sistema de Juntas</b></h1>
    <?php
    ob_start();
    if (!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])) {

        $user = new User();
        $conditions['where'] = array(
            'id' => $sessData['userID'],
        );
        $conditions['return_type'] = 'single';
        $userData = $user->getRows($conditions);
        if ($userData['rol'] == 'admin') {
            header("Location: views/panel2.php");
        } else if ($userData['rol'] == 'otro') {
            header("Location: views/panel1.php");
        } elseif ($userData['rol'] == 'comun') {
            header("Location: views/panel1.php");
        }
    ?>
        <h2>Bienvenido <?php echo $userData['nombres']; ?></h2>
        <p><b>Nombres: </b><?php echo $userData['nombres'] . ' ' . $userData['apellidos']; ?></p>
        <p><b>Email: </b><?php echo $userData['email']; ?></p>
        <p><b>Telefono: </b><?php echo $userData['telefono']; ?></p>
</div>

<?php } else { ?>
    <h2><b>(Acceder)</b></h2>
    <?php echo !empty($statusMsg) ? '<p class="' . $statusMsgType . '">' . $statusMsg . '</p>' : ''; ?>
    <center>
        <div class="login-form">
            <form id="loginForm" action="MiCuenta.php" method="post">
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Ingrese Usuario" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Ingrese Password" required="">
                </div>
            
                <div class="form-group">
                    <button type="submit" name="loginSubmit" class="btn btn-primary btn-block btn-sm" onclick="showPreload()" title='Iniciar Session'>Iniciar Sesión</button>
                </div>
            </form>
        </div>
    </center>
<?php } ?>

</div>

<!--Inicia columna 7-->
<div class="col-sm-3 text wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;"></div>
<br>
<?php include('footer.php');
ob_end_flush();
?>

<script>
    function showPreload() {
        document.getElementById('preload').style.display = 'block';
    }
</script>

