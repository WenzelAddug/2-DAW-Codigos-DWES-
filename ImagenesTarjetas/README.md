# Imágenes Tarjetas - Forma de pago

Elegir una forma de pago (Visa, Mastercard, PayPal...) pulsando en su imagen. Hay dos versiones:

- `pagocookie.php` -> guarda la tarjeta elegida en una **cookie** que dura 30 días, así aunque cierres el navegador se acuerda.
- `pagosesion.php` -> guarda la tarjeta en una **sesión** que caduca a los 5 minutos.

Si todavía no hay forma de pago se muestra un mensaje y la lista de tarjetas para elegir. Si ya hay una, se muestra la actual y se puede cambiar.

Las imágenes de las tarjetas están en `imagenes/`.
