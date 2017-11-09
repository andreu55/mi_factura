<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mi_factura_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

/* cambiar el conjunto de caracteres a utf8 */
if (!$conn->set_charset("utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", $conn->error);
    exit();
} else {
    printf("Conjunto de caracteres actual: %s<br>\n", $conn->character_set_name());
}

?>
