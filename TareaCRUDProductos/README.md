# CRUD Productos con PDO

Tarea del Tema 8 (PHP y Base de Datos) de DWES.

CRUD sobre la tabla `Productos` de la BD `ProductosDB`, adaptando el ejemplo `crud-usuariosPDO` que hicimos en clase.

## Que hace
- Listar todos los productos (los que tienen el stock por debajo del stock mínimo salen en rojo)
- Añadir un producto nuevo
- Ver los detalles de un producto
- Modificar un producto (el código no se puede cambiar porque es la clave primaria)
- Borrar un producto (pide confirmación con JavaScript)

Antes de guardar se comprueban los datos (código entre 1 y 9999, que no esté repetido, stock y precio numéricos...).

## Como probarlo
1. Importar `app/dat/ProductosDB.sql` en una base de datos llamada `ProductosDB` (con phpMyAdmin por ejemplo)
2. Cambiar el usuario y la contraseña de la BD en `app/config.php` si hace falta
3. Abrir `index.php` desde el servidor
