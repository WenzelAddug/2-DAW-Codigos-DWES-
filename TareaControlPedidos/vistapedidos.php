<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Pedidos del cliente</title>
<style>
    table { border-collapse: collapse; }
    td { border: 1px solid black; padding: 4px 10px; }
    .total { font-weight: bold; text-align: right; }
</style>
</head>
<body>
    <h2>Bienvenido usuario: <?= $cliente->nombre ?>. Has entrado <?= $cliente->veces ?> veces en nuestra web</h2>

    <?php if (count($pedidos) > 0) { ?>
        <p><b>Esta es su lista de pedidos del cliente con código <?= $cliente->cod_cliente ?>:</b></p>
        <table>
            <?php foreach ($pedidos as $p) { ?>
            <tr>
                <td><?= $p->producto ?></td>
                <td><?= $p->precio ?></td>
            </tr>
            <?php } ?>
            <tr>
                <td class="total">TOTAL PEDIDOS</td>
                <td class="total"><?= $total ?></td>
            </tr>
        </table>
    <?php } else { ?>
        <p>No existen pedidos para este cliente.</p>
    <?php } ?>

    <br>
    <a href="acceso.html">Volver</a>
</body>
</html>
