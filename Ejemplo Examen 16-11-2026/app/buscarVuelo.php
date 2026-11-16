<?php
session_start();

require_once 'modelo/Vuelo.php';
require_once 'modelo/AccesoDatos.php';
require_once 'tools.php';

// PUNTO EXTRA: cuento las consultas en un cookie que dura una semana
// Se guarda con path "/" para que tambien lo pueda leer el index.php
$consultas = 0;
if (isset($_COOKIE['consultas'])){
    $consultas = $_COOKIE['consultas'];
}
$consultas++;
setcookie("consultas", $consultas, time()+3600*24*7, "/");

$destino = "";
if (isset($_GET['destino'])){
    $destino = trim($_GET['destino']);
}
$plazas  = filter_input(INPUT_GET, 'plazas', FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => 5]]);

$ac = AccesoDatos::initModelo();

// CASO 1: el numero de plazas no es correcto
if ( $plazas === false || $plazas === null ) {
    $msgerror = "ERROR: El N.º de plazas no es correcto debe ser entre 1 y 5";
    include 'vistas/error.php';
    exit();
}

// CASO 1: el destino no existe
if ( !$ac->existeDestino($destino) ) {
    $msgerror = "ERROR: No hay vuelos con destino ".mb_strtoupper($destino).".";
    include 'vistas/error.php';
    exit();
}

$tvuelos = $ac->getVuelos($destino, $plazas);
AccesoDatos::closeModelo();

// CASO 2: existe el destino pero no hay vuelos con plazas suficientes
// CASO 3: hay vuelos con plazas, se muestra el listado
if ( count($tvuelos) == 0 ) {
    $msgerror = "ERROR: No hay vuelos con plazas disponibles con destino ".mb_strtoupper($destino).".";
    include 'vistas/error.php';
} else {
    include 'vistas/listado.php';
}

