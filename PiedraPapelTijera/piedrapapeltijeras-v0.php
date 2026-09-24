<?php
// JUEGO DE PIEDRA, PAPEL Y TIJERAS
//-------------------------------
// Caracteres asociadas a las logos 
// PIEDRA (Puño derecho)
// PIEDRA2 (Puño Izquierdo / jugador 2 ) 
define ('PIEDRA',   "&#x1F91C;");
define ('PIEDRA2',  "&#x1F91B;");
define ('TIJERAS',  "&#x1F596;");
define ('PAPEL',    "&#x1F91A;" );

// Tabla de mensajes en función del ganador
$tmsg = [
          "¡Empate !",
          " Ha ganado el jugador 1",
          " Ha ganado el jugador 2"
        ];


/**
 *  Calcula el ganador 
 *  Parámetros: Dos valores PIEDRA, PAPEL O TIJERA
 *  Resultado: 0 (Empate),1 (1 Gana jugador 1), 2 (Gana jugador 2)   
 *  
 */

function calcularGanador (String $valor1, String $valor2): int{
    // Si los dos jugadores sacan la misma ficha, es empate
    if ($valor1 == $valor2) {
        return 0;
    }

    // Miro qué ficha pierde contra la ficha del jugador 1
    switch ($valor1) {
        case PIEDRA:
            $fichaQuePierde = TIJERAS;   // La piedra gana a las tijeras
            break;
        case PAPEL:
            $fichaQuePierde = PIEDRA;    // El papel gana a la piedra
            break;
        case TIJERAS:
            $fichaQuePierde = PAPEL;     // Las tijeras ganan al papel
            break;
    }

    // Si el jugador 2 tiene esa ficha, gana el jugador 1. Si no, gana el jugador 2
    return ($valor2 == $fichaQuePierde) ? 1 : 2;
}
/**
 *  Obtiene un valor aleatorio PIEDRA, PAPEL O TIJERAS
 * @return string
 */
function obtenerFicha (): string {
   // Guardo las tres fichas en un array
   $fichas = [PIEDRA, PAPEL, TIJERAS];
   // array_rand devuelve una posición al azar del array (0, 1 o 2)
   $pos = array_rand($fichas);
   return $fichas[$pos];
  }


$jugador1 = obtenerFicha();
$jugador2 = obtenerFicha();
$pos = calcularGanador($jugador1,$jugador2);
$mensaje =  $tmsg[$pos]; 

// Si el jugador 2 saca piedra, se cambia el símbolo para que sea el puño izquierdo
$jugador2 = ($jugador2 == PIEDRA)?PIEDRA2:$jugador2;

?>

<html>
<head>
<title>Online PHP Script Execution</title>
</head>
<body>
<h1>¡Piedra, papel, tijera!</h1>

    <p>Actualice la página para mostrar otra partida.</p>

    <table>
      <tr>
        <th>Jugador 1</th>
        <th>Jugador 2</th>
      </tr>
      <tr>
        <td><span style="font-size: 7rem"><?= $jugador1; ?></span></td>
        <td><span style="font-size: 7rem"><?= $jugador2; ?></span></td>
      </tr>
      <tr>
        <th colspan="2"><?= $mensaje ?></th>
      </tr>
    </table>
</body>
</html>