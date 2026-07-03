<?php ob_start(); ?>

<h1><?= isset($producto) ? "Editar" : "Crear" ?> Producto</h1>

<form method="POST">

    <input type="text" name="nombre"
           placeholder="Nombre"
           value="<?= $producto['nombre'] ?? '' ?>" required>

    <input type="text" name="descripcion"
           placeholder="Descripción"
           value="<?= $producto['descripcion'] ?? '' ?>" required>

    <input type="number" name="precio"
           placeholder="Precio"
           value="<?= $producto['precio'] ?? '' ?>" required>

    <input type="number" name="stock"
           placeholder="Stock"
           value="<?= $producto['stock'] ?? '' ?>" required>

    <button type="submit">Guardar</button>

</form>

<?php $contenido = ob_get_clean(); require __DIR__ . '/../layouts/base.php'; ?>