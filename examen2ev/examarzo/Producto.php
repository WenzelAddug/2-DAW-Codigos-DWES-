<?php
// Clase asociada a la tabla productos
class Producto {
    private $cod_pro;
    private $nombre_pro;
    private $precio;

    // Getter con método mágico
    public function __get($atributo){
        if (property_exists($this, $atributo)) {
            return $this->$atributo;
        }
    }
    // Setter con método mágico
    public function __set($atributo, $valor){
        if (property_exists($this, $atributo)) {
            $this->$atributo = $valor;
        }
    }
}
