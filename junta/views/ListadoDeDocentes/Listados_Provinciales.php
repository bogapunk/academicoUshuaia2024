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
$localidad = isset($_GET['localidad']) ? $_GET['localidad'] : '';// ver


$anio = isset($_GET['year']) ? $_GET['year'] : '';
$nota = isset($_GET['nota']) ? $_GET['nota'] : '';
$titulo = isset($_GET['titulo']) ? $_GET['titulo'] : '';
$subtitulo = isset($_GET['subtitulo']) ? $_GET['subtitulo'] : '';
$establecimiento = isset($_POST['itemCode']) ? $_POST['itemCode'] : '';// ver 

$prov = isset($_POST['prov']) ? $_POST['prov'] : '';
$legdoc = isset($_POST['legdoc']) ? $_POST['legdoc'] : '';


// Verificar si el ID 'prov' está presente
if (!empty($prov)) {
    $sql_listado_generales = "SELECT modalidades, ciudad FROM [Junta].[dbo].[_junta_listadosgenerales] WHERE id = :prov";

    $conexion = new Cconexion("10.1.9.113", "junta", "SA", 'Davinci2024#');

    try {
        $conn = $conexion->conectar2();
        $stmt = $conn->prepare($sql_listado_generales);
        $stmt->bindParam(':prov', $prov, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($results) > 0) {
            $row = $results[0];
            // Procesar las modalidades
            $modalidades = str_replace("-", ",", $row['modalidades']);
            if (substr($modalidades, -1) == "-") {
                $modalidades = substr($modalidades, 0, -1);
            }

            // Procesar las ciudades
            $ciudad = explode("-", $row['ciudad']);
            $ciudad_str = implode("','", array_map('trim', $ciudad));
        } else {
            echo "No data found";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    echo "No ID provided";
    exit;
}

// Convertir los valores a enteros para mayor seguridad
$codmod = (int)$codmod;
$anio = (int)$anio;

try {
    $conexion = new Cconexion("10.1.9.113", "junta", "SA", 'Davinci2024#');
    $conn = $conexion->conectar2();

    $query = "SELECT DISTINCT
            j_doc.dni, 
            j_doc.ApellidoyNombre, 
            j_mov.legdoc, 
            j_mov.puntajetotal, 
            j_mov.establecimiento,
            (j_mov.titulo + j_mov.otrosantecedentes) as totalodn1,
            j_mov.serviciosprovincia,
            j_mov.concepto,
            j_dep.nomdep,
            j_dep.coddep,
            j_mov.antiguedadgestion,
            j_mov.promedio,
            j_doc.fechatit
        FROM [Junta].[dbo].[_junta_movimientos] j_mov
        INNER JOIN [Junta].[dbo].[_junta_docentes] j_doc ON j_mov.legdoc = j_doc.legajo
        INNER JOIN [Junta].[dbo].[_junta_dependencias] j_dep ON j_mov.establecimiento = j_dep.coddep
        WHERE 
            j_mov.codmod IN ($modalidades) AND
            j_mov.codloc IN ('$ciudad_str') AND
            j_mov.anodoc = :anio AND
            j_mov.tipo = 'titulares'
        ORDER BY
            j_mov.puntajetotal DESC,
            totalodn1 DESC,
            j_mov.concepto DESC,
            j_mov.serviciosprovincia DESC,
            j_mov.promedio DESC,
            j_mov.antiguedadgestion DESC,
            j_doc.fechatit DESC";


$stmt = $conn->prepare($query);
$stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdf = new FPDF('P', 'mm', 'Legal');
    $pdf->SetFont('Arial', '', 10);
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 28);
    $pdf->Cell(120, 15, $_GET["titulo"], 0, 0, "L");
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(90, 3, 'JUNTA DE CLASIFICACIÓN Y DISCIPLINA NIVEL', 0, 1, "C");
    $pdf->Cell(120, 3, '', 0, 0, "L");
    $pdf->Cell(90, 3, 'INICIAL, PRIMARIO, MODALIDAD Y GABINETE', 0, 1, "C");
    $pdf->Cell(120, 3, '', 0, 0, "L");
    $pdf->SetFont('Arial', 'I', 6);
    if ($_GET["localidad"] === "USH") {
        $pdf->Cell(90, 3, 'Gdor. Campos N 1443 - Casa 56/57 Tira 11(9410) Ushuaia', 0, 1, "C");
        $pdf->SetFont('Arial', 'I', 18);
        $pdf->Cell(120, 15, $_GET["subtitulo"], 0, 0, "L");
        $pdf->SetFont('Arial', 'I', 6);
        $pdf->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
        $pdf->SetFont('Arial', 'I', 12);
        $pdf->Cell(120, 3, "Disposicin:  " . $_GET["disposicion"] . " Anexo: " . $_GET["anexo"], 0, 0, "R");
    } else {
        $pdf->Cell(90, 3, 'Thorne N 1949 Depto 8 (9420) Rio Grande', 0, 1, "C");
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(120, 15, $_GET["subtitulo"], 0, 0, "L");
        $pdf->SetFont('Arial', 'I', 6);
        $pdf->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
        $pdf->SetFont('Arial', 'I', 12);
        $pdf->Cell(120, 3, "Disposicion:  " . $_GET["disposicion"] . " Anexo: " . $_GET["anexo"], 0, 0, "R");
    }

    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(120, 3, utf8_decode('Nota Nº: ') . utf8_decode($_GET['nota']), 0, 0, "R");

    $pdf->SetFont('Arial', 'I', 6);
    $pdf->Cell(90, 3, 'Tel. (02901)441443-441447       Internos 1443 - 1447', 0, 1, "C");
    $pdf->Cell(120, 3, '', 0, 0, "L");
    $pdf->Cell(90, 3, ' Email: juntaegb1y2@gmail.com -- juntaegb1y2@gmail.com', 0, 1, "C");

    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->Line($x, $y, $pdf->GetPageWidth() - $x, $y);
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(30, 5, utf8_decode('Año: ') . $_GET['year'], 0, 0, "L");
    $pdf->Cell(45, 5, utf8_decode('Localidad: ') . $_GET['localidad'], 0, 0, "L");
    $pdf->Ln(10); // Espacio adicional antes de la cabecera de la tabla

    // Agregar la cabecera de la tabla
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(7, 5, 'Nro', 1, 0, 'C');
    $pdf->Cell(20, 5, 'LEGAJO', 1, 0, 'C');
    $pdf->Cell(80, 5, 'NOMBRE', 1, 0, 'C');
    $pdf->Cell(25, 5, 'DNI', 1, 0, 'C');
    $pdf->Cell(15, 5, 'TOTAL', 1, 0, 'C');
    $pdf->Cell(50, 5, 'ESCUELA', 1, 1, 'C');

    $nroOrden = 1;
    $contador = 1;

    foreach ($results as $row) {
        if ($contador % 62 == 0) {
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(7, 5, 'Nro', 1, 0, 'C');
            $pdf->Cell(20, 5, 'LEGAJO', 1, 0, 'C');
            $pdf->Cell(80, 5, 'NOMBRE', 1, 0, 'C');
            $pdf->Cell(25, 5, 'DNI', 1, 0, 'C');
            $pdf->Cell(15, 5, 'TOTAL', 1, 0, 'C');
            $pdf->Cell(40, 5, 'ESCUELA', 1, 1, 'C');
        }
      
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(7, 5, $nroOrden, 1, 0, 'C');
        $pdf->Cell(20, 5, $row['legdoc'], 1, 0, 'C');
        $pdf->Cell(80, 5, $row['ApellidoyNombre'], 1, 0, 'L');
        $pdf->Cell(25, 5, $row['dni'], 1, 0, 'C');
        $pdf->Cell(15, 5, $row['puntajetotal'], 1, 0, 'C');
        $pdf->Cell(50, 5, $row['nomdep'], 1, 1, 'C');
        

        $nroOrden++;
        $contador++;
    }

    ob_end_clean();
    $pdf->Output('D', 'file.pdf');
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
