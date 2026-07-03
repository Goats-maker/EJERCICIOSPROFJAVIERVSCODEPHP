<?php

$errores = [];
$enviado = false;

$nombre = "";
$email = "";
$asunto = "";
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $asunto = htmlspecialchars(trim($_POST["asunto"]));
    $mensaje = htmlspecialchars(trim($_POST["mensaje"]));

    // Validaciones

    if (strlen($nombre) < 2) {
        $errores[] = "El nombre debe tener al menos 2 caracteres.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "Ingrese un correo electrónico válido.";
    }

    if (strlen($asunto) < 3) {
        $errores[] = "El asunto debe tener al menos 3 caracteres.";
    }

    if (strlen($mensaje) < 10) {
        $errores[] = "El mensaje debe contener al menos 10 caracteres.";
    }

    if (empty($errores)) {

        $registro =
            date("d/m/Y H:i:s") . " | " .
            $nombre . " | " .
            $email . " | " .
            $asunto . " | " .
            $mensaje . PHP_EOL;

        file_put_contents(
            "mensajes.txt",
            $registro,
            FILE_APPEND
        );

        $enviado = true;

        $nombre = "";
        $email = "";
        $asunto = "";
        $mensaje = "";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Formulario de Contacto</title>

    <link
        rel="stylesheet"
        href="estilos.css">

</head>

<body>

<div class="contenedor">

    <h1>📧 Formulario de Contacto</h1>

    <?php if($enviado): ?>

        <div class="mensaje-exito">

            ✅ Mensaje enviado correctamente.

        </div>

    <?php endif; ?>


    <?php if(!empty($errores)): ?>

        <div class="mensaje-error">

            <ul>

                <?php foreach($errores as $error): ?>

                    <li><?= $error ?></li>

                <?php endforeach; ?>

            </ul>

        </div>

    <?php endif; ?>


<form
method="POST"
action="">


<div class="grupo">

<label>

Nombre

</label>

<input

type="text"

name="nombre"

value="<?= $nombre ?>"

placeholder="Ingrese su nombre"

required>

</div>


<div class="grupo">

<label>

Correo electrónico

</label>

<input

type="email"

name="email"

value="<?= $email ?>"

placeholder="ejemplo@gmail.com"

required>

</div>


<div class="grupo">

<label>

Asunto

</label>

<input

type="text"

name="asunto"

value="<?= $asunto ?>"

placeholder="Motivo del mensaje"

required>

</div>


<div class="grupo">

<label>

Mensaje

</label>

<textarea

name="mensaje"

rows="6"

placeholder="Escriba aquí su mensaje..."

required><?= $mensaje ?></textarea>

</div>


<button type="submit">

Enviar Mensaje

</button>

</form>

</div>

</body>

</html>