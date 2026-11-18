
<?php
//Implemento el modelo con  Patrón Singleton
/**
 * @author alberto
 *  
 */
include_once 'Cliente.php';
include_once 'Pedido.php';

class AccesoDatos
{

	private static $modelo;
	private $dbh;
	

	/**
	 *  Crea o devuelve la instancia ya creada
	 *  Patrón Singleton
	 * @return object AccesoDatos
	 * 
	 */
	public static function initModelo()
	{
		if (self::$modelo == null) {
			self::$modelo = new AccesoDatos();
		}
		return self::$modelo;
	}

	/**
	 * Constructor privado invocados desde initModelo
	 * Crea la conexión y las sentencias preparadas
	 */

	private function __construct()
	{

		try {
			$dsn = "mysql:host=localhost;dbname=etienda;charset=utf8";
			$this->dbh = new PDO($dsn, "root", "root");
			$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
		} catch (PDOException $e) {
			echo "Error de conexión " . $e->getMessage();
			exit();
		}
		$this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
		
	}

	/** 
	 *  Comprueba si el usuario y su clave existen
	 * 
	 *  @param string $usuario - nombre del usuario
	 *  @param string $clave - contraseña del usuario
	 *  @return object de tipo cliente o false
	 * 
	 */

	public  function ckequearUsuario(String $usuario, String $clave):mixed
	{

		$objcli = false;
                $stmt1 = $this->dbh->prepare("select * from clientes where nombre = ? and clave = ?");
		$stmt1->bindValue(1, $usuario);
		$stmt1->bindValue(2, $clave);
		$stmt1->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
		if ( $stmt1->execute() ){
			$objcli = $stmt1->fetch();
		}
		
		return $objcli;
	}

	/**
	 *  Devuelve la lista de pedidos de un usuario a partir
	 *  de su código
	 *
	 *  @param int $cod_cliente - Código de cliente
	 *  @return Array de pedidos o array vacio
	 *
	 */
	// Devuelvo la lista de Pedidos
	public function obtenerListaPedidos(int $cod_cliente): array
	{
		$listaresu = [];
		$stmt2 = $this->dbh->prepare("select * from pedidos where cod_cliente = ?");
		$stmt2->bindValue(1, $cod_cliente);
		$stmt2->setFetchMode(PDO::FETCH_CLASS, 'Pedido');
		if ($stmt2->execute() ){
			$listaresu = $stmt2->fetchAll();
		}
		return $listaresu;
	}

	/**
	 *  Incremente el número de acceso de usuario
	 *  @param String códiog del cliente
	 */
	public function incrementarVeces(int $codigo)
	{
		$stmt3 = $this->dbh->prepare("update clientes SET veces=veces+1 where cod_cliente= ?");
		$stmt3->bindValue(1, $codigo);
		$stmt3->execute();
	}


	/**
	 * Evito que se pueda clonar el objeto.
	 * Termina la aplicación.
	 * Patrón Singleton
	 */

	public function clone()
	{

		die("No se puede clonar la conexion a BD");
	}

	public function close()
	{
		$this->dbh = null;
	}
}
