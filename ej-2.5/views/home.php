?php
ob_start();
?>
<div class="hero-container">
    <div class="hero-content">
        <h1>Lleva el control de tu rendimiento académico</h1>
        <p class="hero-subtitle">El sistema unificado del INDEL diseñado para gestionar tus apuntes de clase, repasar materias y organizar tu conocimiento de forma privada y segura.</p>
        <div class="hero-actions">
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <a href="index.php?route=apuntes" class="btn-primary">Ir a mi Panel Privado</a>
            <?php else: ?>
                <a href="index.php?route=registro" class="btn-primary">Comenzar Ahora</a>
                <a href="index.php?route=login" class="btn-secondary">Acceder al Sistema</a>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">🛡️</div>
            <h3>Privacidad Garantizada</h3>
            <p>Tus apuntes son estrictamente personales. Gracias a nuestros esquemas de aislamiento de datos, nadie más podrá acceder a tu información.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">⚡</div>
            <h3>Búsqueda Ultra Rápida</h3>
            <p>Filtra y localiza apuntes de cualquier materia de manera instantánea utilizando nuestra barra dinámica optimizada.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">💻</div>
            <h3>Diseño Moderno</h3>
            <p>Una interfaz responsiva, limpia y ágil adaptada perfectamente para su visualización en computadoras, tablets o smartphones.</p>
        </div>
    </div>
</div>
<?php
$contenido_vista = ob_get_clean();
require "views/layouts/base.php";