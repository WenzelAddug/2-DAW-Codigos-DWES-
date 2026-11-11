<?php
require_once 'conexion.php';
require_once 'Producto.php';
require_once 'ProductoRepository.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Prueba PDO</title>
</head>
<body>
<?php
try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $repo = new ProductoRepository($pdo);

    echo "<h2>CRUD de productos</h2>";

    // Crear
    $nuevoProd = new Producto();
    $nuevoProd->nombre = "Teclado Mecánico";
    $nuevoProd->precio = 59.99;
    $nuevoProd->stock = 10;

    $idGenerado = $repo->crear($nuevoProd);
    echo "Producto creado: " . $nuevoProd->info() . "<br>";

    // Listar
    echo "<br><strong>Lista de productos:</strong><br>";
    $lista = $repo->obtenerTodos();
    foreach ($lista as $p) {
        echo "- " . $p->info() . "<br>";
    }

    // Actualizar
    $prodParaEditar = $repo->obtenerPorId($idGenerado);
    if ($prodParaEditar) {
        $prodParaEditar->precio = 45.00;
        $prodParaEditar->stock = 9;
        $repo->actualizar($prodParaEditar);
        echo "<br>Producto actualizado (nuevo precio: 45.00$)<br>";
    }

    // Comprobar que se ha cambiado
    $prodVerificado = $repo->obtenerPorId($idGenerado);
    echo "Comprobacion: " . $prodVerificado->info() . "<br>";

    // Borrar
    $filas = $repo->eliminar($idGenerado);
    if ($filas > 0) {
        echo "<br>Producto eliminado";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>
</body>
</html>
