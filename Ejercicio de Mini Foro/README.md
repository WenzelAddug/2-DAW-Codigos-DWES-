# Ejercicio de Mini Foro

Mini foro que es una primera aproximación al **Modelo Vista Controlador**. El código está en `foro_v1/`.

## Estructura
- `index.php` -> el controlador, según la `orden` que llega carga una plantilla u otra
- `app/funciones.php` -> funciones auxiliares
- `app/plantillas/` -> las vistas (entrada, comentario, detalles...)
- `web/` -> CSS y logo
- `app/.htaccess` -> para que no se pueda entrar directamente a la carpeta `app`

## Funcionamiento
- **Entrar**: el usuario tiene que tener 8 o más caracteres y la contraseña es el nombre al revés.
- **Nueva opinión**: se escribe un comentario.
- **Detalles**: muestra el comentario y sus datos: número de palabras, letra más repetida, palabra más repetida y número de vocales.
- **Terminar**: vuelve al formulario de entrada.

Los textos se limpian con `htmlspecialchars` para evitar la inyección de código.
