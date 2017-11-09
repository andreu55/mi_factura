<?php

require_once('db.php');

// Reset tables
if ($conn->query("DROP TABLE facturas, gastos") === TRUE) { echo "Droped tables<br>"; }
else { echo "Error droping: " . $conn->error; }

// Migration

// Creamos tabla facturas
$sql = "CREATE TABLE facturas (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  num VARCHAR(30) NOT NULL,
  cliente VARCHAR(255) NOT NULL,
  fecha DATE NOT NULL,
  horas SMALLINT UNSIGNED NOT NULL,
  precio DECIMAL UNSIGNED NOT NULL,
  pagada TINYINT UNSIGNED NOT NULL,
  persona_fisica TINYINT UNSIGNED NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table facturas created successfully<br>";
} else {
    exit("Error creating facturas: " . $conn->error);
}


// Creamos tabla gastos
$sql = "CREATE TABLE gastos (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  fecha DATE NOT NULL,
  cantidad DECIMAL(10,2) UNSIGNED NOT NULL,
  iva DECIMAL(10,2) UNSIGNED NOT NULL,
  concepto VARCHAR(255) NOT NULL,
  tipo VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table gastos created successfully<br>";
} else {
    exit("Error creating gastos: " . $conn->error);
}





// Seeding

// Facturas
$sql = "INSERT INTO facturas (num, cliente, fecha, horas, precio, pagada, persona_fisica) VALUES
  ('001/17', 'Jose Ángel Rodriguez', '2017-04-30', '0', '2000', '1', '1'),
  ('002/17', 'Taxo Valoración', '2017-04-30', '100', '51', '1', '0'),
  ('003/17', 'Taxo Valoración', '2017-05-30', '100', '51', '1', '0'),
  ('004/17', 'Taxo Valoración', '2017-08-04', '290', '15', '1', '0'),
  ('005/17', 'Taxo Valoración', '2017-09-30', '0', '1600', '1', '0')
";

