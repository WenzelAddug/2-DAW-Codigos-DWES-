<?php
include_once "Producto.php";

// Datos de conexion
define('SERVER_DB', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWD', 'root');
define('DATABASE', 'Almacendb');

/*
 * Todas las operaciones sobre la BD Almacendb
 * Patron Singleton: un unico objeto de la clase
 */
class AccesoDatos {

    private static $modelo = null;
    private $dbh = null;

    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }

    // Constructor privado, se accede por getModelo
    private function __construct(){
        try {
            $dsn = "mysql:host=".SERVER_DB.";dbname=".DATABASE.";charset=utf8";
            $this->dbh = new PDO($dsn, DB_USER, DB_PASSWD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
    }

    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->dbh = null;
            self::$modelo = null;
        }
    }

    // Devuelve los productos con un stock mayor que $minimo
    public function getProductosStock(int $minimo):array {
        $tproductos = [];
        $stmt_productos = $this->dbh->prepare("select * from Productos where stock_disponible > :minimo order by producto_no");
        $stmt_productos->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        $stmt_productos->bindValue(':minimo', $minimo);
        if ($stmt_productos->execute()){
            while ($pro = $stmt_productos->fetch()){
                $tproductos[] = $pro;
            }
        }
        return $tproductos;
    }

    // Baja un 10% el precio de los productos que vienen en el array
    // Devuelve cuantos productos se han actualizado
    public function actualizarPrecios(array $tproductono):int {
        $cont = 0;
        $stmt_precio = $this->dbh->prepare("update Productos set precio_actual = precio_actual * 0.90 where producto_no = :no");
        foreach ($tproductono as $no){
            $stmt_precio->bindValue(':no', $no);
            $stmt_precio->execute();
            $cont += $stmt_precio->rowCount();
        }
        return $cont;
    }

    // Evito que se pueda clonar el objeto (Singleton)
    public function __clone(){
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }
}
