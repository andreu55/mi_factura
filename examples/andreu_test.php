<?php

$nombre_pdf = 'factura.pdf';

if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$horas = $_POST['horas'];

	$ftemp = explode('-', $_POST['fecha']);
	$fecha = $ftemp[2] . "/" . $ftemp[1] . "/" . $ftemp[0];

	$nombre_pdf = 'fac_' . $id . '.pdf';
}

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Andreu García');
$pdf->SetTitle('Factura Andreu');
$pdf->SetSubject('Factura' . date('Y'));

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'B', 20);
// $pdf->SetFont('helvetica', 'BI', 20);

$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(230,230,230), 'opacity'=>1, 'blend_mode'=>'Normal'));
$pdf->SetFillColor(220, 255, 220);

// add a page
$pdf->AddPage();

// http://www.radmin.com/tcpdf_old/doc/com-tecnick-tcpdf/TCPDF.html#methodCell
// Cell (width, height, $txt, $border [L, T, R, B], $ln [0, 1, 2], $align [L, C, R, J], $fill, $link, $stretch)

// Título
$pdf->SetFont('times', 'B', 19);
$pdf->Cell(90, 0, 'Andreu García Martínez', 0, 0, 'L', 0, '', 1);

$pdf->SetFont('times', 'BI', 19);
$pdf->Cell(90, 0, 'Fac. ' . $id, 0, 1, 'R', 0, '', 1);

$pdf->Cell(0, 2, '', 'T', 1);
// $pdf->Cell(0, 0, '', '', 1);

// Mis datos
$pdf->SetFont('times', 'I', 15);
$pdf->Cell(90, 0, 'C/Cienfuegos 16 - 3', 0, 0, 'L', 0, '', 1);
$pdf->Cell(90, 0, '622 666 125', 0, 1, 'R', 0, '', 1);

$pdf->Cell(90, 0, '46007, Valencia.', 0, 0, 'L', 0, '', 1);
$pdf->Cell(90, 0, 'anduwet2@gmail.com', 0, 1, 'R', 0, '', 1);

$pdf->Ln();

// Facturar a:
$pdf->SetFont('times', 'B', 15);
$pdf->Cell(90, 12, 'Facturar a:', 0, 0, 'L', 0, '', 1);
$pdf->Cell(90, 12, 'Fecha. ' . $fecha, 0, 1, 'R', 0, '', 1);

$pdf->SetFont('times', 'I', 15);
$pdf->Cell(90, 0, 'TAXO Valoración, S.L.', 0, 1, 'L', 0, '', 1);
$pdf->Cell(90, 0, 'Avda. de Aragón 30 F 13', 0, 1, 'L', 0, '', 1);


$pdf->Cell(0, 0, 'Has trabajado ' . $horas . ' horas', 0, 1, 'C', 1, '', 0);

$pdf->Cell(0, 0, ':)', 0, 1, 'C', 0, '', 0);


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output($nombre_pdf, 'I');

//============================================================+
// END OF FILE
//============================================================+
