<?php
// Reporte de errores activo para fases de desarrollo (Quita la pantalla blanca)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Carga obligatoria de archivos base
require_once "config/database.php";
require_once "helpers/auth.php";

// Captura de ruta. Por defecto nos envía a 'home'
$route = $_GET['route'] ?? 'home';

switch ($route) {

    case 'home':
        require "views/home.php";
        break;

    case 'login':
        require "controllers/AuthController.php";
        login($pdo);
        break;

    case 'registro':
        require "controllers/AuthController.php";
        register($pdo);
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php?route=home");
        exit;

    case 'apuntes':
        require "controllers/ApunteController.php";
        index($pdo);
        break;

    case 'crear':
        require "controllers/ApunteController.php";
        create($pdo);
        break;

    case 'editar':
        require "controllers/ApunteController.php";
        editar($pdo);
        break;

    case 'ver':
        require "controllers/ApunteController.php";
        ver($pdo);
        break;

    case 'eliminar':
        require "controllers/ApunteController.php";
        delete($pdo);
        break;

    default:
        // Manejo elegante de un error 404
        http_response_code(404);
        echo "<div style='font-family: sans-serif; text-align: center; margin-top: 5rem;'>";
        echo "<h2>Error 404: La página solicitada no existe.</h2>";
        echo "<a href='index.php?route=home'>Volver al inicio legítimo</a>";
        echo "</div>";
        break;
}
?>