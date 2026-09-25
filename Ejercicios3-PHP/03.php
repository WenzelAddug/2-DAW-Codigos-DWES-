<?php
// Ejercicio 3: elegir al azar uno de los cinco medios
$medios = [
    "El País"   => "https://www.elpais.com",
    "El Mundo"  => "https://www.elmundo.es",
    "ABC"       => "https://www.abc.es",
    "La Razón"  => "https://www.larazon.es",
    "20 Minutos" => "https://www.20minutos.es"
];

// array_rand devuelve una clave al azar (el nombre del periodico)
$elegido = array_rand($medios);
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 03 - Medio al azar</title>
</head>

<body>
    <h1>Ejercicio 3</h1>
    El Medio recomendado es: <a href="<?= $medios[$elegido] ?>" target="_blank"><?= $elegido ?></a>
</body>

</html>
