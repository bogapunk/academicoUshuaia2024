
<?php
header('Content-Type: text/html; charset=UTF-8');
require('fpdf.php'); // Ajusta esta ruta según sea necesario



// Conexiรณn a la base de datos
$servername = "10.1.9.113";
$username = "sa";
$password = "Davinci2024#";
$dbname = "junta"; // Asegรบrate de que este sea el nombre correcto de la base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica si la conexiรณn fue exitosa
if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

// Obtener los valores del formulario
$codmod = $_POST['selected-codmod'];

$tipo = $_POST['tipoc'];
$localidad = $_POST['codloc'];
$anio = $_POST['anio'];
$nota = $_POST['nota'];
$titulos = $_POST['titulos'];
$subtitulo = $_POST['subtitulo'];

$establecimiento = isset($_POST['establecimiento']) ? $_POST['establecimiento'] : '';

$sql_modality = "SELECT codmod, nommod FROM _junta_modalidades where codmod= '$codmod'";

$query33 = "SELECT j_mov.*,(j_mov.titulo + j_mov.otrosantecedentes ) as totalodn1, j_doc.dni, j_doc.ApellidoyNombre 
          FROM _junta_movimientos j_mov
          INNER JOIN _junta_docentes j_doc ON j_mov.legdoc = j_doc.legajo 
          WHERE j_mov.excluido = '23' 
          AND j_mov.codmod = '$codmod' 
          AND j_mov.codloc = '$localidad' 
          AND j_mov.tipo = '$tipo'";

$query = "SELECT j_mov.*, (j_mov.titulo + j_mov.otrosantecedentes) as totalodn1, j_doc.dni, j_doc.ApellidoyNombre, j_doc.dni
           FROM _junta_movimientos j_mov  
           INNER JOIN _junta_docentes j_doc ON j_mov.legdoc = j_doc.legajo   
           WHERE j_mov.excluido = '23' and codmod= '$codmod' and tipo = '$tipo' and anodoc ='$anio'";

$query3 = " AND j_mov.excluido = '23'";

if ($tipo == 'Titular'){
    $query .= " AND j_mov.establecimiento ='$establecimiento' order by j_mov.puntajetotal desc, totalodn1 desc, j_mov.concepto desc, j_mov.serviciosprovincia desc, j_mov.promedio desc, j_mov.antiguedadgestion desc, j_mov.antiguedadtitulo desc, J_doc.fechatit desc";
} else {
    $query .= " order by j_mov.puntajetotal desc, j_mov.serviciosprovincia desc, j_mov.promedio desc, j_mov.antiguedadgestion desc, j_mov.antiguedadtitulo desc, j_doc.fechatit desc";
}


$result = $conn->query($query);
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}


// Crear el PDF en orientaciรณn horizontal (L)
$pdf = new FPDF('L', 'mm', 'Legal');

$pdf->AddPage();

// Agrega la linea que abarca todo el ancho de la pรกgina


$pdf->SetFont('Arial', '', 28);
$pdf->Cell(250, 15, $_POST["titulos"], 0, 0, "L");
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(90, 3, 'JUNTA DE CLASIFICACIรN Y DISCIPLINA NIVEL', 0, 1, "C");
$pdf->Cell(250, 3, '', 0, 0, "L");
$pdf->Cell(90, 3, 'INICIAL, PRIMARIO, MODALIDAD Y GABINETE', 0, 1, "C");
$pdf->Cell(250, 3, '', 0, 0, "L");
$pdf->SetFont('Arial', 'I', 6);

if ($_POST["codloc"] === "USH") {
    $pdf->Cell(90, 3, 'Gdor. Campos N 1443 - Casa 56/57 Tira 11(9410) Ushuaia', 0, 1, "C");
    $pdf->SetFont('Arial', 'I', 18);
    $pdf->Cell(250, 15, $_POST["subtitulo"], 0, 0, "L");
    $pdf->SetFont('Arial', 'I', 6);
    $pdf->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
} else {
    $pdf->Cell(90, 3, 'Thorne N 1949 Depto 8 (9420) Rรญo Grande', 0, 1, "C");
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(250, 15, $_POST["subtitulo"], 0, 0, "L");
    $pdf->SetFont('Arial', 'I', 6);
    $pdf->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
}

