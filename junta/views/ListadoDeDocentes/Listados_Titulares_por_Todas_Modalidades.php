<?php
/* 'Listados de Titulares todas las modalidades por escuela solo titulares-Todas las modalidades por escuela (Solo titulares) opcion 2 */
header('Content-Type: text/html; charset=UTF-8');

ob_start ();
require('fpdf.php'); // Ajusta esta ruta según sea necesario

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
        $this->charset = $charset; // Asignar el valor del parámetro $charset a la propiedad $charset

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
$localidad = isset($_GET['localidad']) ? $_GET['localidad'] : '';// ver


$anio = isset($_GET['year']) ? $_GET['year'] : '';
$nota = isset($_GET['nota']) ? $_GET['nota'] : '';

$titulo = isset($_GET['titulo']) ? $_GET['titulo'] : '';
$subtitulo = isset($_GET['subtitulo']) ? $_GET['subtitulo'] : '';
$establecimiento = isset($_POST['itemCode']) ? $_POST['itemCode'] : '';// ver 


$disposicion =isset($_GET['disposicion']) ? $_GET['disposicion'] : '';
$anexo =isset($_GET['anexo']) ? $_GET['anexo'] : '';



$sql_modality = "Select * FROM [Junta].[dbo].[_junta_modalidades] where codmod= '$codmod'";
$sql_modality2 =" select [codniv],[coddep],[nomdep],[codloc],[iddep],[CUISE]
FROM [Junta].[dbo].[_junta_dependencias] where coddep= '$establecimiento'";

// Preparar la consulta parametrizada para obtener datos de la tabla _junta_modalidades

// Validar que $codmod sea un número entero antes de convertirlo
$codmod =  (int)$codmod; // Si no es un número entero, se asigna 0
$establecimiento =(int)$establecimiento;// Si es numérico
$anio = (int)$anio; // Si es numérico

$puntaje_total = 0;
$servicios_provincia = 0;
$promedio2 = 0;
$antiguedad_gestion = 0;
$antiguedad_titulo = 0;

$contador = 1;
$pagina = 1;
$xmodalidad = 0;

