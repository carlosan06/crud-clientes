-- Base de datos para el CRUD de clientes
CREATE DATABASE IF NOT EXISTS crud_clientes CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE crud_clientes;

CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cedula VARCHAR(10) NOT NULL UNIQUE,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(15),
    direccion VARCHAR(200),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Datos de ejemplo
INSERT IGNORE INTO clientes (cedula, nombres, apellidos, email, telefono, direccion) VALUES
('1700000001', 'María', 'López', 'maria.lopez@ejemplo.com', '0991234567', 'Quito'),
('1700000002', 'Juan', 'Pérez', 'juan.perez@ejemplo.com', '0987654321', 'Ambato'),
('1700000003', 'Ana', 'Torres', 'ana.torres@ejemplo.com', '0971112233', 'Latacunga');

-- Usuario de la aplicación (solo acceso local)
CREATE USER IF NOT EXISTS 'crud_user'@'localhost' IDENTIFIED BY 'crud123';
GRANT ALL PRIVILEGES ON crud_clientes.* TO 'crud_user'@'localhost';
FLUSH PRIVILEGES;
