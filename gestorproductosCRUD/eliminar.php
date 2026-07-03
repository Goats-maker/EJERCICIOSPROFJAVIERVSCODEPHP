<?php

require 'db.php';

// Verificar que exista el ID
if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = $_GET["id"];

// Buscar el producto
$stmt = getDB()->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->execute([$id]);

$producto = $stmt->fetch();

if (!$producto) {
    die("Producto no encontrado.");
}

// Si confirma la eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt = getDB()->prepare("DELETE FROM productos WHERE id = ?");

    $stmt->execute([$id]);

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Eliminar Producto</title>

<link rel="stylesheet" href="estilos.css">

</head>

<body>

<div class="contenedor-form">

<h1>🗑 Eliminar Producto</h1>

<p class="mensaje">

¿Estás seguro de que deseas eliminar el siguiente producto?

</p>

<div class="producto-info">

<h2><?= htmlspecialchars($producto['nombre']) ?></h2>

<p><?= htmlspecialchars($producto['descripcion']) ?></p>

<p><strong>Precio:</strong> $<?= number_format($producto['precio'],2) ?></p>

<p><strong>Stock:</strong> <?= $producto['stock'] ?></p>

</div>

<form method="POST">

<div class="botones">

<button
type="submit"
class="btn btn-eliminar">

🗑 Sí, eliminar

</button>

<a
href="index.php"
class="btn btn-cancelar">

❌ Cancelar

</a>

</div>

</form>

</div>

</body>

</html>