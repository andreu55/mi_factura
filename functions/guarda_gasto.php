<?php

require_once('../config/db.php');
require_once('../config/helper.php');


if (!isset($_POST['fecha']) || !$_POST['fecha']
 || !isset($_POST['cantidad']) || !$_POST['cantidad']
 || !isset($_POST['iva']) || !$_POST['iva']
 || !isset($_POST['tipo']) || !$_POST['tipo']
 || !isset($_POST['concepto']) || !$_POST['concepto']) {
  echo json_encode(['res' => 400, 'msj' => 'Faltan datos!']);
  exit();
}

$fecha = $_POST['fecha'];
$cantidad = $_POST['cantidad'];
$iva = $_POST['iva'];
$tipo = $_POST['tipo'];
$concepto = $_POST['concepto'];

$sql = "INSERT INTO gastos (fecha, cantidad, iva, concepto, tipo)
  VALUES ('$fecha', $cantidad, $iva, '$concepto', '$tipo')";

if ($db->query($sql) === TRUE) {
    echo json_encode(['res' => 200, 'msj' => 'Ok']);
    exit();
} else {
    echo json_encode(['res' => 400, 'msj' => "Error: " . $sql . "<br>" . $db->error]);
    exit();
}

$db->close();
