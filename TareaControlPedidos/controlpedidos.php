<?php
include_once "AccesoDatos.php";

// Controlador: recibe los datos del formulario de acceso.html

// Compruebo que me han mandado el nombre y la clave
if (empty($_GET['nombre']) || empty($_GET['clave'])){
    $msg = "ERROR: tienes que escribir el nombre de cliente y la contraseña";
    include_once "vistaerror.php";
    exit();
}

$nombre = trim(strip_tags($_GET['nombre']));
$clave  = trim(strip_tags($_GET['clave']));

$db = AccesoDatos::getModelo();
$cliente = $db->getCliente($nombre, $clave);

// No existe ese cliente con esa clave
if ($cliente == false){
    $msg = "ERROR: el nombre de cliente o la contraseña no son correctos";
    AccesoDatos::closeModelo();
    include_once "vistaerror.php";
    exit();
}

// Ha entrado una vez mas, lo guardo en la BD y en el objeto
// para que en la vista salga ya el numero actualizado
$db->incrementarVeces($cliente->cod_cliente);
$cliente->veces = $cliente->veces + 1;

// Saco sus pedidos y calculo el total
$pedidos = $db->getPedidos($cliente->cod_cliente);
$total = 0;
foreach ($pedidos as $p){
    $total += $p->precio;
}

AccesoDatos::closeModelo();

// Cargo la vista
include_once "vistapedidos.php";
