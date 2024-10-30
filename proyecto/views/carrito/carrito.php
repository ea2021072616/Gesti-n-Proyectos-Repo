<div class="contenedor-carrito">
    <h1 style="text-align: center">Carrito</h1>
    <div class="alinear-tabla">

        <button class="boton">
            <a href="<?=base_url?>carrito/vaciar">Vaciar Carrito</a> 
        </button>
    </div>
    <table style="margin-bottom: 20px;">
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Eliminar</th>
        </tr>
        <?php if(isset($carrito)):
        
        foreach($carrito as $indice => $producto): 
            $item = $producto['producto'];        
            ?>
            <tr>
                <td>
                    <img width="115px;" src="<?=base_url?>/uploads/images/<?=$item->imagen?>" alt="imagen del producto"> 
                </td>
                <td>
                    <a href="<?=base_url?>producto/productoUnico&id=<?=$item->id?>"><?= $item->nombre; ?></a>
                </td>
                <td>
                    <?= $item->precio?>
                </td>
                <td>
                    <fieldset class="control-unidades-carrito">
                        <button class="boton-disminuir menos" type="button" onclick="location.href='<?=base_url?>carrito/reducir&indice=<?=$indice?>'">-</button>
                        <input type="text" name="cantidad" value="<?= $_SESSION['carrito'][$indice]['unidades']?>" readonly />
                        <button class="boton-aumentar mas" type="button" onclick="location.href='<?=base_url?>carrito/aumentar&indice=<?=$indice?>'">+</button>
                    </fieldset>                    
                </td>
                <td>
                    <a href="<?=base_url?>carrito/quitar&indice=<?=$indice?>">
                        <i class="icono-borrar fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach;
        endif;
        ?>
    </table>
    <?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) : ?>
        <div class="alinear-tabla total">
            <h3>Total:</h3>
            <?php $valores = Utilidades::valoresCarrito(); ?>
            <p>$<?=number_format((float)$valores['total'], 2, '.', '');?></p>
        </div>
        <div class="alinear-tabla">
            <button class="boton">
                <a href="<?=base_url?>pedido/realizarPedido">Finalizar Compra</a> 
            </button>
        </div>
    <?php endif; ?>
</div>
