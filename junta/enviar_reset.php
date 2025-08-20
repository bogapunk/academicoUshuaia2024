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

// Incluir PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './PHPMailer/src/Exception.php';

echo '<link rel="shortcut icon" href="./imagenes/favicon.svg" type="image/x-icon" />';
echo '<meta charset="UTF-8">';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = trim($_POST['email']);

        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            $token = bin2hex(random_bytes(50));
            $stmt = $pdo->prepare("UPDATE usuarios SET token = ? WHERE email = ?");
            $stmt->execute([$token, $email]);
            $link = "http://localhost:8080/juntas2024/junta/resetear_contraseña.php?token=" . $token;

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'mail.cajapolicialtdf.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'juntatdf@cajapolicialtdf.com';
                $mail->Password = 'Tdf3015***';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->SMTPOptions = [
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true,
                    ],
                ];

                $mail->setFrom('juntatdf@cajapolicialtdf.com', 'Junta Docentes');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Recuperar contraseña';
                $mail->Body = "
                    <p>Hola,</p>
                    <p>Para recuperar tu contraseña, haz clic en el siguiente enlace:</p>
                    <p><a href='$link' style='padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;'>Recuperar Contraseña</a></p>
                    <p>Si no solicitaste este cambio, puedes ignorar este correo.</p>
                ";

                $mail->send();

                echo '
                    <div style="text-align: center; margin-top: 30px;">
                        <p style="color: green; font-weight: bold; font-size: 18px;">
                            ✅ Se envió el enlace de recuperación a tu correo.
                        </p>
                        <a href="index.php" style="
                            display: inline-block;
                            margin-top: 20px;
                            padding: 10px 20px;
                            background-color: #28a745;
                            color: white;
                            text-decoration: none;
                            border-radius: 5px;
                            font-weight: bold;
                        ">
                            Volver al inicio
                        </a>
                    </div>
                ';
            } catch (Exception $e) {
                echo "<p style='color: red;'>❌ Error al enviar el correo: {$mail->ErrorInfo}</p>";
            }
        } else {
            echo "<p style='color: orange;'>⚠️ El email no está registrado en el sistema.</p>";
        }
    } else {
        echo "<p style='color: orange;'>⚠️ Por favor, ingresa un email válido.</p>";
    }
}
?>