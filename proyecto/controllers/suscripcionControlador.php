<?php

class suscripcionControlador {
    public function index(){
        require_once 'views/suscripcion/exito.php';
    }

    public function suscribirse(){
        if(isset($_POST['correo'])){
            $correo = $_POST['correo'];
            var_dump($correo);
            require_once 'APIs/suscripcion.php';
            header("Location:".base_url."suscripcion/index");
        }
    }
}
