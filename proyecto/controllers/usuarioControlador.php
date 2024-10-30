<?php
require_once 'models/usuario.php';

class usuarioControlador {

    public $estaLogueado;

    public function index(){
        echo "Controlador de Usuario, Acción index";
    }

    public function setEstaLogueado($estaLogueado){
        $this->estaLogueado = $estaLogueado;
    }

    public function getEstaLogueado(){
        return $this->estaLogueado;
    }

    public function guardar(){
        if(isset($_POST)){
            $nombre = isset($_POST['nombre-registro']) ? $_POST['nombre-registro'] : false;
            $apellido = isset($_POST['apellido-registro']) ? $_POST['apellido-registro'] : false;
            $correo = isset($_POST['correo-registro']) ? $_POST['correo-registro'] : false;
            $clave = isset($_POST['clave-registro']) ? $_POST['clave-registro'] : false;
            
            if($nombre && $apellido && $correo && $clave){
                $usuario = new Usuario();
                $usuario->setNombre($_POST['nombre-registro']);
                $usuario->setApellido($_POST['apellido-registro']);
                $usuario->setCorreo($_POST['correo-registro']);
                $usuario->setClave($_POST['clave-registro']);
                $guardar = $usuario->guardar();

                if($guardar){
                    $_SESSION['registro'] = 'completado';
                    require_once 'views/usuario/registroCompletado.php';
                } else {
                    require_once 'views/usuario/registroCompletado.php';
                    $_SESSION['registro'] = 'fallido';
                }
            } else {
                require_once 'views/usuario/registroCompletado.php';
                $_SESSION['registro'] = 'fallido';
            }
        } else {
            require_once 'views/usuario/registroCompletado.php';
            $_SESSION['registro'] = 'fallido';
        }
        exit(header("Location:".base_url));
    }

    public function iniciarSesion(){
        if(isset($_POST)){
            // Identificar usuario
            $usuario = new Usuario();
            $usuario->setCorreo($_POST['correo-login']);
            $usuario->setClave($_POST['clave']);
            
            $identidad = $usuario->iniciarSesion();

            // Crear sesión para mantener al usuario logueado
            if($identidad && is_object($identidad)){
                $_SESSION['identity'] = $identidad;
                header("Location:".base_url);

                if($identidad->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }
            } else {
                $_SESSION['error_login'] = 'Falló la identificación';
                echo '¡Falló la identificación!';
            }
        }
    }

    public function cerrarSesion(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }

        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);            
        }

        header("Location:".base_url);
    }
} // fin de la clase
