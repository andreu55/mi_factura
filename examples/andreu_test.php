<?php

$nombre_pdf = 'factura.pdf';

if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$horas = $_POST['horas'];
	$fecha = $_POST['fecha'];
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
$pdf->SetFont('times', 'BI', 20);
// $pdf->SetFont('helvetica', 'B', 20);

$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// add a page
$pdf->AddPage();

// Title
// $pdf->Cell(0, 15, 'Hola Andreu', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Cell(0, 0, 'Hola Andreu', 0, 1, 'C', 0, '', 0);
$pdf->Cell(0, 0, 'Num. factura ' . $id, 0, 1, 'C', 0, '', 0);
$pdf->Cell(0, 0, 'Has trabajado ' . $horas . ' horas', 0, 1, 'C', 0, '', 0);
$pdf->Cell(0, 0, 'Fecha ' . $fecha, 0, 1, 'C', 0, '', 0);
$pdf->Cell(0, 0, ':)', 0, 1, 'C', 0, '', 0);


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output($nombre_pdf, 'I');

//============================================================+
// END OF FILE
//============================================================+
