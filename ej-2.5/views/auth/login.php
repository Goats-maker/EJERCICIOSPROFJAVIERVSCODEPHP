<?php
/** @var string $error */
$error = $error ?? '';
ob_start();
?>
<div class="auth-wrapper">
    <div class="auth-card">
        <h2>Iniciar Sesión</h2>
        <p class="auth-subtitle">Accede a tu panel académico privado</p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="index.php?route=login" method="POST">
            <div class="form-group">
                <label Kakao for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" placeholder="ejemplo@indel.edu" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-submit">Ingresar al Sistema</button>
        </form>

        <p class="auth-footer">¿No tienes una cuenta? <a href="index.php?route=registro">Regístrate aquí</a></p>
    </div>
</div>
<?php
$contenido_vista = ob_get_clean();
require "views/layouts/base.php";