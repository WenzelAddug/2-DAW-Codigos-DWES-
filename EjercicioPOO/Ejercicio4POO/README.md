# Ejercicio POO en PHP - IV: Bicicletas eléctricas

App de alquiler de bicis eléctricas: muestra las bicis operativas y te dice cuál es la más cercana a tu ubicación. Está hecho completando el código que dio el profesor.

## Archivos
- `BiciElectrica.php` -> clase `BiciElectrica` (atributos privados, `__get`/`__set` mágicos, `__toString` y `distancia`)
- `funciones.php` -> `cargarbicis`, `mostrartablabicis` y `bicimascercana`
- `consultabicis.php` -> programa principal con la tabla y el formulario
- `Bicis.csv` -> datos de las bicis: `id, coord x, coord y, batería, operativa (1/0)`

## Qué he completado
- **`distancia($x, $y)`**: fórmula de la distancia entre dos puntos con `sqrt` y `pow`:
  `d = √((x2 - x1)² + (y2 - y1)²)`
- **`mostrartablabicis`**: recorre la tabla de objetos y solo pinta las bicis que están operativas.
- **`bicimascercana`**: recorre las bicis operativas y se queda con la que tiene menor distancia (si no hay ninguna devuelve `null`).
- **`consultabicis.php`**: si llegan `coordx` y `coordy` por GET muestra la bici más cercana y un botón **Volver**; si no, muestra el formulario.

## Ejemplo
Con la ubicación `x = 1000`, `y = 1000`:
```
Bicicleta disponible más cercana es Identificador: 2015 Bateria 63 %
```
