-- Base de datos para el ejemplo de CRUD con PDO
-- Importar desde phpMyAdmin (pestaña Importar) o pegar en la pestaña SQL

SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS tienda_demo
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE tienda_demo;

CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL
);

-- Algunos datos de prueba
INSERT INTO productos (nombre, precio, stock) VALUES
('Ratón inalámbrico', 19.99, 25),
('Monitor 24 pulgadas', 129.90, 8),
('Auriculares USB', 34.50, 15);
