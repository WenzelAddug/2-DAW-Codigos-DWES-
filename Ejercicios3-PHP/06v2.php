<?php
// Ejercicio 6 version 2: ordenar con funciones de la libreria
include('infopaises.php');

// funcion para comparar dos paises por su poblacion
function compararPoblacion($a, $b) {
    return $a["Poblacion"] - $b["Poblacion"];
}

// uasort ordena el array pero mantiene las claves (nombre del pais)
// queda ordenado de menor a mayor poblacion
uasort($paises, 'compararPoblacion');

// end nos lleva a la ultima posicion (el maximo)
$datosMax = end($paises);
// key nos da la clave de esa posicion (el nombre del pais)
$paisMax = key($paises);
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 06 v2 - País con más población</title>
</head>

<body>
    <h1>Ejercicio 6 (versión 2)</h1>
    El país con más población es <b><?= $paisMax ?></b> con <?= $datosMax["Poblacion"] ?> habitantes.<br>
    Sus ciudades son:
    <ul>
        <?php foreach ($ciudades[$paisMax] as $ciudad) : ?>
            <li><?= $ciudad ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>
