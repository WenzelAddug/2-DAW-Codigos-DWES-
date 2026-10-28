<?php
session_start();

// Manejo de la sesión con dos valores
// 'cliente' => nombre del cliente
// 'pedidos' => array asociativo fruta => cantidad


// Nuevo cliente: anoto en la sesión su nombre y creo su tabla de pedidos vacía
if (isset($_GET['cliente'])) {
    $_SESSION['cliente'] = $_GET['cliente'];
    $_SESSION['pedidos'] = array();
}

// No hay definido un cliente todavía en la session
if (!isset($_SESSION['cliente'])) {
    require_once 'bienvenida.php';
    exit();
}


// Proceso las acciones
if (isset($_POST["accion"])) {

switch ($_POST["accion"]) {
     case " Anotar ":
        // Actualizo la tabla de pedidos en la sesión
        $fruta = $_POST['fruta'];
        $cantidad = intval($_POST['cantidad']);
        if ($cantidad > 0) {
            // Si ya habia pedido esa fruta se suma a lo que tenia
            if (isset($_SESSION['pedidos'][$fruta])) {
                $_SESSION['pedidos'][$fruta] += $cantidad;
            } else {
                $_SESSION['pedidos'][$fruta] = $cantidad;
            }
        }
        break;
    case " Anular ":
        // Vacío la tabla de pedidos en la sesión
        $_SESSION['pedidos'] = array();
        break;
    case " Terminar ":
           // Destruyo la sesión y vuelvo a la página de bienvenida
        // Primero guardo la tabla para enseñarla en la despedida
        $compraRealizada = htmlTablaPedidos();
        $_SESSION = array();
        session_destroy();
        require_once 'despedida.php';
        exit();
        break;


}
}

$compraRealizada = htmlTablaPedidos();
require_once 'compra.php';


// Función axiliar que genera una tabla HTML a partir  la tabla de pedidos
// Almacenada en la sesión
function htmlTablaPedidos(): string
{
    $msg = "";
    if (isset($_SESSION['pedidos']) && count($_SESSION['pedidos']) > 0) {
        $msg .= "Este es su pedido :<br>";
        $msg .= "<table border='1'>";
        foreach ($_SESSION['pedidos'] as $fruta => $cantidad) {
            $msg .= "<tr><td><b>$fruta</b></td><td>$cantidad</td></tr>";
        }
        $msg .= "</table>";
    }
    return $msg;
}
