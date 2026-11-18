-- BD usuariosctl para la prueba final de PHP
CREATE DATABASE IF NOT EXISTS usuariosctl;
USE usuariosctl;

CREATE TABLE `Usuarios` (
  `login` varchar(10) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `comentario` varchar(30) NOT NULL,
  `bloqueo` int NOT NULL,
  `saldo` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `Usuarios` (`login`, `nombre`, `password`, `comentario`, `bloqueo`, `saldo`) VALUES
('2r34', 'Ramón Rodriguez', '309403sk', 'Programador Junior', 0, '19.06'),
('9389', 'Silvia Pérez Pio', 'o3o3o3', 'Analista JR2dd', 1, '73.37'),
('fernan', 'Fernando Pérez 3', '12345', 'SysADM & DB manager', 1, '148.50'),
('sad', 'Silvia Ana', 'sdsad12312', 'Jefe de proyectos', 0, '5.10');

ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`login`);
COMMIT;
