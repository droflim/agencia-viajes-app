-- Crear base de datos
CREATE DATABASE IF NOT EXISTS elchatca_AGENCIA;
USE elchatca_AGENCIA;

-- Crear tabla de vuelos
CREATE TABLE IF NOT EXISTS VUELO (
    id INT AUTO_INCREMENT PRIMARY KEY,
    origen VARCHAR(100),
    destino VARCHAR(100),
    fecha DATE,
    plazas_disponibles INT,
    precio DECIMAL(10,2)
);

-- Crear tabla de hoteles
CREATE TABLE IF NOT EXISTS HOTEL (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    ubicacion VARCHAR(100),
    habitaciones_disponibles INT,
    tarifa_noche DECIMAL(10,2)
);
