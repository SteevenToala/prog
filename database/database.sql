CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  email VARCHAR(100),
  password VARCHAR(255),
  tipo_usuario ENUM('administrador', 'empleado', 'cliente'),
  fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE usuarios
MODIFY COLUMN tipo_usuario ENUM('administrador', 'empleado', 'cliente');



CREATE TABLE vehiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,      -- Identificador único del vehículo
    marca VARCHAR(50) NOT NULL,             -- Marca del vehículo (ej. Toyota, Ford)
    modelo VARCHAR(50) NOT NULL,            -- Modelo del vehículo (ej. Corolla, Mustang)
    matricula VARCHAR(20) UNIQUE NOT NULL,  -- Matrícula del vehículo (única)
    disponibilidad ENUM('Disponible', 'No disponible') DEFAULT 'Disponible',  -- Disponibilidad del vehículo
    tarifa DECIMAL(10, 2) NOT NULL,         -- Tarifa de alquiler por día o por unidad de tiempo
    estado ENUM('Excelente', 'Bueno', 'Regular', 'Malo') DEFAULT 'Bueno', -- Estado físico del vehículo
    color VARCHAR(30),                      -- Color del vehículo (opcional)
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Fecha de registro del vehículo en el sistema
);
