<?php
include_once "AccesoDatos.php";

$bd = AccesoDatos::getModelo();
$mensaje = "";
$hoy = date("Y-m-d");

// Procesar POST si hay datos
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['orden']) && $_POST['orden'] == "ACTUALIZAR"){

    // Chequear cookie: si ya se ha actualizado hoy no se deja
    if (isset($_COOKIE['ultimaActualizacion']) && $_COOKIE['ultimaActualizacion'] == $hoy){
        $mensaje = "ERROR: solo se puede actualizar los precios una vez al día. Ya se han actualizado hoy.";
    }
    // Los checkbox solo se envian si estan marcados
    else if (empty($_POST['tproductos'])){
        $mensaje = "No has marcado ningún producto.";
    }
    else {
        // Obtengo una tabla con los números de productos.
        $tProductoNoActualizar = $_POST['tproductos'];
        // Actualizo lo productos incluidos en la tabla
        $num = $bd->actualizarPrecios($tProductoNoActualizar);
        // Guardo la fecha de hoy en el cookie (dura un dia)
        setcookie("ultimaActualizacion", $hoy, time() + 24*3600);
        $mensaje = "Se ha rebajado un 10% el precio de $num productos.";
    }
}

// Obtener la lista de productos (con stock mayor que 10)
$tproductos = $bd->getProductosStock(10);
AccesoDatos::closeModelo();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Bajar precios</title>
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container" style="width: 600px;">
<div id="header">
<h1>BAJAR PRECIOS PRODUCTOS SIN PEDIDOS</h1>
</div>
<div id="content">

<?php if ($mensaje != "") { ?>
    <p><b><?= $mensaje ?></b></p>
<?php } ?>

<form name='entrada' method="post">
<table>
<tr>
<th></th>
<th>no</th>
<th>Descripción del producto</th>
<th>stock</th>
<th>precio</th>
</tr>
<?php foreach ($tproductos as $pro): ?>
<tr>
<td><input type="checkbox" name="tproductos[]" value="<?= $pro->producto_no ?>"></td>
<td><?= $pro->producto_no ?></td>
<td><?= $pro->descripcion ?></td>
<td><?= $pro->stock_disponible ?></td>
<td><?= number_format($pro->precio_actual, 2, '.', '') ?></td>
</tr>
<?php endforeach; ?>
</table>
<br>
<input type="submit" name="orden" value="ACTUALIZAR">
</form>
</div>
</div>
</body>
</html>
