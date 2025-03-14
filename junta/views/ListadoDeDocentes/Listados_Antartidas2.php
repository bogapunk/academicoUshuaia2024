<?php
    /* Listados Antertidas-Normales  */
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
$localidad = $_GET['localidad'] == 'ant' ? 'Antártida' : $_GET['localidad'];


$anio = isset($_GET['year']) ? $_GET['year'] : '';
$nota = isset($_GET['nota']) ? $_GET['nota'] : '';
$titulo = isset($_GET['titulo']) ? $_GET['titulo'] : '';
$subtitulo = isset($_GET['subtitulo']) ? $_GET['subtitulo'] : '';
$establecimiento = isset($_POST['itemCode']) ? $_POST['itemCode'] : '';// ver 
$hijos =  isset($_GET['hijos']) ? $_GET['hijos'] : '';


$sql_modality = "Select codmod ,nommod FROM [Junta].[dbo].[_junta_modalidades] where codmod= '$codmod'";
$sql_modality2 ="Select [codniv],[coddep],[nomdep],[codloc],[iddep],[CUISE]
FROM [Junta].[dbo].[_junta_dependencias] where coddep= '$establecimiento'";


// Preparar la consulta parametrizada para obtener datos de la tabla _junta_modalidades
// Validar que $codmod sea un número entero antes de convertirlo
$codmod =  (int)$codmod; // Si no es un número entero, se asigna 0
$establecimiento =(int)$establecimiento;// Si es numérico
$anio = (int)$anio; // Si es numérico
try {
    // Crear una instancia de la clase Cconexion
    $conexion = new Cconexion("10.1.9.113", "junta", "SA", 'Davinci2024#');
    // Obtener la conexión usando el método conectar2()

    
    $conn = $conexion->conectar2();
    /* Listados Normales */
    if ($conn) {
        // Construir la consulta con filtros
        $query = "SELECT *,
                 (j_mov.puntajetotal + COALESCE(j_mov2.puntajetotal, 0)) AS combinado 
          FROM [Junta].[dbo].[_junta_movimientos] j_mov
          INNER JOIN [Junta].[dbo].[_junta_docentes] j_doc 
              ON j_mov.legdoc = j_doc.legajo
          INNER JOIN [Junta].[dbo].[_junta_movimientos] j_mov2 
              ON j_mov.legdoc = j_mov2.legvinc
               AND j_mov.anodoc = j_mov2.anodoc  -- Aseguramos que sea el mismo año
          WHERE
              j_mov.codmod= $codmod 
              AND j_mov.tipo = '$tipo' 
              AND j_mov.anodoc = $anio
              AND j_mov.codloc = '$localidad'";

                    if ($tipo == 'titulares') {
                        $query .= " AND j_mov.establecimiento = '$establecimiento' 
                                    ORDER BY j_doc.apellidoynombre, 
                                            j_mov.puntajetotal DESC, 
                                            j_mov.serviciosprovincia DESC, 
                                            j_mov.promedio DESC, 
                                            j_mov.antiguedadgestion DESC, 
                                            j_mov.antiguedadtitulo DESC, 
                                            j_doc.fechatit DESC";
                    } else {
                        $query .= " ORDER BY combinado DESC, 
                                            j_mov.puntajetotal DESC, 
                                            j_mov.serviciosprovincia DESC, 
                                            j_mov.promedio DESC, 
                                            j_mov.antiguedadgestion DESC, 
                                            j_mov.antiguedadtitulo DESC, 
                                            j_doc.fechatit DESC";
                    }

                   
        // Preparar la consulta
        $stmt = $conn->prepare($query);
        
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Crear el objeto FPDF
        $pdf = new FPDF('L', 'mm', 'Legal');
       
        $pdf->AddPage();
        // Encabezado del PDF
        $pdf->SetFont('Arial', '', 28);
        //$pdf->Cell(250, 15, $_GET["titulo"], 0, 0, "L");
        $pdf->Cell(250, 15, utf8_decode($_GET["titulo"]), 0, 0, "L");
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(90, 3, utf8_decode('JUNTA DE CLASIFICACIÓN Y DISCIPLINA NIVEL'), 0, 1, "C");
        $pdf->Cell(250, 3, '', 0, 0, "L");
        $pdf->Cell(90, 3, 'INICIAL, PRIMARIO, MODALIDAD Y GABINETE', 0, 1, "C");
        $pdf->Cell(250, 3, '', 0, 0, "L");
        $pdf->SetFont('Arial', 'I', 6);

        if ($_GET["localidad"] === "ANT") {
            $pdf->Cell(90, 3, 'Gdor. Campos N 1443 - Casa 56/57 Tira 11(9410) Ushuaia', 0, 1, "C");
            $pdf->SetFont('Arial', 'I', 18);
            //$pdf->Cell(250, 15, $_GET["subtitulo"], 0, 0, "L");
            $pdf->Cell(250, 15, utf8_decode($_GET["subtitulo"]), 0, 0, "L");
            $pdf->SetFont('Arial', 'I', 6);
            $pdf->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
        } 

        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(250, 3, utf8_decode('Nota Nº: ') . utf8_decode($_GET['nota']), 0, 0, "R");
        $pdf->SetFont('Arial', 'I', 6);
        $pdf->Cell(90, 3, 'Tel. (02901)441443-441447       Internos 1443 - 1447', 0, 1, "C");
        $pdf->Cell(250, 3, '', 0, 0, "L");
        $pdf->Cell(90, 3, 'Email:juntaegb1y2@gmail.com, Email:juntaegb1y2@gmail.com', 0, 1, "C");

        // Agregar la línea que abarca todo el ancho de la página
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->Line($x, $y, $pdf->GetPageWidth() - $x, $y);
        $pdf->Ln(); // Salto de línea después de la línea horizontal
        $pdf->Ln(); // Salto de línea después de la línea horizontal
        
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(30, 5, utf8_decode('Año: ') . $_GET['year'], 0, 0, "L");
        
        $pdf->Cell(45, 5, utf8_decode('Localidad: ') . $localidad, 0, 0, "L");
        $pdf->Cell(20, 5, utf8_decode('Modalidad: ') . $modalidad, 0, 0, 'L');
        $pdf->Ln(); 
        $pdf->Ln(); 
        $pdf->SetFont('Arial', 'I', 10); // Cambiado a Arial
        // Cabecera de la tabla
        $pdf->Cell(7, 5, iconv('UTF-8', 'ISO-8859-1', 'Nº'), 1, 0, 'C');
        $pdf->Cell(15, 5, 'LEGAJO', 1, 0, 'C');
        $pdf->Cell(53, 5, 'NOMBRE', 1, 0, 'C');
        $pdf->Cell(20, 5, 'DNI', 1, 0, 'C');
        $pdf->Cell(79, 5, 'TITULO', 1, 0, 'C');
        $pdf->Cell(10, 5, 'P.TIT', 1, 0, 'C');
        $pdf->Cell(15, 5, 'PROM.', 1, 0, 'C');
        $pdf->Cell(20, 5, 'ANT.GEST.', 1, 0, 'C');
        $pdf->Cell(12, 5, 'A.TIT.', 1, 0, 'C');
        $pdf->Cell(20, 5, 'SERV.PR', 1, 0, 'C');
        $pdf->Cell(17, 5, 'O. SERV', 1, 0, 'C');
        $pdf->Cell(12, 5, 'RES.', 1, 0, 'C');
        $pdf->Cell(12, 5, 'PUBL.', 1, 0, 'C');
        $pdf->Cell(12, 5, 'O.ANT.', 1, 0, 'C');
        $pdf->Cell(12, 5, 'TOTAL', 1, 0, 'C');
        $pdf->Cell(12, 5, 'HIJOS', 1, 0, 'C');
        $pdf->Cell(15, 5, 'T.COMB.', 1, 0, 'C');


        $pdf->Ln(); 
        $nroOrden = 1;
        $contador = 1;
        $pagina =1;

        class PDF extends FPDF {
            // Cabecera de página
            
            function Header() {
                global $pagina, $contador;
        
                // Verificar si es la primera página
                if ($pagina == 1 && $contador==1) {
                    // Configuración de la fuente y posición
                    $this->SetFont('Arial', '', 28);
                    //$this->Cell(250, 15, $_GET["titulo"], 0, 0, "L");
                    $this->Cell(250, 15, utf8_decode($_GET["titulo"]), 0, 0, "L");
                    $this->SetFont('Arial', 'I', 8);
                    $this->Cell(90, 3, utf8_decode('JUNTA DE CLASIFICACIÓN Y DISCIPLINA NIVEL'), 0, 1, "C");
                    $this->Cell(250, 3, '', 0, 0, "L");
                    $this->Cell(90, 3, 'INICIAL, PRIMARIO, MODALIDAD Y GABINETE', 0, 1, "C");
                    $this->Cell(250, 3, '', 0, 0, "L");
                    $this->SetFont('Arial', 'I', 6);
        
                    // Verificar la localidad para mostrar la dirección correspondiente
                    if ($_GET["localidad"] === "ANT") {
                        $this->Cell(90, 3, 'Gdor. Campos N 1443 - Casa 56/57 Tira 11(9410) Ushuaia', 0, 1, "C");
                        $this->SetFont('Arial', 'I', 18);
                        //$this->Cell(250, 15, $_GET["subtitulo"], 0, 0, "L");
                        $this->Cell(250, 15, utf8_decode($_GET["subtitulo"]), 0, 0, "L");
                        $this->SetFont('Arial', 'I', 6);
                        $this->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
                    
                    }
        
                    $this->SetFont('Arial', 'I', 10);
                    $this->Cell(250, 3, utf8_decode('Nota Nº: ') . utf8_decode($_GET['nota']), 0, 0, "R");

                    $this->SetFont('Arial', 'I', 6);
                    $this->Cell(90, 3, 'Tel. (02901)441443-441447       Internos 1443 - 1447', 0, 1, "C");
                    $this->Cell(250, 3, '', 0, 0, "L");
                    $this->Cell(90, 3, 'Email:juntaegb1y2@gmail.com , Email:juntaegb1y2@gmail.com', 0, 1, "C");
                    // Salto de línea adicional antes de continuar
                    $this->Ln(5); // Puedes ajustar el valor para que se vea bien en el diseño
                    // Agregar la línea que abarca todo el ancho de la página
                    $x = $this->GetX();
                    $y = $this->GetY();
                    $this->Line($x, $y, $this->GetPageWidth() - $x, $y);
                    $this->Ln(); // Salto de línea después de la línea horizontal
                    $pagina++;   
		            $contador=1;
                }
        
                // Verificar si es la primera página o si el contador es múltiplo de 29
                if ($pagina > 1 || $contador % 30 == 0) {
                    // Configuración de la fuente y posición para la cabecera
                    $this->SetFont('Arial', 'I', 10);
                    $this->SetFont('Arial', 'I', 10);
                    $this->Cell(30, 5, utf8_decode('Año: ') . $_GET['year'], 0, 0, "L");
                    $this->Cell(45, 5, utf8_decode('Localidad: ') . utf8_decode($_GET['localidad'] === 'ANT' ? 'Antártida' : $_GET['localidad']), 0, 0, "L");

                    $this->Cell(20, 5, utf8_decode('Modalidad: ') . utf8_decode($_GET['modalidad']), 0, 0, "L");
                    $this->Ln(); 
                    $this->Ln(); 
                    
                    
                    // Salto de línea al final de la fila
                    $this->Ln(); // Salto de línea después de la línea horizontal
                }
            }
        }
        $pdf = new PDF('L', 'mm', 'Legal');;
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 10); 
        
        $nroOrden = 1; // Inicializar el contador de números
        // Recorrer los resultados y generar el PDF
      
// Imprimir la cabecera una sola vez antes del ciclo foreach
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(7, 5, iconv('UTF-8', 'ISO-8859-1', 'Nº'), 1, 0, 'C');
$pdf->Cell(15, 5, 'LEGAJO', 1, 0, 'C');
$pdf->Cell(53, 5, 'NOMBRE', 1, 0, 'C');
$pdf->Cell(20, 5, 'DNI', 1, 0, 'C');
$pdf->Cell(79, 5, 'TITULO', 1, 0, 'C');
$pdf->Cell(10, 5, 'P.TIT', 1, 0, 'C');
$pdf->Cell(15, 5, 'PROM.', 1, 0, 'C');
$pdf->Cell(20, 5, 'ANT.GEST.', 1, 0, 'C');
$pdf->Cell(12, 5, 'A.TIT.', 1, 0, 'C');
$pdf->Cell(20, 5, 'SERV.PR', 1, 0, 'C');
$pdf->Cell(17, 5, 'O. SERV', 1, 0, 'C');
$pdf->Cell(12, 5, 'RES.', 1, 0, 'C');
$pdf->Cell(12, 5, 'PUBL.', 1, 0, 'C');
$pdf->Cell(12, 5, 'O.ANT.', 1, 0, 'C');
$pdf->Cell(12, 5, 'TOTAL', 1, 0, 'C');
$pdf->Cell(12, 5, 'HIJOS', 1, 0, 'C');
$pdf->Cell(15, 5, 'T.COMB.', 1, 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(); // Salto de línea después de la cabecera

// Ahora comienza el ciclo foreach para imprimir los registros
foreach ($results as $index => $row) {
    // Si es necesario agregar una nueva página cada 30 registros
    if ($contador % 30 == 0) {
        $pdf->AddPage(); // Agregar una nueva página
        $pagina++;
    }

    // Determina si es un registro par o impar
    $valorCelda = ($index % 2 == 0) ? $nroOrden++ : "Vin";

    // Primer par de columnas
    $pdf->Cell(7, 5, $valorCelda, 1, 0, 'C');
    $pdf->Cell(15, 5, $row['legdoc'], 1, 0, 'C');
    $pdf->Cell(53, 5, utf8_decode($row['ApellidoyNombre']), 1, 0, 'L');
    $pdf->Cell(20, 5, $row['dni'], 1, 0, 'C');
    $pdf->Cell(79, 5, utf8_decode($row['Titulobas']), 1, 0, 'C');
    if ($codmod == 10) {
        $pdf->Cell(10, 5, $row['titulo'], 1, 0, 'C');
        $pdf->Cell(15, 5, $row['promedio'], 1, 0, 'C');
        $pdf->Cell(20, 5, number_format($row['antiguedadgestion'], 2, '.', ''), 1, 0, 'C');
        $pdf->Cell(12, 5, $row['antiguedadtitulo'], 1, 0, 'C');
    
        $pdf->Cell(20, 5, number_format($row['serviciosprovincia'], 2, '.', ''), 1, 0, 'C');
        $pdf->Cell(17, 5, number_format($row['otrosservicios'], 2, '.', ''), 1, 0, 'C');
        $pdf->Cell(12, 5, number_format($row['residencia'], 2, '.', ''), 1, 0, 'C');
        $pdf->Cell(12, 5, number_format($row['publicaciones'], 2, '.', ''), 1, 0, 'C');
        $pdf->Cell(12, 5, number_format($row['otrosantecedentes'], 2, '.', ''), 1, 0, 'C');
        $pdf->Cell(12, 5, $row['puntajetotal'], 1, 0, 'C');
    } elseif ($codmod == 11) {
        $pdf->Cell(10, 5, $row['titulo'], 1, 0, 'C');
        $pdf->Cell(15, 5, $row['promedio'], 1, 0, 'C');
        $pdf->Cell(20, 5, number_format($row['antiguedadgestion'], 2, '.', ''), 1, 0, 'C');
        $pdf->Cell(12, 5, $row['antiguedadtitulo'], 1, 0, 'C');
    
        $pdf->Cell(20, 5, number_format($row['serviciosprovincia'], 2, '.', ''), 1, 0, 'C');
        $pdf->Cell(17, 5, number_format($row['otrosservicios'], 2, '.', ''), 1, 0, 'C');
        $pdf->Cell(12, 5, number_format($row['residencia'], 2, '.', ''), 1, 0, 'C');
        $pdf->Cell(12, 5, number_format($row['publicaciones'], 2, '.', ''), 1, 0, 'C');
        $pdf->Cell(12, 5, number_format($row['otrosantecedentes'], 2, '.', ''), 1, 0, 'C');
        $pdf->Cell(12, 5, $row['puntajetotal'], 1, 0, 'C');
    }

    // Verificar si es una fila par (índice par) y mostrar hijos y t.comb
    if ($index % 2 == 0) {
        // Si es una fila par, no mostrar los valores de hijos y combinado
        $pdf->Cell(12, 5, '', 1, 0, 'C');
        $pdf->Cell(15, 5, '', 1, 0, 'C');
    } else {
        // Si no es una fila par (índice impar), mostrar los valores de hijos y combinado
        $pdf->Cell(12, 5, $row['hijos'], 1, 0, 'C');
        $pdf->Cell(15, 5, $row['combinado'], 1, 0, 'C');
    }

    // Si es el segundo registro del par, salto de línea
    if ($index % 2 != 0) {
        $pdf->Ln(); // Salto de línea después del segundo registro
    }

    $contador++;
    $pdf->Ln(); // Salto de línea adicional después de cada par de celdas
}

        // Definir el textoT basado en el tipo de listado
    if ($_GET["tipoc"] === "titulares") {
        $textoT = "Ante igualdad de merito se procede conforme lo establecido en el Anexo I de la Resolucion MEyC N 0049/00 Punto 8 Inc. a), b), c)";
    } else {
        $textoT = "Ante igualdad de merito se procede conforme lo establecido en el Anexo I de la Resolucion MEyC N 0050/00 Punto 9 Inc. a), b), c), d)";
    }

    // Añadir el textoT al PDF
    $pdf->SetFont('Arial', '', 9);
    $pdf->MultiCell(0, 10, $textoT, 0, 'C');
    
    // Salida del PDF
    ob_end_clean();
    $pdf->Output('D', 'file.pdf');
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
