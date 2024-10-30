<div class="contenedor-categorias">
    <h2 style="text-align: center">Gestionar Categorías</h2>
    <div class="agregar-categoria">
        <button class="boton agregar-categoria"><a href="<?=base_url?>categoria/crear">Agregar Categoría</a> </button>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Categoría</th>
            <th>Acciones</th>
        </tr>
        
        <?php while($categoria = $categorias->fetch_object()): ?>
        <tr>
            <td><?=$categoria->id;?></td>
            <td><?=$categoria->nombre;?></td>
            <td>
                <a href="<?=base_url?>categoria/eliminar&id=<?=$categoria->id;?>"><i class="icono-borrar fas fa-trash"></i></a>
                <a href="<?=base_url?>categoria/editar&id=<?=$categoria->id;?>"><i class="icono-editar fas fa-edit"></i></a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
