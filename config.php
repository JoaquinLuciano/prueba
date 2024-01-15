<?php
// Configuración de la base de datos
$servername = "127.0.0.1"; // Puedes usar "localhost" si MySQL está en el mismo servidor
$username = "root";
$password = "";
$database0 = "nutricalc";
$database1 = "porciones";

// Crear la conexión a la base de datos
$conn0 = new mysqli($servername, $username, $password, $database0);
$conn1 = new mysqli($servername, $username, $password, $database1);

// Verificar si hay errores en la conexión
if ($conn0 -> connect_error && $conn1 -> connect_error) {
    die("Error de conexión: " . $conn0->connect_error);
    die("Error de conexión: " . $conn1->connect_error);
}
?>
