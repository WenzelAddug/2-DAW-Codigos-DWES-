# Ejercicio POO en PHP - III: Coche (carrera)

Clase `Coche` y una prueba que simula una carrera de 5 coches hasta los 500 km.

## Archivos
- `Coche.php` -> la clase completada (con el namespace `pruebas00\taller\POO` como en el enunciado)
- `PruebaCoche.php` -> la carrera, con `alcanzarMeta` y `ordenarClasificacion` hechas

## Que hace
- Atributos privados: `modelo`, `distanciaTotal`, `distanciaParcial`, `motor`, `velocidad` y `velocidadMax`.
- `arrancar`, `parar`, `acelera`, `frena`, `recorre`, `info` y `getKilometros`.
- `infoError` es privado y escribe el mensaje de error.
- Si no se cumple alguna condicion el metodo devuelve `false` y llama a `infoError`:
  - no se puede arrancar si ya esta arrancado
  - no se puede pasar de la velocidad maxima
  - no se puede frenar si la velocidad es 0 (si frena mas de lo que lleva se queda en 0)
  - no se puede parar si ya esta parado
  - con el coche parado no se puede frenar, acelerar ni recorrer

## Funciones auxiliares
- `alcanzarMeta` recorre la parrilla y devuelve true si algun coche llega a la distancia.
- `ordenarClasificacion` ordena por km con el metodo de la burbuja (de mas a menos).
  Le he puesto `&` en el parametro (`array &$tcoches`) porque si no PHP pasa una copia del array
  y la parrilla no se ordena.

## Nota
Como la velocidad es con `random_int`, cada vez que se ejecuta sale una clasificacion distinta.
