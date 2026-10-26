<?php
// Forma de pago guardada en una cookie (dura aunque se cierre el navegador)

$tarjetas = ['cashu', 'cirrus1', 'dinersclub', 'mastercard1', 'paypal', 'visa1', 'visa_electron'];

// Caso 2: llega una nueva tarjeta -> guardo la cookie y recargo la pagina
if (isset($_GET['nuevatarjeta']) && in_array($_GET['nuevatarjeta'], $tarjetas)) {
    $fecha_expiracion = time() + 30 * 24 * 3600; // Expira dentro de 30 dias
    setcookie('tarjeta', $_GET['nuevatarjeta'], $fecha_expiracion);
    header('Location: pagocookie.php');
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
// Caso 1: sin parametros, miro si ya hay tarjeta en la cookie
if (isset($_COOKIE['tarjeta'])) {
    echo "<H2> SU FORMA DE PAGO ACTUAL ES</H2> </br>\n";
    echo "<img src='imagenes/" . $_COOKIE['tarjeta'] . ".gif' />\n";
    echo "<h2>SELECCIONE UNA NUEVA TARJETA DE CREDITO </h2><br>\n";
} else {
    echo "<h2>SELECCIONE UNA TARJETA DE CREDITO </h2><br>\n";
}

foreach ($tarjetas as $tarjeta) {
    echo "<a href='pagocookie.php?nuevatarjeta=$tarjeta'><img src='imagenes/$tarjeta.gif' /></a>&ensp;\n";
}
?>
        </center>
    </body>
</html>
