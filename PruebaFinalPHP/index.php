<?php
session_start();

include_once 'app/dat/AccesoDatos.php';
include_once 'app/funciones.php';
include_once 'app/acciones.php';

// CONTROL DE ACCESO CON PIN

// Si han pasado los 5 minutos borro la sesion y vuelve a pedir el pin
if (isset($_SESSION['inicio']) && (time() - $_SESSION['inicio']) > TIEMPO_SESION){
    session_destroy();
    header("Refresh:0 url='./index.php'");
    exit();
}

// Si no tiene la variable de sesion le pido el pin
if (!isset($_SESSION['acceso'])){
    $mensaje = "";
    if (isset($_POST['pin'])){
        if ($_POST['pin'] == PIN_ACCESO){
            // Pin correcto: guardo el acceso y la hora en la que ha entrado
            $_SESSION['acceso'] = true;
            $_SESSION['inicio'] = time();
            header("Refresh:0 url='./index.php'");
            exit();
        } else {
            $mensaje = "El pin no es correcto";
        }
    }
    include_once "app/layout/formulariopin.php";
    exit();
}


// Div con contenido
$contenido="";

if ($_SERVER['REQUEST_METHOD'] == "GET" ){
    
    if ( isset($_GET['orden'])){
        switch ($_GET['orden']) {
            case "Nuevo"    : accionAlta(); break;
            case "Borrar"   : accionBorrar   ($_GET['id']); break;
            case "Modificar": accionModificar($_GET['id']); break;
            case "Detalles" : accionDetalles ($_GET['id']);break;
            case "Terminar" : accionTerminar(); break;
            case "Incrementar Saldo"  : accionIncrementarSaldo(); break;
            case "Actualizar Bloqueos": accionActualizarBloqueos(); break;
        }
    }
} 
// POST Formulario de alta o de modificación
else {
    if (  isset($_POST['orden'])){
        limpiarArrayEntrada($_POST); //Evito la posible inyección de código
         switch($_POST['orden']) {
             case "Nuevo"    : accionPostAlta(); break;
             case "Modificar": accionPostModificar(); break;
             case "Detalles":; // No hago nada
         }
    }
}

$contenido .= mostrarDatos();
// Muestro la página principal
include_once "app/layout/principal.php";




