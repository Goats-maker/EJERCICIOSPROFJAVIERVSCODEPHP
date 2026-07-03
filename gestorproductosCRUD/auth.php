<?php
session_start();

function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }
}

function currentUser() {
    return [
        "id" => $_SESSION['user_id'] ?? null,
        "nombre" => $_SESSION['nombre'] ?? null
    ];
}
?>