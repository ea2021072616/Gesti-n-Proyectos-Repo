<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';

class categoriaControlador {
    public function index(){
        Utilidades::esAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->obtenerCategorias();
        require_once 'views/categorias/index.php';
    }

    public function crear(){
        require_once 'views/categorias/crear.php';
    }

    public function guardar(){        
        Utilidades::esAdmin();
        if(isset($_POST) && isset($_POST['nombre'])){
            // Guardar categoría en la base de datos
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);

            if(isset($_GET['id'])){
                $categoria->setId($_GET['id']);
                $categoria->actualizar();

            } else{
                $categoria->guardar();
            }
        }

        header("Location:".base_url."categoria/index");
    }

    public function mostrar(){
        if(isset($_GET['id'])){
            // Buscar categoría
            $categoria = new Categoria();
            $categoria->setId($_GET['id']);
            $categoria = $categoria->obtenerCategoria();

            // Obtener todos los productos de la categoría
            $producto = new Producto();
            $producto->setCategoria_id($_GET['id']);
            $productos = $producto->obtenerProductosPorCategoria();
        }

        require_once 'views/categorias/mostrar.php';
    }

    public function eliminar(){
        Utilidades::esAdmin();

        if(isset($_GET['id'])){
            $categoria = new Categoria();
            $categoria->setId($_GET['id']);
            $eliminar = $categoria->eliminar();

            if($eliminar){
                $_SESSION['categoriaEliminada'] = "completado";
            } else{
                $_SESSION['categoriaEliminada'] = "fallido";
            }
        } else {
            $_SESSION['categoriaEliminada'] = "fallido";
        }

        header("Location:".base_url."categoria/index");

    } // fin de eliminar

    public function editar(){
        Utilidades::esAdmin();
        
        if(isset($_GET['id'])){
            $editar = true;
            $categoria = new Categoria();
            $categoria->setId($_GET['id']);
            $editarCategoria = $categoria->obtenerCategoriaActual();

            require_once 'views/categorias/crear.php';
        } else {
            header("Location:".base_url."producto/gestionar");
        }

    } // fin de editar

}
