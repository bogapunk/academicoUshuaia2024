<?php
/* Listados Modalidades opcion modalidades-opcion 3 Por Modalidad (ciudad unificada) */
header('Content-Type: text/html; charset=UTF-8');

ob_start();
require('fpdf.php'); // Ajusta esta ruta según sea necesario

class Cconexion {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $charset;

    public function __construct($host, $dbname, $username, $password, $charset = 'UTF-8') {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->charset = $charset;
    }

    public function conectar2() {
        try {
            $conn = new PDO("sqlsrv:Server=$this->host;Database=$this->dbname", $this->username, $this->password);
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
$anio = isset($_GET['year']) ? $_GET['year'] : '';
$nota = isset($_GET['nota']) ? $_GET['nota'] : '';
$titulo = isset($_GET['titulo']) ? $_GET['titulo'] : '';
$subtitulo = isset($_GET['subtitulo']) ? $_GET['subtitulo'] : '';
$establecimiento = isset($_POST['itemCode']) ? $_POST['itemCode'] : '';

$sql_modality = "Select [codmod], [nommod] FROM [Junta].[dbo].[_junta_modalidades] where codmod= '$codmod'";
$sql_modality2 = "select [codniv], [coddep], [nomdep], [codloc], [iddep], [CUISE] FROM [Junta].[dbo].[_junta_dependencias] where coddep= '$establecimiento'";

// Validar que $codmod y otros sean números enteros antes de convertirlos
$codmod = (int)$codmod; 
$establecimiento = (int)$establecimiento;
$anio = (int)$anio;

try {
    $conexion = new Cconexion("db", "junta", "SA", '"asd123"');
    $conn = $conexion->conectar2();
    
    if ($conn) {
        $query = "SELECT *,(j_mov.titulo + j_mov.otrosantecedentes) as totalodn1
                  FROM [Junta].[dbo].[_junta_movimientos] j_mov
                  INNER JOIN [Junta].[dbo].[_junta_docentes] j_doc ON j_mov.legdoc = j_doc.legajo
                  WHERE j_mov.excluido = '23' 
                  AND codmod = '$codmod' 
                  AND tipo = '$tipo' 
                  AND anodoc = '$anio' 
                  AND codloc = '$localidad' 
                  ORDER BY codmod, puntajetotal DESC";

        if ($tipo == 'titulares') {
            $titulo = "Inscripcion: Titulares";
        } elseif ($tipo == "transitorio") {
            $titulo = "Inscripción: Interinatos y Suplencias";
        } elseif ($tipo == "permanente") {
            $titulo = "Inscripcion: Permanente";
        } else {
            $titulo = "Inscripcion: Concurso de Titularidad";
        }

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdf = new FPDF('L', 'mm', 'Legal');
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 28);
        $pdf->Cell(250, 15, $titulo, 0, 0, "L");
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(90, 3, 'JUNTA DE CLASIFICACIÓN Y DISCIPLINA NIVEL', 0, 1, "C");
        $pdf->Cell(250, 3, '', 0, 0, "L");
        $pdf->Cell(90, 3, 'INICIAL, PRIMARIO, MODALIDAD Y GABINETE', 0, 1, "C");
        $pdf->Cell(250, 3, '', 0, 0, "L");
        $pdf->SetFont('Arial', 'I', 6);

        if ($_GET["localidad"] === "Ushuaia") {
            $pdf->Cell(90, 3, 'Gdor. Campos N 1443 - Casa 56/57 Tira 11(9410) Ushuaia', 0, 1, "C");
            $pdf->SetFont('Arial', 'I', 18);
            $pdf->Cell(250, 15, $_GET["subtitulo"], 0, 0, "L");
            $pdf->SetFont('Arial', 'I', 6);
            $pdf->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
        } else {
            $pdf->Cell(90, 3, 'Thorne N 1949 Depto 8 (9420) Río Grande', 0, 1, "C");
            $pdf->SetFont('Arial', 'I', 10);
            $pdf->Cell(250, 15, $_GET["subtitulo"], 0, 0, "L");
            $pdf->SetFont('Arial', 'I', 6);
            $pdf->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
        }

        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(250, 3, 'Nota N: ' . $_GET["nota"], 0, 0, "R");
        $pdf->SetFont('Arial', 'I', 6);
        $pdf->Cell(90, 3, 'Tel. (02901)441443-441447       Internos 1443 - 1447', 0, 1, "C");
        $pdf->Cell(250, 3, '', 0, 0, "L");
        $pdf->Cell(90, 3, 'juntaegb1y2@gmail.com           e-mail:juntaegb1y2@gmail.com', 0, 1, "C");

        // Agregar la línea que abarca todo el ancho de la página
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->Line($x, $y, $pdf->GetPageWidth() - $x, $y);
        $pdf->Ln(); // Salto de línea después de la línea horizontal

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(30, 5, 'Ano: ' . $_GET["year"], 0, 0, "L");
        $pdf->Cell(45, 5, 'Localidad: ' . $_GET["localidad"], 0, 0, "L");
        $pdf->Cell(20, 5, 'Modalidad: ' . $_GET["modalidad"], 0, 0, "L");
        $pdf->Ln(); 
        $pdf->Ln(); 
        $pdf->SetFont('Arial', 'B', 10); // Cambiado a Arial

        // Cabecera de la tabla
        $pdf->Cell(10, 5, 'N', 1, 0, 'C');
        $pdf->Cell(30, 5, 'LEGAJO', 1, 0, 'C');
        $pdf->Cell(80, 5, 'NOMBRE', 1, 0, 'C');
        $pdf->Cell(20, 5, 'DNI', 1, 0, 'C');
        $pdf->Cell(20, 5, 'TOTAL', 1, 0, 'C');
        $pdf->Cell(20, 5, 'NOTIFICACION', 1, 0, 'C');

        $pdf->SetFont('Arial', '', 10);

        // Recorrer los resultados y generar el PDF
        $nroOrden = 1; // Inicializar el contador de orden
        foreach ($results as $row) {
            $pdf->Cell(10, 5, $nroOrden, 1, 0, 'C'); // Mostrar el índice incremental
            $pdf->Cell(30, 5, $row['legdoc'], 1, 0, 'C');
            $pdf->Cell(80, 5, $row['ApellidoyNombre'], 1, 0, 'L');
            $pdf->Cell(20, 5, $row['dni'], 1, 0, 'C');
            $pdf->Cell(20, 5, $row['titulo'], 1, 0, 'C');
            $pdf->Cell(20, 5, $row['puntajetotal'], 1, 0, 'C');
            $pdf->Ln();
            $nroOrden++; // Incrementar el contador
        }

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(343, 5, $textoT, 1, 1, 'C');
        
        ob_end_clean();
        $pdf->Output('D', 'file.pdf');
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>