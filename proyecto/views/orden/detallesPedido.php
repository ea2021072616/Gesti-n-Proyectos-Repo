<h1 class="texto-centrado">Detalles del Pedido</h1>

<?php
$ultimoPedido = $ultimoRes->fetch_object();
?>

<?php if(isset($_SESSION['admin'])): ?>
    <h2 class="alinear-tabla">Cambiar Estado del Pedido</h2>
    <form style="margin-bottom: 20px;" class="alinear-tabla" action="<?=base_url?>pedido/estado" method="POST">
    <div class="grupo-formulario">
        <input type="text" class="oculto" name="idPedido" value="<?=$ultimoPedido->id?>">
        <select name="estatus" style="width: 35%" id="estado-pedido">
            <option value="confirmado" <?=$ultimoPedido->estatus == "confirmado" ? 'selected' : ''?>>Confirmado para entrega</option>
            <option value="procesando" <?=$ultimoPedido->estatus == "procesando" ? 'selected' : ''?>>En proceso</option>
            <option value="enviado" <?=$ultimoPedido->estatus == "enviado" ? 'selected' : ''?>>Ya enviado</option>
            <option value="entregado" <?=$ultimoPedido->estatus == "entregado" ? 'selected' : ''?>>Pedido entregado</option>
        </select>
    </div>   
    <div>
        <input type="submit" value="Cambiar Estado" class="boton">
    </div>
    </form>
<?php endif; ?>

<div class="contenedor-detalles-pedido" style="margin-bottom: 50px;">
    <h2 class="alinear-tabla">Información del Pedido</h2>
    <table>
        <tr>
            <th>ID del Pedido</th>
            <th>Dirección de Entrega</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Precio Total</th>
            <th>Estado</th>
        </tr>
        <tr>
            <td><?=$ultimoPedido->id;?></td>
            <td><?=$ultimoPedido->direccion;?></td>
            <td><?=$ultimoPedido->fecha;?></td>
            <td><?=$ultimoPedido->hora;?></td>
            <td>$<?=$ultimoPedido->precio_total;?></td>
            <td><?=$ultimoPedido->estatus;?></td>
        </tr>
    </table>

    <h2 class="alinear-tabla" style="margin-top: 20px;">Información de los Productos</h2>
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
        </tr>
        <?php while($elemento = $productos->fetch_object()) :?>
            <tr>
                <td>
                    <img width="115px;" src="<?=base_url?>/uploads/images/<?=$elemento->imagen?>" alt="imagen del producto"> 
                </td>
                <td>
                    <a style="color: blue" href="<?=base_url?>producto/productoUnico&id=<?=$elemento->id?>"><?= $elemento->nombre; ?></a>
                </td>
                <td>
                    $<?= $elemento->precio?>
                </td>
                <td>
                    <?= $elemento->unidades;?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
