<?php
// Clase asociada a la tabla socios
class Socio {
    private $cod_socio;
    private $nombre;
    private $clave;
    private $cantidad_max;

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
