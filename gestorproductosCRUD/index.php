<?php
require 'db.php';
require "auth.php";
requireLogin();   // 🔒 si no hay sesión, lo manda al login


// Obtener todos los productos
$stmt = getDB()->query("SELECT * FROM productos ORDER BY id DESC");
$productos = $stmt->fetchAll();

// Estadísticas
$totalProductos = count($productos);

$totalStock = 0;
$valorInventario = 0;

foreach ($productos as $p) {
    $totalStock += $p['stock'];
    $valorInventario += ($p['precio'] * $p['stock']);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inventario INDEL</title>

    <link rel="stylesheet" href="estilos.css">

</head>

<body>

<div class="contenedor">

    <header>

        <h1>📦 Inventario INDEL</h1>

        <a href="crear.php" class="btn btn-nuevo">
            ➕ Nuevo Producto
        </a>

    </header>

    <section class="cards">

        <div class="card">

            <h2><?php echo $totalProductos; ?></h2>

            <p>Productos registrados</p>

        </div>

        <div class="card">

            <h2><?php echo $totalStock; ?></h2>

            <p>Unidades en stock</p>

        </div>

        <div class="card">

            <h2>$<?php echo number_format($valorInventario,2); ?></h2>

            <p>Valor del inventario</p>

        </div>

    </section>

    <div class="buscador">

        <input
            type="text"
            id="buscar"
            placeholder="🔍 Buscar producto..."
        >

    </div>

    <table id="tablaProductos">

        <thead>

            <tr>

                <th>ID</th>

                <th>Nombre</th>

                <th>Descripción</th>

                <th>Precio</th>

                <th>Stock</th>

                <th>Fecha</th>

                <th>Acciones</th>

            </tr>

        </thead>

        <tbody>

        <?php foreach($productos as $producto): ?>

        <tr>

            <td><?= $producto['id'] ?></td>

            <td><?= htmlspecialchars($producto['nombre']) ?></td>

            <td><?= htmlspecialchars($producto['descripcion']) ?></td>

            <td>$<?= number_format($producto['precio'],2) ?></td>

            <td><?= $producto['stock'] ?></td>

            <td><?= $producto['creado_en'] ?></td>

            <td>

                <a class="btn btn-editar"
                    href="editar.php?id=<?= $producto['id'] ?>">
                    ✏ Editar
                </a>

                <a class="btn btn-eliminar"
                    href="eliminar.php?id=<?= $producto['id'] ?>">
                    🗑 Eliminar
                </a>

            </td>

        </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

<script>

const buscador=document.getElementById("buscar");

buscador.addEventListener("keyup",function(){

let texto=this.value.toLowerCase();

let filas=document.querySelectorAll("#tablaProductos tbody tr");

filas.forEach(function(fila){

let contenido=fila.textContent.toLowerCase();

fila.style.display=contenido.includes(texto)?"":"none";

});

});

</script>

</body>

</html>