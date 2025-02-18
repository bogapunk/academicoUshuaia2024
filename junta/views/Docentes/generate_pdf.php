<?php
require('../ListadoDeDocentes/fpdf.php');

// Crear una nueva instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Configuración del documento
$pdf->SetTitle('Informacion del Docente');
$pdf->SetFont('Arial', 'B', 18);

// Agregar un título
$pdf->Cell(190, 10, 'JUNTA DE CLASIFICACIONES 2025', 0, 1, 'C');
$pdf->Cell(190, 10, 'Informacion del Docente', 0, 1, 'C');

// Espacio entre el título y la tabla
$pdf->Ln(10);

// Datos de la URL
$legajo = $_GET['legajo'];
$apellidoynombre = $_GET['apellidoynombre'];
$dni = $_GET['dni'];
$domicilio = $_GET['domicilio'];
$lugarinsc = $_GET['lugarinsc'];
$fechanacim = date('d-m-Y', strtotime($_GET['fechanacim']));
$promedioT = number_format($_GET['promedioT'], 2, '.', '');
$telefonos = $_GET['telefonos'];
$Titulobas = $_GET['Titulobas'];
$fechatit = date('d-m-Y', strtotime($_GET['fechatit']));
$otorgadopor = $_GET['otorgadopor'];
$finicio = date('d-m-Y', strtotime($_GET['finicio']));
$otrostit = $_GET['otrostit'];
$fingreso = date('d-m-Y', strtotime($_GET['fingreso']));
$cargosdocentes = $_GET['cargosdocentes'];
$faperturaleg = date('d-m-Y', strtotime($_GET['faperturaleg']));
$Nacionalidad = $_GET['Nacionalidad'];
$email = $_GET['email'];
$obsdoc = $_GET['obsdoc'];

// Configuración de la tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFont('Arial', 'U', 20); // 'U' habilita el subrayado y tamaño de 18

// Mostrar "Datos Personales" subrayado y centrado
$pdf->Cell(190, 15, 'Datos Personales', 0, 1, 'C');

// Si quieres dibujar una línea debajo del texto:
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Línea desde 10 en X hasta 200 en X en la misma Y
// Datos en la tabla
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(95, 10, 'Legajo', 1, 0, 'L');
$pdf->Cell(95, 10, $legajo, 1, 1, 'L');

$pdf->Cell(95, 10, 'Apellido y Nombre', 1, 0, 'L');
$pdf->Cell(95, 10, utf8_decode($apellidoynombre), 1, 1, 'L');

$pdf->Cell(95, 10, 'DNI', 1, 0, 'L');
$pdf->Cell(95, 10, $dni, 1, 1, 'L');

$pdf->Cell(95, 10, 'Domicilio', 1, 0, 'L');
$pdf->Cell(95, 10, $domicilio, 1, 1, 'L');

$pdf->Cell(95, 10, 'Lugar Inscripcion', 1, 0, 'L');
$pdf->Cell(95, 10, $lugarinsc, 1, 1, 'L');

$pdf->Cell(95, 10, 'Fecha Nacimiento', 1, 0, 'L');
$pdf->Cell(95, 10, $fechanacim, 1, 1, 'L');

$pdf->Cell(95, 10, 'Promedio', 1, 0, 'L');
$pdf->Cell(95, 10, $promedioT, 1, 1, 'L');

$pdf->Cell(95, 10, 'Telefono', 1, 0, 'L');
$pdf->Cell(95, 10, $telefonos, 1, 1, 'L');

$pdf->Cell(95, 10, 'Titulo Basico', 1, 0, 'L');
$pdf->Cell(95, 10, $Titulobas, 1, 1, 'L');

$pdf->Cell(95, 10, 'Fecha Titulo', 1, 0, 'L');
$pdf->Cell(95, 10, $fechatit, 1, 1, 'L');

$pdf->Cell(95, 10, 'Otorgado Por', 1, 0, 'L');
$pdf->Cell(95, 10, $otorgadopor, 1, 1, 'L');

$pdf->Cell(95, 10, 'Fecha Inicio Docencia', 1, 0, 'L');
$pdf->Cell(95, 10, $finicio, 1, 1, 'L');

$pdf->Cell(95, 10, 'Otros Titulos', 1, 0, 'L');
$pdf->Cell(95, 10, $otrostit, 1, 1, 'L');

$pdf->Cell(95, 10, 'Fecha Ingreso', 1, 0, 'L');
$pdf->Cell(95, 10, $fingreso, 1, 1, 'L');

$pdf->Cell(95, 10, 'Cargo Docente', 1, 0, 'L');
$pdf->Cell(95, 10, $cargosdocentes, 1, 1, 'L');

$pdf->Cell(95, 10, 'Fecha Apertura Legajo', 1, 0, 'L');
$pdf->Cell(95, 10, $faperturaleg, 1, 1, 'L');

$pdf->Cell(95, 10, 'Nacionalidad', 1, 0, 'L');
$pdf->Cell(95, 10, $Nacionalidad, 1, 1, 'L');

$pdf->Cell(95, 10, 'Email', 1, 0, 'L');
$pdf->Cell(95, 10, $email, 1, 1, 'L');

$pdf->Cell(95, 10, 'Observaciones', 1, 0, 'L');
$pdf->Cell(95, 10, utf8_decode($obsdoc), 1, 1, 'L');

// Salida del PDF (mostrarlo en el navegador)
$pdf->Output('docente_info.pdf', 'I');
?>