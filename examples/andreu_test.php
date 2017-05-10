<?php

$nombre_pdf = 'factura.pdf';

$datos_taxo = ['TAXO Valoración, S.L.', 'Avda. de Aragón 30 F 13'];

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

$pdf->Cell(0, 2, '', 'T', 1); // Linea separadora
// $pdf->Cell(0, 0, '', '', 1);

// Mis datos
$pdf->SetFont('times', 'I', 15);

$pdf->Cell(0, 0, 'NIF: 29196333H', 0, 1, 'L', 0, '', 1);

$pdf->Cell(90, 0, 'Calle Cienfuegos 16, pta 3', 0, 0, 'L', 0, '', 1);
$pdf->Cell(90, 0, '622 666 125', 0, 1, 'R', 0, '', 1);

$pdf->Cell(90, 0, '46007, Valencia.', 0, 0, 'L', 0, '', 1);
$pdf->Cell(90, 0, 'anduwet2@gmail.com', 0, 1, 'R', 0, '', 1);

$pdf->Ln();

// Facturar a:
$pdf->SetFont('times', 'B', 15);
$pdf->Cell(90, 12, 'Facturar a:', 0, 0, 'L', 0, '', 1);
$pdf->Cell(90, 12, 'Fecha. ' . $fecha, 0, 1, 'R', 0, '', 1);

// Datos cliente aqui
$pdf->SetFont('times', 'I', 15);
$pdf->Cell(90, 0, $datos_taxo[0], 0, 1, 'L', 0, '', 1);
$pdf->Cell(90, 0, $datos_taxo[1], 0, 1, 'L', 0, '', 1);

$pdf->Ln();

// bgcolor="#cccccc" colspan="2"

$html = '<table border="1" cellspacing="0" cellpadding="5">
	<tr>
		<th><b>Concepto</b></th>
		<th align="center"><b>Cant.</b></th>
		<th align="center"><b>Base Unit.</b></th>
		<th align="right"><b>Importe</b></th>
	</tr>
	<tr>
		<td>Desarrollo web y bla bla</td>
		<td align="center">'.$horas.'</td>
		<td align="center">15</td>
		<td>4B</td>
	</tr>
	<tr>
		<td></td>
		<td bgcolor="#0000FF" color="yellow" align="center">A2 € &euro; &#8364; &amp; è &egrave;<br/>A2 € &euro; &#8364; &amp; è &egrave;</td>
		<td bgcolor="#FFFF00" align="left"><font color="#FF0000">Red</font> Yellow BG</td>
		<td>4C</td>
	</tr>
	<tr>
		<td>1A</td>
		<td rowspan="2" colspan="2" bgcolor="#FFFFCC">2AA<br />2AB<br />2AC</td>
		<td bgcolor="#FF0000">4D</td>
	</tr>
	<tr>
		<td>1B</td>
		<td>4E</td>
	</tr>
	<tr>
		<td>1C</td>
		<td>2C</td>
		<td>3C</td>
		<td>4F</td>
	</tr>
</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');







$pdf->Cell(0, 0, 'Has trabajado ' . $horas . ' horas', 0, 1, 'C', 1, '', 0);

$pdf->Cell(0, 0, ':)', 0, 1, 'C', 0, '', 0);


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output($nombre_pdf, 'I');

//============================================================+
// END OF FILE
//============================================================+
