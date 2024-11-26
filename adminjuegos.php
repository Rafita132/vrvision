<?php
session_start();

define('ADMIN_USERNAME', 'u554899566_usurafa'); 
define('ADMIN_PASSWORD', 'Bj9~yNBZVBz'); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        $_SESSION['loggedin'] = true;
        header('Location: adminjuegos.php');
        exit();
    } else {
        $error = "Credenciales incorrectas";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: adminjuegos.php');
    exit();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
?>
    <div class="login-admin">
        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
        <form method="post" action="adminjuegos.php">
            <div class="login-usu">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="login-con">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Iniciar Sesión</button>
        </form>
    </div>
<?php
    exit();
}

include 'conexion.php';
include 'adminheader.php'; 
?>

<div class="tabla-adminjuegos">

    <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'agregado'): ?>
        <div class="alert alert-success">Juego agregado correctamente.</div>
    <?php elseif (isset($_GET['mensaje']) && $_GET['mensaje'] == 'eliminado'): ?>
        <div class="alert alert-success">Juego eliminado correctamente.</div>
    <?php elseif (isset($_GET['mensaje']) && $_GET['mensaje'] == 'editado'): ?>
        <div class="alert alert-success">Juego editado correctamente.</div>
    <?php endif; ?>

</div>

    <table class="tabla-juegosadmin">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Título</th>
                <th>Género</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $sql = "SELECT * FROM Juegos";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                    echo "<td><img src='" . htmlspecialchars($row['Imagen']) . "' width='100' /></td>";
                    echo "<td>" . htmlspecialchars($row['Titulo']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Genero']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Descripcion']) . "</td>";
                    echo "<td>";
                    echo "<button class='btn btn-warning btn-sm' onclick='editGame(" . json_encode($row) . ")'>Editar</button> ";
                    echo "<button class='btn btn-danger btn-sm' onclick='confirmDelete(" . $row['ID'] . ")'>Eliminar</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay juegos disponibles.</td></tr>";
            }
            ?>
        </tbody>
    </table>
<div class="for-agregar-juego">
    <form action="agregarjuego.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="imagen">Imagen (URL):</label>
            <input type="text" name="imagen" id="imagen" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="genero">Género:</label>
            <input type="text" name="genero" id="genero" class="form-control">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Añadir Juego</button>
    </form>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" action="editarjuego.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Juego</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editId" name="id">
                    <div class="form-group mb-3">
                        <label for="editImagen">Imagen (URL):</label>
                        <input type="text" id="editImagen" name="imagen" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editTitulo">Título:</label>
                        <input type="text" id="editTitulo" name="titulo" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editGenero">Género:</label>
                        <input type="text" id="editGenero" name="genero" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="editDescripcion">Descripción:</label>
                        <textarea id="editDescripcion" name="descripcion" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script>

function editGame(game) {
    document.getElementById('editId').value = game.ID;
    document.getElementById('editImagen').value = game.Imagen;
    document.getElementById('editTitulo').value = game.Titulo;
    document.getElementById('editGenero').value = game.Genero;
    document.getElementById('editDescripcion').value = game.Descripcion;
    var editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
}

function confirmDelete(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este juego?')) {
        window.location.href = 'eliminarjuego.php?id=' + id;
    }
}
</script>

<?php include 'adminfooter.php'; ?>

<?php
$conn->close();
?>
