<?php if(isset($categoria)): ?>
    <h1 style="text-align: center;"><?=ucfirst($categoria->nombre);?></h1>
    <div class="vista-productos">
    <?php while ($producto = $productos->fetch_object()): ?>
        <div class="producto">
            <div class="imagen-producto" style="background-image: url('<?=base_url?>uploads/images/<?=$producto->imagen?>');">
                <!-- <img src="escriba la base url aquí!!! assets/img/product1.png" alt="imagen del producto"> -->
            </div>
            <div class="titulo-producto">
                <h4><?=$producto->nombre?></h4>
            </div>
            <div class="titulo-producto">
                <p>$<?=$producto->precio?></p>
            </div>
            <div class="descripcion-producto">
                <p>
                    <?=$producto->descripcion?>
                </p>
            </div>
            <button class="boton boton-ver-mas"><a href="<?=base_url?>producto/productoUnico&id=<?=$producto->id?>">Ver más</a></button>
        </div>
    <?php endwhile; ?>  
    </div>       
<?php else: ?>
    <h1>No se encontraron categorías...</h1>
<?php endif; ?>