try {
    $conexion = new Cconexion("localhost", "junta", "SA", '"asd123"');
    $conn = $conexion->conectar2();


if($conn){
    $query = "SELECT *,(j_mov.titulo + j_mov.otrosantecedentes) as totalodn1
     FROM
            [Junta].[dbo].[_junta_movimientos] j_mov
        INNER JOIN
            [Junta].[dbo].[_junta_docentes] j_doc ON j_mov.legdoc = j_doc.legajo
        WHERE
            j_mov.excluido = '23' AND anodoc ='$anio'AND  establecimiento = $establecimiento ORDER BY j_mov.codmod, j_mov.puntajetotal DESC, totalodn1 DESC, j_mov.concepto DESC, j_mov.serviciosprovincia DESC, j_mov.promedio DESC, j_mov.antiguedadgestion DESC, j_mov.antiguedadtitulo DESC, j_doc.fechatit DESC";
     
     
        // Preparar la consulta
        $stmt = $conn->prepare($query);
                
                
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener los resultados
     
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Crear instancia de FPDF
        $pdf = new FPDF('L', 'mm', 'Legal');
        $pdf->SetFont('Arial', '', 10);

        // Agregar la primera página
        $pdf->AddPage();

        // Encabezado del PDF
        $pdf->SetFont('Arial', '', 28);
        $pdf->Cell(250, 15, $_GET["titulo"], 0, 0, "L");
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
            $pdf->SetFont('Arial', 'I', 12);
            $pdf->Cell(250, 3, "Disposicin:  " . $_GET["disposicion"] . " Anexo: " . $_GET["anexo"], 0, 0, "R");
        } else {
            $pdf->Cell(90, 3, 'Thorne N 1949 Depto 8 (9420) Río Grande', 0, 1, "C");
            $pdf->SetFont('Arial', 'I', 10);
            $pdf->Cell(250, 15, $_GET["subtitulo"], 0, 0, "L");
            $pdf->SetFont('Arial', 'I', 6);
            $pdf->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
            $pdf->SetFont('Arial', 'I', 12);
            $pdf->Cell(250, 3, "Disposicion:  " . $_GET["disposicion"] . " Anexo: " . $_GET["anexo"], 0, 0, "R");
        }

        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(250, 3, 'Nota N: ' . $_GET['nota'], 0, 0, "R");
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
        
        $nroOrden = 1;
        $contador = 1;
        $pagina =1;

        $puntaje_total=0;
        $servicios_provincia=0;
        $promedio2=0;
        $antiguedad_gestion=0;
        $antiguedad_titulo=0;
        $xmodalidad=0;
        $pdf->Ln(); 
        
        $pdf->SetFont('Arial', 'B', 0); // Cambiado a Arial
        // Inicializar una variable para almacenar la modalidad actual
        $modalidad_actual = '';
        foreach ($results as $row) {
           
            if ($row['codmod'] !== $modalidad_actual) {
               // Imprimir la modalidad junto con su nombre
               
                    $pdf->SetFont('Arial', '', 12);
                      // Preparar la consulta SQL para obtener el nombre de la modalidad
                                $sql_modalidad = "SELECT nommod FROM [_junta_modalidades] WHERE codmod = :codmod";

                                // Preparar la consulta parametrizada
                                $stmt_modalidad = $conn->prepare($sql_modalidad);

                                // Asignar el valor del código de modalidad
                                $stmt_modalidad->bindValue(':codmod', $row['codmod'], PDO::PARAM_INT);

                                // Ejecutar la consulta
                                $stmt_modalidad->execute();

                                // Obtener el nombre de la modalidad
                                $nombre_modalidad = $stmt_modalidad->fetchColumn();

                                // Imprimir la modalidad junto con su nombre
                                $pdf->Cell(350, 8, 'Modalidad ' . $row['codmod'] . ' - ' . $nombre_modalidad, 1, 0, "C");


                   // $pdf->Cell(325, 8, 'Modalidad ' . $row['codmod'] . ' - ' . $row['nommod'], 1, 0, "C");
                   
                    $pdf->Ln();
                    $modalidad_actual = $row['codmod']; // Actualizar la modalidad actual

                     // Imprimir encabezado de la tabla
                                $pdf->SetFont('Arial', '', 10);
                                $pdf->Cell(7, 5, "N", 1, 0, "C");
                                $pdf->Cell(15, 5, "LEGAJO", 1, 0, "C");
                                $pdf->Cell(75, 5, "NOMBRE", 1, 0, "C");
                                $pdf->Cell(40, 5, "OBS.", 1, 0, "C");
                                $pdf->Cell(12, 5, "HS.", 1, 0, "C");
                                $pdf->Cell(22, 5, "DNI", 1, 0, "C");
                                $pdf->Cell(14, 5, "TITULO", 1, 0, "C");
                                $pdf->Cell(12, 5, "CONC", 1, 0, "C");
                                $pdf->Cell(20, 5, "SERV.PR.", 1, 0, "C");
                                $pdf->Cell(20, 5, "O. SERV", 1, 0, "C");
                                $pdf->Cell(20, 5, "RESIDENC.", 1, 0, "C");
                                $pdf->Cell(20, 5, "PUBLIC.", 1, 0, "C");
                                $pdf->Cell(23, 5, "O. ANTEC.", 1, 0, "C");
                                $pdf->Cell(15, 5, "TOTAL", 1, 0, "C");
                                $pdf->Cell(30, 5, "NOTIFICADO", 1, 1, "C");
                                $contador = 1; // Reiniciar el contador de filas
                            }

                            // Imprimir detalles del docente
                            $pdf->Cell(7, 5, $contador, 1, 0, "C");
                            $pdf->Cell(15, 5, $row['legdoc'], 1, 0, "C");
                            $pdf->Cell(75, 5, $row['ApellidoyNombre'], 1, 0, "L");
                            $wobs = $row['obs'] != "" ? $row['obs'] : "";
                            $pdf->Cell(40, 5, $wobs, 1, 0, "C");
                            $pdf->Cell(12, 5, $row['horas'], 1, 0, "C");
                            $pdf->Cell(22, 5, $row['dni'], 1, 0, "C");
                            $pdf->Cell(14, 5, $row['titulo'], 1, 0, "C");
                            $pdf->Cell(12, 5, $row['concepto'], 1, 0, "C");
                            $pdf->Cell(20, 5, $row['serviciosprovincia'], 1, 0, "C");
                            $pdf->Cell(20, 5, $row['otrosservicios'], 1, 0, "C");
                            $pdf->Cell(20, 5, $row['residencia'], 1, 0, "C");
                            $pdf->Cell(20, 5, $row['publicaciones'], 1, 0, "C");
                            $pdf->Cell(23, 5, $row['otrosantecedentes'], 1, 0, "C");
                            $pdf->Cell(15, 5, $row['puntajetotal'], 1, 0, "C");
                            $pdf->Cell(30, 5, " ", 1, 0, "C");

                            // Si hay igualdad de mérito, marcar con un asterisco
                            if ((float)$puntaje_total == (float)$row['puntajetotal'] && (float)$servicios_provincia == (float)$row['serviciosprovincia'] && (float)$promedio2 == (float)$row['promedio'] && (float)$antiguedad_gestion == (float)$row['antiguedadgestion'] && (float)$antiguedad_titulo == (float)$row['antiguedadtitulo']) {
                                $pdf->Cell(3, 5, "*", 0, 0, "C");
                            }

                            $pdf->Cell(3, 5, " ", 0, 1, "C");
                            $contador++; // Incrementar el contador de filas
                            // Actualizar valores para la próxima iteración
                            $puntaje_total = (float)$row['puntajetotal'];
                            $servicios_provincia = (float)$row['serviciosprovincia'];
                            $promedio2 = (float)$row['promedio'];
                            $antiguedad_gestion = (float)$row['antiguedadgestion'];
                            $antiguedad_titulo = (float)$row['antiguedadtitulo'];
                        }
                            
                                if ($_GET["tipoc"] === "titulares") {
                                    $textoT = "Ante igualdad de merito se procede conforme lo establecido en el Anexo I de la Resolucion MEyC N 0049/00 Punto 8 Inc. a), b), c)";
                                } else {
                                    $textoT = "Ante igualdad de merito se procede conforme lo establecido en el Anexo I de la Resolucion MEyC N 0050/00 Punto 9 Inc. a), b), c), d)";
                                }
                                
                                $pdf->SetFont('Arial', '', 12);
                                $pdf->Cell(350, 5, $textoT, 1, 1, 'C');
                                
                                // Salida del PDF
                                ob_end_clean();
                            
                                // Output PDF
                                $pdf->Output('D', 'file.pdf');
                            } 
                        } catch (Exception $e) {
                            echo "Error: " . $e->getMessage();
                        }
?>