# Ejercicios5-PHP - Funciones de librería

Boletín de ejercicios PHP (05) usando funciones de librería (expresiones regulares con `preg_match`, fechas con `date`, `mktime` y `checkdate`).

| Archivo | Ejercicio |
|---|---|
| `nif.php` | Pide un DNI y muestra su letra del NIF (resto de dividir entre 23, las letras están en un array) |
| `registrar.php` | Formulario de registro: nombre, email y contraseña dos veces, comprobando que la contraseña es segura |
| `vermes.php` | Generador de calendarios: eliges mes y año (de 1980 al año actual) y muestra el calendario del mes |

## 1. nif.php
- Se llama a sí mismo por **POST**.
- Se comprueba que el DNI son solo dígitos en el **cliente** (JavaScript) y en el **servidor** (`preg_match`).
- La letra se calcula con la función `calcularLetra`. Ejemplo: `12345678` -> `12345678Z`.

## 2. registrar.php
Comprueba que:
- no hay ningún campo vacío
- el correo es correcto (patrón de email de los apuntes)
- las dos contraseñas coinciden
- la contraseña tiene 8 caracteres o más, alguna mayúscula, alguna minúscula, algún dígito y algún carácter especial

Muestra "Usuario registrado" o la lista de errores. En el cliente con JavaScript se comprueba lo más sencillo (campos vacíos, que coincidan y la longitud).

## 3. vermes.php
- Los selects se generan con PHP, el año actual sale con `date("Y")`.
- El calendario se hace con `mktime`: `date("t")` da los días del mes y `date("N")` el día de la semana del día 1.
- Sábados y domingos en rojo y el enlace **Recargar** para empezar otra vez.
