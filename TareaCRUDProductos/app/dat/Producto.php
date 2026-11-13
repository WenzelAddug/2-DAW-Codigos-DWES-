<?php


class Producto
{
    // Los nombres son los de las columnas de la tabla Productos pero en minusculas
    // (en AccesoDatos pongo PDO::CASE_LOWER para que coincidan)
    private $codigo;
    private $nombre;
    private $stock;
    private $stock_min;
    private $precio;

    // Getter con método mágico
    public function __get($atributo){
        if(property_exists($this, $atributo)) {
            return $this->$atributo;
        }
    }
    // Setter con método mágico
    public function __set($atributo,$valor){
        if(property_exists($this, $atributo)) {
            $this->$atributo = $valor;
        }
    }

}
