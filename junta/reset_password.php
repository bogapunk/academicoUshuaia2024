<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cambio de Password - Sistema de Junta</title>
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

        input[type="email"] {
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

        #mensaje {
            margin-top: 15px;
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<link rel="shortcut icon" href="./imagenes/favicon.svg" type="image/x-icon"/>  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body>
    <div class="container">
    <center><img src="./imagenes/aif-logo.png" width="250" height="100"></center>
        <h2>Cambio de Password </h2>
        <h3>-Sistema de Junta-</h3>

        <form id="resetForm" action="enviar_reset.php" method="post">
          <input type="email" name="email" id="email" placeholder="Ingrese su correo electrónico" required>
            <button type="submit"> <i class="fas fa-paper-plane"></i> Enviar enlace de reseteo</button>
            <p id="mensaje"></p>
        </form>

        <style>
    .boton-volver {
        background-color: #28a745; /* Verde */
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        color: white;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .boton-volver:hover {
        background-color: #218838; /* Verde más oscuro al pasar el mouse */
    }
</style>

<div style="margin-top: 20px;">
    <a href="index.php" class="boton-volver"><i class="fas fa-arrow-left"></i> Volver al Inicio</a>
</div>
<br>
        <div class="panel-footer"><a href="https://www.aif.gob.ar/" target="_blank">Agencia de innovacion</a>
      <center><img src="./imagenes/pie_footer.png" width="50" height="50"></center>
            
            
            </div>
        <div class="e-con-inner">
                <div class="elementor-element elementor-element-79dab63d elementor-widget elementor-widget-heading" data-id="79dab63d" data-element_type="widget" data-widget_type="heading.default">
                <div class="elementor-widget-container">
            <p class="elementor-heading-title elementor-size-default">© 2025 - Todos los derechos reservados | Las Islas Malvinas son argentinas.</p>       </div>
                </div>
                    </div>
</html>
    </div>

    <script>
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Evita envío inmediato

            const email = document.getElementById('email').value;
            const form = document.getElementById('resetForm');

            fetch('verificar_email.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'email=' + encodeURIComponent(email)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    form.submit(); // Envío real del formulario
                } else {
                    document.getElementById('mensaje').textContent = data.message;
                }
            })
            .catch(error => {
                document.getElementById('mensaje').textContent = 'Error al verificar el correo.';
            });
        });
    </script>
</body>

</html>
