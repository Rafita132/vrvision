<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "srv1582.hstgr.io";
$username = "u554899566_usurafa";
$password = "Bj9~yNBZVBz";
$database = "u554899566_Dataservervr";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

?>
