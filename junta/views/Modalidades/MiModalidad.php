<?php
session_start();
include('header2.php');

if (isset($_POST['insertar'])) {
    $codmod = isset($_POST['codmod']) ? (int) $_POST['codmod'] : 0;
    $nommod = isset($_POST['nommod']) ? $_POST['nommod'] : '';
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
    $tope = isset($_POST['tope']) ? (int) $_POST['tope'] : 0;

    try {
        $dsn = "sqlsrv:Server=10.1.9.113;Database=junta;TrustServerCertificate=true";
        $connect = new PDO($dsn, 'SA', 'Davinci2024#');
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO _junta_modalidades (codmod, nommod, titulo, tope) 
                VALUES (:codmod, :nommod, :titulo, :tope)";

        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':codmod', $codmod, PDO::PARAM_INT);
        $stmt->bindParam(':nommod', $nommod, PDO::PARAM_STR);
        $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindParam(':tope', $tope, PDO::PARAM_INT);

        $result = $stmt->execute();

        if ($result) {
            $safeCodigo = htmlspecialchars($codmod, ENT_QUOTES, 'UTF-8');
            $safeNombre = htmlspecialchars($nommod, ENT_QUOTES, 'UTF-8');
            $safeTitulo = htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8');
            ?>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Modalidad registrada exitosamente!',
                    html: '<div style="text-align:left;font-size:15px;line-height:2;">' +
                          '<p><strong>Código:</strong> <span style="font-size:20px;color:#2698f3;font-weight:700;"><?php echo $safeCodigo; ?></span></p>' +
                          '<p><strong>Descripción:</strong> <?php echo $safeNombre; ?></p>' +
                          '<p><strong>Título:</strong> <?php echo $safeTitulo; ?></p>' +
                          '</div>' +
                          '<p style="margin-top:12px;font-size:13px;color:#6b7280;">Puede copiar esta información antes de continuar.</p>',
                    icon: 'success',
                    confirmButtonText: 'Continuar',
                    confirmButtonColor: '#2698f3',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then(function() {
                    window.location.href = 'ListarModalidades.php';
                });
            });
            </script>
            <?php
        } else {
            ?>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                juntaError('Error al registrar', 'No se pudieron agregar los datos. Comuníquese con el administrador.').then(function() {
                    window.location.href = 'RegistroModalidad.php';
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
                window.location.href = 'RegistroModalidad.php';
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
            window.location.href = 'RegistroModalidad.php';
        });
    });
    </script>
    <?php
}

include('footer2.php');
?>
