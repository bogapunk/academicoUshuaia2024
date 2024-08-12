<?php
session_start();

include 'header.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class SqlServer {
    private $dbHost = "db";
    private $dbUsername = "SA";
    private $dbPassword = '"asd123"';
    private $dbName = "junta";
    private $db;

    public function __construct() {
        $connectionInfo = array(
            "Database" => $this->dbName,
            "UID" => $this->dbUsername,
            "PWD" => $this->dbPassword,
            "TrustServerCertificate"=>true
        );
        $this->db = sqlsrv_connect($this->dbHost, $connectionInfo);
        if ($this->db === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }

    public function select($sql, $params = array()) {
        $stmt = sqlsrv_query($this->db, $sql, $params);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $rows = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $rows[] = $row;
        }
        sqlsrv_free_stmt($stmt);
        return $rows;
    }

    public function insert($sql, $params = array()) {
        $stmt = sqlsrv_query($this->db, $sql, $params);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        return sqlsrv_rows_affected($stmt);
    }

    public function update($sql, $params = array()) {
        $stmt = sqlsrv_query($this->db, $sql, $params);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        return sqlsrv_rows_affected($stmt);
    }
}

class UsuariosModel extends SqlServer {
    public $id, $password, $nombres, $apellidos, $rol;

    public function __construct()
    {
        parent::__construct();
    }

    public function selectUsuarios()
    {
        $sql = "SELECT * FROM usuarios WHERE estado = 1";
        $res = $this->select($sql);
        return $res;
    }

    // Otras funciones de la clase UsuariosModel...

    public function actualizarToken(int $userId, string $token)
    {
        $query = "UPDATE usuarios SET token = ? WHERE id = ?";
        $data = array($token, $userId);
        $resul = $this->update($query, $data);
        return $resul;
    }

    public function selectUsuarioByEmail(string $email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $params = array($email);
        $res = $this->select($sql, $params);
        return $res;
    }
}

if (isset($_POST['forgotSubmit'])) {
    $email = $_POST['email'];

    // Validar el correo electrónico (puedes agregar validaciones adicionales si es necesario)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $statusMsg = 'Por favor, ingrese un correo electrónico válido.';
        $statusMsgType = 'error';
    } else {
        $usuarioModel = new UsuariosModel();
        $userData = $usuarioModel->selectUsuarioByEmail($email);

        if ($userData && isset($userData[0]['id'])) { // Asegúrate de verificar correctamente el resultado
            $userId = (int) $userData[0]['id'];
            $token = bin2hex(random_bytes(32)); // Genera un token seguro de 32 bytes

            // Actualizar el token en la base de datos
            $usuarioModel->actualizarToken($userId, $token);


            // Enviar correo electrónico con el enlace de restablecimiento de contraseña usando PHPMailer
            $resetLink = stripos($_SERVER['SERVER_PROTOCOL'],'http') === 0 ? "https"."://".$_SERVER['HTTP_HOST'].'/ReiniciarPassword.php?token=' . $token : "http"."://".$_SERVER['HTTP_HOST'].'/ReiniciarPassword.php?token=' . $token;

            // Configurar PHPMailer
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Username = 'd042d602592f0b'; // Tu correo Gmail
                $mail->Password = 'b5809fa388b86f'; // Tu contraseña Gmail
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('bogarin1983@gmail.com', 'Horacio Bogarin');
                $mail->addAddress($email); // Agregar el destinatario

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Solicitud de Restablecimiento de Contraseña';
                $mail->Body    = 'Hola ' . $userData[0]['nombres'] . ', haz solicitado restablecer tu contraseña. ' . 'Por favor haz clic en este enlace para cambiar tu contraseña: ' . $resetLink . ' Si no solicitaste esto, ignora este correo.';

                $mail->send();
                $statusMsg = 'Se ha enviado un correo electrónico con instrucciones para restablecer tu contraseña.';
                $statusMsgType = 'success';
            } catch (Exception $e) {
                $statusMsg = 'Error al enviar el correo electrónico, por favor inténtalo de nuevo más tarde. Detalles: ' . $mail->ErrorInfo;
                $statusMsgType = 'error';
            }
        } else {
            $statusMsg = 'No se encontró ninguna cuenta asociada con este correo electrónico.';
            $statusMsgType = 'error';
        }
    }

    $_SESSION['sessData']['estado']['msg'] = $statusMsg;
    $_SESSION['sessData']['estado']['type'] = $statusMsgType;

    header('Location: ReseteoMail.php');
    exit;
}
?>
<div class="col-sm-3 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;"></div>
<div class="col-sm-6 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">

    <h2>Reseteo password</h2>
    <h4>Ingrese Email de su cuenta para reniciar su contraseña</h4>
    <?php echo !empty($statusMsg) ? '<p class="'.$statusMsgType.'">'.$statusMsg.'</p>' : ''; ?>
    <div class="regisFrm">
        <form action="ReseteoMail.php" method="post">
            <input type="email" name="email" placeholder="EMAIL" required="">
            <div class="send-button">
                <input type="submit" name="forgotSubmit" value="CONTINUAR">
            </div>
        </form>
    </div>
</div>
<div class="col-sm-3 r-form-1-box wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;"></div>

<?php include('footer.php'); ?>