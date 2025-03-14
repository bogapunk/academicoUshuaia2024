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
$establecimiento = isset($_GET['item_select']) ? $_GET['item_select'] : '';// ver 
 

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
    $conexion = new Cconexion("10.1.9.113", "junta", "SA", 'Davinci2024#');
    $conn = $conexion->conectar2();


if($conn){
                $query = "SELECT *,
                (COALESCE(j_mov.titulo, '') + COALESCE(j_mov.otrosantecedentes, '')) AS totalodn1
            FROM
                [Junta].[dbo].[_junta_movimientos] j_mov
            INNER JOIN
                [Junta].[dbo].[_junta_docentes] j_doc ON j_mov.legdoc = j_doc.legajo
            WHERE
                (j_mov.excluido = '23' OR j_mov.excluido = 'no' OR j_mov.excluido IS NULL) 
                AND anodoc = $anio 
                AND establecimiento = $establecimiento 
                AND codloc = '$localidad' 
            ORDER BY j_mov.codmod, j_mov.puntajetotal DESC, totalodn1 DESC,
                j_mov.concepto DESC, j_mov.serviciosprovincia DESC,
                j_mov.promedio DESC, j_mov.antiguedadgestion DESC,
                j_mov.antiguedadtitulo DESC, j_doc.fingreso asc";//esta modificcacion se debe revisar para ver si esta ok para todos

       


        
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
        //$titulo_utf8 = mb_convert_encoding($titulo, 'UTF-8', 'auto');
       
        $pdf->Cell(250, 15, utf8_decode($_GET["titulo"]), 0, 0, "L");
        
        
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(90, 3,  utf8_decode('JUNTA DE CLASIFICACIÓN Y DISCIPLINA NIVEL'), 0, 1, "C");
        $pdf->Cell(250, 3, '', 0, 0, "L");
        $pdf->Cell(90, 3, 'INICIAL, PRIMARIO, MODALIDAD Y GABINETE', 0, 1, "C");
        $pdf->Cell(250, 3, '', 0, 0, "L");
        $pdf->SetFont('Arial', 'I', 6);
        if ($_GET["localidad"] === "USH") {
            $pdf->Cell(90, 3, 'Gdor. Campos N 1443 - Casa 56/57 Tira 11(9410) Ushuaia', 0, 1, "C");
            $pdf->SetFont('Arial', 'I', 18);
            $pdf->Cell(250, 15, utf8_decode($_GET["subtitulo"]), 0, 0, "L");
            $pdf->SetFont('Arial', 'I', 6);
            $pdf->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
            $pdf->SetFont('Arial', 'I', 12);
           
            $pdf->Cell(250, 3, utf8_decode("Disposición:  " . $disposicion . " Anexo: " . $anexo), 0, 0, "R");
        } else {
            $pdf->Cell(90, 3, 'Thorne N 1949 Depto 8 (9420) Rio Grande', 0, 1, "C");
            $pdf->SetFont('Arial', 'I', 10);
            $pdf->Cell(250, 15, utf8_decode($_GET["subtitulo"]), 0, 0, "L");
            $pdf->SetFont('Arial', 'I', 6);
            $pdf->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
            $pdf->SetFont('Arial', 'I', 12);
            $pdf->Cell(250, 3, utf8_decode("Disposición:  " . $disposicion . " Anexo: " . $anexo), 0, 0, "R");
        }

        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(250, 3, utf8_decode('Nota Nº: ') . utf8_decode($_GET['nota']), 0, 0, "R");
        $pdf->SetFont('Arial', 'I', 6);
        $pdf->Cell(90, 3, 'Tel. (02901)441443-441447       Internos 1443 - 1447', 0, 1, "C");
        $pdf->Cell(250, 3, '', 0, 0, "L");
        $pdf->Cell(90, 3, 'Email:juntaegb1y2@gmail.com -- juntaegb1y2@gmail.com', 0, 1, "C");

        // Agregar la línea que abarca todo el ancho de la página
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->Line($x, $y, $pdf->GetPageWidth() - $x, $y);
        $pdf->Ln(); // Salto de línea después de la línea horizontal

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(30, 5, utf8_decode('Año: ') . $_GET['year'], 0, 0, "L");
        $pdf->Cell(45, 5, utf8_decode('Localidad: ') . $_GET['localidad'], 0, 0, "L");
        
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
        function formatearNumero($numero) {
            // Convertir a número flotante
            $numeroFloat = floatval($numero);
            
            // Verificar si el número tiene parte decimal
            if (floor($numeroFloat) == $numeroFloat) {
                // Es un entero, retornar como entero sin decimales
                return intval($numeroFloat);
            } else {
                // Es un decimal, retornar con dos decimales
                return number_format($numeroFloat, 2);
            }
        }
        $modalidad_actual = '';
        foreach ($results as $row) {
            $codmod = htmlspecialchars($row['codmod'], ENT_QUOTES, 'UTF-8');
               
            if ($row['codmod'] !== $modalidad_actual) {
               // Imprimir la modalidad junto con su nombre
               
                    $pdf->SetFont('Arial', '', 12);
                      // Preparar la consulta SQL para obtener el nombre de la modalidad
                                $sql_modalidad = "SELECT nommod FROM [_junta_modalidades] WHERE codmod = :codmod";

                                // Preparar la consulta parametrizada
                                $stmt_modalidad = $conn->prepare($sql_modalidad);

                                // Asignar el valor del código de modalidad
                                $stmt_modalidad->bindValue(':codmod', utf8_decode($row['codmod']), PDO::PARAM_INT);

                                // Ejecutar la consulta
                                $stmt_modalidad->execute();

                                // Obtener el nombre de la modalidad
                                $nombre_modalidad = $stmt_modalidad->fetchColumn();
                                  
                                 // Convertir el nombre a UTF-8 si es necesario antes de imprimir en el PDF
                                  $nombre_modalidad = utf8_decode($nombre_modalidad);
                                 
                                // Imprimir la modalidad junto con su nombre
                             
                                $pdf->Cell(345, 8, 'Modalidad: ' . $row['codmod'] . ' - ' . $nombre_modalidad, 1, 0, "C");


                   // $pdf->Cell(325, 8, 'Modalidad ' . $row['codmod'] . ' - ' . $row['nommod'], 1, 0, "C");
                   
                    $pdf->Ln();
                    $modalidad_actual = utf8_decode($row['codmod']); // Actualizar la modalidad actual
                
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
                            $pdf->Cell(75, 5, utf8_decode($row['ApellidoyNombre']), 1, 0, "L");
                            $wobs = $row['obs'] != "" ? $row['obs'] : "";
                            $pdf->Cell(40, 5, $wobs, 1, 0, "C");
                            $pdf->Cell(12, 5, $row['horas'], 1, 0, "C");
                            $pdf->Cell(22, 5, $row['dni'], 1, 0, "C");
                            
                            // Aplicar formateo antes de imprimir cada valor
                                    $pdf->Cell(14, 5, formatearNumero($row['titulo']), 1, 0, "C");
                                    $pdf->Cell(12, 5, formatearNumero($row['concepto']), 1, 0, "C");
                                    $pdf->Cell(20, 5, formatearNumero($row['serviciosprovincia']), 1, 0, "C");
                                    $pdf->Cell(20, 5, formatearNumero($row['otrosservicios']), 1, 0, "C");
                                    $pdf->Cell(20, 5, formatearNumero($row['residencia']), 1, 0, "C");
                                    $pdf->Cell(20, 5, formatearNumero($row['publicaciones']), 1, 0, "C");
                                    $pdf->Cell(23, 5, formatearNumero($row['otrosantecedentes']), 1, 0, "C");
                                    $pdf->Cell(15, 5, formatearNumero($row['puntajetotal']), 1, 0, "C");

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
                                $pdf->Cell(345, 5, $textoT, 1, 1, 'C');
                                
                                // Salida del PDF
                                ob_end_clean();
                            
                                // Output PDF
                                $pdf->Output('D', 'file.pdf');
                            } 
                        } catch (Exception $e) {
                            echo "Error: " . $e->getMessage();
                        }
?>