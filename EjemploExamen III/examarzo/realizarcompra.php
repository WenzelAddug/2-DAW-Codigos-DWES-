<?php
include_once "AccesoDatos.php";

$cod_socio = isset($_POST['cod_socio']) ? trim(strip_tags($_POST['cod_socio'])) : "";
$clave     = isset($_POST['clave'])     ? trim(strip_tags($_POST['clave']))     : "";
$cod_pro   = isset($_POST['cod_pro'])   ? trim(strip_tags($_POST['cod_pro']))   : "";

$db = AccesoDatos::getModelo();
$socio = $db->getSocio($cod_socio, $clave);
$producto = false;
$compra = false;

if ($socio != false){
    $producto = $db->getProducto($cod_pro);
    // Si el precio no supera el limite se hace la compra
    if ($producto != false && $producto->precio <= $socio->cantidad_max){
        $db->restarLimite($socio->cod_socio, $producto->precio);
        $socio->cantidad_max = $socio->cantidad_max - $producto->precio;
        $compra = true;
    }
}
AccesoDatos::closeModelo();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Realizar compra</title>
</head>
<body>
<?php if ($socio == false) { ?>
    <!-- Caso 3 -->
    <p><b>ERROR: Los valores de código de cliente y contraseña no son válidos</b></p>

<?php } else if ($producto == false) { ?>
    <!-- Caso 4 -->
    <p><b>ERROR: No se encuentra ningún producto con el código <?= $cod_pro ?> en nuestro catálogo</b></p>

<?php } else { ?>
    <h2>BIENVENIDO/A <?= $socio->nombre ?></h2>
    <?php if ($compra) { ?>
        <!-- Caso 1 -->
        <p>Se ha efectuado la compra del producto: <?= $producto->cod_pro ?> <?= $producto->nombre_pro ?> por <?= $producto->precio ?> Euros</p>
        <p>Su nuevo limite actual de compra es de <?= $socio->cantidad_max ?> Euros</p>
    <?php } else { ?>
        <!-- Caso 2 -->
        <p>NO se ha podido efectuar la compra del producto: <?= $producto->cod_pro ?> <?= $producto->nombre_pro ?> por <?= $producto->precio ?> Euros</p>
        <p>Su límite actual de compra es de <?= $socio->cantidad_max ?> Euros.</p>
    <?php } ?>
<?php } ?>

<br>
<a href="compra.html">Volver</a>
</body>
</html>
