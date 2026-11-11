<?php
// Clase Producto
class Producto {
    public $id;
    public $nombre;
    public $precio;
    public $stock;

    public function info() {
        return "[ID: {$this->id}] {$this->nombre} - Precio: {$this->precio}$ (Stock: {$this->stock})";
    }
}
?>
