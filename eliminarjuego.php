<?php

include 'conexion.php';

if (isset($_GET['id'])) {

    $id = intval($_GET['id']); 

    $sql = "DELETE FROM Juegos WHERE ID = $id";

    if ($conn->query($sql) === TRUE) {
        header('Location: adminjuegos.php?mensaje=eliminado');
    } else {
        echo "Error al eliminar el juego: " . $conn->error;
    }
} else {
    echo "ID no especificado.";
}

$conn->close();
?>
