<?php

$host = "localhost"; 
$usuario = "u554899566_usurafa"; 
$contrasena = "@wpTqSnOoufa*Nk6"; 
$nombre_base_datos = "u554899566_Dataservervr"; 

// Crear la conexión
$conn = new mysqli($host, $usuario, $contrasena, $nombre_base_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");

?>
