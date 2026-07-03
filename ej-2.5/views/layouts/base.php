<?php
/** @var string $contenido_vista */
$contenido_vista = $contenido_vista ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDEL Academic</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>

    <header class="main-header">
        <div class="header-container">
            <a href="index.php?route=home" class="logo">INDEL <span>Academic</span></a>
            <nav class="nav-links">
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <div class="user-nav">
                        <span class="user-name">👤 <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></span>
                        <a href="index.php?route=apuntes" class="btn-link">Mis Apuntes</a>
                        <a href="index.php?route=logout" class="btn-logout">Cerrar sesión</a>
                    </div>
                <?php else: ?>
                    <a href="index.php?route=login" class="btn-link">Iniciar Sesión</a>
                    <a href="index.php?route=registro" class="btn-primary-sm">Registrarse</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <?php echo $contenido_vista; ?>
    </main>

    <footer class="main-footer">
        <div class="footer-container">
            <p>&copy; <?php echo date('Y'); ?> INDEL - Instituto de Desarrollo Académico. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="public/js/app.js"></script>
</body>
</html>