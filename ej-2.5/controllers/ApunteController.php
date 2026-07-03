<?php
require_once "models/Apunte.php";

function index($pdo) {
    requireLogin();
    $mis_apuntes = Apunte::getAllByUser($pdo, currentUser());
    require "views/apuntes/index.php";
}

function ver($pdo) {
    requireLogin();
    $id = $_GET['id'] ?? null;
    $apunte = Apunte::getByIdAndUser($pdo, $id, currentUser());

    if (!$apunte) {
        die("Error: El apunte solicitado no existe o no tienes permisos para visualizarlo.");
    }

    require "views/apuntes/ver.php";
}

function create($pdo) {
    requireLogin();
    $error = '';
    $acc_form = 'crear';
    
    // Variables vacías para el formulario de creación
    $titulo = '';
    $materia = '';
    $contenido = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = trim($_POST['titulo'] ?? '');
        $materia = trim($_POST['materia'] ?? '');
        $contenido = trim($_POST['contenido'] ?? '');

        if (empty($titulo) || empty($contenido)) {
            $error = 'El título y el contenido del apunte son obligatorios.';
        } else {
            Apunte::create($pdo, currentUser(), $titulo, $materia, $contenido);
            header("Location: index.php?route=apuntes");
            exit;
        }
    }
    require "views/apuntes/form.php";
}

function editar($pdo) {
    requireLogin();
    $id = $_GET['id'] ?? null;
    $apunte = Apunte::getByIdAndUser($pdo, $id, currentUser());

    if (!$apunte) {
        die("Error: El apunte solicitado no existe o no tienes permisos para editarlo.");
    }

    $error = '';
    $acc_form = 'editar';
    
    // Cargar datos existentes
    $titulo = $apunte['titulo'];
    $materia = $apunte['materia'];
    $contenido = $apunte['contenido'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = trim($_POST['titulo'] ?? '');
        $materia = trim($_POST['materia'] ?? '');
        $contenido = trim($_POST['contenido'] ?? '');

        if (empty($titulo) || empty($contenido)) {
            $error = 'El título y el contenido son obligatorios.';
        } else {
            Apunte::update($pdo, $id, currentUser(), $titulo, $materia, $contenido);
            header("Location: index.php?route=apuntes");
            exit;
        }
    }
    require "views/apuntes/form.php";
}

function delete($pdo) {
    requireLogin();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? null;
        Apunte::delete($pdo, $id, currentUser());
    }
    header("Location: index.php?route=apuntes");
    exit;
}
?>