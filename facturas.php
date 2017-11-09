<?php

require_once('config/db.php');


// Faltará cargar los datos de la db


$facturas_array = [
  ["005/17", "Taxo Valoración", "30/09/2017", "0", "1600", "1", "0"],
  ["004/17", "Taxo Valoración", "04/08/2017", "290", "15", "1", "0"],
  ["003/17", "Taxo Valoración", "30/05/2017", "100", "51", "1", "0"],
  ["002/17", "Taxo Valoración", "30/04/2017", "100", "51", "1", "0"],
  ["001/17", "Jose Ángel Rodriguez", "30/04/2017", "0", "2000", "1", "1"]
];

$gastos_array = [
  ['01/07/2017', '13.77', '0.21', 'Yoigo', 'servicios'],
  ['01/07/2017', '42.07', '0.21', 'Vodafone', 'servicios'],
  ['03/07/2017', '2.70', '0.10', 'Almuerzo', 'restaurantes'],
  ['04/07/2017', '12', '0.10', 'Almuerzo', 'restaurantes'],
  ['06/07/2017', '3', '0.10', 'Almuerzo', 'restaurantes'],
  ['06/07/2017', '94.90', '0.21', 'PcComponentes HDD Solido', 'hardware'],
  ['06/07/2017', '139', '0.21', 'Amazon Pantalla', 'hardware'],
  ['07/07/2017', '3', '0.10', 'Almuerzo', 'restaurantes'],
  ['11/07/2017', '8.70', '0.10', 'Almuerzo', 'restaurantes'],
  ['12/07/2017', '3', '0.10', 'Almuerzo', 'restaurantes'],
  ['13/07/2017', '6', '0.10', 'Almuerzo', 'restaurantes'],
  ['14/07/2017', '9.6', '0.10', 'Chivito', 'restaurantes'],
  ['17/07/2017', '5.7', '0.10', 'Almuerzo', 'restaurantes'],
  ['18/07/2017', '3', '0.10', 'Almuerzo', 'restaurantes'],
  ['20/07/2017', '3.9', '0.10', 'Almuerzo', 'restaurantes'],
  ['21/07/2017', '2.7', '0.10', 'Almuerzo', 'restaurantes'],
  ['24/07/2017', '2.5', '0.10', 'Almuerzo', 'restaurantes'],
  ['25/07/2017', '2.5', '0.10', 'Almuerzo', 'restaurantes'],
  ['26/07/2017', '2.5', '0.10', 'Almuerzo', 'restaurantes'],
  ['27/07/2017', '10', '0.10', 'Colala', 'restaurantes'],
  ['28/07/2017', '4.8', '0.10', 'Chivito', 'restaurantes'],
  ['01/08/2017', '50.47', '0.21', 'Yoigo', 'servicios'],
  ['01/08/2017', '3.3', '0.10', 'Almuerzo', 'restaurantes'],
  ['02/08/2017', '4', '0.10', 'Almuerzo', 'restaurantes'],
  ['03/08/2017', '3', '0.10', 'Almuerzo', 'restaurantes'],
  ['04/08/2017', '4.8', '0.10', 'Papito', 'restaurantes'],
  ['08/08/2017', '5.5', '0.10', 'Almuerzo', 'restaurantes'],
  ['09/08/2017', '2.5', '0.10', 'Almuerzo', 'restaurantes'],
  ['10/08/2017', '4', '0.10', 'Almuerzo 2 tickets', 'restaurantes'],
  ['11/08/2017', '42.25', '0.21', 'Vodafone', 'servicios'],
  ['16/08/2017', '16.49', '0.21', 'Amazon Prime', 'servicios'],
  ['17/08/2017', '4.8', '0.10', 'Almuerzo 2 tickets', 'restaurantes'],
  ['18/08/2017', '6.7', '0.10', 'Almuerzo 2 tickets', 'restaurantes'],
  ['21/08/2017', '2.68', '0.10', 'Consum', 'restaurantes'],
  ['22/08/2017', '4.5', '0.10', 'Chivito', 'restaurantes'],
  ['23/08/2017', '2.25', '0.10', 'Almuerzo', 'restaurantes'],
  ['24/08/2017', '2.25', '0.10', 'Almuerzo', 'restaurantes'],
  ['25/08/2017', '10', '0.10', 'Aoyama', 'restaurantes'],
  ['25/08/2017', '1.3', '0.10', 'Chivito', 'restaurantes'],
  ['26/08/2017', '6', '0.10', 'Taxi', 'servicios'],
  ['28/08/2017', '2.5', '0.10', 'Almuerzo', 'restaurantes'],
  ['29/08/2017', '2.7', '0.10', 'Almuerzo', 'restaurantes'],
  ['30/08/2017', '3.2', '0.10', 'Almuerzo', 'restaurantes'],
  ['31/08/2017', '5.2', '0.10', 'Almuerzo', 'restaurantes'],
  ['01/09/2017', '2', '0.10', 'Desayuno', 'restaurantes'],
  ['01/09/2017', '4.5', '0.10', 'Chivito', 'restaurantes'],
  ['01/09/2017', '24.5', '0.21', 'Yoigo', 'servicios'],
  ['13/09/2017', '5.1', '0.10', 'Almuerzo', 'restaurantes'],
  ['13/09/2017', '5.1', '0.10', 'Merienda', 'restaurantes'],
  ['14/09/2017', '5.4', '0.10', 'Almuerzo', 'restaurantes'],
  ['14/09/2017', '3', '0.10', 'Almuerzo', 'restaurantes'],
  ['15/09/2017', '4.8', '0.10', 'Chivito', 'restaurantes'],
  ['12/09/2017', '2.6', '0.10', 'Almuerzo', 'restaurantes'],
  ['06/09/2017', '3.4', '0.10', 'Desayuno', 'restaurantes'],
  ['06/09/2017', '2.5', '0.10', 'Almuerzo', 'restaurantes'],
  ['05/09/2017', '3.9', '0.10', 'Almuerzo', 'restaurantes'],
  ['04/09/2017', '2.7', '0.10', 'Almuerzo', 'restaurantes'],
  ['11/09/2017', '2.6', '0.10', 'Almuerzo', 'restaurantes'],
  ['18/09/2017', '2.7', '0.10', 'Almuerzo', 'restaurantes'],
  ['19/09/2017', '2.7', '0.10', 'Almuerzo', 'restaurantes'],
  ['20/09/2017', '5.5', '0.10', 'Almuerzo', 'restaurantes'],
  ['20/09/2017', '250', '0.21', 'Osteopatía', 'baile'],
  ['21/09/2017', '2.7', '0.10', 'Almuerzo', 'restaurantes'],
  ['22/09/2017', '3', '0.10', 'Chivito', 'restaurantes'],
  ['25/09/2017', '2.7', '0.10', 'Almuerzo', 'restaurantes'],
  ['26/09/2017', '2.7', '0.10', 'Almuerzo', 'restaurantes'],
  ['27/09/2017', '2.7', '0.10', 'Almuerzo', 'restaurantes'],
  ['27/09/2017', '42.5', '0.10', 'Clases', 'baile'],
  ['28/09/2017', '2.5', '0.10', 'Almuerzo', 'restaurantes'],
  ['29/09/2017', '4.5', '0.10', 'Chivito', 'restaurantes'],
  ['01/10/2017', '12.7', '0.10', 'Mas de Barberans', 'restaurantes'],
  ['03/10/2017', '3', '0.10', 'Alumuerzo', 'restaurantes'],
  ['03/10/2017', '3.5', '0.10', 'Chivito', 'restaurantes'],
  ['04/10/2017', '3', '0.10', 'Alumuerzo', 'restaurantes'],
  ['04/10/2017', '6.59', '0.10', 'Comida consum', 'restaurantes'],
  ['05/10/2017', '2.7', '0.10', 'Alumuerzo', 'restaurantes'],
  ['06/10/2017', '9.3', '0.10', 'Chivito', 'restaurantes'],
  ['10/10/2017', '2.5', '0.10', 'Alumuerzo', 'restaurantes'],
  ['11/10/2017', '1.5', '0.10', 'Alumuerzo', 'restaurantes'],
  ['13/10/2017', '4.5', '0.10', 'Chivito', 'restaurantes'],
  ['14/10/2017', '14.1', '0.10', 'Comida ZGZ', 'restaurantes'],
  ['14/10/2017', '14', '0.10', 'Comida ZGZ', 'restaurantes'],
  ['15/10/2017', '4', '0.10', 'Comida MUV', 'restaurantes'],
  ['15/10/2017', '10', '0.10', 'Comida MUV', 'restaurantes'],
  ['15/10/2017', '5', '0.10', 'Comida MUV', 'restaurantes'],
  ['16/10/2017', '2.5', '0.10', 'Almuerzo', 'restaurantes'],
  ['17/10/2017', '3', '0.10', 'Alumuerzo', 'restaurantes'],
  ['18/10/2017', '2.7', '0.10', 'Almuerzo', 'restaurantes'],
  ['19/10/2017', '2.5', '0.10', 'Almuerzo', 'restaurantes'],
  ['20/10/2017', '2.35', '0.10', 'Merienda', 'restaurantes'],
  ['20/10/2017', '4.5', '0.10', 'Chivito', 'restaurantes'],
  ['23/10/2017', '2.5', '0.10', 'Almuerzo', 'restaurantes'],
  ['25/10/2017', '7.74', '0.10', 'Comida consum', 'restaurantes'],
  ['26/10/2017', '3', '0.10', 'Almuerzo', 'restaurantes'],

  ['03/11/2017', '25', '0.21', '5 Aniversario BB', 'baile'],
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
  $gastos[$i]->tipo = $g[4];
}

function trimestre($datetime)
{
  $mes = date("m",strtotime($datetime));
  $mes = is_null($mes) ? date('m') : $mes;
  $trim = floor(($mes-1) / 3)+1;
  return $trim;
}
