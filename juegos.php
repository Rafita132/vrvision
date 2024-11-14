<?php include 'header.php' ?>

<?php include 'conexion.php';

$sql = "SELECT ID, Imagen, Titulo, Genero, Descripcion FROM juegos";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        echo "<div class='juego'>";
        echo "<h2>" . htmlspecialchars($fila["Titulo"]) . "</h2>";
        echo "<img src='" . htmlspecialchars($fila["Imagen"]) . "' alt='" . htmlspecialchars($fila["Titulo"]) . "' />";
        echo "<p><strong>Género:</strong> " . htmlspecialchars($fila["Genero"]) . "</p>";
        echo "<p><strong>Descripción:</strong> " . htmlspecialchars($fila["Descripcion"]) . "</p>";
        echo "</div>";
    }
} else {
    echo "No se encontraron juegos.";
}

$conn->close();
?>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="js/app.js"></script>
<?php include 'footer.php' ?>