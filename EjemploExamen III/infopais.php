<?php
// Forma antigua de definir Array en PHP
$paises = array(
    'Argentina' => array("Capital" => "Buenos Aires", "Poblacion" => "40000000"),
    'Francia' => array("Capital" => "París", "Poblacion" => "50000000"),
    'España' => array("Capital" => "Madrid", "Poblacion" => "42000000"),
    'Italia' => array("Capital" => "Roma", "Poblacion" => "46000000"),
    'Suiza'=> array("Capital" => "Zúrich", "Poblacion" => "9000000"),
    'Colombia' => array("Capital" => "Bogotá", "Poblacion" => "36000000"),
    'Chile' => array("Capital" => "Santiago", "Poblacion" => "36000000"),
    'Suecia' => array("Capital" => "Estocolmo", "Poblacion" => "25000000"),
);

// Forma moderna, mas compacta
$ciudades = [
    'Argentina' => ["Buenos Aires", "Córdoba","Parana","Rosario"],
    'Francia' => ["París","Burdeos","Niza","Lille","Nantes"],
    'España' => ["Madrid", "Barcelona","León","Sevilla", "Valencia", "Málaga"],
    'Italia' => ["Roma", "Venecia","Florencia","Pisa", "Génova", "Milán", "Turín", "Nápoles"],
    'Suiza' => ["Zúrich","Ginebra","Basilea","Lausana"],
    'Colombia' => ["Bogotá", "Medellín","Cali","Barranquilla", "Bucaramanga"],
    'Chile' => ["Santiago", "Arica","Iquique","Osorno", "Viña del Mar"],
    'Suecia' => ["Estocolmo", "Upsala","Gotemburgo","Lund"],
];

$pais = "";
$error = "";
$listaciudades = [];

if (isset($_GET['pais'])){
    // Quito espacios y pongo la primera en mayuscula (españa -> España)
    $pais = ucfirst(mb_strtolower(trim(strip_tags($_GET['pais']))));

    if (!isset($paises[$pais])){
        $error = "ERROR: el país $pais no se encuentra en la tabla de países";
    } else {
        // Todas las ciudades menos la capital
        $capital = $paises[$pais]["Capital"];
        foreach ($ciudades[$pais] as $ciudad){
            if ($ciudad != $capital){
                $listaciudades[] = $ciudad;
            }
        }
    }

    // Tabla de paises con su poblacion ordenada (de mayor a menor)
    $poblaciones = [];
    foreach ($paises as $nombre => $infopais){
        $poblaciones[$nombre] = $infopais["Poblacion"];
    }
    arsort($poblaciones);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Información de países</title>
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 5px;
    }
</style>
</head>
<body>
<h1>Información de países</h1>

<form method="GET">
    Nombre del país: <input type="text" name="pais" value="<?= $pais ?>">
    <input type="submit" value="Buscar">
</form>

<?php if (isset($_GET['pais'])) { ?>

    <?php if ($error != "") { ?>
        <p style="color:red"><?= $error ?></p>
    <?php } else { ?>
        <h3>Ciudades de <?= $pais ?> (sin contar la capital <?= $capital ?>):</h3>
        <ul>
        <?php foreach ($listaciudades as $ciudad) : ?>
            <li><?= $ciudad ?></li>
        <?php endforeach; ?>
        </ul>
    <?php } ?>

    <h3>Países ordenados por población</h3>
    <table>
        <tr>
            <th>País</th>
            <th>Población</th>
        </tr>
        <?php foreach ($poblaciones as $nombre => $poblacion) : ?>
        <tr>
            <td><?= $nombre ?></td>
            <td><?= number_format($poblacion, 0, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

<?php } ?>
</body>
</html>
