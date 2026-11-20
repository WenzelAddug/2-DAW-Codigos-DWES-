# Ejemplo Examen III - BD y POO

Ejemplo de examen de DWES con tres ejercicios.

## 1. contadorsesion.php (2 puntos)
- Muestra un contador guardado en la sesión. Si no existe empieza en 100.
- Botones **Incrementar**, **Decrementar** y **Anular**.
- Al pulsar Anular se destruye la sesión y sale "La sesión ha sido anulada" (sin el valor) con el botón **Recargar** (`location.reload()`). Al recargar el contador vuelve a empezar en 100.

## 2. infopais.php (2 puntos)
- Tiene las tablas `$paises` y `$ciudades` del enunciado y pide el nombre de un país en un formulario.
- Si el país no está en `$paises` muestra un mensaje de error.
- Si está, muestra todas sus ciudades menos la capital.
- Después muestra una tabla con cada país y su población, ordenada por población (de mayor a menor).

## 3. examarzo (6 puntos)
Aplicación de compras con la BD `comprasdb` (tablas `socios` y `productos`).
- `compra.html`: formulario con código de cliente, clave y código de producto (POST a `realizarcompra.php`).
- `realizarcompra.php`: script principal. Muestra la bienvenida y si se puede hacer la compra según el límite (`cantidad_max`). Si se hace, resta el precio al límite en la BD.
- `Socio.php` y `Producto.php`: clases de las tablas.
- `AccesoDatos.php`: acceso a la BD con PDO y patrón Singleton.
- `comprasdb.sql`: script para crear la BD.

Casos que controla:
1. Socio, clave y producto correctos y el precio no supera el límite: se hace la compra y se muestra el nuevo límite.
2. Todo correcto pero el precio supera el límite: no se hace la compra.
3. Código de cliente y/o clave incorrectos: mensaje de error.
4. El producto no existe: mensaje de error con el código.

## Cómo probarlo
1. Importar `examarzo/comprasdb.sql` en MySQL (usuario `root` / contraseña `root`, se cambia arriba del `AccesoDatos.php`).
2. Copiar la carpeta `EjemploExamen III` en `htdocs`.
3. Abrir `contadorsesion.php`, `infopais.php` y `examarzo/compra.html`.
