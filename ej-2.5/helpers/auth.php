<?php
// Gestión global de sesiones y seguridad de acceso
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Fuerza el redireccionamiento al login si el usuario no está autenticado.
 */
function requireLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: index.php?route=login");
        exit;
    }
}

/**
 * Obtiene el ID del usuario en sesión actual o null.
 */
function currentUser() {
    return $_SESSION['usuario_id'] ?? null;
}
?>