<?php
const HISTORIAL = "numeros.txt";
header('Content-Type: application/json; charset=utf-8');
// Solo puede devolver numeros pares
$valor = random_int(1, 10);
if ($valor % 2 !== 0) {
    $valor = $valor + 1;
} 
// Guardar el valor en un fichero donde se guarden el historial de números generados

file_put_contents('numero.txt', $valor);
// Leer el valor del archivo
$valor = file_get_contents('numero.txt');
echo json_encode([
    'numero' => $valor,
]);
// Borrar el archivo
unlink('numero.txt');
