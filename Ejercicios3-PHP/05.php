<?php
// Ejercicio 5: resultado de la bonoloto
// 6 numeros de 1 a 49 sin repetir

$numeros = [];
// repetimos hasta tener 6 numeros
while (sizeof($numeros) < 6) {
    $num = random_int(1, 49);
    // solo lo añadimos si no esta ya en el array
    if (!in_array($num, $numeros)) {
        $numeros[] = $num;
    }
}

// el sexto es el complementario
$complementario = $numeros[5];

// los 5 primeros son la jugada ganadora
$ganadora = [];
for ($i = 0; $i < 5; $i++) {
    $ganadora[] = $numeros[$i];
}
// ordenamos de menor a mayor
sort($ganadora);
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 05 - Bonoloto</title>
    <style>
        table {
            border-collapse: collapse;
        }

        td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 5 - Bonoloto</h1>
    <table>
        <tr>
            <?php foreach ($ganadora as $valor) : ?>
                <td><?= $valor ?></td>
            <?php endforeach; ?>
        </tr>
    </table>
    <br>
    Complementario <?= $complementario ?>
</body>

</html>
