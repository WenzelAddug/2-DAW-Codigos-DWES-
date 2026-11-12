<?php
echo " Tu nombre es ". htmlspecialchars($_GET["nombre"]);
echo  " Tu curso es ".$_GET["curso"];
echo " Tu nota es ",   $_GET['nota'];
echo "<br> Parámetros por GET <br>";
var_dump($_GET);
echo "<br> Parámetros por POST <br>";
var_dump($_POST);
echo "<br> Parámetros GET/POST <br>";
var_dump($_REQUEST);