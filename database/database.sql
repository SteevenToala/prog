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