$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(250, 3, 'Nota N: ' . $_POST["nota"], 0, 0, "R");
$pdf->SetFont('Arial', 'I', 6);
$pdf->Cell(90, 3, 'Tel. (02901)441443-441447       Internos 1443 - 1447', 0, 1, "C");
$pdf->Cell(250, 3, '', 0, 0, "L");
$pdf->Cell(90, 3, 'juntaegb1y2@gmail.com           e-mail:juntaegb1y2@gmail.com', 0, 1, "C");
// Agrega la linea que abarca todo el ancho de la pรกgina
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->Line($x, $y, $pdf->GetPageWidth() - $x, $y);
$pdf->Ln(); // Salto de linea despues de la lรญnea horizontal
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(30, 5, 'Año: ' . $_POST["anio"], 0, 0, "L");
$pdf->Cell(45, 5, 'Localidad: ' . $_POST["codloc"], 0, 0, "L");
$pdf->Cell(20, 5, 'Modalidad: ' . $_POST["nommod"], 0, 0, "L");
$pdf->Ln(); 
$pdf->Ln(); 
$pdf->SetFont('Arial', 'B', 10); // Cambiado a Arial
$pdf->Cell(10, 5, 'N', 1, 0, 'C');
$pdf->Cell(30,5, 'LEGAJO', 1, 0, 'C');
$pdf->Cell(80, 5, 'NOMBRE', 1, 0, 'C');
$pdf->Cell(20, 5, 'DNI', 1, 0, 'C');
$pdf->Cell(20, 5, 'TITULO', 1, 0, 'C');
$pdf->Cell(20, 5, 'PROMEDIO', 1, 0, 'C');
$pdf->Cell(20, 5, 'ANT.GEST.', 1, 0, 'C');
$pdf->Cell(20, 5, 'ANT. TIT.', 1, 0, 'C');
$pdf->Cell(20, 5, 'SERV.PR.', 1, 0, 'C');
$pdf->Cell(20, 5, 'O. SERV', 1, 0, 'C');
$pdf->Cell(20, 5, 'RESIDENC.', 1, 0, 'C');
$pdf->Cell(20, 5, 'PUBLIC.', 1, 0, 'C');
$pdf->Cell(23, 5, 'O. ANTEC.', 1, 0, 'C');
$pdf->Cell(20, 5, 'TOTAL', 1, 1, 'C'); // Salto de lรญnea al final de la fila
$nroOrden= 1;
$pagina =1;
$contador =1;
class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        global $pagina, $contador;

        // Verificar si es la primera página
        if ($pagina == 1 && $contador==1) {
            // Configuración de la fuente y posición
            $this->SetFont('Arial', '', 28);
            $this->Cell(250, 15, $_POST["titulos"], 0, 0, "L");
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(90, 3, 'JUNTA DE CLASIFICACIÓN Y DISCIPLINA NIVEL', 0, 1, "C");
            $this->Cell(250, 3, '', 0, 0, "L");
            $this->Cell(90, 3, 'INICIAL, PRIMARIO, MODALIDAD Y GABINETE', 0, 1, "C");
            $this->Cell(250, 3, '', 0, 0, "L");
            $this->SetFont('Arial', 'I', 6);

            // Verificar la localidad para mostrar la dirección correspondiente
            if ($_POST["codloc"] === "USH") {
                $this->Cell(90, 3, 'Gdor. Campos N 1443 - Casa 56/57 Tira 11(9410) Ushuaia', 0, 1, "C");
                $this->SetFont('Arial', 'I', 18);
                $this->Cell(250, 15, $_POST["subtitulo"], 0, 0, "L");
                $this->SetFont('Arial', 'I', 6);
                $this->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
            } else {
                $this->Cell(90, 3, 'Thorne N 1949 Depto 8 (9420) Río Grande', 0, 1, "C");
                $this->SetFont('Arial', 'I', 10);
                $this->Cell(250, 15, $_POST["subtitulo"], 0, 0, "L");
                $this->SetFont('Arial', 'I', 6);
                $this->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
            }

            $this->SetFont('Arial', 'I', 10);
            $this->Cell(250, 3, 'Nota N: ' . $_POST["nota"], 0, 0, "R");
            $this->SetFont('Arial', 'I', 6);
            $this->Cell(90, 3, 'Tel. (02901)441443-441447       Internos 1443 - 1447', 0, 1, "C");
            $this->Cell(250, 3, '', 0, 0, "L");
            $this->Cell(90, 3, 'juntaegb1y2@gmail.com           e-mail:juntaegb1y2@gmail.com', 0, 1, "C");
            
            // Agregar la línea que abarca todo el ancho de la página
            $x = $this->GetX();
            $y = $this->GetY();
            $this->Line($x, $y, $this->GetPageWidth() - $x, $y);
            $this->Ln(); // Salto de línea después de la línea horizontal
        }

        // Verificar si es la primera página o si el contador es múltiplo de 31
        if ($pagina == 1 || $contador % 31 == 0) {
            // Configuración de la fuente y posición para la cabecera
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(30, 5, 'Año: ' . $_POST["anio"], 0, 0, "L");
            $this->Cell(45, 5, 'Localidad: ' . $_POST["codloc"], 0, 0, "L");
            $this->Cell(20, 5, 'Modalidad: ' . $_POST["nommod"], 0, 0, "L");
            $this->Ln(); 
            $this->Ln(); 
            $this->SetFont('Arial', 'B', 10); // Cambiado a Arial
            $this->Cell(10, 5, 'N', 1, 0, 'C');
            $this->Cell(30,5, 'LEGAJO', 1, 0, 'C');
            $this->Cell(80, 5, 'NOMBRE', 1, 0, 'C');
            $this->Cell(20, 5, 'DNI', 1, 0, 'C');
            $this->Cell(20, 5, 'TITULO', 1, 0, 'C');
            $this->Cell(20, 5, 'PROMEDIO', 1, 0, 'C');
            $this->Cell(20, 5, 'ANT.GEST.', 1, 0, 'C');
            $this->Cell(20, 5, 'ANT. TIT.', 1, 0, 'C');
            $this->Cell(20, 5, 'SERV.PR.', 1, 0, 'C');
            $this->Cell(20, 5, 'O. SERV', 1, 0, 'C');
            $this->Cell(20, 5, 'RESIDENC.', 1, 0, 'C');
            $this->Cell(20, 5, 'PUBLIC.', 1, 0, 'C');
            $this->Cell(23, 5, 'O. ANTEC.', 1, 0, 'C');
            $this->Cell(20, 5, 'TOTAL', 1, 1, 'C'); // Salto de línea al final de la fila
        }
    }
}
$pdf = new PDF('L', 'mm', 'Legal');;
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10); 
while ($row = $result->fetch_assoc()) {
$pdf->Cell(10, 5, $nroOrden, 1,0, 'C'); // Mostrar el índice incremental
$pdf->Cell(30, 5, $row['legdoc'], 1,0, 'C');
$pdf->Cell(80, 5, $row['ApellidoyNombre'], 1,0, 'L');
$pdf->Cell(20, 5, $row['dni'], 1,0, 'C');
$pdf->Cell(20, 5, $row['titulo'], 1,0, 'C');
$pdf->Cell(20, 5, $row['promedio'], 1,0, 'C');
$pdf->Cell(20, 5, $row['antiguedadgestion'], 1,0, 'C');
$pdf->Cell(20, 5, $row['antiguedadtitulo'], 1,0, 'C');
$pdf->Cell(20, 5, $row['serviciosprovincia'], 1,0, 'C');
$pdf->Cell(20, 5, $row['otrosservicios'], 1,0, 'C');
$pdf->Cell(20, 5, $row['residencia'], 1,0, 'C');
$pdf->Cell(20, 5, $row['publicaciones'], 1,0, 'C');
$pdf->Cell(23, 5, $row['otrosantecedentes'], 1,0, 'C');
$pdf->Cell(20, 5, $row['puntajetotal'], 1,0, 'C');
$nroOrden++; // Incrementar el contador
$contador = $contador +1;
$pdf->Ln();
}


if ($_POST["tipoc"] === "titulares") {
    $textoT = "Ante igualdad de merito se procede conforme lo establecido en el Anexo I de la Resolucion MEyC N 0049/00 Punto 8 Inc. a), b), c)";
} else {
    $textoT = "Ante igualdad de merito se procede conforme lo establecido en el Anexo I de la Resolucion MEyC N 0050/00 Punto 9 Inc. a), b), c), d)";
}

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(343, 5, $textoT, 1, 1, 'C');

$pdf->Output();

$conn->close();
?>
