<?php
require_once "models/Usuario.php";

function login($pdo) {
    if (isset($_SESSION['usuario_id'])) {
        header("Location: index.php?route=apuntes");
        exit;
    }

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $error = 'Por favor, rellena todos los campos.';
        } else {
            $usuario = Usuario::findByEmail($pdo, $email);
            if ($usuario && password_verify($password, $usuario['password'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                header("Location: index.php?route=apuntes");
                exit;
            } else {
                $error = 'El correo o la contraseña son incorrectos.';
            }
        }
    }
    require "views/auth/login.php";
}

function register($pdo) {
    if (isset($_SESSION['usuario_id'])) {
        header("Location: index.php?route=apuntes");
        exit;
    }

    $error = '';
    $success = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = trim($_POST['nombre'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($nombre) || empty($email) || empty($password)) {
            $error = 'Todos los campos son estrictamente obligatorios.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'El formato de correo electrónico no es válido.';
        } elseif (strlen($password) < 6) {
            $error = 'La contraseña debe tener un mínimo de 6 caracteres.';
        } elseif (Usuario::findByEmail($pdo, $email)) {
            $error = 'Este correo electrónico ya se encuentra registrado.';
        } else {
            if (Usuario::create($pdo, $nombre, $email, $password)) {
                $success = '¡Usuario registrado con éxito! Ya puedes iniciar sesión.';
            } else {
                $error = 'Ocurrió un error inesperado al registrar el usuario.';
            }
        }
    }
    require "views/auth/registro.php";
}