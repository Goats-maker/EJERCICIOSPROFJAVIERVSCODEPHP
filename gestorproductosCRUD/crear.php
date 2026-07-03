<?php

require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt = getDB()->prepare(

        "INSERT INTO productos
        (nombre, descripcion, precio, stock)
        VALUES (?, ?, ?, ?)"

    );

    $stmt->execute([

        $_POST["nombre"],
        $_POST["descripcion"],
        $_POST["precio"],
        $_POST["stock"]

    ]);

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nuevo Producto</title>

    <link rel="stylesheet" href="estilos.css">

</head>

<body>

<div class="contenedor-form">

    <h1>➕ Agregar Producto</h1>

    <form method="POST">

        <label>Nombre</label>

        <input
            type="text"
            name="nombre"
            required
        >

        <label>Descripción</label>

        <textarea
            name="descripcion"
            rows="4"
            required
        ></textarea>

        <label>Precio</label>

        <input
            type="number"
            name="precio"
            step="0.01"
            min="0"
            required
        >

        <label>Stock</label>

        <input
            type="number"
            name="stock"
            min="0"
            required
        >

        <div class="botones">

            <button
                class="btn btn-guardar"
                type="submit">
                💾 Guardar
            </button>

            <a
                href="index.php"
                class="btn btn-cancelar">
                ↩ Regresar
            </a>

        </div>

    </form>

</div>

</body>

</html>