<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"
      integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js" defer></script>
    <script type="text/javascript" src="<?=base_url?>cliente/js/index.js" defer></script>
    <title>Comercio Electrónico</title>
</head>
<body>
<div class="contenedor-pagina">
    <div id="contenido-principal">
    <!-- Encabezado  -->
    <header class="encabezado">
         <div class="encabezado-principal">
             <div class="menu-comercio">
                <div class="logo">
                    <a href="<?=base_url?>">
                        <img src="assets/img/logo.png" alt="Logo de la Empresa" width="150" height="100" />
                    </a>
                </div>

                <div class="elementos-menu">
                    <?php $categorias = Utilidades::mostrarCategorias(); 
                        while($categoria = $categorias->fetch_object()): ?>
                        <p><a href="<?=base_url?>categoria/mostrar&id=<?=$categoria->id;?>"><?=$categoria->nombre?></a></p>
                    <?php endwhile;?>                                    
                </div>
             </div>
             <div class="menu-usuario">
                 <div class="perfil-usuario">
                    <?php if(isset($_SESSION['identity'])): ?>
                    <i class="usuario far fa-user"></i>
                    <?php else: ?>
                        <i class="usuario far fa-user oculto"></i>
                    <?php endif; ?>
                    <div class="menu-hover-perfil oculto">
                        <ul>
                            <?php if(isset($_SESSION['admin'])): ?>
                                <li><a href="<?=base_url?>categoria/index">Gestionar Categorías</a></li>
                                <li><a href="<?=base_url?>producto/gestionar">Gestionar Productos</a></li>
                                <li><a href="<?=base_url?>pedido/gestionar">Gestionar Pedidos</a></li>
                            <?php endif; ?>
                            <li><a href="<?=base_url?>pedido/misPedidos">Mis pedidos</a></li>
                            <li><a href="<?=base_url?>usuario/cerrarSesion">Cerrar sesión</a></li>
                        </ul>
                    </div>
                 </div>
                 
                 <div class="login">
                    <?php if(isset($_SESSION['identity'])): ?>
                        <p>Bienvenido, <?=$_SESSION['identity']->nombre?>!</p>
                    <?php else: ?>
                    <p>Login</p>
                    <?php endif; ?>
                </div>
                <div class="buscar">
                    <i class="fas fa-search"></i>
                </div>
                <div class="favoritos">
                    <i class="far fa-heart"></i>
                </div>
                <div class="carrito">
                    <?php $rutaCarrito = base_url."carrito/index"; ?>
                    <a href="<?=$rutaCarrito?>"><i class="fas fa-shopping-cart"></i></a>                    
                </div>
             </div>
         </div>
    </header>
