<?php
session_start();

$anulada = false;

if (isset($_GET['accion'])){
    switch ($_GET['accion']){
        case "Incrementar":
            if (isset($_SESSION['contador'])){
                $_SESSION['contador']++;
            }
            break;
        case "Decrementar":
            if (isset($_SESSION['contador'])){
                $_SESSION['contador']--;
            }
            break;
        case "Anular":
            // Solo anulo si hay contador. Si ya estaba anulada es que se ha
            // pulsado Recargar y entonces se vuelve a empezar desde 100
            if (isset($_SESSION['contador'])){
                session_destroy();
                $anulada = true;
            }
            break;
    }
}

// Si no existe el contador en la sesion empieza en 100
if (!$anulada && !isset($_SESSION['contador'])){
    $_SESSION['contador'] = 100;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Contador con sesión</title>
</head>
<body>
<h1>Contador con sesión</h1>

<?php if ($anulada) { ?>
    <p>La sesión ha sido anulada
    <input type="button" value=" Recargar " onclick="location.reload();">
    </p>
<?php } else { ?>
    <p>Valor de contador = <?= $_SESSION['contador'] ?></p>
    <form method="GET">
        <input type="submit" name="accion" value="Incrementar">
        <input type="submit" name="accion" value="Decrementar">
        <input type="submit" name="accion" value="Anular">
    </form>
<?php } ?>
</body>
</html>
