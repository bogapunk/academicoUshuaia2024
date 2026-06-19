<?php
session_start();
include('header2.php');

if (isset($_POST['insertar'])) {
    $nomdep = $_POST['nomdep'];
    $coddep = $_POST['coddep'];
    $domicilio = $_POST['domicilio'];
    $codloc = $_POST['codloc'];
    $directo = $_POST['directo'];
    $interno = $_POST['interno'];
    $codniv = $_POST['codniv'];

    try {
        $dsn = "sqlsrv:Server=10.1.9.113;Database=junta;TrustServerCertificate=true";
        $connect = new PDO($dsn, 'SA', 'Davinci2024#');
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO _junta_dependencias (nomdep, coddep, domicilio, codloc, directo, interno, codniv) 
                VALUES (:nomdep, :coddep, :domicilio, :codloc, :directo, :interno, :codniv)";

        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':nomdep', $nomdep, PDO::PARAM_STR);
        $stmt->bindParam(':coddep', $coddep, PDO::PARAM_INT);
        $stmt->bindParam(':domicilio', $domicilio, PDO::PARAM_STR);
        $stmt->bindParam(':codloc', $codloc, PDO::PARAM_STR);
        $stmt->bindParam(':directo', $directo, PDO::PARAM_STR);
        $stmt->bindParam(':interno', $interno, PDO::PARAM_STR);
        $stmt->bindParam(':codniv', $codniv, PDO::PARAM_INT);

        $result = $stmt->execute();

        if ($result) {
            $safeNombre = htmlspecialchars($nomdep, ENT_QUOTES, 'UTF-8');
            $safeCodigo = htmlspecialchars($coddep, ENT_QUOTES, 'UTF-8');
            $safeLoc = htmlspecialchars($codloc, ENT_QUOTES, 'UTF-8');
            ?>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Dependencia registrada exitosamente!',
                    html: '<div style="text-align:left;font-size:15px;line-height:2;">' +
                          '<p><strong>Código:</strong> <span style="font-size:20px;color:#2698f3;font-weight:700;"><?php echo $safeCodigo; ?></span></p>' +
                          '<p><strong>Nombre:</strong> <?php echo $safeNombre; ?></p>' +
                          '<p><strong>Localidad:</strong> <?php echo $safeLoc; ?></p>' +
                          '</div>' +
                          '<p style="margin-top:12px;font-size:13px;color:#6b7280;">Puede copiar esta información antes de continuar.</p>',
                    icon: 'success',
                    confirmButtonText: 'Continuar',
                    confirmButtonColor: '#2698f3',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then(function() {
                    window.location.href = 'ListarDependencias.php';
                });
            });
            </script>
            <?php
        } else {
            ?>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                juntaError('Error al registrar', 'No se pudieron agregar los datos. Comuníquese con el administrador.').then(function() {
                    window.location.href = 'RegistroDependencia.php';
                });
            });
            </script>
            <?php
        }
    } catch (PDOException $e) {
        $errorMsg = htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            juntaError('Error de conexión', '<?php echo addslashes($errorMsg); ?>').then(function() {
                window.location.href = 'RegistroDependencia.php';
            });
        });
        </script>
        <?php
    }
} else {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        juntaAlert('No se recibieron datos. Redirigiendo al formulario de registro...', 'warning').then(function() {
            window.location.href = 'RegistroDependencia.php';
        });
    });
    </script>
    <?php
}

include('footer2.php');
?>
