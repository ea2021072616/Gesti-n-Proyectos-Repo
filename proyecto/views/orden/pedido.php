<?php if(!isset($_SESSION['identidad'])): ?>
    <h3 class="alinear-tabla">¡Por favor, inicia sesión para completar tu compra!</h3>
<?php else: ?>
    <div class="alinear-tabla">
        <button class="boton"><a href="<?=base_url?>/carrito/index">Regresar al Carrito</a></button>
    </div>
    <h1 class="texto-centrado">Formulario de Pedido</h1>
    <div class="formulario-pedido alinear-tabla">
        <form action="<?=base_url?>pedido/agregar" method="POST">
            <div class="grupo-formulario">
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" id="direccion">
            </div>
            <div class="grupo-formulario">
                <label for="provincia">Ciudad:</label>
                <input type="text" name="provincia" id="provincia">
            </div>
            <div class="grupo-formulario">
                <label for="departamento">Departamento:</label>
                <input type="text" name="departamento" id="departamento">
            </div>
            <input type="submit" class="boton" value="Comprar Ahora">
        </form>
    </div>
<?php endif; ?>