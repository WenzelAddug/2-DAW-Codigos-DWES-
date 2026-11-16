<?php
require_once "Vuelo.php";
/*
 * Acceso a datos con BD y Patrón Singleton
 */
class AccesoDatos {

    private static $modelo = null;
    private $dbh = null;
    private $stmt = null;
    private $stmt_destino = null;

    public static function initModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }


    private function __construct(){

        try {
            $dsn = "mysql:host=localhost;dbname=airflyDB;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "root");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        // Construyo la consulta
        try {
            // Vuelos a un destino con plazas suficientes ordenados por precio
            $this->stmt = $this->dbh->prepare("select * from Vuelos where destino=:destino and asientos_libres >= :plazas order by precio_billete");
            // Cuantos vuelos hay a un destino (para saber si existe)
            $this->stmt_destino = $this->dbh->prepare("select count(*) from Vuelos where destino=:destino");
        } catch (PDOException $e){
            echo " Error al crear la sentencia ".$e->getMessage();
            exit();
        }
    }

    // Devuelvo true si hay algun vuelo a ese destino
    public function existeDestino (string $destino):bool {
        $resu = false;
        $this->stmt_destino->bindValue(':destino', $destino);
        if ( $this->stmt_destino->execute() ){
            $num = $this->stmt_destino->fetchColumn();
            if ( $num > 0 ){
                $resu = true;
            }
        }
        return $resu;
    }

    // Devuelvo un array de objetos Vuelo con plazas suficientes, ordenados por precio
    public function getVuelos (string $destino, int $plazas):array {
        $resu = [];
        $this->stmt->setFetchMode(PDO::FETCH_CLASS, 'Vuelo');
        $this->stmt->bindValue(':destino', $destino);
        $this->stmt->bindValue(':plazas', $plazas, PDO::PARAM_INT);
        if ( $this->stmt->execute() ){
            $resu = $this->stmt->fetchAll();
        }
        return $resu;
    }

    // Cierro la conexión
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->dbh = null;
            self::$modelo = null;
        }
    }

     // Evito que se pueda clonar el objeto.
    public function __clone()
    {
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }
}

