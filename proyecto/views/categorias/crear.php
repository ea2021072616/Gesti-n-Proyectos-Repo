<div class="contenedor-crear-categoria">
<?php if(isset($editar) && isset($categoriaEditar) && is_object($categoriaEditar)):?>
    <h2>Editar Categoría - <?= $categoriaEditar->nombre;?></h2>
    <?php $url_accion = base_url."categoria/guardar&id=".$categoriaEditar->id; ?>
<?php else : ?>
    <h2>Agregar Categoría</h2>
    <?php $url_accion = base_url."categoria/guardar"; ?>
<?php endif; ?>

    <form action="<?=$url_accion?>" method="POST">
        <div class="grupo-formulario">
            <label for="nombre">Nombre:</label>            
            <input type="text" name="nombre" required value="<?=isset($categoriaEditar) && is_object($categoriaEditar) ? $categoriaEditar->nombre : ''; ?>">
        </div>
        <input type="submit" class="boton" value="<?=isset($categoriaEditar) && is_object($categoriaEditar) ? 'Editar Categoría' : 'Crear Categoría'; ?>">   
    </form>
</div>
