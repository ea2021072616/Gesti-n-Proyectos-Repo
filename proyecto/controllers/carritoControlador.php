<?php
require_once 'models/producto.php';

class carritoControlador {
    public function index(){
        if(isset($_SESSION['carrito'])){
            $carrito = $_SESSION['carrito'];
        }
        require_once "views/carrito/carrito.php";
    }

    public function agregar(){
        if(isset($_GET['id'])){
            $productoId = $_GET['id'];
        } else{
            header('Location: '.base_url);
        }

        if(isset($_SESSION['carrito'])){
            $contador = 0;
            foreach($_SESSION['carrito'] as $indice => $valor){
                if($valor['productoId'] == $productoId){
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $contador++;
                }
            }
        }

        if(!isset($contador) || $contador == 0){
            // obtener producto
            $producto = new Producto();
            $producto->setId($productoId);
            $producto = $producto->obtenerProductoActual();

            if(is_object($producto)){
                $_SESSION['carrito'][] = array(
                    "productoId" => $producto->id,
                    "precio" => $producto->precio,
                    "unidades" => 1,
                    "producto" => $producto
                );
            }
        }

        header("Location: ".base_url."carrito/index");
    }

    public function eliminar(){
        unset($_SESSION['carrito']);
        header("Location: ".base_url."carrito/index");
    }

    public function quitar(){
        if(isset($_GET['indice'])){
            $indice = $_GET['indice'];
            unset($_SESSION['carrito'][$indice]);
        }
        header("Location: ".base_url."carrito/index");
    }

    public function aumentar(){
        if(isset($_GET['indice'])){
            $indice = $_GET['indice'];
            $_SESSION['carrito'][$indice]['unidades']++;
        }
        header("Location: ".base_url."carrito/index");
    }

    public function reducir(){
        if(isset($_GET['indice'])){
            $indice = $_GET['indice'];
            $_SESSION['carrito'][$indice]['unidades']--;
            if($_SESSION['carrito'][$indice]['unidades'] == 0){
                unset($_SESSION['carrito'][$indice]);
            }
        }
        header("Location: ".base_url."carrito/index");
    }
}
