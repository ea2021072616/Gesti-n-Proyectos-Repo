<?php
require_once 'models/pedido.php';
require_once 'vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

class pedidoControlador {
    public function index(){
        echo "Controlador de Pedidos, Acción index";
    }

    public function pedido(){
        require_once 'views/pedido/pedido.php';
    }

    public function agregar(){
        if(isset($_SESSION['identity'])){
            $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : false;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $usuarioId = $_SESSION['identity']->id;
            $valores = Utilidades::valoresCarrito();
            $precioTotal = $valores['total'];

            // Guardar pedido en la base de datos
            if($departamento && $provincia && $direccion){
                $pedido = new Pedido();
                $pedido->setDepartamento($departamento);
                $pedido->setProvincia($provincia);
                $pedido->setDireccion($direccion);
                $pedido->setUsuario_id($usuarioId);
                $pedido->setPrecio_total($precioTotal);
                $guardar = $pedido->guardar();

                // Guardar pedido en la tabla pedido_producto
                $guardarProductosPedido = $pedido->guardarProductosPedido();
                
                if($guardar && $guardarProductosPedido){
                    $_SESSION['pedido'] = "completado";
                } else {
                    $_SESSION['pedido'] = "fallido";
                }
            } else {
                $_SESSION['pedido'] = "fallido";
            }
        } else {
            header("Location: ".base_url);
        }

        header("Location: ".base_url."pedido/confirmado");
    }

    public function confirmado(){
        $pedido = new Pedido();
        $ultimoPedido = $pedido->obtenerUltimoPedido();
        require_once 'views/pedido/confirmado.php';
    }

    public function descargar(){
        $pedido = new Pedido();
        $pedidoDescarga = $pedido->obtenerUltimoPedido();
        $html2pdf = new Html2Pdf();
        ob_start();
        require_once 'views/pedido/confirmarDescarga.php';
        $html = ob_get_clean();
        $html2pdf->writeHTML($html);
        ob_end_clean();
        $html2pdf->output();
        unset($_SESSION['carrito']);
    }

    public function misPedidos(){
       Utilidades::estaLogueado();
       $todosPedidos = new Pedido();
       $usuarioId = $_SESSION['identity']->id;
       $todosPedidos->setUsuario_id($usuarioId);
       $resultado = $todosPedidos->obtenerTodosPorUsuario();
       require_once 'views/orden/misPedidos.php';
    }

    public function detallesPedido(){
        Utilidades::estaLogueado();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $usuarioId = $_SESSION['identity']->id;
            $pedido = new Pedido();
            $pedido->setId($id);
            $detallesPedido = $pedido->obtenerPedidoEspecifico();
            $productos = $pedido->obtenerProductosPorPedido();
            $pedido->setUsuario_id($usuarioId);
            $verificacion = $pedido->obtenerUltimoPorUsuario();
            require_once 'views/pedido/detallesPedido.php';
        } else {
            header("Location: ".base_url."pedido/misPedidos");
        }
    }

    public function gestionar(){
        Utilidades::esAdmin();
        $admin = true;
        $pedido = new Pedido();
        $resultado = $pedido->obtenerProductos();
        require_once 'views/pedido/misPedidos.php';
    }

    public function actualizarEstado(){
        Utilidades::esAdmin();
        if(isset($_POST['pedidoId']) && isset($_POST['estatus'])){
            // Actualizar pedido
            $pedido = new Pedido();
            $pedido->setId($_POST['pedidoId']);
            $pedido->setEstatus($_POST['estatus']);
            $pedido->actualizar();
            header("Location: ".base_url."pedido/detallesPedido&id=".$_POST['pedidoId']);
        } else {
            header("Location: ".base_url);
        }
    }
}
