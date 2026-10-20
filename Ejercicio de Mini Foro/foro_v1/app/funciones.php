<?php
// Usuario de 8 o más caracteres y la contraseña es el nombre al revés
function usuarioOk($usuario, $contraseña) :bool {
  
   return (strlen($usuario) >= 8 && $contraseña == strrev($usuario));
    
}

// Evitar la inyección de código
function limpiar($texto) {
   $texto = trim($texto);
   $texto = substr($texto, 0, 300);
   return htmlspecialchars($texto);
}

// Saca las palabras del comentario en un array
function palabras($texto) {
   $palabras = [];
   $partes = explode(' ', $texto);
   foreach ($partes as $p) {
      if ($p != '') {
         $palabras[] = $p;
      }
   }
   return $palabras;
}

function numPalabras($texto) {
   return count(palabras($texto));
}

function letraRepetida($texto) {
   $texto = str_replace(' ', '', strtolower($texto));
   if ($texto == '') {
      return '';
   }
   $frecuencia = count_chars($texto, 1);
   return chr(array_search(max($frecuencia), $frecuencia));
}

function palabraRepetida($texto) {
   $cuenta = [];
   foreach (palabras($texto) as $p) {
      if (isset($cuenta[$p])) {
         $cuenta[$p]++;
      } else {
         $cuenta[$p] = 1;
      }
   }
   if (count($cuenta) == 0) {
      return '';
   }
   return array_search(max($cuenta), $cuenta);
}

function numVocales($texto) {
   $texto = strtolower($texto);
   $total = 0;
   foreach (['a', 'e', 'i', 'o', 'u'] as $v) {
      $total += substr_count($texto, $v);
   }
   return $total;
}
