<?php

class Usuario
{

    private string $login;
    private string $nombre;
    private string $password;
    private string $comentario;

    function __get(string  $name)
    {
        if (property_exists($this, $name)) {
            if ($name == "comentario"){
                return "Sin comentario";
            }
            return $this->$name;
        }
    }

    function __set(string $name, mixed $value)
    {
        if (property_exists($this, $name)) {
            return $this->$name = $value;
        }
    }
}
