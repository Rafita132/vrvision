<?php
// Habilitar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Datos de conexión a la base de datos
$host = "srv1582.hstgr.io";
$username = "u554899566_usurafa";
$password = "Bj9~yNBZVBz";
$database = "u554899566_Dataservervr";

// Crear la conexión
$conn = new mysqli($host, $username, $password, $database);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

?>