<?php

require_once('../config/db.php');
require_once('../config/helper.php');


if (!isset($_POST['id']) || !$_POST['id']) {
  echo json_encode(['res' => 400, 'msj' => 'Faltan datos!']);
  exit();
}

$id = $_POST['id'];

$sql = "DELETE FROM gastos WHERE id = $id";

if ($db->query($sql) === TRUE) {
    echo json_encode(['res' => 200, 'msj' => 'Ok']);
    exit();
} else {
    echo json_encode(['res' => 400, 'msj' => "Error: " . $sql . "<br>" . $db->error]);
    exit();
}

$db->close();
