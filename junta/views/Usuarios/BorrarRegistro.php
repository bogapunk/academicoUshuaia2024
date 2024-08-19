
<?php

// Include database connection
include('dbconect.php');
class Connection {
  private $serverName = "db"; // o la dirección IP del servidor
  private $database = "junta";
  private $username = "SA"; // Reemplaza con tu usuario
  private $password = '"asd123"'; // Reemplaza con tu contraseña
  private $conn;

  public function open() {
      try {
          $this->conn = new PDO("sqlsrv:server=$this->serverName;Database=$this->database;TrustServerCertificate=true", $this->username, $this->password);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return $this->conn;
      } catch (PDOException $e) {
          echo "Error de conexión: " . $e->getMessage();
      }
  }

  public function close() {
      $this->conn = null;
  }
}
// Check if user ID is provided in the URL
if (isset($_GET['id'])) {
  $userId = $_GET['id'];

  // Create database connection
  $database = new Connection();
  $db = $database->open();

  try {
    // Prepare and execute the DELETE query
    //$sql = "DELETE FROM usuarios WHERE id = :id"; este lo borra 
    $sql = "UPDATE usuarios SET estado = 0 WHERE id = :id;";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $userId);
    $stmt->execute();

    // Check if the query was successful
    if ($stmt->rowCount() > 0) {
      // Set success message
      $_SESSION['message'] = "Usuario eliminado correctamente.";
    } else {
      // Set error message
      $_SESSION['message'] = "No se encontró el usuario con ID: " . $userId;
    }
  } catch (PDOException $e) {
    // Set error message in case of exception
    $_SESSION['message'] = $e->getMessage();
  }

  // Close the database connection
  $database->close();
} else {
  // Set error message if no user ID is provided
  $_SESSION['message'] = "No se ha seleccionado un usuario para eliminar.";
}

$redirectURL = stripos($_SERVER['SERVER_PROTOCOL'],'http') === 0 ? 'https://'.$_SERVER['HTTP_HOST'].'/views/Usuarios/ListarUsuarios.php' : 'http://'.$_SERVER['HTTP_HOST'].'/views/Usuarios/ListarUsuarios.php';

// Redirect to the list users page
echo('<script type="text/javascript">
window.location.href="'.$redirectURL.'?message=El Usuario fue eliminado con exito"
</script>')

?>