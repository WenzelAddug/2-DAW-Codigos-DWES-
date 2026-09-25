<?php
// Ejercicio 7: elegir dos paises al azar
include('infopaises.php');

// array_rand con 2 nos devuelve un array con 2 claves distintas
$elegidos = array_rand($paises, 2);
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 07 - Dos países al azar</title>
</head>

<body>
    <h1>Ejercicio 7</h1>
    <?php foreach ($elegidos as $pais) : ?>
        <h2><?= $pais ?></h2>
        Capital: <?= $paises[$pais]["Capital"] ?><br>
        Población: <?= $paises[$pais]["Poblacion"] ?><br>
        Ciudades: <?= implode(", ", $ciudades[$pais]) ?><br>
        <a href="https://www.google.es/maps/place/<?= $pais ?>" target="_blank">Ver <?= $pais ?> en Google Maps</a>
        <hr>
    <?php endforeach; ?>
</body>

</html>
