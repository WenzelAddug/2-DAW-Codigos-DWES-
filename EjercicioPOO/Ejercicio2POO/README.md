# Ejercicio POO en PHP - II: Reloj (con alarma)

Clase `Reloj` que guarda la hora como segundos desde las 00:00:00.

## Archivos
- `Reloj.php` -> la clase completada + la mejora de la alarma
- `PruebaReloj.php` -> la prueba del enunciado
- `PruebaAlarma.php` -> prueba que he hecho para la mejora de la alarma

## Que hace
- `__construct(hora, minutos, segundos)` pasa todo a segundos y pone formato 24 por defecto.
- `mostrar()` devuelve la hora tipo `22:30:23` o `10:30:23 pm` si el formato es de 12.
- `cambiarFormato24(bool)` cambia entre 24 y 12 horas.
- `tictac()` suma un segundo, y cuando llega a las 24:00:00 vuelve a 00:00:00.
- `comparar(Reloj)` devuelve los segundos de diferencia con el otro reloj (en positivo con `abs`).

### Mejora: alarma
- Atributos nuevos: `alarma` (hora de la alarma en segundos) y `alarmaActivada` (true/false).
- `fijarAlarma(hora, minutos)` y `activarAlarma(bool)`.
- En `tictac()` si la alarma esta activada y se llega a esa hora sale un mensaje de que esta sonando.

## Resultado de PruebaReloj
```
Reloj nº 1 20:10:10
Reloj nº 2 20:10:15
Están en la misma hora
Reloj nº 1 08:10:15 pm
Reloj nº 2 08:10:15 pm
Los relojes se diferencias en 50000 segundos
Reloj nº 1 10:03:35
Reloj nº 2 23:56:55
```
