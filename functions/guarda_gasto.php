<?php

require_once('../config/db.php');
require_once('../config/helper.php');

$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : date('Y-m-d');
$cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
$iva = isset($_POST['iva']) ? $_POST['iva'] : 0.10;
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : 'restaurantes';
$concepto = isset($_POST['concepto']) ? $_POST['concepto'] : "Sin concepto";

$sql = "INSERT INTO gastos (fecha, cantidad, iva, concepto, tipo)
  VALUES ('$fecha', $cantidad, $iva, '$concepto', '$tipo')";

if ($db->query($sql) === TRUE) {
    echo "200 OK";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();

header("Location: ../ok.php");
die();
