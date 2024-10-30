<!-- Modal de Inicio de Sesión -->
<section class="seccion-login oculto">
    <div class="contenedor-login">
        <div class="caja-login">
            <i class="cerrar fas fa-times-circle"></i>
            <div class="titulo-login">
                <h3>Iniciar Sesión:</h3>
            </div>
            <form action="<?=base_url?>usuario/iniciarSesion" method="POST" id="formulario-login" class="formulario-login">
                <div class="grupo-formulario">
                    <label for="correo-login">Correo Electrónico:</label>
                    <input type="email" name="correo-login" id="correo-login">
                </div>
                <div class="grupo-formulario">
                    <label for="clave">Contraseña:</label>
                    <input type="password" name="clave" id="clave">
                </div>
                <div class="grupo-formulario">
                    <input type="submit" class="boton boton-login" value="Iniciar Sesión">
                </div>
            </form>
            <div class="yaRegistrado">
                <p>¿No tienes una cuenta? <span class="registrarse-aqui negrita"> ¡Regístrate aquí!</span></p>
            </div>
        </div>
    </div>
</section>
