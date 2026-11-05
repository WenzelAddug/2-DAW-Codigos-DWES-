# Formulario con Imagen

Formulario de un personaje (nombre, alias, edad, armas, si tiene magia...) con subida de una imagen.

- Si se entra por **GET** se muestra el formulario (`captura.html`).
- Si llega por **POST** se procesan los datos en `index.php`:
  - se limpian los datos con `trim` y `htmlspecialchars` para que no metan código
  - se comprueban los errores de subida (`UPLOAD_ERR_...`)
  - la imagen no puede pasar de 10 KB y se guarda en la carpeta `uploads/`
- Al final se muestran los datos del personaje con su imagen.

`calavera.png` es una imagen de ejemplo para probar la subida.
