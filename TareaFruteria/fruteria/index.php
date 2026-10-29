<?php
session_start();

// Manejo de la sesión con dos valores
// 'cliente' => nombre del cliente
// 'pedidos' => array asociativo fruta => cantidad


// 2º Nuevo cliente: anoto en la sesión su nombre y creo su tabla de pedidos vacía
if (isset($_GET['cliente'])) {
    $_SESSION['cliente'] =  $_GET['cliente']; //añadimos el cliente
    $_SESSION['pedidos'] = [];
}

// 1º No hay definido un cliente todavía en la session 
if (!isset($_SESSION['cliente'])) {
    include"bienvenida.php"; //añadimos la pagina principal para que el usuario se registre
    die();
}


// 3º Proceso las acciones 
if (isset($_POST["accion"])) {

switch ($_POST["accion"]) {
     case " Anotar ":
        $fruta = $_POST["fruta"];
        $cantidad = $_POST["cantidad"];
        // Actualizo la tabla de pedidos en la sesión
        if(isset($_SESSION["pedidos"][$fruta])){
            $_SESSION["pedidos"][$fruta] += $cantidad;
        }else{
            $_SESSION["pedidos"][$fruta] = $cantidad;
        }
        break;
    case " Anular ":
        $fruta = $_POST["fruta"];
        // Vacío la tabla de pedidos en la sesión
        unset($_SESSION["pedidos"][$fruta]);
        break;
    case " Terminar ":
// Destruyo la sesión y vuelvo a la página de bienvenida
        $compraRealizada = htmlTablaPedidos();
        include_once "despedida.php";
        session_destroy ();
        exit();
        break;

}
}

$compraRealizada = htmlTablaPedidos();
require_once 'compra.php';


// Función axiliar que genera una tabla HTML a partir  la tabla de pedidos
// Almacenada en la sesión
function htmlTablaPedidos(): string {
    $msg = "";
    $msg .="<table>";
    foreach ($_SESSION["pedidos"] as $fruta => $cantidad) {
     $msg .= "<tr><td>". $fruta."</td><td>".$cantidad. "</td></tr>";
    }
    $msg .= "</table>";
    return $msg;
}