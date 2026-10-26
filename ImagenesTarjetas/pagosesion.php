<?php
// Forma de pago guardada en una sesion (dura hasta cerrar el navegador o pasar el tiempo)
session_start();

define('TIEMPO', 300); // Tiempo maximo de la sesion en segundos (5 minutos)

$tarjetas = ['cashu', 'cirrus1', 'dinersclub', 'mastercard1', 'paypal', 'visa1', 'visa_electron'];

// Si ha pasado el tiempo fijado borro la sesion
if (isset($_SESSION['inicio']) && time() - $_SESSION['inicio'] > TIEMPO) {
    session_unset();
}

// Caso 2: llega una nueva tarjeta -> la guardo en la sesion y recargo la pagina
if (isset($_GET['nuevatarjeta']) && in_array($_GET['nuevatarjeta'], $tarjetas)) {
    $_SESSION['tarjeta'] = $_GET['nuevatarjeta'];
    $_SESSION['inicio'] = time();
    header('Location: pagosesion.php');
    exit();
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Forma de pago</title>
    </head>
    <body>
        <center>
<?php
// Caso 1: sin parametros, miro si ya hay tarjeta en la sesion
if (isset($_SESSION['tarjeta'])) {
    echo "<H2> SU FORMA DE PAGO ACTUAL ES</H2> </br>\n";
    echo "<img src='imagenes/" . $_SESSION['tarjeta'] . ".gif' />\n";
    echo "<h2>SELECCIONE UNA NUEVA TARJETA DE CREDITO </h2><br>\n";
} else {
    echo "<H2> NO TIENE FORMA DE PAGO ASIGNADA</H2> </br>\n";
    echo "<h2>SELECCIONE UNA TARJETA DE CREDITO </h2><br>\n";
}

foreach ($tarjetas as $tarjeta) {
    echo "<a href='pagosesion.php?nuevatarjeta=$tarjeta'><img src='imagenes/$tarjeta.gif' /></a>&ensp;\n";
}
?>
        </center>
    </body>
</html>
