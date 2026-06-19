<?php
session_start();
include('header2.php');

if (isset($_POST['insertar'])) {
    $listado = $_POST['listado'];
    $modalidades = $_POST['modalidades'];
    $ciudad = $_POST['ciudad'];

    try {
        $dsn = "sqlsrv:Server=10.1.9.113;Database=junta;TrustServerCertificate=true";
        $connect = new PDO($dsn, 'SA', 'Davinci2024#');
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO _junta_listadosgenerales (listado, modalidades, ciudad) 
                VALUES (:listado, :modalidades, :ciudad)";

        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':listado', $listado, PDO::PARAM_STR);
        $stmt->bindParam(':modalidades', $modalidades, PDO::PARAM_STR);
        $stmt->bindParam(':ciudad', $ciudad, PDO::PARAM_STR);

        $result = $stmt->execute();

        if ($result) {
            $safeListado = htmlspecialchars($listado, ENT_QUOTES, 'UTF-8');
            $safeModalidades = htmlspecialchars($modalidades, ENT_QUOTES, 'UTF-8');
            $safeCiudad = htmlspecialchars($ciudad, ENT_QUOTES, 'UTF-8');
            ?>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Listado registrado exitosamente!',
                    html: '<div style="text-align:left;font-size:15px;line-height:2;">' +
                          '<p><strong>Listado:</strong> <span style="font-size:17px;color:#2698f3;font-weight:700;"><?php echo $safeListado; ?></span></p>' +
                          '<p><strong>Ciudad:</strong> <?php echo $safeCiudad; ?></p>' +
                          '<p><strong>Modalidades:</strong> <?php echo $safeModalidades; ?></p>' +
                          '</div>' +
                          '<p style="margin-top:12px;font-size:13px;color:#6b7280;">Puede copiar esta información antes de continuar.</p>',
                    icon: 'success',
                    confirmButtonText: 'Continuar',
                    confirmButtonColor: '#2698f3',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then(function() {
                    window.location.href = 'ListarConfiguracionListados.php';
                });
            });
            </script>
            <?php
        } else {
            ?>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                juntaError('Error al registrar', 'No se pudieron agregar los datos. Comuníquese con el administrador.').then(function() {
                    window.location.href = 'RegistroConfiguracionListado.php';
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
                window.location.href = 'RegistroConfiguracionListado.php';
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
            window.location.href = 'RegistroConfiguracionListado.php';
        });
    });
    </script>
    <?php
}

include('footer2.php');
?>
