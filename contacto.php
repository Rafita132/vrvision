<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = strip_tags(trim($_POST["nombre"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $telefono = trim($_POST["telefono"]);
    $mensaje = trim($_POST["mensaje"]);

    $para = 'litelralph@vrvisions.eu';
    $asunto = "Nuevo mensaje de contacto de $nombre";

    $contenido_email = "Nombre: $nombre\n";
    $contenido_email .= "Email: $email\n\n";
    $contenido_email .= "Teléfono: $telefono\n\n";
    $contenido_email .= "Mensaje:\n$mensaje\n";

    $encabezados = "From: $nombre <$email>";

    $success = mail($para, $asunto, $contenido_email, $encabezados);
    if ($success) {
        echo "<script type='text/javascript'>
                alert('Gracias por contactar con VRVisions, le contestaremos lo antes posible dentro de nuestro horario comercial.');
                window.location.href = 'index.php'; // Redirigir después del mensaje
              </script>";
    } else {
        echo '<p>Oops! Algo salió mal y no pudimos enviar tu mensaje.</p>';
    }
} else {
    http_response_code(403);
    echo "<p>Hubo un problema con tu envío, por favor intenta de nuevo.</p>";
}

?>
