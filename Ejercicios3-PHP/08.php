<?php
// Ejercicio 8: tabla HTML con los datos de los paises
include('infopaises.php');
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 08 - Tabla de países</title>
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

        .der {
            text-align: right;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 8</h1>
    <table>
        <tr>
            <th>País</th>
            <th>Capital</th>
            <th>Población</th>
            <th>Ciudades</th>
        </tr>
        <?php foreach ($paises as $pais => $datos) : ?>
            <tr>
                <td><?= $pais ?></td>
                <td><?= $datos["Capital"] ?></td>
                <!-- number_format pone los puntos: 42.000.000 -->
                <td class="der"><?= number_format($datos["Poblacion"], 0, ",", ".") ?></td>
                <!-- implode junta las ciudades con comas -->
                <td><?= implode(", ", $ciudades[$pais]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>