if ($conn->query($sql) === TRUE) {
    echo "Facturas seeded<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Gastos
$sql = "INSERT INTO gastos (fecha, cantidad, iva, concepto, tipo) VALUES
  ('2017-07-01', '13.77', '0.21', 'Yoigo', 'servicios'),
  ('2017-07-01', '42.07', '0.21', 'Vodafone', 'servicios'),
  ('2017-07-03', '2.70', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-07-04', '12', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-07-06', '3', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-07-06', '94.90', '0.21', 'PcComponentes HDD Solido', 'hardware'),
  ('2017-07-06', '139', '0.21', 'Amazon Pantalla', 'hardware'),
  ('2017-07-07', '3', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-07-11', '8.70', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-07-12', '3', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-07-13', '6', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-07-14', '9.6', '0.10', 'Chivito', 'restaurantes'),
  ('2017-07-17', '5.7', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-07-18', '3', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-07-20', '3.9', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-07-21', '2.7', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-07-24', '2.5', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-07-25', '2.5', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-07-26', '2.5', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-07-27', '10', '0.10', 'Colala', 'restaurantes'),
  ('2017-07-28', '4.8', '0.10', 'Chivito', 'restaurantes'),
  ('2017-08-01', '50.47', '0.21', 'Yoigo', 'servicios'),
  ('2017-08-01', '3.3', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-08-02', '4', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-08-03', '3', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-08-04', '4.8', '0.10', 'Papito', 'restaurantes'),
  ('2017-08-08', '5.5', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-08-09', '2.5', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-08-10', '4', '0.10', 'Almuerzo 2 tickets', 'restaurantes'),
  ('2017-08-11', '42.25', '0.21', 'Vodafone', 'servicios'),
  ('2017-08-16', '16.49', '0.21', 'Amazon Prime', 'servicios'),
  ('2017-08-17', '4.8', '0.10', 'Almuerzo 2 tickets', 'restaurantes'),
  ('2017-08-18', '6.7', '0.10', 'Almuerzo 2 tickets', 'restaurantes'),
  ('2017-08-21', '2.68', '0.10', 'Consum', 'restaurantes'),
  ('2017-08-22', '4.5', '0.10', 'Chivito', 'restaurantes'),
  ('2017-08-23', '2.25', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-08-24', '2.25', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-08-25', '10', '0.10', 'Aoyama', 'restaurantes'),
  ('2017-08-25', '1.3', '0.10', 'Chivito', 'restaurantes'),
  ('2017-08-26', '6', '0.10', 'Taxi', 'servicios'),
  ('2017-08-28', '2.5', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-08-29', '2.7', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-08-30', '3.2', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-08-31', '5.2', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-09-01', '2', '0.10', 'Desayuno', 'restaurantes'),
  ('2017-09-01', '4.5', '0.10', 'Chivito', 'restaurantes'),
  ('2017-09-01', '24.5', '0.21', 'Yoigo', 'servicios'),
  ('2017-09-13', '5.1', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-09-13', '5.1', '0.10', 'Merienda', 'restaurantes'),
  ('2017-09-14', '5.4', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-09-14', '3', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-09-15', '4.8', '0.10', 'Chivito', 'restaurantes'),
  ('2017-09-12', '2.6', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-09-06', '3.4', '0.10', 'Desayuno', 'restaurantes'),
  ('2017-09-06', '2.5', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-09-05', '3.9', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-09-04', '2.7', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-09-11', '2.6', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-09-18', '2.7', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-09-19', '2.7', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-09-20', '5.5', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-09-20', '250', '0.21', 'Osteopatía', 'baile'),
  ('2017-09-21', '2.7', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-09-22', '3', '0.10', 'Chivito', 'restaurantes'),
  ('2017-09-25', '2.7', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-09-26', '2.7', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-09-27', '2.7', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-09-27', '42.5', '0.10', 'Clases', 'baile'),
  ('2017-09-28', '2.5', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-09-29', '4.5', '0.10', 'Chivito', 'restaurantes'),
  ('2017-10-01', '12.7', '0.10', 'Mas de Barberans', 'restaurantes'),
  ('2017-10-03', '3', '0.10', 'Alumuerzo', 'restaurantes'),
  ('2017-10-03', '3.5', '0.10', 'Chivito', 'restaurantes'),
  ('2017-10-04', '3', '0.10', 'Alumuerzo', 'restaurantes'),
  ('2017-10-04', '6.59', '0.10', 'Comida consum', 'restaurantes'),
  ('2017-10-05', '2.7', '0.10', 'Alumuerzo', 'restaurantes'),
  ('2017-10-06', '9.3', '0.10', 'Chivito', 'restaurantes'),
  ('2017-10-10', '2.5', '0.10', 'Alumuerzo', 'restaurantes'),
  ('2017-10-11', '1.5', '0.10', 'Alumuerzo', 'restaurantes'),
  ('2017-10-13', '4.5', '0.10', 'Chivito', 'restaurantes'),
  ('2017-10-14', '14.1', '0.10', 'Comida ZGZ', 'restaurantes'),
  ('2017-10-14', '14', '0.10', 'Comida ZGZ', 'restaurantes'),
  ('2017-10-15', '4', '0.10', 'Comida MUV', 'restaurantes'),
  ('2017-10-15', '10', '0.10', 'Comida MUV', 'restaurantes'),
  ('2017-10-15', '5', '0.10', 'Comida MUV', 'restaurantes'),
  ('2017-10-16', '2.5', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-10-17', '3', '0.10', 'Alumuerzo', 'restaurantes'),
  ('2017-10-18', '2.7', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-10-19', '2.5', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-10-20', '2.35', '0.10', 'Merienda', 'restaurantes'),
  ('2017-10-20', '4.5', '0.10', 'Chivito', 'restaurantes'),
  ('2017-10-23', '2.5', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-10-25', '7.74', '0.10', 'Comida consum', 'restaurantes'),
  ('2017-10-26', '3', '0.10', 'Almuerzo', 'restaurantes'),
  ('2017-11-03', '25', '0.21', '5 Aniversario BB', 'baile')
";

if ($conn->query($sql) === TRUE) {
    echo "Gastos seeded<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerramos conexion
$conn->close();
