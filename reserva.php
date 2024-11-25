<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = strip_tags(trim($_POST["nombre"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $telefono = trim($_POST["telefono"]);
    $fecha = trim($_POST["fecha"]);
    $hora = trim($_POST["hora"]);
    $pack = trim($_POST["pack"]);
    $cumpleanos = trim($_POST["cumpleanos"]);
    $personas = isset($_POST["personas"]) ? trim($_POST["personas"]) : '';

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
    if ($cumpleanos === 'si' && !empty($personas)) {
        $contenido_email .= "Número de personas: $personas\n";
    }

    $encabezados = "From: $nombre <$email>";

    $success = mail($para, $asunto, $contenido_email, $encabezados);

    if ($success) {
        echo "<script>
                alert('Gracias por contactar con VRVisions, le contestaremos lo antes posible dentro de nuestro horario comercial.');
                window.location.href = 'index.php'; // Redirigir al usuario al inicio después de cerrar el alert
              </script>";
    } else {
        echo "<script>
                alert('Oops! Algo salió mal y no pudimos enviar tu reserva.');
              </script>";
    }
} else {
    http_response_code(403);
    echo "<p>Hubo un problema con tu envío, por favor intenta de nuevo.</p>";
}
?>