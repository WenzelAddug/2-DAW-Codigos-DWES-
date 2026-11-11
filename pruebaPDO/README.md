# pruebaPDO

Ejemplo sencillo de CRUD con PDO (Tema 8). Hay una clase `Producto` y una clase `ProductoRepository` que hace las consultas (insertar, listar, buscar por id, actualizar y borrar).

## Archivos
- `tienda_demo.sql` -> base de datos y tabla productos
- `conexion.php` -> datos de conexion
- `Producto.php` -> clase Producto
- `ProductoRepository.php` -> consultas con PDO
- `index.php` -> prueba del CRUD

## Como probarlo
1. Copiar la carpeta en `htdocs` de XAMPP.
2. Arrancar Apache y MySQL.
3. Importar `tienda_demo.sql` en phpMyAdmin.
4. Abrir `http://localhost/pruebaPDO/`.
