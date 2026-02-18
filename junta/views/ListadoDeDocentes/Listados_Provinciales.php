<?php
/* Listados Normales Provinciales  por ciudad, modalidad, y TitularesComplementarios, por ciudad y sin establecimiento (titulares) listado 5*/
header('Content-Type: text/html; charset=UTF-8');
ob_start();
require('fpdf.php'); // Ajusta esta ruta según sea necesario
function traeesc($cod, $legdoc, $anio) {
    try {
        $conexion = new Cconexion("db", "junta", "SA", '"asd123"');
        $conn = $conexion->conectar2();

        $sql = "SELECT j_dep.nomdep 
                FROM [Junta].[dbo].[_junta_movimientos] j_mov 
                INNER JOIN [Junta].[dbo].[_junta_dependencias] j_dep 
                ON j_mov.establecimiento = j_dep.coddep 
                WHERE j_mov.legdoc = :legdoc 
                AND j_mov.codmod = :codmod 
                AND j_mov.anodoc = :anio";

        $stmt = $conn->prepare($sql);
        $stmt->execute(['legdoc' => $legdoc, 'codmod' => $cod, 'anio' => $anio]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['nomdep'];
        } else {
            return "1";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function traenombremod($cod) {
    try {
        $conexion = new Cconexion("10.1.9.113", "junta", "SA", 'Davinci2024#');
        $conn = $conexion->conectar2();

        $sql = "SELECT nommod FROM [Junta].[dbo].[_junta_modalidades] WHERE codmod = :codmod";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['codmod' => $cod]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['nommod'];
        } else {
            return "Modalidad inexistente";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function nombpropio($nombre) {
    $palabras = explode(" ", $nombre);
    $retorno = "";

    foreach ($palabras as $palabra) {
        $retorno .= ucfirst(strtolower($palabra)) . " ";
    }

    return trim($retorno);
}

class Cconexion {
    private $host;
    private $dbname;
    private $username;
    private $password;

    public function __construct($host, $dbname, $username, $password, $charset = 'UTF-8') {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->charset = $charset;
    }

    public function conectar2() {
        try {
            $conn = new PDO("sqlsrv:Server=$this->host;Database=$this->dbname;TrustServerCertificate=true", $this->username, $this->password);
            $conn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $exp) {
            throw new Exception("Connection error: " . $exp->getMessage());
        }
    }
}


// Obtener los valores del formulario de manera segura
$codmod = isset($_GET['codmod']) ? $_GET['codmod'] : '';
$modalidad = isset($_GET['modalidad']) ? $_GET['modalidad'] : '';
$tipo = isset($_GET['tipoc']) ? $_GET['tipoc'] : '';
$localidad = isset($_GET['localidad']) ? $_GET['localidad'] : '';

      
$anio = isset($_GET['year']) ? (int)$_GET['year'] : 0; // Convertir a entero
$nota = isset($_GET['nota']) ? $_GET['nota'] : '';
$titulo = isset($_GET['titulo']) ? $_GET['titulo'] : '';
$subtitulo = isset($_GET['subtitulo']) ? $_GET['subtitulo'] : '';
$establecimiento = isset($_POST['itemCode']) ? $_POST['itemCode'] : '';
$ciudad = isset($_REQUEST['ciudad']) && !empty($_REQUEST['ciudad']) ? $_REQUEST['ciudad'] : null;
$legdoc = $_REQUEST['legdoc'] ?? '';
$listado = $_REQUEST['listado'] ?? '';
$idmodalidad = isset($_GET['idmodalidad']) ? $_GET['idmodalidad'] : '';


// Verificar que el parámetro idmodalidad no esté vacío
if (empty($idmodalidad)) {
    die("No se ha proporcionado el ID de modalidad.");
}

$modalidades = explode(",", str_replace("'", "", $codmod)); // Convertir a array

$placeholders = implode(',', array_fill(0, count($modalidades), '?')); // Crear placeholders dinámicos

// Verificar si 'ciudad' está presente
if (!$ciudad) {
    die("No ID proporcionado.");
}
// Valores posibles de codloc esto es nuevo 
// Valores posibles de codloc
$valores_validos = ['USH', 'RGD', 'TOL', 'ANT','PROVIN'];

// Si $localidad tiene uno de los valores esperados, se filtra si es tolhuin me trai por defecto tambien rio grande , en caso contrario no 
if (in_array($localidad, $valores_validos)) {

    if ($localidad == 'TOL') {
        $localidad_condition = "AND (j_mov.codloc = 'TOL' OR j_mov.codloc = 'RGD')";

    } elseif ($localidad == 'PROVIN') {
        $localidad_condition = "AND j_mov.codloc IN ('USH','RGD','TOL')";

    } else {
        $localidad_condition = "AND j_mov.codloc = '$localidad'";
    }

} else {
    $localidad_condition = '';
}

// Conectar a la base de datos
$conexion = new Cconexion("10.1.9.113", "junta", "SA", 'Davinci2024#');
$conn = $conexion->conectar2();

try {
    $sql_listado_generales = "SELECT modalidades, ciudad, id  
                              FROM [Junta].[dbo].[_junta_listadosgenerales] 
                              WHERE id = ?";

    $stmt = $conn->prepare($sql_listado_generales);
    $stmt->bindParam(1, $idmodalidad, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verificar si se encontró algún resultado
    if (count($results) > 0) {
        $row = $results[0];

        // Obtener las modalidades
        $modalidades = $row['modalidades'];  // Esta es la columna 'modalidades'

        // Convertir modalidades a lista de valores separados por comas
        $modalidades = implode("','", explode("-", trim($modalidades, "-")));

        // Obtener las ciudades y prepararlas para la consulta
        $ciudad_array = array_filter(explode("-", trim($row['ciudad'])), 'strlen');
        $ciudad_str = "'" . implode("','", $ciudad_array) . "'";

        // Ahora puedes usar estas variables en tu consulta principal
        // ---- CONSULTA PRINCIPAL ----
        $query = "SELECT DISTINCT j_doc.dni, j_doc.ApellidoyNombre, j_mov.legdoc, 
       MAX(j_mov.puntajetotal) AS puntajetotal, 
       MAX(j_mov.establecimiento) AS establecimiento, 
       MAX(j_mov.titulo + j_mov.otrosantecedentes) AS totalodn1, 
       MAX(j_mov.serviciosprovincia) AS serviciosprovincia, 
       MAX(j_mov.concepto) AS concepto, 
       MAX(j_dep.nomdep) AS nomdep,
       MAX(j_dep.coddep) AS coddep, 
       MAX(j_mov.antiguedadgestion) AS antiguedadgestion, 
       MAX(j_mov.promedio) AS promedio, 
       MAX(j_doc.fechatit) AS fechatit
FROM [Junta].[dbo].[_junta_movimientos] j_mov
JOIN [Junta].[dbo].[_junta_docentes] j_doc ON j_mov.legdoc = j_doc.legajo
JOIN [Junta].[dbo].[_junta_dependencias] j_dep ON j_mov.establecimiento = j_dep.coddep
WHERE j_mov.codmod IN ('$modalidades') 
$localidad_condition -- todo los valores de localidad 
AND j_mov.anodoc = $anio 
AND j_mov.tipo = 'titulares'
GROUP BY 
    j_doc.dni, j_doc.ApellidoyNombre, j_mov.legdoc
ORDER BY  
    puntajetotal DESC, totalodn1 DESC, concepto DESC, serviciosprovincia DESC, promedio DESC, antiguedadgestion DESC, fechatit DESC;";

    } else {
        die("No se encontraron datos.");
    }
} catch (Exception $e) {
    die("Error en la consulta: " . $e->getMessage());
}
 
    $stmt2 = $conn->prepare($query);
    $stmt2->execute();
    $resultados = $stmt2->fetchAll(PDO::FETCH_ASSOC);




        // Preparar la consulta
        $stmt = $conn->prepare($query);
        
        
        // Ejecutar la consulta
        $stmt->execute();
  
        // Obtener los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
  if (!$results) {
      die("No se encontraron resultados en la consulta.");
  }
$localidad = isset($_GET['localidad']) ? trim($_GET['localidad']) : '';

if ($localidad === 'PROVIN') {
    $localidad_display = 'USH-RGD-TOL';

} elseif ($localidad === 'TOL') {
    $localidad_display = 'RGD-TOL';

} elseif ($localidad !== '') {
    $localidad_display = $localidad;

} else {
    $localidad_display = '';
}
  // A partir de aquí, puedes seguir generando el PDF con los resultados obtenidos...

  $pdf = new FPDF('P', 'mm', 'Legal');
  $pdf->SetFont('Arial', '', 10);
  $pdf->AddPage();
  
  // Encabezado del PDF
  $pdf->SetFont('Arial', 'B', 15);
  $pdf->Cell(120, 13, utf8_decode($_GET["titulo"]), 0, 0, "L");
  
  $pdf->SetFont('Arial', '', 13);
  // Descomentar si es necesario
  // $pdf->Cell(120, 3, utf8_decode($listado).'-Titulares ', 0, 0, 'L');
  
  // Subtítulos y localización
  $pdf->SetFont('Arial', 'I', 8);
  $pdf->Cell(90, 3, utf8_decode('JUNTA DE CLASIFICACIÓN Y DISCIPLINA NIVEL'), 0, 1, "C");
  $pdf->Cell(120, 3, '', 0, 0, "L");
  $pdf->Cell(90, 3, 'INICIAL, PRIMARIO, MODALIDAD Y GABINETE', 0, 1, "C");
  $pdf->Cell(120, 3, '', 0, 0, "L");
  
  // Dirección y detalles según localidad
  $pdf->SetFont('Arial', 'I', 6);
  if ($_GET["localidad"] === "USH") {
      $pdf->Cell(90, 3, 'Gdor. Campos N 1443 - Casa 56/57 Tira 11(9410) Ushuaia', 0, 1, "C");
      $pdf->SetFont('Arial', 'B', 13);
      $pdf->Cell(120, 13, utf8_decode($_GET["subtitulo"]), 0, 0, "L");
      $pdf->SetFont('Arial', 'I', 10);
      $pdf->Cell(1, 15,"Fecha:  ". date("d/m/Y"), 0, 0, "R");  
      $pdf->SetFont('Arial', 'I', 6);
      $pdf->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
      $pdf->SetFont('Arial', 'I', 12);
     // $pdf->Cell(170, 17, "Disposicion:  " . $_GET["disposicion"] . " Anexo: " . $_GET["anexo"], 0, 0, "C");
  } else {
      $pdf->Cell(90, 3, 'Thorne N 1949 Depto 8 (9420) Rio Grande', 0, 1, "C");
      $pdf->SetFont('Arial', 'B', 15);
      $pdf->Cell(120, 15, utf8_decode($_GET["subtitulo"]), 0, 0, "L");
      $pdf->SetFont('Arial', 'I', 10);
      $pdf->Cell(1, 15,"Fecha:  ". date("d/m/Y"), 0, 0, "R"); 
      $pdf->SetFont('Arial', 'I', 6);
      $pdf->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
      $pdf->SetFont('Arial', 'I', 12);
      //$pdf->Cell(200, 3, "Disposicion:  " . $_GET["disposicion"] . " Anexo: " . $_GET["anexo"], 0, 0, "L");
  }
  
  // Datos de contacto y separación de la cabecera
  $pdf->SetFont('Arial', 'I', 6);
  $pdf->Cell(330, 3, 'Tel. (02901)441443-441447       Internos 1443 - 1447', 0, 1, "C");
  $pdf->Cell(120, 3, '', 0, 0, "L");
  $pdf->Cell(90, 3, ' Email: juntaegb1y2@gmail.com -- juntaegb1y2@gmail.com', 0, 1, "C");
  
// Salto de línea en blanco
 $pdf->Ln(1);  // Aquí agregamos un salto de línea con un tamaño de 5 (ajusta el valor según lo que necesites)
  // Línea separadora
  $x = $pdf->GetX();
  $y = $pdf->GetY();
  $pdf->Line($x, $y, $pdf->GetPageWidth() - $x, $y);
  $pdf->Ln();
  
  // Información adicional
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(30, 5, utf8_decode('Año: ') . $_GET['year'], 0, 0, "L");
// Verificar si la localidad está vacía
if (($_GET['localidad']== 'PROVIN')) {
    // Si muetra provinciales mostrara 'USH-RGD-TOL'
    $localidad_display = 'USH-RGD-TOL';
} elseif ($_GET['localidad'] == 'TOL') {
    // Si es 'TOL', mostrar 'RGD-TOL'
    $localidad_display = 'RGD-TOL';
} else {
    // Si no está vacía y no es 'TOL', usar el valor de localidad recibido
    $localidad_display = $_GET['localidad'];
}


// Ahora, usar la variable $localidad_display para mostrar el texto en el PDF
$pdf->Cell(45, 5, utf8_decode('Localidad: ') . $localidad_display, 0, 0, "L");
  $pdf->Cell(120, 5, "Disposicion:" . $_GET["disposicion"] . " Anexo: " . $_GET["anexo"], 0, 0, "C");
  $pdf->Ln(10); // Espacio adicional antes de la cabecera de la tabla
    // Agregar la cabecera de la tabla
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 5, 'Nro', 1, 0, 'C');
    $pdf->Cell(20, 5, 'LEGAJO', 1, 0, 'C');
    $pdf->Cell(80, 5, 'NOMBRE', 1, 0, 'C');
    $pdf->Cell(25, 5, 'DNI', 1, 0, 'C');
    $pdf->Cell(15, 5, 'TOTAL', 1, 0, 'C');
    $pdf->Cell(50, 5, 'ESCUELA', 1, 1, 'C');

    $nroOrden = 1;
    $contador = 1;

    foreach ($results as $row) {
        if ($contador % 57 == 0) {
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(10, 5, 'Nro', 1, 0, 'C');
            $pdf->Cell(20, 5, 'LEGAJO', 1, 0, 'C');
            $pdf->Cell(80, 5, 'NOMBRE', 1, 0, 'C');
            $pdf->Cell(25, 5, 'DNI', 1, 0, 'C');
            $pdf->Cell(15, 5, 'TOTAL', 1, 0, 'C');
            $pdf->Cell(50, 5, 'ESCUELA', 1, 1, 'C');
        }
       
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 5, $nroOrden, 1, 0, 'C');
        $pdf->Cell(20, 5, $row['legdoc'], 1, 0, 'C');
        $pdf->Cell(80, 5,  utf8_decode($row['ApellidoyNombre']), 1, 0, 'L');
        $pdf->Cell(25, 5, $row['dni'], 1, 0, 'C');
        $pdf->Cell(15, 5, $row['puntajetotal'], 1, 0, 'C');
        $pdf->Cell(50, 5, utf8_decode($row['nomdep']), 1, 1, 'C');
        

        $nroOrden++;
        $contador++;
    }

    ob_end_clean();
    $pdf->Output('D', 'file.pdf');

?>
