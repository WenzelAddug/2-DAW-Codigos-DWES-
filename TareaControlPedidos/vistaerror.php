<?php
// A los 4 segundos vuelve al formulario de acceso
header("Refresh:4; url=acceso.html");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Error de acceso</title>
</head>
<body>
    <h2 style="color:red"><?= $msg ?></h2>
    <p>En 4 segundos volverás a la página de acceso...</p>
</body>
</html>
