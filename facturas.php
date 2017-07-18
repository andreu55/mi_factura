
<?php

$facturas_array = [
  ["001/17", "Jose Ángel Rodriguez", "30/04/2017", "0", "2000", "1", "1"],
  ["002/17", "Taxo Valoración", "30/04/2017", "100", "51", "1", "0"],
  ["003/17", "Taxo Valoración", "30/05/2017", "100", "51", "1", "0"],
  ["004/17", "O'Clock Digital", "30/06/2017", "90", "15", "0", "0"],
];

$servicios = [
  ['01/07/2017', '42.07', '0.21', 'Vodafone', 'servicios'],
];

$hardware = [
  ['06/07/2017', '94.90', '0.21', 'PcComponentes HDD Solido', 'hardware'],
  ['06/07/2017', '139', '0.21', 'Amazon Pantalla', 'hardware'],
];

$restaurantes = [
  ['03/07/2017', '2.70', '0.10', 'Almuerzo', 'restaurantes'],
  ['04/07/2017', '12', '0.10', 'Almuerzo', 'restaurantes'],
  ['06/07/2017', '3', '0.10', 'Almuerzo', 'restaurantes'],
  ['07/07/2017', '3', '0.10', 'Almuerzo', 'restaurantes'],
  ['11/07/2017', '8.70', '0.10', 'Almuerzo', 'restaurantes'],
  ['12/07/2017', '3', '0.10', 'Almuerzo', 'restaurantes'],
  ['13/07/2017', '6', '0.10', 'Almuerzo', 'restaurantes'],
  ['14/07/2017', '9.6', '0.10', 'Chivito', 'restaurantes'],
  ['17/07/2017', '5.7', '0.10', 'Almuerzo', 'restaurantes'],
  ['18/07/2017', '3', '0.10', 'Almuerzo', 'restaurantes'],
];


$gastos_array = array_merge($servicios, $hardware, $restaurantes);


foreach ($facturas_array as $i => $f) {
  $facturas[$i] = new stdClass;
  $facturas[$i]->id = $f[0]; // Num factura
  $facturas[$i]->cliente = $f[1];
  $facturas[$i]->fecha = $f[2];
  $facturas[$i]->horas = $f[3]; // Cantidad / Horas
  $facturas[$i]->precio = $f[4]; // Precio por hora / Precio final (si 'cantidad' = 0)
  $facturas[$i]->pagada = $f[5]; // Pagada?
  $facturas[$i]->persona_fisica = $f[6]; // Persona fisica? (Para retener irpf o no!)
}

foreach ($gastos_array as $i => $g) {
  $gastos[$i] = new stdClass;
  $gastos[$i]->fecha = $g[0];
  $gastos[$i]->cantidad = $g[1];
  $gastos[$i]->iva = $g[2];
  $gastos[$i]->concepto = $g[3];
  $gastos[$i]->tipo = $g[4];
}

function trimestre($datetime)
{
  $mes = date("m",strtotime($datetime));
  $mes = is_null($mes) ? date('m') : $mes;
  $trim = floor(($mes-1) / 3)+1;
  return $trim;
}
