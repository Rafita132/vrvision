<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: adminjuegos.php');
    exit();
}

include 'adminheader.php';

if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $sql_delete = "DELETE FROM Reservas WHERE id = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo "<script>alert('Reserva eliminada correctamente.');</script>";
    } else {
        echo "<script>alert('Error al eliminar la reserva.');</script>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $pack = $_POST['pack'];
    $cumpleanos = $_POST['cumpleanos'];
    $personas = $_POST['personas'];

    $sql_update = "UPDATE Reservas SET nombre = ?, email = ?, telefono = ?, fecha = ?, hora = ?, pack = ?, cumpleanos = ?, personas = ? WHERE id = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param('ssssssssi', $nombre, $email, $telefono, $fecha, $hora, $pack, $cumpleanos, $personas, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Reserva actualizada correctamente.');</script>";

        // Enviar correo electrónico al cliente
        $from = "literalph@vrvisions.eu";
        $to = $email;
        $subject = "Actualización de tu reserva";
        $message = "Hola $nombre,\n\nTu reserva ha sido actualizada con los siguientes detalles:\n\n" .
                   "Fecha: $fecha\nHora: $hora\nPack: $pack\nNúmero de personas: $personas\n" .
                   "Cumpleaños: $cumpleanos\n\nGracias por confiar en nosotros.\n\nSaludos,\nEquipo de VRVisions";
        $headers = "From: $from";

        if (mail($to, $subject, $message, $headers)) {
            echo "<script>alert('Correo enviado al cliente.');</script>";
        } else {
            echo "<script>alert('Error al enviar el correo al cliente.');</script>";
        }
    } else {
        echo "<script>alert('Error al actualizar la reserva.');</script>";
    }
}
?>

<div class="container mt-5">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Pack</th>
                <th>Cumpleaños</th>
                <th>Personas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM Reservas";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['telefono']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['fecha']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['hora']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['pack']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['cumpleanos']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['personas']) . "</td>";
                    echo "<td>
                            <button class='btn btn-warning btn-sm' onclick='editReservation(" . json_encode($row) . ")'>Editar</button>
                            <button class='btn btn-danger btn-sm' onclick='confirmDelete(" . $row['id'] . ")'>Eliminar</button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No hay reservas disponibles.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editId" name="id">
                    <div class="form-group mb-3">
                        <label for="editNombre">Nombre:</label>
                        <input type="text" id="editNombre" name="nombre" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editEmail">Email:</label>
                        <input type="email" id="editEmail" name="email" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editTelefono">Teléfono:</label>
                        <input type="text" id="editTelefono" name="telefono" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editFecha">Fecha de la Reserva:</label>
                        <input type="date" id="editFecha" name="fecha" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editHora">Hora de la Reserva:</label>
                        <input type="time" id="editHora" name="hora" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editPack">Pack:</label>
                        <input type="text" id="editPack" name="pack" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editCumpleanos">Cumpleaños:</label>
                        <select id="editCumpleanos" name="cumpleanos" class="form-control" required>
                            <option value="si">Sí</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editPersonas">Número de Personas:</label>
                        <input type="number" id="editPersonas" name="personas" class="form-control" min="1" max="8" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" name="edit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
function editReservation(reserva) {
    document.getElementById('editId').value = reserva.id;
    document.getElementById('editNombre').value = reserva.nombre;
    document.getElementById('editEmail').value = reserva.email;
    document.getElementById('editTelefono').value = reserva.telefono;
    document.getElementById('editFecha').value = reserva.fecha;
    document.getElementById('editHora').value = reserva.hora;
    document.getElementById('editPack').value = reserva.pack;
    document.getElementById('editCumpleanos').value = reserva.cumpleanos;
    document.getElementById('editPersonas').value = reserva.personas;

    var editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
}

function confirmDelete(id) {
    if (confirm('¿Estás seguro de que deseas eliminar esta reserva?')) {
        window.location.href = 'adminreservas.php?delete_id=' + id;
    }
}
</script>

<?php include 'adminfooter.php'; ?>

<?php
$conn->close();
?>
