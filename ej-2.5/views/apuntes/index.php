<?php
/** @var array $mis_apuntes */
$mis_apuntes = $mis_apuntes ?? [];
$total_entradas = count($mis_apuntes);
$texto_entradas = $total_entradas === 1 ? '1 entrada' : $total_entradas . ' entradas';

ob_start();
?>
<div class="panel-container">
    <div class="panel-header">
        <div class="panel-title-area">
            <h1>Mis apuntes</h1>
            <span class="badge-count"><?php echo $texto_entradas; ?></span>
        </div>
        <a href="index.php?route=crear" class="btn-primary">+ Nuevo apunte</a>
    </div>

    <div class="search-bar-container">
        <input 
            type="text" 
            id="buscar-apuntes" 
            placeholder="🔎 Buscar en mis apuntes por título o materia..." 
            autocomplete="off"
            class="search-input"
        >
    </div>

    <div class="apuntes-grid">
        <?php if (empty($mis_apuntes)): ?>
            <div class="no-data-card">
                <p>No se encontraron apuntes. ¡Haz clic en el botón de arriba para crear el primero!</p>
            </div>
        <?php else: ?>
            <?php foreach ($mis_apuntes as $apunte): ?>
                <div class="apunte-card">
                    <div class="card-body">
                        <span class="materia-tag"><?php echo htmlspecialchars($apunte['materia'] ?: 'Sin Materia'); ?></span>
                        <h2 class="titulo"><?php echo htmlspecialchars($apunte['titulo']); ?></h2>
                        <p class="extracto">
                            <?php 
                                $texto = strip_tags($apunte['contenido']);
                                echo strlen($texto) > 120 ? substr($texto, 0, 120) . '...' : $texto; 
                            ?>
                        </p>
                    </div>
                    <div class="card-footer">
                        <span class="fecha-update">
                            ⏱ <?php echo date('d/m/Y H:i', strtotime($apunte['actualizado'])); ?>
                        </span>
                        <div class="card-actions">
                            <a href="index.php?route=ver&id=<?php echo $apunte['id']; ?>" class="action-btn view-btn" title="Ver Detalle">👁️</a>
                            <a href="index.php?route=editar&id=<?php echo $apunte['id']; ?>" class="action-btn edit-btn" title="Editar">✏️</a>
                            
                            <form action="index.php?route=eliminar" method="POST" class="form-eliminar" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $apunte['id']; ?>">
                                <button type="submit" class="action-btn delete-btn" title="Eliminar">🗑️</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?php
$contenido_vista = ob_get_clean();
require "views/layouts/base.php";