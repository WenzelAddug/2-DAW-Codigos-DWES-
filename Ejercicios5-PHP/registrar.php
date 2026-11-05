<?php
// Ejercicio 2: registrar usuarios comprobando los datos y la contraseña

function limpiar($dato)
{
    $dato = trim($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}

// patron de email de los apuntes
function testEmail($email): bool
{
    $patron = "/^[a-zA-Z0-9]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/";
    if (preg_match($patron, $email)) {
        return true;
    }
    return false;
}

$nombre = "";
$email = "";
$errores = [];   // aqui voy guardando todos los errores
$registrado = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = limpiar($_POST['nombre']);
    $email  = limpiar($_POST['email']);
    // la contraseña no la limpio porque puede tener caracteres especiales
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    // 1. ningun campo vacio
    if ($nombre == "") {
        $errores[] = "Falta el nombre";
    }
    if ($email == "") {
        $errores[] = "Falta el correo electrónico";
    }
    if ($pass1 == "" || $pass2 == "") {
        $errores[] = "Falta la contraseña (hay que escribirla dos veces)";
    }

    // 2. email correcto
    if ($email != "" && !testEmail($email)) {
        $errores[] = "El correo electrónico no es correcto";
    }

    // 3. las contraseñas coinciden y son seguras
    if ($pass1 != "" && $pass2 != "") {
        if ($pass1 != $pass2) {
            $errores[] = "Las contraseñas no coinciden";
        } else {
            if (strlen($pass1) < 8) {
                $errores[] = "La contraseña tiene que tener 8 caracteres o más";
            }
            if (!preg_match("/[A-Z]/", $pass1)) {
                $errores[] = "La contraseña tiene que tener alguna mayúscula";
            }
            if (!preg_match("/[a-z]/", $pass1)) {
                $errores[] = "La contraseña tiene que tener alguna minúscula";
            }
            if (!preg_match("/[0-9]/", $pass1)) {
                $errores[] = "La contraseña tiene que tener algún dígito";
            }
            // cualquier cosa que no sea letra ni numero
            if (!preg_match("/[^a-zA-Z0-9]/", $pass1)) {
                $errores[] = "La contraseña tiene que tener algún carácter especial (por ejemplo * # $ _ ...)";
            }
        }
    }

    if (count($errores) == 0) {
        $registrado = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2 - Registrar usuario</title>
    <style>
        .error { color: red; }
        .ok { color: green; font-weight: bold; }
    </style>
    <script>
        // chequeo sencillo en el cliente, el resto lo hace el servidor
        function validar() {
            var nombre = document.getElementsByName("nombre")[0].value.trim();
            var email = document.getElementsByName("email")[0].value.trim();
            var pass1 = document.getElementsByName("pass1")[0].value;
            var pass2 = document.getElementsByName("pass2")[0].value;

            if (nombre == "" || email == "" || pass1 == "" || pass2 == "") {
                alert("No puede haber ningún campo vacío");
                return false;
            }
            if (pass1 != pass2) {
                alert("Las contraseñas no coinciden");
                return false;
            }
            if (pass1.length < 8) {
                alert("La contraseña tiene que tener 8 caracteres o más");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Registro de usuarios</h1>

    <?php if ($registrado) { ?>
        <p class="ok">Usuario registrado: <?= $nombre ?> (<?= $email ?>)</p>
        <a href="registrar.php">Registrar otro usuario</a>
    <?php } else { ?>

        <?php
        // muestro los errores si hay
        if (count($errores) > 0) {
            echo "<p class='error'>Error, no se ha podido registrar el usuario:</p>";
            echo "<ul class='error'>";
            foreach ($errores as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
        }
        ?>

        <form method="POST" action="registrar.php" onsubmit="return validar()">
            <p>Nombre: <input type="text" name="nombre" value="<?= $nombre ?>"></p>
            <p>Correo electrónico: <input type="text" name="email" value="<?= $email ?>"></p>
            <p>Contraseña: <input type="password" name="pass1"></p>
            <p>Repetir contraseña: <input type="password" name="pass2"></p>
            <input type="submit" value="Registrar">
        </form>
        <p><small>La contraseña tiene que tener mínimo 8 caracteres, mayúsculas, minúsculas, algún dígito y algún carácter especial.</small></p>

    <?php } ?>
</body>
</html>
