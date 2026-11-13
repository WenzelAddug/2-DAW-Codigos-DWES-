<?php

// MUESTRA TODOS LOS PRODUCTOS
function mostrarDatos (){

    $titulos = [ "Código","Nombre","Stock","Stock mín.","Precio"];
    $msg = "<table>\n";
     // Identificador de la tabla
    $msg .= "<tr>";
    for ($j=0; $j < count($titulos); $j++){
        $msg .= "<th>$titulos[$j]</th>";
    }
    $msg .= "</tr>";
    $auto = $_SERVER['PHP_SELF'];
    $db = AccesoDatos::getModelo();
    $tprod = $db->getProductos();
    foreach ($tprod as $prod) {
        $msg .= "<tr>";
        $msg .= "<td>$prod->codigo</td>";
        $msg .= "<td>$prod->nombre</td>";
        // Si el stock esta por debajo del minimo lo marco en rojo
        if ($prod->stock < $prod->stock_min){
            $msg .= "<td class=\"stockbajo\">$prod->stock ⚠️</td>";
        } else {
            $msg .= "<td>$prod->stock</td>";
        }
        $msg .= "<td>$prod->stock_min</td>";
        $msg .= "<td>".number_format($prod->precio,2,',','.')." €</td>";
        $msg .="<td><a href=\"#\" onclick=\"confirmarBorrar('$prod->nombre','$prod->codigo');\" >🗑️</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Modificar&id=$prod->codigo\">✏️</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Detalles&id=$prod->codigo\" >👁️</a></td>\n";
        $msg .="</tr>\n";

    }
    $msg .= "</table>";

    return $msg;
}

/*
 * Compruebo los datos del formulario antes de guardarlos en la BD
 * Devuelve un mensaje con el error o "" si esta todo bien
 */
function comprobarDatos($prod):string{
    $error = "";
    if (filter_var($prod->codigo, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => 9999]]) === false){
        $error = "El código tiene que ser un número entre 1 y 9999";
    }
    else if ($prod->nombre == "" || mb_strlen($prod->nombre) > 30){
        $error = "El nombre no puede estar vacío ni tener más de 30 caracteres";
    }
    else if (filter_var($prod->stock, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]) === false){
        $error = "El stock tiene que ser un número entero (0 o más)";
    }
    else if (filter_var($prod->stock_min, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]) === false){
        $error = "El stock mínimo tiene que ser un número entero (0 o más)";
    }
    else if (!is_numeric($prod->precio) || $prod->precio < 0){
        $error = "El precio tiene que ser un número positivo (usa el punto para los decimales)";
    }
    return $error;
}

/*
 *  Funciones para limpiar la entreda de posibles inyecciones
 */

function limpiarEntrada(string $entrada):string{
    $salida = trim($entrada); // Elimina espacios antes y después de los datos
    $salida = strip_tags($salida); // Elimina marcas
    return $salida;
}
// Función para limpiar todos elementos de un array
function limpiarArrayEntrada(array &$entrada){

    foreach ($entrada as $key => $value ) {
        $entrada[$key] = limpiarEntrada($value);
    }
}
