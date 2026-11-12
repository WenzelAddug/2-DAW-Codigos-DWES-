<?php
function usuarioOk(string $usuario, string $contraseña) :bool {
  
   // En un program real la validación no sería tal trivial
   return ( strlen($usuario) >= 8  && $usuario == strrev($contraseña) );
    
}

function contarPalabras (string $cadena){
    return str_word_count($cadena,0);
    
}
// Solución sin funciones de arrays
function letraMasrepetida (string $cadenaletras){
    // Obtengo una tabla con caracteres separados por SI
    // Por ejemplo la ñ en UTF8
    // existen caracteres especiales que ocupan más de un byte
    $cadena = mb_str_split($cadenaletras);
    $vecesMax = 0;
    $letraMax = ''; // Cualquier letra inicial vale
    $tamaño = count($cadena);
    for ($i=0; $i<$tamaño; $i++ ) {
        $veces = 1;
        $letrai = $cadena[$i];
        // Busco en resto de array
        for ($j=$i+1; $j<$tamaño; $j++ ){
            if ( $letrai == $cadena[$j]){
                $veces++;
            }
        }
        if ( $veces > $vecesMax){
                $letraMax = $letrai;
                $vecesMax = $veces;
        }
      }
    return $letraMax;  
}

// Solución usando la libreria de arrays
function palabraMasrepetida (string $cadena){
    // Obtengo el array de palabras
    $palabras = str_word_count($cadena,1);
    // Cuento cuando aparece cada palabra;
    // Genera una tabla con clave palabra y valor las veces que aparece
    $palabrasveces = array_count_values($palabras);
    // Ordeno el array por el valor manteniendo la clave 
    asort($palabrasveces);
    // Muestro el último que es que tiene el valor más alto
    return array_key_last($palabrasveces); 
 }

 function limpiarEntrada (string &$cadena){
    $cadena = htmlspecialchars($cadena);
 }


