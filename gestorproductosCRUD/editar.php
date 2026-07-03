<?php

require 'db.php';

// Verificar que exista el ID
if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = $_GET["id"];

// Obtener el producto
$stmt = getDB()->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->execute([$id]);

$producto = $stmt->fetch();

if (!$producto) {
    die("Producto no encontrado.");
}

// Actualizar producto
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt = getDB()->prepare(

        "UPDATE productos
        SET nombre = ?,
            descripcion = ?,
            precio = ?,
            stock = ?
        WHERE id = ?"

    );

    $stmt->execute([

        $_POST["nombre"],
        $_POST["descripcion"],
        $_POST["precio"],
        $_POST["stock"],
        $id

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

<title>Editar Producto</title>

<link rel="stylesheet" href="estilos.css">

</head>

<body>

<div class="contenedor-form">

<h1>✏ Editar Producto</h1>

<form method="POST">

<label>Nombre</label>

<input
type="text"
name="nombre"
value="<?= htmlspecialchars($producto['nombre']) ?>"
required>

<label>Descripción</label>

<textarea
name="descripcion"
rows="4"
required><?= htmlspecialchars($producto['descripcion']) ?></textarea>

<label>Precio</label>

<input
type="number"
name="precio"
step="0.01"
min="0"
value="<?= $producto['precio'] ?>"
required>

<label>Stock</label>

<input
type="number"
name="stock"
min="0"
value="<?= $producto['stock'] ?>"
required>

<div class="botones">

<button
class="btn btn-guardar"
type="submit">

💾 Actualizar

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