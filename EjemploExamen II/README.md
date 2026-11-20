# Ejemplo Examen II - CRUD Usuarios con control de acceso

Ejemplo de examen II de DWES. Mejoras sobre el ejemplo `crud-usuariosPDO` de clase usando la nueva BD `usuariosctl`, que tiene dos campos nuevos: `bloqueo` y `saldo`.

## Cambios que he hecho
1. **Clase Usuario y mostrarDatos**: `Usuario.php` tiene los campos `bloqueo` y `saldo`. La tabla ahora muestra esos dos campos y un checkbox (`marcados[]`) en cada fila para seleccionar uno o varios usuarios. En la vista principal hay dos botones nuevos con `name="orden"`: **Incrementar Saldo** y **Actualizar Bloqueos**.
2. **Control de acceso con PIN**: si no existe la variable de sesión `acceso` se muestra `formulariopin.php`. El PIN correcto es `12345`; si es incorrecto se vuelve a pedir. El acceso dura 5 minutos (se guarda la hora de entrada en `$_SESSION['inicio']`), pasado ese tiempo se borra la sesión y vuelve a pedir el PIN. Al pulsar **Terminar** también se cierra la sesión.
3. **Incrementar Saldo**: sube un 10% el saldo de los usuarios marcados y vuelve a mostrar la tabla.
4. **Actualizar Bloqueos**: los usuarios marcados pasan a `bloqueo = 1` y los que no están marcados a `bloqueo = 0`, y se vuelve a mostrar la tabla.

Además, como `bloqueo` y `saldo` son `NOT NULL`, al dar de alta un usuario nuevo se guarda con bloqueo 0 y saldo 0.

## Archivos modificados / nuevos
- `index.php`: control del PIN y del tiempo de sesión + las dos órdenes nuevas.
- `app/config.php`: nombre de la BD, el PIN y el tiempo de la sesión.
- `app/dat/Usuario.php`, `app/dat/AccesoDatos.php` (métodos `incrementarSaldo` y `cambiarBloqueo`).
- `app/funciones.php` (`mostrarDatos`), `app/acciones.php`.
- `app/layout/principal.php`, `app/layout/formulario.php`, `app/layout/formulariopin.php` (nuevo).
- `app/dat/usuariosctl.sql`: script de la BD.

## Cómo probarlo
1. Importar `app/dat/usuariosctl.sql` en MySQL (usuario `root` / contraseña `root`, se cambia en `app/config.php`).
2. Copiar la carpeta en `htdocs` y abrir `index.php`.
3. Poner el PIN `12345`.
