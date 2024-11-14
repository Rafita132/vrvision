<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar la entrada de los datos del formulario
    $nombre = strip_tags(trim($_POST["nombre"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $telefono = trim($_POST["telefono"]);
    $fecha = trim($_POST["fecha"]);
    $hora = trim($_POST["hora"]);
    $pack = trim($_POST["pack"]);

    // Definir el destinatario del correo electrónico
    $para = 'litelralph@vrvisions.eu';

    // Asunto del correo
    $asunto = "Nueva reserva de $nombre";

    // Contenido del correo electrónico
    $contenido_email = "Detalles de la Reserva:\n";
    $contenido_email .= "Nombre: $nombre\n";
    $contenido_email .= "Email: $email\n";
    $contenido_email .= "Teléfono: $telefono\n";
    $contenido_email .= "Fecha: $fecha\n";
    $contenido_email .= "Hora: $hora\n";
    $contenido_email .= "Pack Seleccionado: $pack\n";

    // Encabezados del correo
    $encabezados = "From: $nombre <$email>";

    // Enviar el correo
    $success = mail($para, $asunto, $contenido_email, $encabezados);

    // Verificar si el correo se envió correctamente
    if ($success) {
        header('Location: gracias.html');
        exit();
    } else {
        echo 'Oops! Algo salió mal y no pudimos enviar tu reserva.';
    }
} else {
    http_response_code(403);
    echo "Hubo un problema con tu envío, por favor intenta de nuevo.";
}
?>