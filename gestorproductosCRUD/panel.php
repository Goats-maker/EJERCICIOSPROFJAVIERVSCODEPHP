<?php
require "auth.php";
requireLogin();

$user = currentUser();
?>

<h1>Bienvenido, <?= $user['nombre'] ?> 🎮</h1>

<p>Último login actualizado en base de datos.</p>


<a href="index.php" style="
    display:inline-block;
    padding:10px;
    background:#3b82f6;
    color:white;
    border-radius:8px;
    text-decoration:none;
">
    📦 Ir al CRUD de Productos
</a>

<a href="logout.php">Cerrar sesión</a>