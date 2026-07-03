<?php
require_once __DIR__ . '/../models/Producto.php';

class ProductoController {

    private $model;

    public function __construct() {
        $this->model = new Producto();
    }

    public function index() {
        $productos = $this->model->todos();
        require __DIR__ . '/../views/productos/index.php';
    }

    public function crear() {

        if ($_POST) {
            $this->model->crear($_POST);
            header("Location: index.php");
            exit;
        }

        $producto = null;
        require __DIR__ . '/../views/productos/form.php';
    }

    public function editar($id) {

        if ($_POST) {
            $this->model->actualizar($id, $_POST);
            header("Location: index.php");
            exit;
        }

        $producto = $this->model->buscar($id);
        require __DIR__ . '/../views/productos/form.php';
    }

    public function eliminar($id) {
        $this->model->eliminar($id);
        header("Location: index.php");
        exit;
    }
}