<?php

include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['titulo']) && isset($_POST['genero']) && isset($_POST['descripcion']) && isset($_POST['imagen'])) {
    $id = intval($_POST['id']);
    $titulo = $conn->real_escape_string(trim($_POST['titulo']));
    $genero = $conn->real_escape_string(trim($_POST['genero']));
    $descripcion = $conn->real_escape_string(trim($_POST['descripcion']));
    $imagen = $conn->real_escape_string(trim($_POST['imagen']));

    $sql = "UPDATE Juegos SET Titulo='$titulo', Genero='$genero', Descripcion='$descripcion', Imagen='$imagen' WHERE ID=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: adminjuegos.php?mensaje=editado');
    } else {
        echo "Error al actualizar el juego: " . $conn->error;
    }
} else {
    echo "Datos no válidos.";
}

$conn->close();
?>
