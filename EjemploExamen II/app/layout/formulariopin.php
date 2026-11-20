<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD DE USUARIOS</title>
    <link href="web/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
    <div id="header">
       <h1>GESTIÓN DE USUARIOS - Prueba Final PHP</h1>
    </div>
    <div id="content">
        <hr>
        <form method="POST">
            <label for="pin">INTRODUZCA EL PIN DE ACCESO</label>
            <input type="password" id="pin" name="pin" autofocus>
        </form>
        <?php if ($mensaje != "") { ?>
            <p style="color:red"><?= $mensaje ?></p>
        <?php } ?>
    </div>
</div>
</body>
</html>
