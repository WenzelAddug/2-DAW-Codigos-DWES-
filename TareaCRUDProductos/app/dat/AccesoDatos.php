<?php
include_once "app/dat/Producto.php";
include_once "app/config.php";

/*
 * Acceso a datos con BD ProductosDB y Patrón Singleton
 * Un único objeto para la clase
 * VERSION 1:  las sentencias precompiladas ser crean en cada función
 */
class AccesoDatos {

    private static $modelo = null;
    private $dbh = null;


    public static function getModelo(){
        // Si no existe lo crea el acceso de a la BD
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }



   // Constructor privado  Patron singleton, se accede por getModelo

    private function __construct(){

        try {
            $dsn = "mysql:host=".SERVER_DB.";dbname=".DATABASE.";charset=utf8";
            // Creo el objeto PDO estableciendo la conexión a la BD
            $this->dbh = new PDO($dsn,DB_USER,DB_PASSWD);
            // Si falla genera una excepción
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Las columnas de la tabla estan en mayusculas (CODIGO, NOMBRE...)
            // asi las paso a minusculas para que coincidan con los atributos de Producto
            $this->dbh->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->dbh = null;     // Cierro la conexión
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo un array de objetos Producto
    public function getProductos ():array {
        $tprod = [];
        // Sobre la conexión PDO prepara la consulta;
        $stmt_productos  = $this->dbh->prepare("select * from Productos order by CODIGO");
        // Los resultados se devuelven como objetos de la clase Producto
        $stmt_productos->setFetchMode(PDO::FETCH_CLASS, 'Producto');

        // Ejecuto la sentencias
        if ( $stmt_productos->execute() ){
            // Mientra $prod no sea false, sea un objeto
            while ( $prod = $stmt_productos->fetch()){
               // añado ese objeto a la tabla
               $tprod[]= $prod;
            }
        }


        return $tprod;
    }

    // Devuelvo un producto o false
    public function getProducto ($codigo) {
        $prod = false;
        $stmt_producto   = $this->dbh->prepare("select * from Productos where CODIGO=:codigo");
        $stmt_producto->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        $stmt_producto->bindParam(':codigo', $codigo);
        if ( $stmt_producto->execute() ){
             // Solo hay un objeto
             if ( $obj = $stmt_producto->fetch()){
                $prod= $obj;
            }
        }
        return $prod;
    }

    // UPDATE
    public function modProducto($prod):bool{

        $stmt_modprod   = $this->dbh->prepare("update Productos set NOMBRE=:nombre, STOCK=:stock, STOCK_MIN=:stock_min, PRECIO=:precio where CODIGO=:codigo");
        $stmt_modprod->bindValue(':codigo',$prod->codigo);
        $stmt_modprod->bindValue(':nombre',$prod->nombre);
        $stmt_modprod->bindValue(':stock',$prod->stock);
        $stmt_modprod->bindValue(':stock_min',$prod->stock_min);
        $stmt_modprod->bindValue(':precio',$prod->precio);
        $stmt_modprod->execute();
        // El número de filas modificadas debe ser 1
        $resu = ($stmt_modprod->rowCount () == 1);
        return $resu;
    }

    //INSERT
    public function addProducto($prod):bool{
        $stmt_creaprod  = $this->dbh->prepare("insert into Productos (CODIGO,NOMBRE,STOCK,STOCK_MIN,PRECIO) Values(?,?,?,?,?)");
        $stmt_creaprod->execute( [$prod->codigo, $prod->nombre, $prod->stock, $prod->stock_min, $prod->precio]);
        $resu = ($stmt_creaprod->rowCount () == 1);
        return $resu;
    }

    //DELETE
    public function borrarProducto($codigo):bool {
        $stmt_borprod = $this->dbh->prepare("delete from Productos where CODIGO =:codigo");
        $stmt_borprod->bindValue(':codigo', $codigo);
        $stmt_borprod->execute();
        $resu = ($stmt_borprod->rowCount () == 1);
        return $resu;
    }

     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    {
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }
}
