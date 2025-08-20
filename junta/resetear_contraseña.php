<?php
// Conexión a la base de datos
$host = '10.1.9.113';
$dbname = 'Junta';
$user = 'SA';
$pass = 'Davinci2024#';

try {
    $pdo = new PDO("sqlsrv:Server=$host;Database=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar si el token existe en la base de datos
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE token = ?");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resetear Password - Sistema de Junta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        h2 {
            margin-bottom: 25px;
            color: #2c3e50;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #2980b9;
        }

        label {
            text-align: left;
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        #mensaje {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>

<link rel="shortcut icon" href="./imagenes/favicon.svg" type="image/x-icon"/>  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<body>
    <div class="container">
    <center><img src="./imagenes/aif-logo.png" width="250" height="100"></center>
    <h2>Cambio de Password</h2>
    <h3>-Sistema de Junta-</h3>

        <form action="guardar_nueva_contraseña.php" method="post" onsubmit="return validarCoincidencia()">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

            <label>Nueva contraseña:</label>
            <input type="password" name="password" id="password" required>

            <label>Repetir nueva contraseña:</label>
            <input type="password" id="confirm_password" required onkeyup="verificarCoincidencia()">

            <span id="mensaje"></span>
            <br><br>

            <button type="submit"> <i class="fas fa-key"></i>  Actualizar contraseña</button>
        </form>
        <br>
        <div class="panel-footer"><a href="https://www.aif.gob.ar/" target="_blank">Agencia de innovacion</a>
      <center><img src="./imagenes/pie_footer.png" width="50" height="50"></center>
            
      <div class="e-con-inner">
                <div class="elementor-element elementor-element-79dab63d elementor-widget elementor-widget-heading" data-id="79dab63d" data-element_type="widget" data-widget_type="heading.default">
                <div class="elementor-widget-container">
            <p class="elementor-heading-title elementor-size-default">© 2025 - Todos los derechos reservados | Las Islas Malvinas son argentinas.</p>       </div>
                </div>  
    </div>

    <script>
        function verificarCoincidencia() {
            const password = document.getElementById('password').value;
            const confirm = document.getElementById('confirm_password').value;
            const mensaje = document.getElementById('mensaje');

            if (password === confirm) {
                mensaje.style.color = 'green';
                mensaje.textContent = 'Las contraseñas coinciden';
            } else {
                mensaje.style.color = 'red';
                mensaje.textContent = 'Las contraseñas no coinciden';
            }
        }

        function validarCoincidencia() {
            const password = document.getElementById('password').value;
            const confirm = document.getElementById('confirm_password').value;

            if (password !== confirm) {
                alert('Las contraseñas no coinciden');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
<?php
    } else {
        echo "El enlace es inválido o ha expirado.";
    }
} else {
    echo "Token inválido.";
}
?>
