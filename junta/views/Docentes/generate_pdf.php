<?php
//require_once('../tcpdf/tcpdf.php');
require_once('tcpdf/tcpdf.php');
// Crear nueva instancia de TCPDF
$pdf = new TCPDF();

// Configuración del PDF
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Autor del Documento');
$pdf->SetTitle('Información del Docente');
$pdf->SetSubject('Informe del Docente');
$pdf->SetKeywords('TCPDF, PDF, ejemplo, prueba');

// Agregar una página
$pdf->AddPage();
// Obtener los datos de la URL
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

// Crear una nueva instancia de TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Configuración del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nombre del Autor');
$pdf->SetTitle('Documento PDF');
$pdf->SetSubject('Información del Docente-junta de clasificacion 2024');

$pdf->SetKeywords('TCPDF, PDF, docente, información');

// Configuración de márgenes
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Configuración de fuente
$pdf->SetFont('helvetica', '', 12);

// Añadir una página
$pdf->AddPage();

// Contenido del PDF
$html = <<<EOD
<center><h1>JUNTA DE CLASIFICACION 2024 </h1></center>
<center><h2>Informacion del Docente </h2></center>
<table border="1" cellpadding="5">
    <tr>
        <th style="text-align:left;">Legajo</th>
        <td>{$legajo}</td>
    </tr>
    <tr>
        <th style="text-align:left;">Apellido y Nombre</th>
        <td>{$apellidoynombre}</td>
    </tr>
    <tr>
        <th style="text-align:left;">DNI</th>
        <td>{$dni}</td>
    </tr>
    <tr>
        <th style="text-align:left;">Domicilio</th>
        <td>{$domicilio}</td>
    </tr>
    <tr>
        <th style="text-align:left;">Lugar Inscripción</th>
        <td>{$lugarinsc}</td>
    </tr>
    <tr>
        <th style="text-align:left;">Fecha Nacimiento</th>
        <td>{$fechanacim}</td>
    </tr>
    <tr>
        <th style="text-align:left;">Promedio</th>
        <td>{$promedioT}</td>
    </tr>
    <tr>
        <th style="text-align:left;">Teléfono</th>
        <td>{$telefonos}</td>
    </tr>
    <tr>
        <th style="text-align:left;">Título Básico</th>
        <td>{$Titulobas}</td>
    </tr>
    <tr>
        <th style="text-align:left;">Fecha Título</th>
        <td>{$fechatit}</td>
    </tr>
    <tr>
        <th style="text-align:left;">Otorgado Por</th>
        <td>{$otorgadopor}</td>
    </tr>
    <tr>
        <th style="text-align:left;">Fecha Inicio Docencia</th>
        <td>{$finicio}</td>
    </tr>
    <tr>
        <th style="text-align:left;">Otros Títulos</th>
        <td>{$otrostit}</td>
    </tr>
    <tr>
        <th style="text-align:left;">Fecha Ingreso</th>
        <td>{$fingreso}</td>
    </tr>
    <tr>
        <th style="text-align:left;">Cargo Docente</th>
        <td>{$cargosdocentes}</td>
    </tr>
    <tr>
        <th style="text-align:left;">Fecha Apertura Legajo</th>
        <td>{$faperturaleg}</td>
    </tr>
    <tr>
        <th style="text-align:left;">Nacionalidad</th>
        <td>{$Nacionalidad}</td>
    </tr>
    <tr>
        <th style="text-align:left;">Email</th>
        <td>{$email}</td>
    </tr>
    <tr>
        <th style="text-align:left;">Observaciones</th>
        <td>{$obsdoc}</td>
    </tr>
</table>
EOD;

// Escribir el contenido del PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Enviar el PDF al navegador como descarga
$pdf->Output('docente_info.pdf', 'I'); // 'server juntas 2024' para descargar
?>
