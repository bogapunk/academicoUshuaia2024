<?php
    /* Listados Normales-litado 2- opciones normal  */
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
$modalidad = isset($_GET['modalidad']) ? utf8_decode($_GET['modalidad']) : '';




$tipo = isset($_GET['tipoc']) ? $_GET['tipoc'] : '';
$localidad = isset($_GET['localidad']) ? $_GET['localidad'] : '';// ver


$anio = isset($_GET['year']) ? $_GET['year'] : '';
$nota = isset($_GET['nota']) ? $_GET['nota'] : '';
$titulo = isset($_GET['titulo']) ? $_GET['titulo'] : '';
$subtitulo = isset($_GET['subtitulo']) ? $_GET['subtitulo'] : '';
$establecimiento = isset($_POST['itemCode']) ? $_POST['itemCode'] : '';// ver 



$sql_modality = "Select [codmod] ,[nommod] FROM [Junta].[dbo].[_junta_modalidades] where codmod= '$codmod'";
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
        $query = "SELECT *,(j_mov.titulo + j_mov.otrosantecedentes) as totalodn1
        FROM
            [Junta].[dbo].[_junta_movimientos] j_mov
        INNER JOIN
            [Junta].[dbo].[_junta_docentes] j_doc ON j_mov.legdoc = j_doc.legajo
        WHERE
        
            (j_mov.excluido = '23'or j_mov.excluido = 'no' or  j_mov.excluido IS NULL) and codmod= $codmod and tipo = '$tipo' and anodoc = $anio and codloc='$localidad' ";
       
         if ($tipo == 'titulares') {
            $query .= " AND establecimiento = $establecimiento order by j_mov.puntajetotal desc, totalodn1 desc, j_mov.concepto desc, j_mov.serviciosprovincia desc, j_mov.promedio desc, j_mov.antiguedadgestion desc, j_mov.antiguedadtitulo desc, J_doc.fechatit desc";
         
        }else{
            
            $query .= " ORDER BY j_mov.puntajetotal DESC, j_mov.serviciosprovincia DESC, j_mov.promedio DESC, j_mov.antiguedadgestion DESC, j_mov.antiguedadtitulo DESC, j_doc.fechatit DESC";
          
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
        $pdf->Cell(250, 15, utf8_decode($_GET["titulo"]), 0, 0, "L");

        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(90, 3, utf8_decode('JUNTA DE CLASIFICACIÓN Y DISCIPLINA NIVEL'), 0, 1, "C");
        $pdf->Cell(250, 3, '', 0, 0, "L");
        $pdf->Cell(90, 3, 'INICIAL, PRIMARIO, MODALIDAD Y GABINETE', 0, 1, "C");
        $pdf->Cell(250, 3, '', 0, 0, "L");
        $pdf->SetFont('Arial', 'I', 6);

        if ($_GET['localidad'] === "USH ") {
            $pdf->Cell(90, 3, 'Gdor. Campos N 1443 - Casa 56/57 Tira 11(9410) Ushuaia', 0, 1, "C");
            $pdf->SetFont('Arial', 'I', 18);
            $pdf->Cell(250, 15, utf8_decode($_GET["subtitulo"]), 0, 0, "L");
            $pdf->SetFont('Arial', 'I', 10);
      $pdf->Cell(90, 15,"Fecha:  ". date("d/m/Y"), 0, 0, "R"); 

            $pdf->SetFont('Arial', 'I', 6);
            $pdf->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
        } else {
            $pdf->Cell(90, 3, 'Thorne N 1949 Depto 8 (9420) Río Grande', 0, 1, "C");
            $pdf->SetFont('Arial', 'I', 10);
            $pdf->Cell(250, 15, utf8_decode($_GET["subtitulo"]), 0, 0, "L");

            $pdf->SetFont('Arial', 'I', 6);
            $pdf->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
        }

        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(250, 3, utf8_decode('Nota Nº: ') . utf8_decode($_GET['nota']), 0, 0, "R");
        $pdf->SetFont('Arial', 'I', 6);
        $pdf->Cell(90, 3, 'Tel. (02901)441443-441447       Internos 1443 - 1447', 0, 1, "C");
        $pdf->Cell(250, 3, '', 0, 0, "L");
        $pdf->Cell(90, 3, 'Email:juntaegb1y2@gmail.com ,Email:juntaegb1y2@gmail.com', 0, 1, "C");
        
        // Agregar la línea que abarca todo el ancho de la página
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->Line($x, $y, $pdf->GetPageWidth() - $x, $y);
        $pdf->Ln(); // Salto de línea después de la línea horizontal
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(30, 5, utf8_decode('Año: ') . $_GET['year'], 0, 0, "L");
        $pdf->Cell(45, 5, utf8_decode('Localidad: ') . $_GET['localidad'], 0, 0, "L");
        $pdf->Cell(20, 5, utf8_decode('Modalidad: ') . $modalidad, 0, 0, 'C');
        $pdf->Ln(); 
        $pdf->Ln(); 
        $pdf->SetFont('Arial', 'B', 10); // Cambiado a Arial

        // Cabecera de la tabla
        $pdf->Cell(10, 5, 'N', 1, 0, 'C');
        $pdf->Cell(30, 5, 'LEGAJO', 1, 0, 'C');
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
        $pdf->Cell(20, 5, 'TOTAL', 1, 0, 'C');
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
                    $this->Cell(250, 15, utf8_decode($_GET['titulo']), 0, 0, "L");

                    $this->SetFont('Arial', 'I', 8);
                    $this->Cell(90, 3, utf8_decode('JUNTA DE CLASIFICACIÓN Y DISCIPLINA NIVEL'), 0, 1, "C");
                    $this->Cell(250, 3, '', 0, 0, "L");
                    $this->Cell(90, 3, 'INICIAL, PRIMARIO, MODALIDAD Y GABINETE', 0, 1, "C");
                    $this->Cell(250, 3, '', 0, 0, "L");
                    $this->SetFont('Arial', 'I', 6);
        
                    // Verificar la localidad para mostrar la dirección correspondiente
                    if ($_GET['localidad'] === "USH") {
                        $this->Cell(90, 3, 'Gdor. Campos N 1443 - Casa 56/57 Tira 11(9410) Ushuaia', 0, 1, "C");
                        $this->SetFont('Arial', 'I', 18);
                        $this->Cell(250, 15, utf8_decode($_GET['subtitulo']), 0, 0, "L");

                        $this->SetFont('Arial', 'I', 6);
                        $this->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
                    } else {
                        
                        $this->Cell(90, 3, utf8_decode('Thorne N 1949 Depto 8 (9420) Río Grande'), 0, 1, "C");
                        $this->SetFont('Arial', 'I', 10);
                        $this->Cell(250, 15, utf8_decode($_GET['subtitulo']), 0, 0, "L");

                        $this->SetFont('Arial', 'I', 6);
                        $this->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
                    }
        
                    $this->SetFont('Arial', 'I', 10);
                    $this->Cell(250, 3, utf8_decode('Nota Nº: ') . utf8_decode($_GET['nota']), 0, 0, "R");
                    $this->SetFont('Arial', 'I', 6);
                    $this->Cell(90, 3, 'Tel. (02901)441443-441447       Internos 1443 - 1447', 0, 1, "C");
                    $this->Cell(250, 3, '', 0, 0, "L");
                    $this->Cell(90, 3, 'Email:juntaegb1y2@gmail.com, Email:juntaegb1y2@gmail.com', 0, 1, "C");
                    
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
                    $this->Cell(30, 5, utf8_decode('Año: ') . $_GET['year'], 0, 0, "L");
                    $this->Cell(45, 5, utf8_decode('Localidad: ') . utf8_decode($_GET['localidad']), 0, 0, "L");
                    $this->Cell(20, 5, utf8_decode('Modalidad: ') . utf8_decode($_GET['modalidad']), 0, 0, "L");
                    $this->Ln(); 
                    $this->Ln(); 
                    $this->SetFont('Arial', 'B', 10); // Cambiado a Arial
                    $this->Cell(10, 5, utf8_decode('Nº'), 1, 0, 'C');
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
         
        function formatearNumero($numero) {
            // Convertir a número flotante
            $numeroFloat = floatval($numero);
            
            // Verificar si el número tiene parte decimal
            if (floor($numeroFloat) == $numeroFloat) {
                // Es un entero
                return intval($numeroFloat); // Devuelve como entero
            } else {
                // Es un decimal
                return number_format($numeroFloat, 2); // Devuelve como decimal con dos decimales
            }
        }


        // Recorrer los resultados y generar el PDF
        foreach ($results as $row) {
              // Usar la función formatearNumero() para cada campo numérico
                            $tituloFormateado = formatearNumero($row['titulo']);
                            $otroServicioFormateado = formatearNumero($row['otrosservicios']);
                            $residenciaFormateada = formatearNumero($row['residencia']);
                            $puntajeTotalFormateado = formatearNumero($row['puntajetotal']);
                            
                            // Aplicar la función formatearNumero() a los campos adicionales
                            $promedioFormateado = formatearNumero($row['promedio']);
                            $antiguedadGestionFormateada = formatearNumero($row['antiguedadgestion']);
                            $antiguedadTituloFormateada = formatearNumero($row['antiguedadtitulo']);
                            $serviciosProvinciaFormateado = formatearNumero($row['serviciosprovincia']);
                            $publicacionesFormateadas = formatearNumero($row['publicaciones']);
                            $otrosAntecedentesFormateados = formatearNumero($row['otrosantecedentes']);

                            // Generar las celdas del PDF con los valores formateados
                            $pdf->Cell(10, 5, $nroOrden, 1, 0, 'C'); // Mostrar el índice incremental
                            $pdf->Cell(30, 5, $row['legdoc'], 1, 0, 'C');
                            $pdf->Cell(80, 5, utf8_decode($row['ApellidoyNombre']), 1, 0, 'L');
                            $pdf->Cell(20, 5, $row['dni'], 1, 0, 'C');
                            $pdf->Cell(20, 5, $tituloFormateado, 1, 0, 'C'); // Usar el valor formateado
                            $pdf->Cell(20, 5, $promedioFormateado, 1, 0, 'C'); // Usar el valor formateado
                            $pdf->Cell(20, 5, $antiguedadGestionFormateada, 1, 0, 'C'); // Usar el valor formateado
                            $pdf->Cell(20, 5, $antiguedadTituloFormateada, 1, 0, 'C'); // Usar el valor formateado
                            $pdf->Cell(20, 5, $serviciosProvinciaFormateado, 1, 0, 'C'); // Usar el valor formateado
                            $pdf->Cell(20, 5, $otroServicioFormateado, 1, 0, 'C'); // Usar el valor formateado
                            $pdf->Cell(20, 5, $residenciaFormateada, 1, 0, 'C'); // Usar el valor formateado
                            $pdf->Cell(20, 5, $publicacionesFormateadas, 1, 0, 'C'); // Usar el valor formateado
                            $pdf->Cell(23, 5, $otrosAntecedentesFormateados, 1, 0, 'C'); // Usar el valor formateado
                            $pdf->Cell(20, 5, $puntajeTotalFormateado, 1, 0, 'C'); // Usar el valor formateado
                            $nroOrden++; // Incrementar el contador
                            $contador++;
                            $pdf->Ln();

               // Agregar la lógica para dibujar el asterisco si se cumplen las condiciones
               if ($puntaje_total == $row['puntajetotal'] &&
               $servicios_provincia == $row['serviciosprovincia'] &&
               $promedio2 == $row['promedio'] &&
               $antiguedad_gestion == $row['antiguedadgestion'] &&
               $antiguedad_titulo == $row['antiguedadtitulo']) {
           
               // Dibujar el asterisco
               $pdf->Cell(3, 5, "*", 0, 0, "C");
           }


        }
        if ($_GET["tipoc"] === "titulares") {
            $textoT = "Ante igualdad de merito se procede conforme lo establecido en el Anexo I de la Resolucion MEyC N 0049/00 Punto 8 Inc. a), b), c)";
        } else {
            $textoT = "Ante igualdad de merito se procede conforme lo establecido en el Anexo I de la Resolucion MEyC N 0050/00 Punto 9 Inc. a), b), c), d)";
        }
        
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(343, 5, $textoT, 1, 1, 'C');
        
        // Salida del PDF
        ob_end_clean();
    
        // Output PDF
        $pdf->Output('D', 'file.pdf');
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
