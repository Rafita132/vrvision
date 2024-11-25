<?php

include 'conexion.php';

include 'header.php'; 
?>
<h1 class="text-center mb-5">Lista de Juegos Disponibles</h1>

<div class="container my-5">

    <?php
    $sql = "SELECT * FROM Juegos";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo '<div class="row">';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-4 mb-4">';
            echo '<div class="card h-100">';

            if (!empty($row['Imagen'])) {
                echo '<img src="' . htmlspecialchars($row['Imagen']) . '" class="card-img-top" alt="' . htmlspecialchars($row['Titulo']) . '">';
            }

            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars($row['Titulo']) . '</h5>';
            echo '<p class="card-text"><strong>Género:</strong> ' . (!empty($row['Genero']) ? htmlspecialchars($row['Genero']) : 'No especificado') . '</p>';
            echo '<p class="card-text">' . (!empty($row['Descripcion']) ? htmlspecialchars($row['Descripcion']) : 'Sin descripción') . '</p>';
            echo '</div>'; 
            echo '</div>'; 
            echo '</div>'; 
        }
        echo '</div>'; 
    } else {
        echo '<p class="text-center">No hay juegos disponibles en este momento.</p>';
    }

    $conn->close();
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="js/app.js"></script>

<?php include 'footer.php'; ?>