<div class="contenedor-productos">
    <h2 style="text-align: center">Gestionar Productos</h2>
    <div class="agregar-producto">
        <button class="boton agregar-producto"><a href="<?=base_url?>producto/crear">Agregar Producto</a> </button>

        <!-- Mostrar mensaje de retroalimentación al agregar producto -->
        <?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == "completado"): ?>
            <p>¡Producto agregado exitosamente!</p>
        <?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] !== "completado"): ?>
            <p style="color: red;">¡No se pudo agregar el producto!</p>
        <?php endif; ?>
        <?php Utilidades::eliminarSesion('producto'); ?>

        <!-- Mostrar mensaje de retroalimentación al eliminar producto -->
        <?php if(isset($_SESSION['eliminado']) && $_SESSION['eliminado'] == "completado"): ?>
            <p>¡Eliminado exitosamente!</p>
        <?php elseif(isset($_SESSION['eliminado']) && $_SESSION['eliminado'] !== "completado"): ?>
            <p style="color: red;">¡Error al eliminar!</p>
        <?php endif; ?>
        <?php Utilidades::eliminarSesion('eliminado'); ?>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>
        
        <?php while($producto = $productos->fetch_object()): ?>
        <tr>
            <td><?=$producto->id;?></td>
            <td><?=$producto->nombre;?></td>
            <td><?=$producto->precio;?></td>
            <td><?=$producto->stock;?></td>
            <td>
                <a href="<?=base_url?>producto/eliminar&id=<?=$producto->id;?>"><i class="icono-borrar fas fa-trash"></i></a>
                <a href="<?=base_url?>producto/editar&id=<?=$producto->id;?>"><i class="icono-editar fas fa-edit"></i></a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>