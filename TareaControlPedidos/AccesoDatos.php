<?php
include_once "Cliente.php";
include_once "Pedido.php";

// Datos de conexion a la BD
define('SERVER_DB', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWD', 'root');
define('DATABASE', 'etienda');

/*
 * DAO de la BD etienda con el patron Singleton
 * (solo hay un objeto de conexion para toda la aplicacion)
 */
class AccesoDatos {

    private static $modelo = null;
    private $dbh = null;

    public static function getModelo(){
        // Si no existe lo creo
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }

    // Constructor privado, solo se llama desde getModelo
    private function __construct(){
        try {
            $dsn = "mysql:host=".SERVER_DB.";dbname=".DATABASE.";charset=utf8";
            $this->dbh = new PDO($dsn, DB_USER, DB_PASSWD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Las sentencias se precompilan de verdad en el servidor
            $this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
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

    // Busco el cliente con ese nombre y clave
    // Devuelve un objeto Cliente o false si no existe
    public function getCliente(String $nombre, String $clave){
        $cli = false;
        $stmt_cliente = $this->dbh->prepare("select * from clientes where nombre = :nombre and clave = :clave");
        $stmt_cliente->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        $stmt_cliente->bindValue(':nombre', $nombre);
        $stmt_cliente->bindValue(':clave', $clave);
        if ($stmt_cliente->execute()){
            if ($obj = $stmt_cliente->fetch()){
                $cli = $obj;
            }
        }
        return $cli;
    }

    // Sumo 1 a las veces que ha entrado el cliente
    public function incrementarVeces(int $cod_cliente):bool {
        $stmt_veces = $this->dbh->prepare("update clientes set veces = veces + 1 where cod_cliente = :cod");
        $stmt_veces->bindValue(':cod', $cod_cliente);
        $stmt_veces->execute();
        $resu = ($stmt_veces->rowCount() == 1);
        return $resu;
    }

    // Devuelvo un array con los pedidos del cliente (vacio si no tiene)
    public function getPedidos(int $cod_cliente):array {
        $tpedidos = [];
        $stmt_pedidos = $this->dbh->prepare("select * from pedidos where cod_cliente = :cod");
        $stmt_pedidos->setFetchMode(PDO::FETCH_CLASS, 'Pedido');
        $stmt_pedidos->bindValue(':cod', $cod_cliente);
        if ($stmt_pedidos->execute()){
            while ($ped = $stmt_pedidos->fetch()){
                $tpedidos[] = $ped;
            }
        }
        return $tpedidos;
    }

    // Evito que se pueda clonar el objeto (Singleton)
    public function __clone(){
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }
}
