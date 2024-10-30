<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == "completado"): ?>
    <div class="contenedor-confirmado">
        <h1 class="texto-centrado">Pedido Confirmado</h1>
        <h4 class="alinear-tabla">¡Tu pedido se ha realizado con éxito! Aquí está la información:</h4>
        <table>
            <tr>
                <th>ID del Pedido</th>
                <th>Dirección de Entrega</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Precio Total</th>
            </tr>
            <tr>
                <?php $ultimoPedido = $ultimoPedido->fetch_object(); ?>
                <td><?=$ultimoPedido->id;?></td>
                <td><?=$ultimoPedido->direccion;?></td>
                <td><?=$ultimoPedido->fecha;?></td>
                <td><?=$ultimoPedido->hora;?></td>
                <td><?=$ultimoPedido->precio_total;?></td>
            </tr>
        </table>
        <div class="alinear-tabla">
            <button class="boton">
                <a href="<?=base_url?>pedido/descargarConfirmacion">
                    Descargar Confirmación
                </a>
            </button>
        </div>
    </div>
<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] != "completado"):?>
    <h3 class="alinear-tabla">Lo sentimos, tu pedido no pudo ser procesado.</h3>
<?php endif; ?>
