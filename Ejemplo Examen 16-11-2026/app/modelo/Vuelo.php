<?php

class Vuelo {

    private $cod_vuelo;
    private $destino;
    private $aerolinea;
    private $clase;
    private $precio_billete;
    private $asientos_libres;

    function __set($name, $value)
    {
        if ( property_exists($this,$name)){
            $this->$name = $value;
        }
    }

    function __get($name)
    {
        if ( property_exists($this,$name)){
            return $this->$name;
        }
    }

}
