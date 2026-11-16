SET NAMES utf8mb4;
CREATE DATABASE IF NOT EXISTS airflyDB DEFAULT CHARACTER SET utf8mb4;
USE airflyDB;

DROP TABLE IF EXISTS `Vuelos`;

CREATE TABLE `Vuelos` (
  `cod_vuelo` varchar(10) NOT NULL,
  `destino` varchar(50) NOT NULL,
  `aerolinea` varchar(50) NOT NULL,
  `clase` int(11) NOT NULL, -- 1: Turista, 2: Business, 3: First Class
  `precio_billete` float NOT NULL,
  `asientos_libres` int(11) NOT NULL,
  PRIMARY KEY (`cod_vuelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- En el enunciado pone `destino_pais` pero la columna de la tabla es `destino`
INSERT INTO `Vuelos` (`cod_vuelo`, `destino`, `aerolinea`, `clase`, `precio_billete`, `asientos_libres`) VALUES
-- Vuelos a Japón (Para probar el orden por precio)
('FLY-006', 'Japón', 'Tokyo Air', 1, 450.0, 15),
('FLY-007', 'Japón', 'Nippon Airways', 2, 920.0, 4),
('FLY-008', 'Japón', 'Pacific Fly', 1, 390.0, 20),
-- Vuelos a Italia
('FLY-009', 'Italia', 'Venice Wings', 2, 210.0, 12),
('FLY-010', 'Italia', 'Sky Tuscany', 1, 95.0, 8),
-- Vuelos a México (Para probar destinos con muchas plazas)
('FLY-011', 'México', 'Azteca Air', 1, 550.0, 60),
('FLY-012', 'México', 'Maya Jets', 2, 890.0, 25),
-- Vuelos a Francia (Para probar el caso 2: Ciudad existe pero sin plazas)
('FLY-013', 'Francia', 'Paris Star', 3, 1100.0, 0),
('FLY-014', 'Francia', 'EuroFlight', 1, 120.0, 0),
-- Vuelos a EE.UU.
('FLY-015', 'EE.UU.', 'Liberty Air', 3, 2500.0, 5),
('FLY-016', 'EE.UU.', 'Atlantic Route', 2, 1300.0, 3),
('FLY-017', 'EE.UU.', 'Global Connect', 1, 750.0, 45);
