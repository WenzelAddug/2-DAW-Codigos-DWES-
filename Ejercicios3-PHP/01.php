<?php
// Ejercicio 1: array con 20 numeros aleatorios entre 1 y 10

// Devuelve el valor maximo del array
function maximo($tabla) {
    $max = $tabla[0];
    foreach ($tabla as $valor) {
        if ($valor > $max) {
            $max = $valor;
        }
    }
    return $max;
}

// Devuelve el valor minimo del array
function minimo($tabla) {
    $min = $tabla[0];
    foreach ($tabla as $valor) {
        if ($valor < $min) {
            $min = $valor;
        }
    }
    return $min;
}

// Devuelve el valor que mas veces se repite
function masRepetido($tabla) {
    // contamos cuantas veces sale cada numero
    // la clave es el numero y el valor es las veces que sale
    $contador = [];
    foreach ($tabla as $valor) {
        if (isset($contador[$valor])) {
            $contador[$valor]++;
        } else {
            $contador[$valor] = 1;
        }
    }
    // buscamos el numero con mas repeticiones
    $repetido = 0;
    $veces = 0;
    foreach ($contador as $numero => $cuantas) {
        if ($cuantas > $veces) {
            $veces = $cuantas;
            $repetido = $numero;
        }
    }
    return $repetido;
}

// Rellenamos el array con 20 numeros
$numeros = [];
for ($i = 0; $i < 20; $i++) {
    $numeros[] = random_int(1, 10);
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 01 - Arrays</title>
    <style>
        table {
            border-collapse: collapse;
        }

        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 1</h1>
    <table>
        <tr>
            <?php foreach ($numeros as $valor) : ?>
                <td><?= $valor ?></td>
            <?php endforeach; ?>
        </tr>
    </table>
    <br>
    Valor máximo: <?= maximo($numeros) ?><br>
    Valor mínimo: <?= minimo($numeros) ?><br>
    Valor que más se repite: <?= masRepetido($numeros) ?><br>
</body>

</html>
