<?php
require_once "app/dat/Producto.php";
require_once 'app/dat/AccesoDatos.php';

function accionBorrar ($codigo){
    $db = AccesoDatos::getModelo();
    $tprod = $db->borrarProducto($codigo);
}

function accionTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
    header("Refresh:0 url='./index.php'");
}

function accionAlta(){
    $prod = new Producto();
    $prod->codigo    = "";
    $prod->nombre    = "";
    $prod->stock     = "";
    $prod->stock_min = "";
    $prod->precio    = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
}

function accionDetalles($codigo){
    $db = AccesoDatos::getModelo();
    $prod = $db->getProducto($codigo);
    $orden = "Detalles";
    include_once "layout/formulario.php";
}


function accionModificar($codigo){
    $db = AccesoDatos::getModelo();
    $prod = $db->getProducto($codigo);
    $orden="Modificar";
    include_once "layout/formulario.php";
}

function accionPostAlta(){
    $prod = new Producto();
    $prod->codigo    = $_POST['codigo'];
    $prod->nombre    = $_POST['nombre'];
    $prod->stock     = $_POST['stock'];
    $prod->stock_min = $_POST['stock_min'];
    $prod->precio    = $_POST['precio'];
    $db = AccesoDatos::getModelo();

    $aviso = comprobarDatos($prod);
    // Compruebo tambien que no exista ya un producto con ese codigo
    // si no, el insert da error de clave primaria duplicada
    if ($aviso == "" && $db->getProducto($prod->codigo) != false){
        $aviso = "Ya existe un producto con el código $prod->codigo";
    }
    // Si hay algun error vuelvo a mostrar el formulario con los datos que habia puesto
    if ($aviso != ""){
        $orden = "Nuevo";
        include_once "layout/formulario.php";
    }
    $db->addProducto($prod);

}

function accionPostModificar(){

    $prod = new Producto();
    $prod->codigo    = $_POST['codigo'];
    $prod->nombre    = $_POST['nombre'];
    $prod->stock     = $_POST['stock'];
    $prod->stock_min = $_POST['stock_min'];
    $prod->precio    = $_POST['precio'];

    $aviso = comprobarDatos($prod);
    if ($aviso != ""){
        $orden = "Modificar";
        include_once "layout/formulario.php";
    }
    $db = AccesoDatos::getModelo();
    $db->modProducto($prod);

}
