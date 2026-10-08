<?php
// Si la peticion es por GET solo se muestra el formulario
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include('captura.html');
    exit();
}

// A partir de aqui la peticion es POST -> procesamos los datos

define('TAM_MAXIMO', 10240);      // 10 Kbytes
define('DIR_SUBIDA', 'uploads');

// Posibles errores de subida (de los apuntes)
$codigosErrorSubida = [
    UPLOAD_ERR_OK         => 'Subida correcta',
    UPLOAD_ERR_INI_SIZE   => 'El tamaño del archivo excede el admitido por el servidor',
    UPLOAD_ERR_FORM_SIZE  => 'El tamaño del archivo excede el admitido por el cliente',
    UPLOAD_ERR_PARTIAL    => 'El archivo no se pudo subir completamente',
    UPLOAD_ERR_NO_FILE    => 'No se seleccionó ningún archivo para ser subido',
    UPLOAD_ERR_NO_TMP_DIR => 'No existe un directorio temporal donde subir el archivo',
    UPLOAD_ERR_CANT_WRITE => 'No se pudo guardar el archivo en disco',
    UPLOAD_ERR_EXTENSION  => 'Una extensión PHP evitó la subida del archivo'
];

// Quita los espacios del principio y del final y cambia los caracteres
// especiales (< > " ' &) para que no nos puedan meter codigo html o javascript
function limpiar($dato)
{
    $dato = trim($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}

// Si no llega nada por POST es que se ha superado el post_max_size
if (count($_POST) == 0) {
    echo "Error: se supera el tamaño máximo de una petición POST <br>";
    echo '<a href="index.php">Volver al formulario</a>';
    exit();
}

// ---------- DATOS DEL JUGADOR ----------
$nombre = isset($_POST['nombre']) ? limpiar($_POST['nombre']) : '';
$alias  = isset($_POST['alias']) ? limpiar($_POST['alias']) : '';

// La edad tiene que ser un numero entero entre 1 y 120
$edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 120]]);
if ($edad === false || $edad === null) {
    $edad = 'No válida';
}

// Los checkbox solo se envian si estan marcados
// Me quedo solo con las armas que estan en la lista por si modifican el formulario
$armasValidas = ['Maza', 'Antorcha', 'Martillo', 'Látigo'];
$armas = [];
if (isset($_POST['armas']) && is_array($_POST['armas'])) {
    foreach ($_POST['armas'] as $arma) {
        if (in_array($arma, $armasValidas)) {
            $armas[] = $arma;
        }
    }
}
$armasTexto = count($armas) > 0 ? implode(', ', $armas) : 'Ninguna';

$magia = (isset($_POST['magia']) && $_POST['magia'] == 'si') ? 'Sí' : 'No';

// ---------- IMAGEN ----------
$imagen = 'calavera.png';   // si no se sube nada se enseña la calavera
$imagenSubida = false;
$mensaje = '';              // mensaje de error de la subida

if (isset($_FILES['imagen'])) {
    $nombreFichero   = $_FILES['imagen']['name'];
    $tipoFichero     = $_FILES['imagen']['type'];
    $tamanioFichero  = $_FILES['imagen']['size'];
    $temporalFichero = $_FILES['imagen']['tmp_name'];
    $errorFichero    = $_FILES['imagen']['error'];

    if ($errorFichero == UPLOAD_ERR_NO_FILE) {
        // No ha elegido ninguna imagen: calavera sin mensaje
        $mensaje = '';
    } elseif ($errorFichero > 0) {
        $mensaje = 'Error al subir la imagen: ' . $codigosErrorSubida[$errorFichero];
    } else {
        // Compruebo el tipo y tambien la extension, que el type lo manda el navegador
        $extension = strtolower(pathinfo($nombreFichero, PATHINFO_EXTENSION));

        if ($tipoFichero != 'image/png' || $extension != 'png') {
            $mensaje = 'Error al subir la imagen: solo se permiten imágenes PNG';
        } elseif ($tamanioFichero > TAM_MAXIMO) {
            $mensaje = 'Error al subir la imagen: el tamaño máximo es de 10 Kbytes (' . round($tamanioFichero / 1024, 1) . ' KB)';
        } elseif (!is_dir(DIR_SUBIDA) || !is_writable(DIR_SUBIDA)) {
            $mensaje = 'Error al subir la imagen: el directorio uploads no existe o no tiene permisos de escritura';
        } else {
            $destino = DIR_SUBIDA . '/' . basename($nombreFichero);
            // Si ya hay una imagen con ese nombre le pongo delante la hora para no machacarla
            if (file_exists($destino)) {
                $destino = DIR_SUBIDA . '/' . time() . '_' . basename($nombreFichero);
            }

            if (move_uploaded_file($temporalFichero, $destino)) {
                $imagen = $destino;
                $imagenSubida = true;
            } else {
                $mensaje = 'Error al subir la imagen: no se ha podido guardar el archivo';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Datos del Jugador</title>
    <style>
        body {
            background-color: #f2f2f7;
            font-family: Arial, Helvetica, sans-serif;
        }

        .tarjeta {
            width: 450px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffff44;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
        }

        .contenido {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .datos,
        .foto {
            width: 48%;
        }

        .foto img {
            max-width: 100%;
            border: 1px solid blue;
        }

        .volver {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="tarjeta">
        <h2>Datos del Jugador</h2>

        <div class="contenido">
            <div class="datos">
                <p><b>Nombre:</b> <?= $nombre ?></p>
                <p><b>Alias:</b> <?= $alias ?></p>
                <p><b>Edad:</b> <?= $edad ?></p>
                <p><b>Armas seleccionadas:</b> <?= $armasTexto ?></p>
                <p><b>¿Practica artes mágicas?:</b> <?= $magia ?></p>
            </div>

            <div class="foto">
                <?php if ($imagenSubida) : ?>
                    <p><b>Imagen subida:</b></p>
                <?php else : ?>
                    <p><b>No se subió ninguna imagen.</b></p>
                <?php endif; ?>

                <img src="<?= htmlspecialchars($imagen) ?>" alt="Imagen del jugador">

                <?php if ($mensaje != '') : ?>
                    <p><?= $mensaje ?></p>
                <?php endif; ?>
            </div>
        </div>

        <p class="volver"><a href="index.php">Volver al formulario</a></p>
    </div>
</body>

</html>
