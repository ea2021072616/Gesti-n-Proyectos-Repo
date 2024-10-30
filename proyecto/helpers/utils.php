<?php

class Utilidades {
    public static function eliminarSesion($nombre){
        if(isset($_SESSION[$nombre])){
            $_SESSION[$nombre] = null;
            unset($_SESSION[$nombre]);
        }

        return $nombre;
    }

    public static function esAdmin(){
        if(!isset($_SESSION['admin'])){
            header('Location: '.base_url);
        } else {
            return true;
        }
    }

    public static function mostrarCategorias(){
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->obtenerCategorias();
        return $categorias;
    }

    public static function valoresCarrito(){
        $valores = array('cantidad' => 0, 'total' => 0);
        if(isset($_SESSION['carrito'])){
            $valores['cantidad'] = count($_SESSION['carrito']);

            foreach($_SESSION['carrito'] as $indice => $valor){
                $valores['total'] += $valor['precio'] * $valor['unidades'];
            }
        }

        return $valores;
    }

    public static function estaLogueado(){
        if(!isset($_SESSION['identity'])){
            header("Location: ".base_url);
        } 
    }
}
