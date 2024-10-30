<?php if(isset($productoUnico)): ?>
    <h1 style="text-align: center;"><?=ucfirst($productoUnico->nombre);?></h1>
    <div class="vista-producto-unico">
    </div>       
<?php else: ?>
    <h1>No se encontró el producto...</h1>
<?php endif; ?>

<div class="contenedor-producto-unico">
    <div class="imagen-destacada-producto" style="background-image: url('<?=base_url?>uploads/images/<?=$productoUnico->imagen;?>');">

    </div>
    <div class="detalles-unico">
        <div class="descripcion">
            <p><?=$productoUnico->descripcion;?></p>
        </div>
        <div class="precio-unico">
            <p>$<?=$productoUnico->precio;?></p>
        </div>
        <button class="boton boton-agregar-carrito"><a href="<?=base_url?>carrito/agregar&id=<?=$productoUnico->id;?>">Añadir al Carrito</a> </button>
    </div>
</div>
