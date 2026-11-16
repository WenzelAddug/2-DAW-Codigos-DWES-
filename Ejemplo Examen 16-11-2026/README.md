# Ejemplo Examen (16-11-2026) - Final de PHP

Ejemplo de examen de DWES: aplicación que consulta la base de datos **airflyDB** (tabla `Vuelos`).
El usuario escribe un destino y las plazas que necesita (entre 1 y 5) y se muestran los vuelos con plazas suficientes, ordenados por precio del billete.

Hecho a partir del proyecto inicial del profesor (estructura MVC con patrón Singleton y PDO).

## Estructura
- `index.php`: formulario (destino y plazas) que envía por GET a `app/buscarVuelo.php`.
- `app/buscarVuelo.php`: valida las plazas, comprueba el destino y carga `listado.php` o `error.php`.
- `app/modelo/Vuelo.php`: clase que representa una fila de la tabla Vuelos.
- `app/modelo/AccesoDatos.php`: conexión a la BD y consultas (Singleton).
- `app/vistas/error.php`: vista con el mensaje de error.
- `app/vistas/listado.php`: vista con la tabla de vuelos.
- `app/tools.php`: `verClase()` (Turista, Business, First Class) y `verEstado()` (últimas plazas si quedan menos de 10).
- `airflyDB.sql`: script para crear la base de datos.

## Casos
1. Plazas incorrectas: `ERROR: El N.º de plazas no es correcto debe ser entre 1 y 5`
2. Destino que no existe: `ERROR: No hay vuelos con destino SEVILLA.`
3. Destino sin plazas: `ERROR: No hay vuelos con plazas disponibles con destino FRANCIA.`
4. Hay vuelos: listado ordenado por precio con "Plazas disponibles" o "Últimas plazas".

**Punto extra:** un cookie cuenta las consultas durante una semana. Si hay más de 3, el `index.php` muestra que hay ofertas especiales para socios.

## Cómo probarlo
1. Importar `airflyDB.sql` en MySQL (usuario `root` / contraseña `root`).
2. Copiar la carpeta en `htdocs` y abrir `index.php` en el navegador.

**Nota:** en el enunciado el INSERT usa la columna `destino_pais`, pero en la tabla se llama `destino`. En el `airflyDB.sql` ya está corregido.
