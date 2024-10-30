<?php if(isset($admin)) :?>
    <h1 class="texto-centrado">Gestionar Pedidos</h1>
    <table style="margin-bottom: 20px;">
        <tr>
            <th>ID de Usuario</th>
            <th>ID del Pedido</th>
            <th>Precio</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>

      <?php while($elemento = $res->fetch_object()): ?>
            <tr>
                <td>
                    <?= $elemento->usuario_id; ?>
                </td>
                <td>
                   <a style="color: blue;" title="click para ver detalles del pedido" href="<?=base_url?>pedido/detallesPedido&id=<?=$elemento->id?>"><?=$elemento->id?></a> 
                </td>
                <td>
                    $<?= $elemento->precio_total; ?>
                </td>
                <td>
                    <?= $elemento->fecha?>
                </td>
                <td>
                    <?= $elemento->estatus?>
                </td>
            </tr>
       <?php endwhile; ?>
</table>

<?php else : ?>
    <h1 class="texto-centrado">Mis Pedidos</h1>
    <table style="margin-bottom: 20px;">
        <tr>
            <th>ID del Pedido</th>
            <th>Precio</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>

      <?php while($elemento = $res->fetch_object()): ?>
            <tr>
                <td>
                   <a style="color: blue;" title="click para ver detalles del pedido" href="<?=base_url?>pedido/detallesPedido&id=<?=$elemento->id?>"><?=$elemento->id?></a> 
                </td>
                <td>
                    $<?= $elemento->precio_total; ?>
                </td>
                <td>
                    <?= $elemento->fecha?>
                </td>
                <td>
                    <?= $elemento->estatus?>
                </td>
            </tr>
       <?php endwhile; ?>
</table>
<?php endif; ?>
