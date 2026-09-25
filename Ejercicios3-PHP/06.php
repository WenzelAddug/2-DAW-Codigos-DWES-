<?php
// Ejercicio 6: pais con mas poblacion buscando en las tablas
include('infopaises.php');

$paisMax = "";
$poblacionMax = 0;

// recorremos todos los paises y guardamos el que tiene mas poblacion
foreach ($paises as $pais => $datos) {
    if ($datos["Poblacion"] > $poblacionMax) {
        $poblacionMax = $datos["Poblacion"];
        $paisMax = $pais;
    }
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 06 - País con más población</title>
</head>

<body>
    <h1>Ejercicio 6</h1>
    El país con más población es <b><?= $paisMax ?></b> con <?= $poblacionMax ?> habitantes.<br>
    Sus ciudades son:
    <ul>
        <?php foreach ($ciudades[$paisMax] as $ciudad) : ?>
            <li><?= $ciudad ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>
