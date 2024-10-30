<?php

class Producto {
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $descuento;
    private $fecha;
    private $imagen;
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
     * Obtener el valor de categoria_id
     */ 
    public function getCategoria_id()
    {
        return $this->categoria_id;
    }

    /**
     * Establecer el valor de categoria_id
     *
     * @return  self
     */ 
    public function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;

        return $this;
    }

    /**
     * Obtener el valor de nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Establecer el valor de nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);

        return $this;
    }

    /**
     * Obtener el valor de descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Establecer el valor de descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);

        return $this;
    }

    /**
     * Obtener el valor de precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Establecer el valor de precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $this->db->real_escape_string($precio);

        return $this;
    }

    /**
     * Obtener el valor de stock
     */ 
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Establecer el valor de stock
     *
     * @return  self
     */ 
    public function setStock($stock)
    {
        $this->stock = $this->db->real_escape_string($stock);

        return $this;
    }

    /**
     * Obtener el valor de descuento
     */ 
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Establecer el valor de descuento
     *
     * @return  self
     */ 
    public function setDescuento($descuento)
    {
        $this->descuento = $this->db->real_escape_string($descuento);

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
     * Obtener el valor de imagen
     */ 
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Establecer el valor de imagen
     *
     * @return  self
     */ 
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function obtenerProductos(){
        $productos = $this->db->query("SELECT * FROM producto ORDER BY id DESC");
        return $productos;
    }

    public function guardar(){
        $sql = "INSERT INTO producto VALUES(NULL, '{$this->getCategoria_id()}', '{$this->getNombre()}', '{$this->getDescripcion()}', '{$this->getPrecio()}', '{$this->getStock()}', NULL, CURDATE(), '{$this->getImagen()}')";
        $guardar = $this->db->query($sql);

        $resultado = false;
        if($guardar){
            $resultado = true;
        }

        return $resultado;
    }

    public function actualizar(){
        $sql = "UPDATE producto SET categoria_id='{$this->getCategoria_id()}', nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio='{$this->getPrecio()}', stock='{$this->getStock()}' "; 
        if($this->getImagen() != null){
            $sql .= ", imagen='{$this->getImagen()}'";
        }
        $sql .= " WHERE id={$this->id};";
        $guardar = $this->db->query($sql);

        $resultado = false;
        if($guardar){
            $resultado = true;
        }

        return $resultado;
    }

    public function eliminar(){
        $sql = "DELETE FROM producto WHERE id={$this->id}";
        $eliminar = $this->db->query($sql);
        
        $resultado = false;
        if($eliminar){
            $resultado = true;
        }

        return $resultado;
    }

    public function obtenerProductoActual(){
        $producto = $this->db->query("SELECT * FROM producto WHERE id={$this->id}");
        return $producto->fetch_object();
    }

    public function obtenerAleatorio($limite){
        $productos = $this->db->query("SELECT * FROM producto ORDER BY RAND() LIMIT $limite");
        return $productos;
    }

    public function obtenerProductosPorCategoria(){
        $sql = "SELECT p.*, c.nombre AS 'nombreCategoria' FROM producto p "
                . "INNER JOIN categoria c ON c.id = p.categoria_id "
                . "WHERE p.categoria_id={$this->getCategoria_id()} "
                . "ORDER BY id DESC";
        $productos = $this->db->query($sql);
        return $productos;
    }
}

// Debugg Mysql

// echo $this->db->error;
// die();
