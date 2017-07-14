
<?php

$facturas_array = [
  ["001/17", "Jose Ángel Rodriguez", "30/04/2017", "0", "2000", "1", "1"],
  ["002/17", "Taxo Valoración", "30/04/2017", "100", "51", "1", "0"],
  ["003/17", "Taxo Valoración", "30/05/2017", "100", "51", "1", "0"],
  ["004/17", "O'Clock Digital", "30/06/2017", "90", "15", "0", "0"],
];

$gastos_array = [
  ['01/07/2017', '42.07', '0.21', 'Vodafone'],
  ['06/07/2017', '94.90', '0.21', 'Pc Componentes'],
  ['11/07/2017', '8.70', '0.21', 'Café'],
  ['12/07/2017', '3', '0.21', 'Café'],
  ['13/07/2017', '6', '0.21', 'Café'],
];


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
}
