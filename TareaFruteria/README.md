# Tarea Frutería

"La Frutería del siglo XXI": una tienda de fruta hecha con **sesiones**. El código está en `fruteria/`.

## Funcionamiento
1. `bienvenida.php`: el cliente escribe su nombre y se guarda en la sesión.
2. `compra.php`: elige fruta (plátanos, naranjas, limones o manzanas) y cantidad y le da a **Anotar**. El pedido se va guardando en la sesión en un array asociativo `fruta => cantidad`.
3. `despedida.php`: al terminar se muestra el pedido completo y se puede empezar con un cliente nuevo.

`index.php` es el que controla todo y `estilo.css` los estilos.
