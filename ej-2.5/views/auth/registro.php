<?php
/** @var string $error */
/** @var string $success */
$error = $error ?? '';
$success = $success ?? '';
ob_start();
?>
<div class="auth-wrapper">
    <div class="auth-card">
        <h2>Crear Cuenta</h2>
        <p class="auth-subtitle">Regístrate para gestionar tus apuntes personales</p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form action="index.php?route=registro" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required value="<?php echo htmlspecialchars($_POST['nombre'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" placeholder="ejemplo@indel.edu" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="password">Contraseña (Mínimo 6 caracteres)</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-submit">Registrar Cuenta</button>
        </form>

        <p class="auth-footer">¿Ya tienes cuenta? <a href="index.php?route=login">Inicia sesión</a></p>
    </div>
</div>
<?php
$contenido_vista = ob_get_clean();
require "views/layouts/base.php";