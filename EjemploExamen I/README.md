# Ejemplo Examen I - Control sobre BD y POO en PHP

(En el enunciado la carpeta se llama `Ejer001`.)

Ejemplo de control de DWES: bajar precios de productos de la BD `Almacendb`.

## Qué hace
- Muestra en una tabla los productos con un stock mayor que 10, con un checkbox en cada fila.
- Al pulsar **ACTUALIZAR** se rebaja un 10% el precio de los productos marcados y se vuelve a mostrar la lista con los precios nuevos.
- La actualización solo se puede hacer **una vez al día desde el mismo navegador**. Se controla con un cookie `ultimaActualizacion` que guarda la fecha de la última actualización. Si se intenta otra vez el mismo día sale un mensaje de error. La consulta siempre se puede repetir.
- Si se pulsa ACTUALIZAR sin marcar nada sale un aviso.

(Como dice el enunciado, el control con cookie se puede saltar borrando los cookies o con una pestaña privada.)

## Archivos
- `consulta.php`: muestra el formulario (GET) y lo procesa por POST.
- `Producto.php`: clase que representa la entidad Producto de la BD.
- `AccesoDatos.php`: todas las operaciones sobre la BD con PDO y patrón Singleton (`getProductosStock` y `actualizarPrecios`).
- `default.css`: hoja de estilo del enunciado (sin tocar).
- `Almacendb.sql`: script para crear la BD.

## Cómo probarlo
1. Importar `Almacendb.sql` en MySQL (usuario `root` / contraseña `root`, se cambia arriba del `AccesoDatos.php`).
2. Copiar la carpeta en `htdocs` y abrir `consulta.php`.
