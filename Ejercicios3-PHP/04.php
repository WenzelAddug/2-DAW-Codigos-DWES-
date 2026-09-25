<?php
// Ejercicio 4: array asociativo con deportes y sus logos
// clave = nombre del deporte, valor = ruta de la imagen
$deportes = [
    "Karate"     => "img/karate.png",
    "Tenis"      => "img/tenis.png",
    "Fútbol"     => "img/futbol.svg",
    "Baloncesto" => "img/baloncesto.svg",
    "Natación"   => "img/natacion.svg"
];
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 04 - Deportes</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #a8a8a8;
            color: white;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 4</h1>
    <table>
        <tr>
            <th>Deporte</th>
            <th>Logo</th>
        </tr>
        <?php foreach ($deportes as $deporte => $imagen) : ?>
            <tr>
                <td><?= $deporte ?></td>
                <td><img src="<?= $imagen ?>" alt="<?= $deporte ?>" width="80" height="80"></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>
