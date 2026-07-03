<?php ob_start(); ?>

<h1>📦 Productos</h1>

<a href="index.php?accion=crear">+ Nuevo</a>

<table border="1">
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Precio</th>
    <th>Stock</th>
</tr>

<?php foreach ($productos as $p): ?>
<tr>
    <td><?= $p['id'] ?></td>
    <td><?= $p['nombre'] ?></td>
    <td><?= $p['precio'] ?></td>
    <td><?= $p['stock'] ?></td>
</tr>
<?php endforeach; ?>

</table>

<?php
// 🔥 ESTO ES LO QUE TE FALTA
$contenido = ob_get_clean();

require __DIR__ . '/../layouts/base.php';
?>