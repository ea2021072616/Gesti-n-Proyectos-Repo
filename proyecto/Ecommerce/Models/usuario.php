<?php

namespace Ecommerce\Modelos;

class Usuario {

    public $nombre;
    public $edad;

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getNombre(){
        return 'Erick is so much';
    }

    public function setEdad($añoActual, $añoNacimiento){
        $this->edad = $añoActual - $añoNacimiento;
    }

    public function getEdad(){
        return $this->edad;
    }

}
