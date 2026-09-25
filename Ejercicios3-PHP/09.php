<?php
// Ejercicio 9: diagrama de barras con las temperaturas
$temperaturas = [6, 10, 12, 14, 16, 20, 25, 30, 18, 15, 14, 8];
$meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio',
          'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

// creamos el array asociativo mes => temperatura de forma automatica
$mestemperatura = [];
for ($i = 0; $i < sizeof($meses); $i++) {
    $mestemperatura[$meses[$i]] = $temperaturas[$i];
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 09 - Temperaturas</title>
    <style>
        table {
            border-collapse: collapse;
            background-color: #e3f0fc;
        }

        td {
            border: 1px solid black;
            padding: 4px;
        }

        img {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 9</h1>
    <table>
        <?php foreach ($mestemperatura as $mes => $temp) : ?>
            <tr>
                <td><?= ucfirst($mes) ?></td>
                <td>
                    <?php
                    // la barra es la misma imagen repetida tantas veces como grados
                    for ($j = 0; $j < $temp; $j++) {
                        echo '<img src="img/barra.svg" alt="">';
                    }
                    ?>
                    <?= $temp ?>ºC
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>
