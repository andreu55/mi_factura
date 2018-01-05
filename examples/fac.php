<?php

$nombre_pdf = 'factura.pdf';
$iva = 21;
$ret_irpf = 7;

if (isset($_POST['id'])) {

	$concepto = $_POST['concepto'];

	if (!$concepto) {
		$concepto = 'Desarrollo web';
		// $concepto = 'Consultoría informática';
	}

	switch ($_POST['cliente']) {
		// $cliente = ['B98893639', 'O´Clock Digital Solutions S.L.', 'Avenida Aragón, 30 Bajo', '46021, Valencia'];
		case '1': $cliente = ['B98893639', 'O´Clock Digital Solutions S.L.', 'Avenida Aragón, 30 Bajo, Valencia']; break;
		case '2': $cliente = ['B96735576', 'TAXO Valoración, S.L.', 'Avda. de Aragón 30 F 13, Valencia']; break;
		case '3': $cliente = ['B98537004', 'Nemesis media, S.L', 'Calle Flora 1 9, Valencia']; break;
		case '4': $cliente = ['15255691K', 'Jose Ángel Rodriguez González', 'Avenida Aragón, 30 Bajo, Valencia']; break;
	}

	$ultimo_char_nif = substr($cliente[0], -1);

	// Si no es numeric es una persona física (asique no le retenemos irpf)
	if (!is_numeric($ultimo_char_nif)) { $ret_irpf = 0; }

	$precio = $_POST['precio'];

	// Si le ponemos las horas cobramos por hora
	if ($_POST['horas']) {
		$horas = $_POST['horas'];
		$base_unit = round($precio, 2); // Lo que vale la hora
		$importe = $horas * $base_unit;
		$cabecera_tabla = ["Concepto & Descripción", "Cant.", "Precio", "Importe"];
	}

	// Sino tiene horas es una cantidad fija
	else {
		$importe = $precio;
		$horas = '';
		$base_unit = '';
		$cabecera_tabla = ["Concepto & Descripción", "", "", "Importe"];
	}


	$base_imponible = $importe;
	$importe_iva = round(($base_imponible*$iva)/100, 2);
	$importe_irpf = round(($base_imponible*$ret_irpf)/100, 2);
	$importe_total = $base_imponible + $importe_iva - $importe_irpf;

	$ftemp = explode('-', $_POST['fecha']);
	$fecha = $ftemp[2] . "/" . $ftemp[1] . "/" . $ftemp[0];
	$any = $ftemp[0];
	$any_sm = substr($ftemp[0], -2);


	// Rellenado de ceros hacia la izquierda
	$id = str_pad($_POST['id'],  3, "0", STR_PAD_LEFT);
	$id_factura = $id . '/' . $any_sm;


	$id_nombre_factura = $id . '-' . $any_sm;
	$nombre_pdf = 'fac_' . $id_nombre_factura . '.pdf';
}

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Andreu García');
$pdf->SetTitle('Factura Andreu');
$pdf->SetSubject('Factura' . $any);

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
if (@file_exists(dirname(__FILE__).'/lang/spa.php')) {
	require_once(dirname(__FILE__).'/lang/spa.php');
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
$pdf->Cell(90, 0, 'Fac. ' . $id_factura, 0, 1, 'R', 0, '', 1);

$pdf->Cell(0, 0, '', 'T', 1); // Linea separadora
// $pdf->Cell(0, 0, '', '', 1);

// Mis datos
$pdf->SetFont('times', 'I', 15);

$pdf->Cell(0, 0, 'NIF: 29196333H', 0, 1, 'L', 0, '', 1);

$pdf->Cell(90, 0, 'Calle Cienfuegos 16, pta 3', 0, 0, 'L', 0, '', 1);
$pdf->Cell(90, 0, '622 666 125', 0, 1, 'R', 0, '', 1);

$pdf->Cell(90, 0, '46006, Valencia.', 0, 0, 'L', 0, '', 1);
$pdf->Cell(90, 0, 'anduwet2@gmail.com', 0, 1, 'R', 0, '', 1);

$pdf->Ln();

// Facturar a:
$pdf->SetFont('times', 'B', 15);
$pdf->Cell(90, 12, 'Facturar a:', 0, 0, 'L', 0, '', 1);
$pdf->Cell(90, 12, 'Fecha ' . $fecha, 0, 1, 'R', 0, '', 1);

// Datos cliente aqui
$pdf->SetFont('times', 'I', 15);
$pdf->Cell(90, 0, 'NIF: ' . $cliente[0], 0, 1, 'L', 0, '', 1);
// $pdf->Cell(90, 0, 'Pagadero a la recepción', 0, 1, 'R', 0, '', 1);

$pdf->Cell(90, 0, $cliente[1], 0, 1, 'L', 0, '', 1);
// $pdf->Cell(90, 0, 'Vencimiento ' . $fecha, 0, 1, 'R', 0, '', 1);


$pdf->Cell(90, 0, $cliente[2], 0, 1, 'L', 0, '', 1);

if (isset($cliente[3]) && $cliente[3]) {
	$pdf->Cell(90, 0, $cliente[3], 0, 1, 'L', 0, '', 1);
}


$pdf->Ln(15);
$pdf->SetFont('helvetica', '', 15);

// bgcolor="#cccccc" colspan="2" rowspan="2"
// font-weight: bold;



$html = '<style>
th {
	border-bottom: 1px solid #000;
	font-size: 15px;
	color: #B5B5B5;
}
</style>
<table border="0" cellspacing="0" cellpadding="5">
	<tr id="hola">
		<th colspan="2">' . $cabecera_tabla[0] . '</th>
		<th align="center">' . $cabecera_tabla[1] . '</th>
		<th align="center">' . $cabecera_tabla[2] . '</th>
		<th align="right">' . $cabecera_tabla[3] . '</th>
	</tr>
	<tr>
		<td colspan="2" style="font-style: italic;">' . $concepto . '</td>
		<td align="center">' . $horas . '</td>
		<td align="center">' . $base_unit . '</td>
		<td align="right">' . $importe . '</td>
	</tr>
	<tr><td colspan="5"></td></tr>
	<tr>
		<td colspan="2"></td>
		<td colspan="2" align="right">Base imponible</td>
		<td align="right">' . number_format(($base_imponible), 2) . '</td>
	</tr>
	<tr>
	<td colspan="4" align="right">IVA ' . $iva . '%</td>
	<td align="right">' . number_format(($importe_iva), 2) . '</td>
	</tr>
	<tr>
		<td colspan="4" align="right">IRPF ' . $ret_irpf . '%</td>
		<td align="right"> -' . number_format(($importe_irpf), 2) . '</td>
	</tr>
	<tr>
		<td colspan="4" align="right"><b>Total</b></td>
		<td align="right"><b>' . number_format(($importe_total), 2) . ' €</b></td>
	</tr>
</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


$pdf->SetFont('times', 'BI', 14);
$pdf->Cell(0, 0, 'Forma de pago', 0, 1, 'L', 0, '', 1);

$pdf->SetFont('times', 'I', 13);
$pdf->Cell(0, 0, 'Transferencia bancaria', 0, 1, 'L', 0, '', 1);

$pdf->Ln(5);

// $pdf->SetFont('times', 'BI', 14);
// $pdf->Cell(0, 0, 'Cuenta bancaria de pago', 0, 1, 'L', 0, '', 1);
// $pdf->Ln(2);

$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 0, 'Openbank', 0, 1, 'L', 0, '', 1);

$pdf->Ln(1);

$pdf->SetFont('helvetica', '', 13);
$pdf->Cell(0, 0, 'IBAN ES1800730100500560829887', 0, 1, 'L', 0, '', 1);




// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output($nombre_pdf, 'I');

//============================================================+
// END OF FILE
//============================================================+
