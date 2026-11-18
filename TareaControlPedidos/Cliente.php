<?php
// Clase Cliente (DTO) con las columnas de la tabla clientes
class Cliente {
    private $cod_cliente;
    private $nombre;
    private $clave;
    private $veces;

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
