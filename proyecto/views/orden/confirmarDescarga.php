<?php $ultimoPedido = $aObtener->fetch_object(); ?>
<style>
    span {
        font-weight: bold;
    }

    .grupo-producto img, .grupo-producto p {
        display: inline;
    }

    h4 {
        margin-bottom: 0px;
    }
</style>

<h1 style="text-align: center;">Tu Pedido</h1>
<hr>
<p><span>ID del Pedido:</span> <?=$ultimoPedido->id?></p>
<p><span>Dirección:</span> <?=$ultimoPedido->direccion?>, <?=$ultimoPedido->provincia?>, <?=$ultimoPedido->departamento?></p>
<p><span>Fecha del Pedido:</span> <?=$ultimoPedido->fecha?></p>
<p><span>Hora del Pedido:</span> <?=$ultimoPedido->hora?></p>

<div style="margin-top: 20px;">
    <?php if(isset($_SESSION['carrito'])){
        $carrito = $_SESSION['carrito'];
    }  
    ?> 
    <h2>Artículos Comprados</h2>       
    <?php if(isset($_SESSION['carrito'])): 
      foreach($carrito as $indice => $producto): 
        $item = $producto['producto'];        
        ?>

        <h4><span>Artículo <?=$indice+1?>:</span>
            <a href="<?=base_url?>producto/productoUnico&id=<?=$item->id?>"><?= $item->nombre; ?></a>
        </h4>
        <ul>
            <li>
                <span>
                Precio:
                </span>
                <?= $item->precio?>
            </li>
            <li>
                <span>
                Unidades:
                </span>
                <?= $producto['unidades']?>
            </li>
        </ul>

    <?php endforeach;
    endif;
    ?>
</div>

<h3><span>Precio Total:</span> $<?=$ultimoPedido->precio_total?></h3>
