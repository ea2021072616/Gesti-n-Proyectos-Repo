<?php
require_once 'models/producto.php';

class productoControlador {
    public function index(){
        // Renderizar índice
        $producto = new Producto();
        $productos = $producto->obtenerAleatorio(6);
        require_once 'views/producto/productos-destacados.php';
    }

    public function gestionar(){
        Utilidades::esAdmin();

        $producto = new Producto();
        $productos = $producto->obtenerProductos();
        require_once 'views/producto/gestionar.php';
    }
    
    public function crear(){
        Utilidades::esAdmin();
        require_once 'views/producto/crear.php';
    }

    public function guardar(){
        Utilidades::esAdmin();
        if(isset($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
        
            if($nombre && $descripcion && $precio && $stock && $categoria){
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);

                // Guardar imagen
                if(isset($_FILES['imagen'])){
                    $imagen = $_FILES['imagen'];
                    $nombreImagen = $imagen['name'];
                    $tipoMime = $imagen['type'];

                    if($tipoMime == "image/jpg" || $tipoMime == "image/jpeg" || $tipoMime == "image/png" || $tipoMime == "image/gif"){
                        if(!is_dir('uploads/imagenes')){
                            mkdir('uploads/imagenes', 0777, true); // El parámetro true permite crear carpetas recursivamente
                        }

                        move_uploaded_file($imagen['tmp_name'], 'uploads/imagenes/'.$nombreImagen);
                        $producto->setImagen($nombreImagen);
                    }
                }

                // Verificar si es un nuevo producto o una actualización
                if(isset($_GET['id'])){
                    $producto->setId($_GET['id']);
                    $guardar = $producto->actualizar();                
                } else {
                    $guardar = $producto->guardar();
                }
                
                if($guardar){
                    $_SESSION['producto'] = "completado";
                } else {
                    $_SESSION['producto'] = "fallido";
                }
            } else {
                $_SESSION['producto'] = "fallido";
            }
        } else {
            $_SESSION['producto'] = "fallido";
        }

        header("Location:".base_url."producto/gestionar");
    } // fin de guardar

    public function editar(){
        Utilidades::esAdmin();
        
        if(isset($_GET['id'])){
            $editar = true;
            $producto = new Producto();
            $producto->setId($_GET['id']);
            $productoEditar = $producto->obtenerProductoActual();

            require_once 'views/producto/crear.php';
        } else {
            header("Location:".base_url."producto/gestionar");
        }
    } // fin de editar

    public function eliminar(){
        Utilidades::esAdmin();

        if(isset($_GET['id'])){
            $producto = new Producto();
            $producto->setId($_GET['id']);
            $eliminar = $producto->eliminar();

            if($eliminar){
                $_SESSION['eliminado'] = "completado";
            } else {
                $_SESSION['eliminado'] = "fallido";
            }
        } else {
            $_SESSION['eliminado'] = "fallido";
        }

        header("Location:".base_url."producto/gestionar");
    } // fin de eliminar

    public function productoUnico(){
        if(isset($_GET['id'])){
            $producto = new Producto();
            $producto->setId($_GET['id']);
            $productoUnico = $producto->obtenerProductoActual();

            require_once 'views/producto/producto-unico.php';
        } else {
            header("Location:".base_url."producto/gestionar");
        }
    }
}
