<?php

class Cconexion {

  private $host;
  private $dbname;
  private $username;
  private $password;

  public function __construct($host, $dbname, $username, $password) {
    $this->host = $host;
    $this->dbname = $dbname;
    $this->username = $username;
    $this->password = $password;
  }

  public function conectar2() {
    try {
      // Ensure sqlsrv driver is enabled
      $conn = new PDO("sqlsrv:Server=$this->host;Database=$this->dbname", $this->username, $this->password);
      echo "Se conecto correctamente a la base de datos";
      

      return $conn;
    } catch(PDOException $exp) {
      $errors = sqlsrv_errors();
      echo "Connection error: $exp<br>";
      if (isset($errors)) {
        foreach ($errors as $error) {
          echo "SQLSTATE: " . $error['SQLSTATE'] . ", code: " . $error['code'] . ", message: " . $error['message'] . "<br>";
        }
      }
      return null;
    }
  }
}

// Example of usage with arguments
$conexion = new Cconexion('localhost', 'ventas', 'boga', '30153846');
$conn = $conexion->conectar2();


if ($conn) {
  // Check for successful connection
  $consulta = "SELECT TOP (1000) [Id], [Vendedor], [Cliente], [Ventas], [Cantidad], [Producto], [Codigo_Estado], [Pais], [Categoria], [Fecha_Pedido] FROM [ventas].[dbo].[ventas]";

  try {
    $stmt = $conn->prepare($consulta);
    $stmt->execute();

    $resultados = $stmt->fetchAll();

    echo "<h3>Resultados de la consulta para la tabla 'ventas':</h3>";
    echo "<table border=1>";
    echo "<tr><th>Id</th><th>Vendedor</th><th>Cliente</th><th>Ventas</th><th>Cantidad</th><th>Producto</th><th>Codigo_Estado</th><th>Pais</th><th>Categoria</th><th>Fecha_Pedido</th></tr>";

    foreach ($resultados as $fila) {
      echo "<tr>";
      echo "<td>" . $fila['Id'] . "</td>";
      echo "<td>" . $fila['Vendedor'] . "</td>";
      echo "<td>" . $fila['Cliente'] . "</td>";
      echo "<td>" . $fila['Ventas'] . "</td>";
      echo "<td>" . $fila['Cantidad'] . "</td>";
      echo "<td>" . $fila['Producto'] . "</td>";
      echo "<td>" . $fila['Codigo_Estado'] . "</td>";
      echo "<td>" . $fila['Pais'] . "</td>";
      echo "<td>" . $fila['Categoria'] . "</td>";
      echo "<td>" . $fila['Fecha_Pedido'] . "</td>";
      echo "</tr>";
    }

    echo "</table>";

  } catch(PDOException $exp) {
    echo "Error al ejecutar la consulta: " . $exp->getMessage();
  }
} else {
  echo "Error al conectar a la base de datos";
}


?>