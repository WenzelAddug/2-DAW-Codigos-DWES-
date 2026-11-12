<?php

class Usuario
{

    private $login;
    private $nombre;
    private $password;
    private $comentario;

    function __get($name)
    {
        if (property_exists($this, $name)) {
            if ($name == "comentario"){
                return "Sin comentario";
            }
            return $this->$name;
        }
    }

    function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            return $this->$name = $value;
        }
    }
}
