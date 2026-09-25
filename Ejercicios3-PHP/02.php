<?php
// Ejercicio 2: array asociativo con periodicos
// clave = nombre del periodico, valor = URL
$medios = [
    "El País"   => "https://www.elpais.com",
    "El Mundo"  => "https://www.elmundo.es",
    "ABC"       => "https://www.abc.es",
    "La Razón"  => "https://www.larazon.es",
    "20 Minutos" => "https://www.20minutos.es"
];
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 02 - Periódicos</title>
</head>

<body>
    <h1>Ejercicio 2</h1>
    <ul>
        <?php foreach ($medios as $nombre => $url) : ?>
            <li><a href="<?= $url ?>" target="_blank"><?= $nombre ?></a></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>
