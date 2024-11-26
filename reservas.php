<?php

include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $conn->real_escape_string(strip_tags(trim($_POST["nombre"])));
    $email = $conn->real_escape_string(filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL));
    $telefono = $conn->real_escape_string(trim($_POST["telefono"]));
    $fecha = $conn->real_escape_string(trim($_POST["fecha"]));
    $hora = $conn->real_escape_string(trim($_POST["hora"]));
    $pack = $conn->real_escape_string(trim($_POST["pack"]));
    $cumpleanos = isset($_POST["cumpleanos"]) ? $conn->real_escape_string(trim($_POST["cumpleanos"])) : 'no';
    $personas = isset($_POST["personas"]) && !empty($_POST["personas"]) ? intval(trim($_POST["personas"])) : 1;

    $sql_check = "SELECT SUM(personas) AS total_personas FROM Reservas WHERE fecha = '$fecha' AND hora = '$hora'";
    $result = $conn->query($sql_check);

    if ($result) {
        $row = $result->fetch_assoc();
        $total_personas = $row['total_personas'] ?? 0;

        if (($total_personas + $personas) > 8) {
            echo "<script>
                    alert('La capacidad máxima de 8 personas para la hora seleccionada ya ha sido alcanzada. Por favor, elige otra hora o reduce el número de personas.');
                    window.location.href = 'reservas.php'; // Redirigir de nuevo a la página de reservas
                  </script>";
            exit();
        }
    } else {
        echo "<script>
                alert('Error al verificar la disponibilidad: " . $conn->error . "');
                window.location.href = 'reservas.php'; // Redirigir de nuevo a la página de reservas
              </script>";
        exit();
    }

    $para = 'litelralph@vrvisions.eu';

    $asunto = "Nueva reserva de $nombre";

    $contenido_email = "Detalles de la Reserva:\n";
    $contenido_email .= "Nombre: $nombre\n";
    $contenido_email .= "Email: $email\n";
    $contenido_email .= "Teléfono: $telefono\n";
    $contenido_email .= "Fecha: $fecha\n";
    $contenido_email .= "Hora: $hora\n";
    $contenido_email .= "Pack Seleccionado: $pack\n";
    $contenido_email .= "Cumpleaños: " . ($cumpleanos === 'si' ? 'Sí' : 'No') . "\n";
    $contenido_email .= "Número de personas: $personas\n";

    $encabezados = "From: $nombre <$email>";

    $success = mail($para, $asunto, $contenido_email, $encabezados);

    if ($success) {
        $sql_insert = "INSERT INTO Reservas (nombre, email, telefono, fecha, hora, pack, cumpleanos, personas)
                       VALUES ('$nombre', '$email', '$telefono', '$fecha', '$hora', '$pack', '$cumpleanos', $personas)";

        if ($conn->query($sql_insert) === TRUE) {
            echo "<script>
                    alert('Reserva enviada correctamente y almacenada en la base de datos.');
                    window.location.href = 'index.php'; // Redirigir al usuario al inicio después de cerrar el alert
                  </script>";
        } else {
            echo "<script>
                    alert('Error al almacenar la reserva en la base de datos: " . $conn->error . "');
                    window.location.href = 'reservas.php'; // Redirigir de nuevo a la página de reservas
                  </script>";
        }
    } else {
        echo "<script>
                alert('Oops! Algo salió mal y no pudimos enviar tu reserva.');
                window.location.href = 'reservas.php'; // Redirigir de nuevo a la página de reservas
              </script>";
    }
} else {
    http_response_code(403);
    echo "<p>Hubo un problema con tu envío, por favor intenta de nuevo.</p>";
}

$conn->close();
?>
