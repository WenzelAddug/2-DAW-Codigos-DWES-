# Tarea de Control - Consultar notas

Aplicación para consultar notas con control de acceso. Muestra información distinta según el rol del usuario (alumno o profesor). El código está en `control1ev/` y sigue la arquitectura que dio el profesor.

## Estructura
- `index.php` -> controlador, decide qué plantilla se carga
- `app/funciones.php` -> `userOk`, `getUserRol`, `verNotasAlumno` y `verNotaTodas`
- `app/acceso.php` -> formulario de acceso
- `app/resultado.php` -> muestra las notas
- `app/bloqueado.php` -> pantalla cuando se superan los intentos (la he añadido yo)
- `dat/datos.php` -> arrays de usuarios, módulos y notas
- `web/default.css` -> estilos

## 1ª Parte
- **Caso 1:** si el usuario o la contraseña no son correctos sale el mensaje y se vuelve a pedir.
- **Caso 2:** si es alumno se muestran sus notas con el nombre de cada módulo.
- **Caso 3:** si es profesor se muestra una tabla con las notas de todos los alumnos.

## 2ª Parte
- En la sesión se guarda el contador `fallos`.
- Cada vez que se equivoca suma 1. Al llegar a **5 intentos erróneos** se muestra que el acceso está bloqueado y que hay que reiniciar el navegador (o abrir una ventana privada).
- Cuando el usuario y la contraseña son correctos el contador vuelve a 0.

## Usuarios para probar
| Usuario | Contraseña | Rol |
|---|---|---|
| 200001 | 123456 | Profesor |
| 100001 | ana01 | Alumno |
| 100002 | andres2 | Alumno |
