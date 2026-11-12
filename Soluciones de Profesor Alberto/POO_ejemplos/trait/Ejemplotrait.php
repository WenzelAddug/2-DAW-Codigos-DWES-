<?php


trait Ejemplotrait
{
    private int $precio;
    function setprecio (int $precio ){
        $this->precio = $precio;
    }
    function getprecio ():int{
        return $this->precio;
    }
}

