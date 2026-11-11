# pruebaPDO - Ejemplo sencillo de CRUD con PDO

Tarea de clase del Tema 8 (PHP y Base de Datos). Es un CRUD (Create, Read, Update, Delete) de la clase `Producto` usando PDO y el patrón DAO, siguiendo el documento del profesor. El código del profesor está separado en varios archivos.

## Estructura
- `tienda_demo.sql` -> crea la base de datos `tienda_demo`, la tabla `productos` y unos productos de prueba
- `conexion.php` -> datos de conexión (DSN, usuario y contraseña)
- `Producto.php` -> clase modelo (entidad) con el método `info()`
- `ProductoRepository.php` -> clase repositorio con `crear`, `obtenerTodos`, `obtenerPorId`, `actualizar` y `eliminar`
- `index.php` -> script principal que prueba el CRUD

## Qué se usa de PDO
- Conexión dentro de `try/catch` con `ERRMODE_EXCEPTION`.
- Consultas preparadas con marcadores (`:nombre`, `:id`...) y `bindValue`, para evitar la inyección SQL.
- `PDO::FETCH_CLASS` y `setFetchMode` para que cada fila se convierta en un objeto `Producto`.
- `lastInsertId()` para saber el ID del producto creado y `rowCount()` para comprobar el borrado.

## Cómo probarlo
1. Copiar la carpeta `pruebaPDO` en `C:\xampp\htdocs`.
2. Arrancar Apache y MySQL desde el panel de XAMPP.
3. Importar `tienda_demo.sql` desde phpMyAdmin (`http://localhost/phpmyadmin`, pestaña Importar).
4. Abrir `http://localhost/pruebaPDO/` en el navegador.

Si MySQL tiene contraseña, hay que ponerla en `$pass` dentro de `conexion.php`.
