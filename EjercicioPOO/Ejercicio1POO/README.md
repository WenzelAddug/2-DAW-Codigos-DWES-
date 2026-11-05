# Ejercicio POO en PHP - I: CuentaBancaria

Clase `CuentaBancaria` con el funcionamiento basico de una cuenta.

## Archivos
- `CuentaBancaria.php` -> la clase (completada a partir de la que dio el profe)
- `PruebaCuentaBancaria.php` -> la clase de prueba del enunciado

## Que hace
- Atributos privados: `saldo`, `numMovimientos` y el static `numCuentas` (cuentas creadas).
- `__construct` con saldo inicial (si no se pone nada empieza en 0).
- `ingreso`, `abono`, `anotarGastos` (quita 20€ si el saldo es menor de 1000), `anotarIntereses` (en %), `transferencia` (quita de esta cuenta y hace un ingreso en la de destino) y `consultarEstado`.
- Todos los metodos menos `consultarEstado` suman una operacion.
- He añadido `getNumCuentas()` (static) para poder ver cuantas cuentas se han creado.

## Resultado
```
Cuenta c1 = Saldo = 70 Nº operaciones = 3
Cuenta c2 = Saldo = 2000 Nº operaciones = 4
Cuenta c3 = Saldo = -50 Nº operaciones = 3
Cuentas creadas = 3
```

## Como probarlo
Abrir `PruebaCuentaBancaria.php` en el navegador con XAMPP o desde terminal con `php PruebaCuentaBancaria.php`.
