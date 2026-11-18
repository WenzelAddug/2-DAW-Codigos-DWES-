# Tarea Control de Pedidos (BD etienda)

Tarea de DWES (Tema 8, PHP y Base de Datos con PDO).

Aplicación que controla el acceso a la base de datos `etienda`. El cliente escribe su nombre y su contraseña y, si son correctos, se le muestran sus pedidos con el total.

## Archivos
- `acceso.html`: formulario con el nombre de cliente y la contraseña (petición GET a `controlpedidos.php`).
- `controlpedidos.php`: controlador. Comprueba los datos, pide la información al modelo y carga la vista que toca.
- `vistapedidos.php`: vista de bienvenida con las veces que ha entrado y la lista de pedidos con el total.
- `vistaerror.php`: vista con el mensaje de error. A los 4 segundos vuelve a `acceso.html`.
- `AccesoDatos.php`: DAO con PDO y patrón Singleton. Usa sentencias precompiladas.
- `Cliente.php`: clase DTO de la tabla `clientes`.
- `Pedido.php`: clase de la tabla `pedidos`.
- `etienda.sql`: script para crear la BD con los datos del enunciado.

## Qué hace
- Si el nombre o la clave están vacíos o no existen, muestra el error y vuelve al formulario.
- Cada vez que el cliente entra se suma 1 a la columna `veces` y se muestra el número actualizado.
- Si el cliente no tiene pedidos (por ejemplo `jesus`) sale "No existen pedidos para este cliente."

## Cómo probarlo
1. Importar `etienda.sql` en MySQL (usuario `root` / contraseña `root`, se puede cambiar arriba del `AccesoDatos.php`).
2. Copiar la carpeta en `htdocs` y abrir `acceso.html`.
3. Probar por ejemplo con `eva` / `secretoeva`.
