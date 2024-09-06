<?php
    /* Listados Excluidos - listado 6- opcion-excluido*/
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
$establecimiento = isset($_POST['itemCode']) ? $_POST['itemCode'] : '';// ver 



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
        $query = "SELECT *
        FROM
            [Junta].[dbo].[_junta_movimientos] j_mov
        INNER JOIN
            [Junta].[dbo].[_junta_docentes] j_doc ON j_mov.legdoc = j_doc.legajo
        INNER JOIN 
        [Junta].[dbo].[_junta_motivosexclusion] j_motexc ON j_mov.excluido = j_motexc.idexclu

        INNER JOIN 
        [Junta].[dbo].[_junta_modalidades] J_mod ON j_mod.codmod = j_mov.codmod
        WHERE
            j_mov.excluido <> '23'  and tipo = '$tipo' and anodoc = $anio and codloc='$localidad' ";

         if ($tipo == 'titulares') {
            $query .= " AND establecimiento = $establecimiento  ORDER BY j_doc.apellidoynombre, j_mov.puntajetotal desc, j_mov.serviciosprovincia desc, j_mov.promedio desc, j.mov.antiguedadgestion desc, j_mov.antiguedadtitulo desc, j_doc.fechatit desc";
         
        }else{
            
            $query .= "ORDER BY j_doc.ApellidoyNombre, j_mov.puntajetotal desc, j_mov.serviciosprovincia desc, j_mov.promedio desc, j_mov.antiguedadgestion desc, j_mov.antiguedadtitulo desc, j_doc.fechatit desc";
          
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
        $pdf->Cell(250, 15, $_GET["titulo"] . ' EXCLUIDOS!!!!!!!!!!!!', 0, 0, "L");
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(90, 3, 'JUNTA DE CLASIFICACIÓN Y DISCIPLINA NIVEL', 0, 1, "C");
        $pdf->Cell(250, 3, '', 0, 0, "L");
        $pdf->Cell(90, 3, 'INICIAL, PRIMARIO, MODALIDAD Y GABINETE', 0, 1, "C");
        $pdf->Cell(250, 3, '', 0, 0, "L");
        $pdf->SetFont('Arial', 'I', 6);

        if ($_GET['localidad'] === "Ushuaia") {
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
      // Mostrar "Interinatos y Suplencias" si el tipo de listado es "transitorio"
        $tipoListado = $_GET["tipoc"] == "transitorio" ? "Interinatos y Suplencias" : $_GET["tipoc"];
        $pdf->Cell(20, 5, 'Tipo de Listado: ' . $tipoListado, 0, 0, "L");
        $pdf->Ln(); 
        $pdf->Ln(); 
        $pdf->SetFont('Arial', 'B', 9); // Cambiado a Arial
        // Cabecera de la tabla
        $pdf->Cell(10, 5, 'N', 1, 0, 'C');
        $pdf->Cell(16, 5, 'LEGAJO', 1, 0, 'C');
        $pdf->Cell(70, 5, 'NOMBRE', 1, 0, 'C');
        $pdf->Cell(25, 5, 'DNI', 1, 0, 'C');
        $pdf->Cell(120, 5, 'CARGO', 1, 0, 'C');
        $pdf->Cell(100, 5, 'MOTIVOS', 1, 0, 'C');
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
                    $this->Cell(250, 15, $_GET["titulo"] . ' EXCLUIDOS', 0, 0, "L");
                    $this->SetFont('Arial', 'I', 8);
                    $this->Cell(90, 3, 'JUNTA DE CLASIFICACIÓN Y DISCIPLINA NIVEL', 0, 1, "C");
                    $this->Cell(250, 3, '', 0, 0, "L");
                    $this->Cell(90, 3, 'INICIAL, PRIMARIO, MODALIDAD Y GABINETE', 0, 1, "C");
                    $this->Cell(250, 3, '', 0, 0, "L");
                    $this->SetFont('Arial', 'I', 6);
        
                    // Verificar la localidad para mostrar la dirección correspondiente
                    if ($_GET["localidad"] === "Ushuaia") {
                        $this->Cell(90, 3, 'Gdor. Campos N 1443 - Casa 56/57 Tira 11(9410) Ushuaia', 0, 1, "C");
                        $this->SetFont('Arial', 'I', 18);
                        $this->Cell(250, 15, $_GET["subtitulo"], 0, 0, "L");
                        $this->SetFont('Arial', 'I', 6);
                        $this->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
                    } else {
                        $this->Cell(90, 3, 'Thorne N 1949 Depto 8 (9420) Río Grande', 0, 1, "C");
                        $this->SetFont('Arial', 'I', 10);
                        $this->Cell(250, 15, $_GET["subtitulo"], 0, 0, "L");
                        $this->SetFont('Arial', 'I', 6);
                        $this->Cell(90, 3, 'Tierra del Fuego', 0, 1, "C");
                    }
        
                    $this->SetFont('Arial', 'I', 10);
                    $this->Cell(250, 3, 'Nota N: ' . $_GET['nota'], 0, 0, "R");
                    $this->SetFont('Arial', 'I', 6);
                    $this->Cell(90, 3, 'Tel. (02901)441443-441447       Internos 1443 - 1447', 0, 1, "C");
                    $this->Cell(250, 3, '', 0, 0, "L");
                    $this->Cell(90, 3, 'juntaegb1y2@gmail.com           e-mail:juntaegb1y2@gmail.com', 0, 1, "C");
                    
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
                    $this->SetFont('Arial', 'B', 10);
                    $this->Cell(30, 5, 'Ano: ' . $_GET["year"], 0, 0, "L");
                    $this->Cell(45, 5, 'Localidad: ' . $_GET["localidad"], 0, 0, "L");
                    $tipoListado = $_GET["tipoc"] == "transitorio" ? "Interinatos y Suplencias" : $_GET["tipoc"];
                    $this->Cell(20, 5, 'Tipo de Listado: ' . $tipoListado, 0, 0, "L");
                    $this->Ln(); 
                    $this->Ln(); 
                    $this->SetFont('Arial', 'B', 9); // Cambiado a Arial
                    $this->Cell(10, 5, 'N', 1, 0, 'C');
                    $this->Cell(16,5, 'LEGAJO', 1, 0, 'C');
                    $this->Cell(70, 5, 'NOMBRE', 1, 0, 'C');
                    $this->Cell(25, 5, 'DNI', 1, 0, 'C');
                    $this->Cell(120, 5, 'CARGO', 1, 0, 'C');
                    $this->Cell(100, 5, 'MOTIVO', 1, 0, 'C');// Salto de línea al final de la fila
                    $this->Ln(); // Salto de línea después de la línea horizontal
                }
            }
        }
        $pdf = new PDF('L', 'mm', 'Legal');;
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 10); 
        
      


        // Recorrer los resultados y generar el PDF
        foreach ($results as $row) {
            if ($contador % 30 == 0) {
                $pdf->AddPage(); // Agregar una nueva página cuando sea necesario
                $pagina++;
            }
            $pdf->Cell(10, 5, $nroOrden, 1, 0, 'C'); // Mostrar el índice incremental
            $pdf->Cell(16, 5, $row['legdoc'], 1, 0, 'C');
            $pdf->Cell(70, 5, $row['ApellidoyNombre'], 1, 0, 'L');
            $pdf->Cell(25, 5, $row['dni'], 1, 0, 'C');
            $pdf->Cell(120, 5, substr($row['nommod'], 0, 40), 1, 0, 'C');
            $pdf->Cell(100, 5, $row['motivo'], 1, 0, 'C');
            $nroOrden++; // Incrementar el contador
            $contador++;
            $pdf->Ln();

    
        }
    
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(350,5,"Todas las modalidades en un mismo listado",1,1,'C');
        // Salida del PDF
        ob_end_clean();
             
        // Output PDF
        $pdf->Output('D', 'file.pdf');
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
