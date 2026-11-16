<?php
/**
 *  Devuelve el texto de la clase del vuelo
 *  1: Turista, 2: Business, 3: First Class
 * @param int $clase
 * @return string
 */
function verClase( int $clase):string {
    switch ($clase) {
        case 1:
            $texto = "Turista";
            break;
        case 2:
            $texto = "Business";
            break;
        case 3:
            $texto = "First Class";
            break;
        default:
            $texto = "Desconocida";
    }
    return $texto;
}
/**
 *  Muestra un mensaje según el valor de plazas, si es menor de 10  devuelve
 *  la cadena 'Últimas plazas' y es caso contrario 'Plazas disponibles'
 * @param int $plazas
 * @return string
 */
function verEstado ( int $plazas):string {
    if ( $plazas < 10 ){
        return "Últimas plazas";
    }
    return "Plazas disponibles";
}
