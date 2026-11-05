<?php
session_start();

include_once('app/funciones.php');

define('MAX_FALLOS', 5);   // numero maximo de intentos erroneos por sesion

// contador de fallos guardado en la sesion
if (!isset($_SESSION['fallos'])) {
    $_SESSION['fallos'] = 0;
}

// 1º CASO - B: si ya ha superado los intentos el acceso esta bloqueado
if ($_SESSION['fallos'] >= MAX_FALLOS) {
    include_once('app/bloqueado.php');
    exit();
}

if (  !empty( $_GET['login']) && !empty($_GET['clave'])){
    if ( userOk($_GET['login'],$_GET['clave'])){
      // datos correctos -> el contador de fallos vuelve a cero
      $_SESSION['fallos'] = 0;
      if ( getUserRol($_GET['login']) == ROL_PROFESOR){
        $contenido = verNotaTodas($_GET['login']);
      } else {
        $contenido = verNotasAlumno($_GET['login']);
      }
      include_once ('app/resultado.php');
    }
    // userOK falso
    else {
       $_SESSION['fallos']++;
       // si con este fallo llega al maximo se bloquea
       if ($_SESSION['fallos'] >= MAX_FALLOS) {
           include_once('app/bloqueado.php');
           exit();
       }
       $contenido = "El número de usuario y la contraseña no son válidos";
       include_once('app/acceso.php');
    }
} else {
    $contenido = " Introduzca su número de usuario y su contraseña";
    include_once('app/acceso.php');
}
