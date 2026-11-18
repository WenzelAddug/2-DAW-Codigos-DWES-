<?php
require_once "app/dat/Usuario.php";
require_once 'app/dat/AccesoDatos.php';

function accionBorrar ($login){    
    $db = AccesoDatos::getModelo();
    $tuser = $db->borrarUsuario($login);
}

function accionTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
    header("Refresh:0 url='./index.php'");
}
 
function accionAlta(){
    $user = new Usuario();
    $user->nombre  = "";
    $user->login   = "";
    $user->password   = "";
    $user->comentario = "";
    $user->bloqueo = 0;
    $user->saldo   = 0;
    $orden= "Nuevo";
    include_once "layout/formulario.php";
}

function accionDetalles($login){
    $db = AccesoDatos::getModelo();
    $user = $db->getUsuario($login);
    $orden = "Detalles";
    include_once "layout/formulario.php";
}


function accionModificar($login){
    $db = AccesoDatos::getModelo();
    $user = $db->getUsuario($login);
    $orden="Modificar";
    include_once "layout/formulario.php";
}

function accionPostAlta(){
    $user = new Usuario();
    $user->nombre  = $_POST['nombre'];
    $user->login   = $_POST['login'];
    $user->password   = $_POST['clave'];
    $user->comentario = $_POST['comentario'];
    // Un usuario nuevo empieza sin bloqueo y con saldo 0
    $user->bloqueo = 0;
    $user->saldo   = 0;
    $db = AccesoDatos::getModelo();
    $db->addUsuario($user);
    
}

function accionPostModificar(){
    
    $user = new Usuario();
    $user->nombre  = $_POST['nombre'];
    $user->login   = $_POST['login'];
    $user->password  = $_POST['clave'];
    $user->comentario = $_POST['comentario'];
    $db = AccesoDatos::getModelo();
    $db->modUsuario($user);
    
}


// Devuelve el array con los login de los checkbox marcados
// Si no se ha marcado ninguno no llega nada y devuelvo un array vacio
function getMarcados():array{
    $marcados = [];
    if (isset($_GET['marcados']) && is_array($_GET['marcados'])){
        foreach ($_GET['marcados'] as $login){
            $marcados[] = limpiarEntrada($login);
        }
    }
    return $marcados;
}

// Sube un 10% el saldo de los usuarios marcados
function accionIncrementarSaldo(){
    $marcados = getMarcados();
    $db = AccesoDatos::getModelo();
    foreach ($marcados as $login){
        $db->incrementarSaldo($login);
    }
}

// Los usuarios marcados se bloquean (1) y los que no estan marcados se desbloquean (0)
function accionActualizarBloqueos(){
    $marcados = getMarcados();
    $db = AccesoDatos::getModelo();
    $tuser = $db->getUsuarios();
    foreach ($tuser as $user){
        if (in_array($user->login, $marcados)){
            $db->cambiarBloqueo($user->login, 1);
        } else {
            $db->cambiarBloqueo($user->login, 0);
        }
    }
}
