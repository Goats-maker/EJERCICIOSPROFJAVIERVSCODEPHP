<?php
/** @var array $apunte */
ob_start();
?>
<div class="view-wrapper">
    <div class="view-card">
        <div class="view-card-header">
            <div>
                <span class="materia-tag-large"><?php echo htmlspecialchars($apunte['materia'] ?: 'Sin Materia'); ?></span>
                <h1><?php echo htmlspecialchars($apunte['titulo']); ?></h1>
                <p class="view-dates">
                    <span>📅 Creado el: <?php echo date('d/m/Y H:i', strtotime($apunte['creado_en'])); ?></span> | 
                    <span>⏱ Última actualización: <?php echo date('d/m/Y H:i', strtotime($apunte['actualizado'])); ?></span>
                </p>
            </div>
            <a href="index.php?route=apuntes" class="btn-back">← Volver</a>
        </div>

        <div class="view-card-body">
            <!-- nl2br preserva los saltos de línea escritos por el usuario -->
            <p class="contenido-completo"><?php echo nl2br(htmlspecialchars($apunte['contenido'])); ?></p>
        </div>

        <div class="view-card-footer">
            <a href="index.php?route=editar&id=<?php echo $apunte['id']; ?>" class="btn-edit-inline">Editar este apunte</a>
            <form action="index.php?route=eliminar" method="POST" class="form-eliminar" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $apunte['id']; ?>">
                <button type="submit" class="btn-delete-inline">Eliminar Apunte</button>
            </form>
        </div>
    </div>
</div>
<?php
$contenido_vista = ob_get_clean();
require "views/layouts/base.php";