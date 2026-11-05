<?php
/*
 * Prueba de la mejora: Reloj con alarma
 */
include_once 'Reloj.php';

$despertador = new Reloj(7,59,55);
$despertador->fijarAlarma(8,0);
$despertador->activarAlarma(true);

echo "<h3> Alarma activada a las 08:00 </h3>";
for ($i=1; $i<= 8; $i++){
    $despertador->tictac();
    echo " <br> ". $despertador->mostrar();
}

// Ahora la desactivo y doy una vuelta entera al dia, no tiene que sonar
$despertador->activarAlarma(false);
echo "<h3> Alarma desactivada </h3>";
for ($i=1; $i<= 86400; $i++){
    $despertador->tictac();
}
echo " <br> Ha pasado un dia y son las ". $despertador->mostrar() ." (no ha sonado)";
