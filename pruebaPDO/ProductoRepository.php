<?php
require_once 'Producto.php';

// Clase con las consultas a la base de datos
class ProductoRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Insertar
    public function crear(Producto $producto) {
        $sql = "INSERT INTO productos (nombre, precio, stock) VALUES (:nombre, :precio, :stock)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nombre', $producto->nombre);
        $stmt->bindValue(':precio', $producto->precio);
        $stmt->bindValue(':stock', $producto->stock);
        $stmt->execute();

        $producto->id = $this->pdo->lastInsertId();
        return $producto->id;
    }

    // Sacar todos los productos
    public function obtenerTodos() {
        $sql = "SELECT * FROM productos";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Producto');
    }

    // Sacar un producto por id
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM productos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        return $stmt->fetch();
    }

    // Modificar
    public function actualizar(Producto $producto) {
        $sql = "UPDATE productos SET nombre = :nombre, precio = :precio, stock = :stock WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nombre', $producto->nombre);
        $stmt->bindValue(':precio', $producto->precio);
        $stmt->bindValue(':stock', $producto->stock);
        $stmt->bindValue(':id', $producto->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Borrar
    public function eliminar($id) {
        $sql = "DELETE FROM productos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
?>
