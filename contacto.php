<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
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
        header('Location: gracias.html');
    } else {
        echo 'Oops! Algo salió mal y no pudimos enviar tu mensaje.';
    }
} else {

    http_response_code(403);
    echo "Hubo un problema con tu envío, por favor intenta de nuevo.";
}
?>
