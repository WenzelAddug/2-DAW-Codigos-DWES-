-- BD comprasdb del examen
CREATE DATABASE IF NOT EXISTS comprasdb;
USE comprasdb;

CREATE TABLE IF NOT EXISTS `socios` (
  `cod_socio` varchar(10) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `clave` varchar(10) DEFAULT NULL,
  `cantidad_max` int(12) NOT NULL DEFAULT 0,
  PRIMARY KEY (`cod_socio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `socios` (`cod_socio`, `nombre`, `clave`,`cantidad_max`) VALUES
('cargg' ,'CARLOS GARCÍA GARCÍA' , 'carlos&',1500),
('miguelp','MIGUEL LÓPEZ PÉREZ' ,'12345' , 600),
('evamg' ,'EVA MARÍA GÓMEZ GARCÍA' ,'12345' ,2000),
('luisfd' ,'LUIS FERNÁNDEZ DIEZ' ,'luis34' ,5000),
('silvigz' ,'SILVIA GARCÍA DIEZ' ,'silviam',1000);

CREATE TABLE IF NOT EXISTS `productos` (
  `cod_pro` varchar(10) NOT NULL,
  `nombre_pro` varchar(40) DEFAULT NULL,
  `precio` int(12) NOT NULL DEFAULT 0,
  PRIMARY KEY (`cod_pro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `productos` (`cod_pro`, `nombre_pro`, `precio`) VALUES
('B001','Bici XL-23' , 1000),
('B010','Bici paseo R2' , 250),
('C003','Canoa 3P' , 2000),
('C033','Canoa 4P' , 2500),
('M022','Mochila travesía', 250),
('R201','Raqueta pingpong' , 10);
