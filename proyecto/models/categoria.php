<?php

class Categoria {
    private $id;
    private $nombre;
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

    public function obtenerCategorias(){
        $categorias = $this->db->query("SELECT * FROM categoria ORDER BY id DESC");
        return $categorias;
    }

    public function obtenerCategoria(){
        $categoria = $this->db->query("SELECT * FROM categoria WHERE id={$this->getId()}");
        return $categoria->fetch_object();
    }

    public function guardar(){
        $sql = "INSERT INTO categoria VALUES(NULL, '{$this->getNombre()}')";
        $guardar = $this->db->query($sql);

        $resultado = false;

        if($guardar){
            $resultado = true;
        }

        return $resultado;
    }

    public function eliminar(){
        $sql = "DELETE FROM categoria WHERE id={$this->id}";
        $eliminar = $this->db->query($sql);

        $resultado = false;
        if($eliminar){
            $resultado = true;
        }

        return $resultado;
    }

    public function obtenerCategoriaActual(){
        $categoria = $this->db->query("SELECT * FROM categoria WHERE id={$this->id}");
        return $categoria->fetch_object();
    }

    public function actualizar(){
        $sql = "UPDATE categoria SET id='{$this->getId()}', nombre='{$this->getNombre()}'";
        $sql .= " WHERE id={$this->id};";
        $guardar = $this->db->query($sql);

        $resultado = false;
        if($guardar){
            $resultado = true;
        }

        return $resultado;
    }
}
