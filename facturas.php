<?php

require_once('config/db.php');
require_once('config/helper.php');

$year = date('Y');
$num_facturas = 0;

// Contamos cuantas facturas hay en total (independiente del año que sea)
$sql = "SELECT count(*) FROM facturas";
$num_facturas = $db->query($sql)->fetch_array()[0];


// Cargamos las facturas
$sql = "SELECT * FROM facturas WHERE fecha BETWEEN '$year-01-01' AND '$year-12-31' ORDER BY fecha DESC, id DESC";
$sqlres = $db->query($sql);

if ($sqlres->num_rows > 0) {
  $i = 0;
  while($r = $sqlres->fetch_array()) {
    $facturas[$i] = new stdClass;
    $facturas[$i]->id = $r['num']; // Num factura
    $facturas[$i]->cliente = $r['cliente'];
    $facturas[$i]->fecha = sqlToHuman($r['fecha']);
    $facturas[$i]->fecha_sql = $r['fecha'];
    $facturas[$i]->horas = $r['horas']; // Cantidad / Horas
    $facturas[$i]->precio = $r['precio']; // Precio por hora / Precio final (si 'cantidad' = 0)
    $facturas[$i]->pagada = $r['pagada']; // Pagada?
    $facturas[$i]->persona_fisica = $r['persona_fisica']; // Persona fisica? (Para retener irpf o no!)
    $i++;
  }
}

// Cargamos las gastos
$sql = "SELECT * FROM gastos WHERE fecha BETWEEN '$year-01-01' AND '$year-12-31' ORDER BY fecha DESC, id DESC";
$sqlres = $db->query($sql);

if ($sqlres->num_rows > 0) {
  $i = 0;
  while($r = $sqlres->fetch_array()) {
    $gastos[$i] = new stdClass;
    $gastos[$i]->id = $r['id'];
    $gastos[$i]->fecha = sqlToHuman($r['fecha']);
    $gastos[$i]->fecha_sql = $r['fecha'];
    $gastos[$i]->cantidad = $r['cantidad'];
    $gastos[$i]->iva = $r['iva'];
    $gastos[$i]->concepto = $r['concepto'];
    $gastos[$i]->tipo = $r['tipo'];
    $i++;
  }
}
