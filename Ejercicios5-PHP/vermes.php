<?php
// Ejercicio 3: generador de calendarios

$tmeses = [1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
           "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

$anioActual = date("Y");   // año actual generado automaticamente

$mes = 0;
$anio = 0;
if (isset($_POST['mes']) && isset($_POST['anio'])) {
    $mes = (int)$_POST['mes'];
    $anio = (int)$_POST['anio'];
    // compruebo que los valores son validos por si modifican el formulario
    if (!checkdate($mes, 1, $anio) || $anio < 1980 || $anio > $anioActual) {
        $mes = 0;
        $anio = 0;
    }
}

// Genera la tabla html del calendario del mes y año indicados
function generarCalendario(int $mes, int $anio, array $tmeses): string
{
    $primerDia = mktime(0, 0, 0, $mes, 1, $anio);
    $numDias = date("t", $primerDia);      // numero de dias del mes
    $diaSemana = date("N", $primerDia);    // 1 (lunes) a 7 (domingo)

    $html = "<table class='calendario'>";
    $html .= "<tr><td colspan='4' class='titulo'>Mes : " . $tmeses[$mes] . "</td>";
    $html .= "<td colspan='3' class='titulo anio'>" . $anio . "</td></tr>";
    $html .= "<tr><td>L</td><td>M</td><td>X</td><td>J</td><td>V</td><td>S</td><td>D</td></tr>";

    $html .= "<tr>";
    // huecos vacios hasta el primer dia del mes
    for ($i = 1; $i < $diaSemana; $i++) {
        $html .= "<td></td>";
    }

    $columna = $diaSemana;
    for ($dia = 1; $dia <= $numDias; $dia++) {
        // sabado y domingo en rojo
        if ($columna >= 6) {
            $html .= "<td class='finde'>$dia</td>";
        } else {
            $html .= "<td>$dia</td>";
        }

        if ($columna == 7) {
            $html .= "</tr>";
            if ($dia < $numDias) {
                $html .= "<tr>";
            }
            $columna = 1;
        } else {
            $columna++;
        }
    }

    // relleno la ultima semana si no acaba en domingo
    if ($columna != 1) {
        for ($i = $columna; $i <= 7; $i++) {
            $html .= "<td></td>";
        }
        $html .= "</tr>";
    }

    $html .= "</table>";
    return $html;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 3 - Generador de calendarios</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; }
        .contenedor { display: flex; border: 1px solid black; width: 800px; }
        .izquierda, .derecha { width: 50%; padding: 15px; }
        .izquierda { border-right: 1px solid black; }
        .izquierda h1 { text-align: center; font-weight: normal; line-height: 1.8; }
        .izquierda p { margin: 30px 0; }
        .calendario { border-collapse: collapse; width: 100%; margin-top: 90px; }
        .calendario td { border: 1px solid #888; padding: 8px; width: 14%; }
        .titulo { color: #0070c0; font-weight: bold; }
        .anio { text-align: right; font-size: 20px; }
        .finde { color: red; }
        .recargar { display: block; text-align: center; margin-top: 60px; color: #0070c0; text-decoration: none; }
    </style>
</head>
<body>
    <div class="contenedor">
        <div class="izquierda">
            <h1>Bienvenido<br>al<br>Generador de calendarios</h1>

            <form method="POST" action="vermes.php">
                <p>Mes :
                    <select name="mes">
                        <?php
                        foreach ($tmeses as $num => $nombre) {
                            $sel = ($num == $mes) ? "selected" : "";
                            echo "<option value='$num' $sel>$nombre</option>";
                        }
                        ?>
                    </select>
                </p>
                <p>Año :
                    <select name="anio">
                        <?php
                        for ($a = 1980; $a <= $anioActual; $a++) {
                            $sel = ($a == $anio) ? "selected" : "";
                            echo "<option value='$a' $sel>$a</option>";
                        }
                        ?>
                    </select>
                </p>
                <p style="text-align:center"><input type="submit" value="Enviar"></p>
            </form>
        </div>

        <div class="derecha">
            <?php
            if ($mes != 0) {
                echo generarCalendario($mes, $anio, $tmeses);
                echo "<a class='recargar' href='vermes.php'>Recargar</a>";
            }
            ?>
        </div>
    </div>
</body>
</html>
