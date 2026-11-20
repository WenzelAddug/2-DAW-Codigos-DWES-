<?php
include_once "Socio.php";
include_once "Producto.php";

// Datos de conexion
define('SERVER_DB', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWD', 'root');
define('DATABASE', 'comprasdb');

/*
 * Acceso a la BD comprasdb con el patron Singleton
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

    // Constructor privado, se llama desde getModelo
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

    // Devuelve el socio con ese codigo y clave, o false si no existe
    public function getSocio(String $cod_socio, String $clave){
        $socio = false;
        $stmt_socio = $this->dbh->prepare("select * from socios where cod_socio = :cod and clave = :clave");
        $stmt_socio->setFetchMode(PDO::FETCH_CLASS, 'Socio');
        $stmt_socio->bindValue(':cod', $cod_socio);
        $stmt_socio->bindValue(':clave', $clave);
        if ($stmt_socio->execute()){
            if ($obj = $stmt_socio->fetch()){
                $socio = $obj;
            }
        }
        return $socio;
    }

    // Devuelve el producto con ese codigo, o false si no existe
    public function getProducto(String $cod_pro){
        $pro = false;
        $stmt_pro = $this->dbh->prepare("select * from productos where cod_pro = :cod");
        $stmt_pro->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        $stmt_pro->bindValue(':cod', $cod_pro);
        if ($stmt_pro->execute()){
            if ($obj = $stmt_pro->fetch()){
                $pro = $obj;
            }
        }
        return $pro;
    }

    // Resta el precio de la compra al limite del socio
    public function restarLimite(String $cod_socio, int $precio):bool {
        $stmt_limite = $this->dbh->prepare("update socios set cantidad_max = cantidad_max - :precio where cod_socio = :cod");
        $stmt_limite->bindValue(':precio', $precio);
        $stmt_limite->bindValue(':cod', $cod_socio);
        $stmt_limite->execute();
        return ($stmt_limite->rowCount() == 1);
    }

    // Evito que se pueda clonar el objeto (Singleton)
    public function __clone(){
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }
}
