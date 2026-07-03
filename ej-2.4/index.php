<?php
require_once "config/database.php";
require_once "models/Producto.php";
require_once "controllers/ProductoController.php";

$controller = new ProductoController();

$accion = $_GET['accion'] ?? 'index';

match ($accion) {
    'index' => $controller->index(),
    'crear' => $controller->crear(),
    'editar' => $controller->editar($_GET['id'] ?? null),
    'eliminar' => $controller->eliminar($_GET['id'] ?? null),
    default => http_response_code(404)
};