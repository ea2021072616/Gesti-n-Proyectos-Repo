<?php

class Pedido {
    private $id;
    private $usuario_id;
    private $departamento;
    private $provincia;
    private $direccion;
    private $precio_total;
    private $estatus;
    private $fecha;
    private $hora;
    private $db;

    public function __construct(){
        $this->db = Database::conexion();
    }

    /**
     * Obtener el valor de id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Establecer el valor de id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Obtener el valor de usuario_id
     */ 
    public function getUsuario_id()
    {
        return $this->usuario_id;
    }

    /**
     * Establecer el valor de usuario_id
     *
     * @return  self
     */ 
    public function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;

        return $this;
    }

    /**
     * Obtener el valor de departamento
     */ 
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Establecer el valor de departamento
     *
     * @return  self
     */ 
    public function setDepartamento($departamento)
    {
        $this->departamento = $this->db->real_escape_string($departamento);

        return $this;
    }

    /**
     * Obtener el valor de provincia
     */ 
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Establecer el valor de provincia
     *
     * @return  self
     */ 
    public function setProvincia($provincia)
    {
        $this->provincia = $this->db->real_escape_string($provincia);

        return $this;
    }

    /**
     * Obtener el valor de direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Establecer el valor de direccion
     *
     * @return  self
     */ 
    public function setDireccion($direccion)
    {
        $this->direccion = $this->db->real_escape_string($direccion);

        return $this;
    }

    /**
     * Obtener el valor de precio_total
     */ 
    public function getPrecio_total()
    {
        return $this->precio_total;
    }

    /**
     * Establecer el valor de precio_total
     *
     * @return  self
     */ 
    public function setPrecio_total($precio_total)
    {
        $this->precio_total = $precio_total;

        return $this;
    }

    /**
     * Obtener el valor de estatus
     */ 
    public function getEstatus()
    {
        return $this->estatus;
    }

    /**
     * Establecer el valor de estatus
     *
     * @return  self
     */ 
    public function setEstatus($estatus)
    {
        $this->estatus = $estatus;

        return $this;
    }

    /**
     * Obtener el valor de fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Establecer el valor de fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Obtener el valor de hora
     */ 
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Establecer el valor de hora
     *
     * @return  self
     */ 
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    public function obtenerProductos(){
        $pedidos = $this->db->query("SELECT * FROM pedido ORDER BY id DESC");
        return $pedidos;
    }

    public function guardar(){
        $sql = "INSERT INTO pedido VALUES(NULL, '{$this->getUsuario_id()}', '{$this->getDepartamento()}', '{$this->getProvincia()}', '{$this->getDireccion()}', '{$this->getPrecio_total()}', 'confirmado', CURDATE(), CURTIME())";
        $guardar = $this->db->query($sql);
    
        $resultado = false;
        if($guardar){
            $resultado = true;
        }

        return $resultado;
    }

    public function obtenerProductoActual(){
        $pedido = $this->db->query("SELECT * FROM pedido WHERE id={$this->id}");
        return $pedido->fetch_object();
    }

    public function guardarProductosPedido(){
        // Obtener ID del último pedido
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);

        $pedidoId = $query->fetch_object()->pedido;

        // Insertar último pedido en tabla pedido_producto
        foreach($_SESSION['carrito'] as $indice => $valor){
            $producto = $valor['producto'];

            $insertar = "INSERT INTO pedido_producto VALUES(NULL, {$pedidoId}, {$producto->id}, {$valor['unidades']})";
            $guardar = $this->db->query($insertar);
        }

        $resultado = false;
        if($guardar){
            $resultado = true;
        }

        return $resultado;
    }

    public function obtenerUltimoPedido(){
        // Obtener último pedido
        $ultimoPedido = $this->db->query("SELECT * FROM pedido ORDER BY id DESC LIMIT 1;");
        return $ultimoPedido;
    }

    public function obtenerTodosPorUsuario(){
        // Obtener todos los pedidos de un usuario específico        
        $sql = "SELECT p.* FROM pedido AS p "
                ."WHERE p.usuario_id= {$this->getUsuario_id()} ORDER BY id DESC";
        $pedido = $this->db->query($sql);
        return $pedido;
    }

    public function obtenerPedidoEspecifico(){
        $sql = "SELECT * FROM pedido WHERE id= {$this->getId()}";
        $pedido = $this->db->query($sql);
        return $pedido;
    }

    public function obtenerUltimoPorUsuario(){
        $sql = "SELECT * FROM pedido AS p "
                . "WHERE usuario_id={$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";

        $producto = $this->db->query($sql);
        return $producto;
    }

    public function obtenerProductosPorPedido(){      
        $sql = "SELECT p.*, pp.unidades FROM producto p "
                . "INNER JOIN pedido_producto pp ON p.id = pp.producto_id "
                . "WHERE pp.pedido_id={$this->getId()}";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function obtenerUnidades(){
        $sql = "SELECT *, COUNT(unidades) AS cnt FROM pedido_producto WHERE pedido_id= {$this->getId()} HAVING cnt > 1";
        $unidades = $this->db->query($sql);
        return $unidades;
    }

    public function actualizar(){
        $sql = "UPDATE pedido SET estatus='{$this->getEstatus()}' "; 
        $sql .= "WHERE id={$this->getId()};";
        $guardar = $this->db->query($sql);

        $resultado = false;
        if($guardar){
            $resultado = true;
        }

        return $resultado;
    }
}

// Debug Mysql

// echo $this->db->error;
// die();
