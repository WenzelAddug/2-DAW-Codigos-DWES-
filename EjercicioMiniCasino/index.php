<?php
session_start();

// Cambiar  visitar --> VALOR DE COOKIE
// Cambiar disponible --> VALOR DE SESSION
$visitas = 1;
if (isset($_COOKIE['visitas'])) {
    $visitas = $_COOKIE['visitas'];
}
$disponible = 0;
if (isset($_SESSION['disponible'])) {
    $disponible = $_SESSION['disponible'];
}
// Actualizo el cookie de visitas
// solo cuando se crea una sesion nueva (cuando sale el formulario de bienvenida)
if (!isset($_SESSION['disponible']) && !isset($_POST['cantidadini'])) {
    if (isset($_COOKIE['visitas'])) {
        $visitas = $_COOKIE['visitas'] + 1;
    }
    setcookie("visitas", $visitas, time() + 30 * 24 * 3600); // Un mes
}

$msg="";

// Entra en el casino --------------------------------
if (! isset($_SESSION['disponible'])) {

    // si ya ha metido el dinero inicial lo guardo en la sesion
    if (isset($_POST['cantidadini']) && $_POST['cantidadini'] > 0) {
        $_SESSION['disponible'] = (int) $_POST['cantidadini'];
        $disponible = $_SESSION['disponible'];
        require_once "form_apuesta.php";
    } else {
        require_once "form_bienvenida.php";
    }
    // No continuo despues de mostrar los formularios
    exit();
}



// Si realiza una apuesta ----------------------------------
// llama a procesar apuesta
if (isset($_POST["apostar"])) {
    $cantidad = (int) $_POST["cantidad"];
    if ($cantidad <= 0) {
        $msg = "Error: tiene que apostar una cantidad mayor que 0.";
    } else if ($cantidad > $_SESSION['disponible']) {
        $msg = "Error: no dispone de $cantidad euros disponibles.";
    } else {
        $msg = procesarApuesta($cantidad, $_SESSION['disponible'], $_POST["apuesta"]);
    }
    $disponible = $_SESSION['disponible'];
 }

// Si abandona o ya no le queda dinero -------------------------
 if (isset($_POST["dejar"]) || ($_SESSION["disponible"] == 0) ) {
    if ($_SESSION["disponible"] == 0) {
        $msg = $msg . "<br> Se ha quedado sin dinero.";
    }
    // cierro la sesion para que la proxima vez empiece de nuevo
    session_destroy();
    require_once "despedida.php";
   exit();
}
// Muestro el formulario si puede seguir apostando
require_once  "form_apuesta.php";
?>


<?php

/**
 *  FUNCIONES AUXILIARES
 */

function procesarApuesta(int $valorapuesta, int & $saldodisponible, string $apuesta): String {
    $msgresultado = "";
    // numero aleatorio para ver si sale par o impar
    $numero = mt_rand(1, 100);
    if ($numero % 2 == 0) {
        $resultado = "PAR";
    } else {
        $resultado = "IMPAR";
    }
    $msgresultado = "RESULTADO DE LA APUESTA : $resultado <br>";

    if ($resultado == $apuesta) {
        $saldodisponible = $saldodisponible + $valorapuesta;
        $msgresultado = $msgresultado . "GANASTE";
    } else {
        $saldodisponible = $saldodisponible - $valorapuesta;
        $msgresultado = $msgresultado . "PERDISTE";
    }
  return $msgresultado;
}
