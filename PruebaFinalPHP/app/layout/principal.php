<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CRUD DE USUARIOS</title>
<link href="web/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="web/js/funciones.js"></script>
</head>
<body>
<div id="container" >
<div id="header">
<h1>GESTIÓN DE USUARIOS - Prueba Final PHP</h1>
</div>
<div id="content">
<!-- La tabla va dentro del form para que se envien los checkbox marcados -->
<form>
<?= $contenido ?>
<button name="orden" value="Nuevo"> Nuevo </button>
<button name="orden" value="Terminar"> Terminar </button>
<button name="orden" value="Incrementar Saldo"> Incrementar Saldo </button>
<button name="orden" value="Actualizar Bloqueos"> Actualizar Bloqueos </button>
</form>
</div>
</div>
</body>
