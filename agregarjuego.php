<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titulo = $conn->real_escape_string(trim($_POST['titulo']));
    $genero = $conn->real_escape_string(trim($_POST['genero']));
    $descripcion = $conn->real_escape_string(trim($_POST['descripcion']));
    $imagen = $conn->real_escape_string(trim($_POST['imagen']));

    $sql = "INSERT INTO Juegos (Titulo, Genero, Descripcion, Imagen) VALUES ('$titulo', '$genero', '$descripcion', '$imagen')";

    if ($conn->query($sql) === TRUE) {

        header('Location: adminjuegos.php?mensaje=agregado');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
