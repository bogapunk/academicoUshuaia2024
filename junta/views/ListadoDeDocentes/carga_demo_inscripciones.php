<?php
function traenombremodalidad($cual) {
  $sqlNroNota = "SELECT * FROM _junta_modalidades WHERE codmod = :cual ORDER BY 1";

  try {
    // Database connection
    $conn = new PDO("mysql:host=localhost;dbname=junta', 'root', '' ");

    // Prepare statement with named parameter
    $stmt = $conn->prepare($sqlNroNota);
    $stmt->bindParam(":cual", $cual);

    // Execute the query
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
      // No record found
      return "No existe a descripcion para esta modalidad :" . $cual;
    } else {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row["nommod"];
    }
  } catch (PDOException $e) {
    // Handle connection or query errors
    return "Error: " . $e->getMessage();
  } finally {
    $conn = null; // Close connection
  }
}

function traeestablecimiento($cual) {
  $sqlNroNota = "SELECT * FROM _junta_dependencias WHERE coddep = :cual ORDER BY 1";

  try {
    // ... (Similar connection and query execution logic as above)
    $conn = new PDO("mysql:host=localhost;dbname=junta', 'root', '' ");
    if ($stmt->rowCount() === 0) {
      return " - ";
    } else {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row["nomdep"];
    }
  } catch (PDOException $e) {
    return "Error: " . $e->getMessage();
  } finally {
    $conn = null;
  }
}

function traenombredoc($doc) {
  $sqlNroNota = "SELECT * FROM _junta_docentes WHERE legajo = :doc ORDER BY 1";

  try {
    // ... (Similar connection and query execution logic as above)
    $conn = new PDO("mysql:host=localhost;dbname=junta', 'root', '' ");
    if ($stmt->rowCount() === 0) {
      return "No existe el docente :" . $doc;
    } else {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row["ApellidoyNombre"];
    }
  } catch (PDOException $e) {
    return "Error: " . $e->getMessage();
  } finally {
    $conn = null;
  }
}

function traepuntaje($anio, $modalidad, $doc, $esc, $eltipo) {
  $sqlNroNota = "SELECT puntajetotal FROM _junta_movimientos WHERE legdoc = :doc AND anodoc = :anio AND codmod = :modalidad AND establecimiento = :esc AND tipo = :eltipo ORDER BY 1";

  try {
    $conn = new PDO("mysql:host=localhost;dbname=junta', 'root', '' ");
    // ... (Similar connection and query execution logic as above)
    if ($stmt->rowCount() === 0) {
      return "No existe el docente :" . $doc;
    } else {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row["puntajetotal"];
    }
  } catch (PDOException $e) {
    return "Error: " . $e->getMessage();
  } finally {
    $conn = null;
  }
}



?>
