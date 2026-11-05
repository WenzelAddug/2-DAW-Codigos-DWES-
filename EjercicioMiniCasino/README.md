# Ejercicio Mini Casino

Minicasino de apuestas a **par o impar**, usando **sesiones** y una **cookie**.

## Funcionamiento
1. `form_bienvenida.php`: se introduce el dinero con el que se va a jugar. También muestra el número de visita, que se guarda en una cookie que dura un mes.
2. `form_apuesta.php`: se elige cantidad y si se apuesta a par o impar. El dinero disponible se guarda en la sesión.
3. `despedida.php`: al abandonar el casino (o quedarse sin dinero) se muestra el resultado final y se puede volver a jugar.

`index.php` controla todo: lee la cookie y la sesión, procesa la apuesta y carga el formulario que toca.
