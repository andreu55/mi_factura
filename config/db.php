<?php

$servername = "localhost";
$username = "andreu";
$password = "marinero";
$dbname = "mi_factura_db";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

/* cambiar el conjunto de caracteres a utf8 */
if (!$db->set_charset("utf8")) {
    die("Error cargando el conjunto de caracteres utf8");
}
