<?php
// Ejercicio 1: calcular la letra del NIF a partir del numero de DNI

// tabla de letras, la posicion es el resto de dividir entre 23
$tletras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B',
            'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];

// devuelve la letra que le corresponde al dni
function calcularLetra(int $dni, array $tletras): string
{
    $resto = $dni % 23;
    return $tletras[$resto];
}

$dni = "";
$msg = "";

// si llega por POST calculo la letra
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = trim($_POST['dni']);

    // compruebo en el servidor que solo son digitos (maximo 8)
    if (preg_match("/^\d{1,8}$/", $dni)) {
        $letra = calcularLetra((int)$dni, $tletras);
        $msg = "El NIF correspondiente es: <b>" . $dni . $letra . "</b>";
    } else {
        $msg = "<span style='color:red'>Error: el DNI solo puede tener digitos (maximo 8)</span>";
        $dni = htmlspecialchars($dni);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1 - Letra del NIF</title>
    <script>
        // comprobacion en la parte cliente
        function validar() {
            var dni = document.getElementsByName("dni")[0].value;
            var patron = /^\d{1,8}$/;
            if (!patron.test(dni)) {
                alert("El DNI solo puede tener digitos (maximo 8)");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Calcular la letra del NIF</h1>

    <form method="POST" action="nif.php" onsubmit="return validar()">
        Número de DNI:
        <input type="text" name="dni" value="<?= $dni ?>" maxlength="8" required>
        <input type="submit" value="Calcular letra">
    </form>

    <p><?= $msg ?></p>
</body>
</html>
