<?php
// Clase que representa una fila de la tabla Productos
class Producto {
    private $producto_no;
    private $descripcion;
    private $precio_actual;
    private $stock_disponible;

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
