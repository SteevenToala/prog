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

ALTER TABLE vehiculos
ADD tipo_vehiculo ENUM('auto', 'camioneta', 'camion','maquinaria');

ALTER TABLE vehiculos
ADD imagen VARCHAR(50);

CREATE TABLE tarifas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_vehiculo VARCHAR(50) NOT NULL,
    duracion_alquiler INT NOT NULL, -- En días
    temporada ENUM('alta', 'baja') NOT NULL,
    precio DECIMAL(10, 2) NOT NULL
);


CREATE TABLE alquileres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehiculo_id INT NOT NULL,               -- ID del vehículo alquilado
    usuario_id INT NOT NULL,                -- ID del usuario que realiza el alquiler
    fecha_inicio VARCHAR(50) NOT NULL,      -- Fecha de inicio del alquiler
    fecha_fin VARCHAR(50),                  -- Fecha de finalización del alquiler
    estado ENUM('Activo', 'Inactivo')   DEFAULT 'Activo',      -- Estado del alquiler
    FOREIGN KEY (vehiculo_id) REFERENCES vehiculos(id),  -- Clave foránea hacia la tabla vehiculos
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)     -- Clave foránea hacia la tabla usuarios
);



INSERT INTO alquileres (vehiculo_id,usuario_id,fecha_inicio,fecha_fin,estado) VALUES (1,20,'2024-11-02','2024-11-03','Activo');