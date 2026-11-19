-- BD Almacendb para el control de BD y POO
CREATE DATABASE IF NOT EXISTS Almacendb;
USE Almacendb;

CREATE TABLE `Productos` (
  `producto_no` int(4) NOT NULL,
  `descripcion` varchar(30) DEFAULT NULL,
  `precio_actual` float(8,2) DEFAULT NULL,
  `stock_disponible` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Productos` (`producto_no`, `descripcion`, `precio_actual`, `stock_disponible`) VALUES
(10, 'MESA DESPACHO MOD. GAVIOTA', 550.00, 5),
(20, 'SILLA DIRECTOR MOD. BUFALO', 670.00, 5),
(30, 'ARMARIO NOGAL DOS PUERTAS', 460.00, 2),
(50, 'ARCHIVADOR CEREZO', 1050.00, 20),
(60, 'CAJA SEGURIDAD MOD B222', 280.00, 15),
(70, 'DESTRUCTORA DE PAPEL A3', 450.00, 25),
(80, 'MODULO ORDENADOR MOD. ERGOS', 550.00, 25);

ALTER TABLE `Productos`
  ADD PRIMARY KEY (`producto_no`);
