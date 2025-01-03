DROP DATABASE IF EXISTS condominios;
CREATE DATABASE condominios;
USE condominios;

CREATE TABLE empleados(
  id_empleado INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(50) NOT NULL,
  email VARCHAR(80) NOT NULL,
  password VARCHAR(255) NOT NULL,
  telefono VARCHAR(10) NOT NULL,
  telefono_emergencia VARCHAR(10) NOT NULL,
  foto_path VARCHAR(255) NOT NULL,
  habilitado BOOLEAN NOT NULL
);

CREATE TABLE administrador(
  id_administrador INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(50) NOT NULL,
  email VARCHAR(80) NOT NULL,
  password VARCHAR(255) NOT NULL,
  habilitado BOOLEAN NOT NULL
);

CREATE TABLE condominos(
  id_condomino INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(50) NOT NULL,
  email VARCHAR(80) NOT NULL,
  password VARCHAR(255) NOT NULL,
  telefono VARCHAR(10) NOT NULL,
  telefono_emergencia VARCHAR(10) NOT NULL,
  torre VARCHAR(5) NOT NULL,
  departamento VARCHAR(30) NOT NULL,
  tipo VARCHAR(15) NOT NULL,
  foto_path VARCHAR(255) NOT NULL,
  habilitado BOOLEAN NOT NULL
);

CREATE TABLE invitados(
  id_invitado INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(50) NOT NULL,
  curp VARCHAR(18) NOT NULL
);

CREATE TABLE detalle_invitados(
  id_condomino INT NOT NULL,
  id_invitado INT NOT NULL,
  horario_inicio TIME NOT NULL,
  horario_final TIME NOT NULL,
  json_qr VARCHAR(255) NOT NULL,
  asunto VARCHAR(6) NOT NULL,
  integrantes INT NOT NULL,
  ocultar BOOLEAN NOT NULL,
  FOREIGN KEY (id_condomino) REFERENCES condominos(id_condomino),
  FOREIGN KEY (id_invitado) REFERENCES invitados(id_invitado)
);

CREATE TABLE eventos(
  id_evento INT PRIMARY KEY AUTO_INCREMENT,
  id_condomino INT NOT NULL,
  cantidad_personas INT NOT NULL,
  fecha DATE NOT NULL,
  turno VARCHAR(10) NOT NULL,
  detalles_evento TEXT NOT NULL,
  tipo_evento VARCHAR(20) NOT NULL,
  foto_path VARCHAR(255) NOT NULL,
  FOREIGN KEY (id_condomino) REFERENCES condominos(id_condomino)
);

CREATE TABLE visitas(
  id_condomino INT NOT NULL,
  id_invitado INT NOT NULL,
  id_empleado INT NOT NULL,
  fecha DATE NOT NULL,
  horario_entrada TIME NOT NULL,
  horario_salida TIME,
  asunto VARCHAR(6) NOT NULL,
  integrantes INT NOT NULL,
  FOREIGN KEY (id_condomino) REFERENCES condominos(id_condomino),
  FOREIGN KEY (id_invitado) REFERENCES invitados(id_invitado),
  FOREIGN KEY (id_empleado) REFERENCES empleados(id_empleado)
);

-- Creación del administrador
-- password = admin
INSERT INTO administrador VALUES (DEFAULT, "Administrador", "admin@admin.com", "$2y$10$0x8N0REE0XEklLiJoJx8euRbLKJ7DJzb6/CW5gn.1ELNTqlt.mKI6", true);
