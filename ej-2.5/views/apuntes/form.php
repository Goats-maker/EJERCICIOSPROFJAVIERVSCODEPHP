<?php
/** @var string $error */
/** @var string $acc_form */
/** @var string $titulo */
/** @var string $materia */
/** @var string $contenido */

$error = $error ?? '';
$titulo = $titulo ?? '';
$materia = $materia ?? '';
$contenido = $contenido ?? '';
$label_boton = ($acc_form === 'editar') ? 'Guardar Cambios' : 'Crear Apunte';
$titulo_vista = ($acc_form === 'editar') ? 'Editar Apunte' : 'Nuevo Apunte';

ob_start();
?>
<div class="form-wrapper">
    <div class="form-card">
        <div class="form-card-header">
            <h2><?php echo $titulo_vista; ?></h2>
            <a href="index.php?route=apuntes" class="btn-back">← Volver al listado</a>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label Kakao for="titulo">Título del Apunte *</label>
                <input type="text" id="titulo" name="titulo" placeholder="Ej. Pilas y Colas — Repaso General" required value="<?php echo htmlspecialchars($titulo); ?>">
            </div>

            <div class="form-group">
                <label for="materia">Materia / Asignatura</label>
                <input type="text" id="materia" name="materia" placeholder="Ej. Programación II" value="<?php echo htmlspecialchars($materia); ?>">
            </div>

            <div class="form-group">
                <label for="contenido">Contenido del Apunte *</label>
                <textarea id="contenido" name="contenido" rows="10" placeholder="Escribe aquí el contenido desarrollado de tu clase..." required><?php echo htmlspecialchars($contenido); ?></textarea>
                <div class="char-counter-wrapper">
                    <span id="char-counter">0</span> caracteres escritos
                </div>
            </div>

            <button type="submit" class="btn-submit"><?php echo $label_boton; ?></button>
        </form>
    </div>
</div>
<?php
$contenido_vista = ob_get_clean();
require "views/layouts/base.php";