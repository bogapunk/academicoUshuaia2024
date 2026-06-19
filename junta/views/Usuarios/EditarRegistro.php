<?php
require_once __DIR__ . '/../seguridad_requiere_admin.php';
require_once __DIR__ . '/../../junta_config.php';
require_once __DIR__ . '/../seguridad_password.php';

if (isset($_POST['editar'])) {
    try {
        $db = new PDO(
            'sqlsrv:server=' . JUNTA_DB_HOST . ';Database=' . JUNTA_DB_NAME . ';TrustServerCertificate=true;ConnectionPooling=1;LoginTimeout=5',
            JUNTA_DB_USER,
            JUNTA_DB_PASS,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    } catch (PDOException $e) {
        error_log('EditarRegistro conexión: ' . $e->getMessage());
        $_SESSION['message'] = 'No se pudo conectar para actualizar el usuario.';
        header('Location: ListarUsuarios.php');
        exit;
    }

    try {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        if ($id <= 0) {
            $_SESSION['message'] = 'Identificador de usuario inválido.';
            header('Location: ListarUsuarios.php');
            exit;
        }

        $nombres = isset($_POST['nombres']) ? trim((string) $_POST['nombres']) : '';
        $apellidos = isset($_POST['apellidos']) ? trim((string) $_POST['apellidos']) : '';
        $email = isset($_POST['email']) ? trim((string) $_POST['email']) : '';
        $telefono = isset($_POST['telefono']) ? trim((string) $_POST['telefono']) : '';
        $rol = isset($_POST['rol']) ? trim((string) $_POST['rol']) : '';
        $estado = isset($_POST['estado']) ? (string) (int) $_POST['estado'] : '1';
        $passwordRaw = isset($_POST['password']) ? trim((string) $_POST['password']) : '';

        $usuarioActualId = isset($_SESSION['sessData']['userID']) ? (int) $_SESSION['sessData']['userID'] : 0;
        if ($id === $usuarioActualId && $estado === '0') {
            $_SESSION['message'] = 'No puede desactivar su propia cuenta mientras está conectado.';
            header('Location: ListarUsuarios.php');
            exit;
        }

        if ($passwordRaw !== '') {
            $validacionPassword = junta_password_validar($passwordRaw);
            if ($validacionPassword !== true) {
                $_SESSION['message'] = $validacionPassword;
                header('Location: ListarUsuarios.php');
                exit;
            }
        }

        $params = array(
            ':nombres'   => $nombres,
            ':apellidos' => $apellidos,
            ':email'     => $email,
            ':telefono'  => $telefono,
            ':rol'       => $rol,
            ':estado'    => $estado,
            ':id'        => $id,
        );

        if ($passwordRaw !== '') {
            $sql = 'UPDATE usuarios SET nombres = :nombres, apellidos = :apellidos, email = :email, telefono = :telefono, rol = :rol, estado = :estado, password = :password WHERE id = :id';
            $params[':password'] = junta_password_hash($passwordRaw);
        } else {
            $sql = 'UPDATE usuarios SET nombres = :nombres, apellidos = :apellidos, email = :email, telefono = :telefono, rol = :rol, estado = :estado WHERE id = :id';
        }

        $stmt = $db->prepare($sql);
        $ok = $stmt->execute($params);
        $_SESSION['message'] = $ok ? 'Usuario actualizado correctamente.' : 'No se pudo actualizar el usuario.';
    } catch (PDOException $e) {
        error_log('EditarRegistro: ' . $e->getMessage());
        $_SESSION['message'] = 'No se pudo actualizar el usuario.';
    }
} else {
    $_SESSION['message'] = 'Complete el formulario de edición.';
}

$filtro = isset($_POST['filtro_retorno']) ? preg_replace('/[^a-z]/', '', (string) $_POST['filtro_retorno']) : 'activos';
header('Location: ListarUsuarios.php?filtro=' . urlencode($filtro));
exit;
