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

if (isset($_POST['token']) && isset($_POST['password'])) {
    $token = $_POST['token'];
    $newPassword = $_POST['password'];

    // Encriptar la nueva contraseña con MD5
    $hashedPassword = md5($newPassword);

    // Verificar si el token existe
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE token = ?");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        // Actualizar la contraseña y limpiar el token
        $update = $pdo->prepare("UPDATE usuarios SET password = ?, token = NULL WHERE token = ?");
        $update->execute([$hashedPassword, $token]);
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Contraseña actualizada</title>
            
<link rel="shortcut icon" href="./imagenes/favicon.svg" type="image/x-icon"/>  
            <style>
                body {
                    font-family: Arial, sans-serif;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                    margin: 0;
                    background-color: #f4f4f4;
                }
                h2 {
                    color: green;
                    margin-bottom: 30px;
                }
                button {
                    padding: 10px 20px;
                    font-size: 16px;
                    background-color: #007BFF;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                }
                button:hover {
                    background-color: #0056b3;
                }
                a {
                    text-decoration: none;
                }
            </style>
        </head>
        <body>
            <h2>✅ Contraseña actualizada correctamente.</h2>
            <a href="index.php">
                <button>Ir al inicio</button>
            </a>
        </body>
        </html>
        <?php
    } else {
        echo "Token inválido.";
    }
} else {
    echo "Datos incompletos.";
}
?>
