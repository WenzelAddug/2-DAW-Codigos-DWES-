<?php
// Activar el almacenamiento en búfer de salida
// Esto permite capturar la salida generada por las vistas y 
// almacenarla en la memoria (buffer) en lugar de enviarla directamente al navegador. 
// No se envia al navegar.
ob_start();
$error = false;
if ( $_SERVER["REQUEST_METHOD"] == 'POST'){
    if (empty($_REQUEST['nombre']) ||  empty($_REQUEST['clave'])){
        $msg =" Error: falta valores introducir los valores de usuario y contraseña.<br> ";
        $error = true;
    } else {
    $nombre = $_REQUEST['nombre'];
    $clave  = $_REQUEST['clave'];
    // Los datos son válidos si son iguales
    if ( $nombre == $clave){
        // Incluir la vista de bienvenida  en buffer de salida
        include ("vistas/bienvenida.php");
        }
    else {
        $msg =  "Error: Usuario y contraseña no son válidos.<br> ";
        $error = true;
        }
    }    
}

if ( $_SERVER["REQUEST_METHOD"] == 'GET' or $error ){
    // Incluir la vista del formulario de entrada en buffer de salida
    include ("vistas/entrada.php");
}    


// Obtener el contenido del búfer de salida y almacenarlo en la variable $contenido
$contenido = ob_get_clean();

// Incluir la vista principal, que mostrará el contenido capturado en $contenido
include ("vistas/principal.php");



