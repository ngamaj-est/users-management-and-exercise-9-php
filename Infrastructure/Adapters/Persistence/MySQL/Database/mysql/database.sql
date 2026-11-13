-- ============================================
-- 1. CREAR USUARIO DE BASE DE DATOS
-- ============================================

CREATE USER IF NOT EXISTS 'Estudiante'@'%'
IDENTIFIED BY 'Developer';

-- ============================================
-- 2. CREAR BASE DE DATOS
-- ============================================

DROP DATABASE IF EXISTS crud_ejercicio9;

CREATE DATABASE crud_ejercicio9;
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- ============================================
-- 3. OTORGAR PERMISOS AL USUARIO
-- ============================================

GRANT ALL PRIVILEGES
ON crud_usuarios.*
TO 'Estudiante'@'%';

FLUSH PRIVILEGES;

-- ============================================
-- 4. USAR BASE DE DATOS
-- ============================================

USE crud_ejercicio9;

-- ============================================
-- 5. TABLA DE ROLES
-- ============================================

CREATE TABLE roles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- ============================================
-- 6. TABLA DE USUARIOS
-- ============================================

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    
    name VARCHAR(100) NOT NULL,
    
    email VARCHAR(150) NOT NULL UNIQUE,
    
    password VARCHAR(255) NOT NULL,
    
    role VARCHAR(20) DEFAULT ‘User’,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_user_role
    FOREIGN KEY (role_id)
    REFERENCES roles(id)
) ENGINE=InnoDB;

-- ============================================
-- 7. INSERTAR ROLES
-- ============================================

INSERT INTO roles (name)
VALUES ('Admin'),
       ('User'),
       ('Estudiante');

-- ============================================
-- 8. INSERTAR USUARIO ADMINISTRADOR
-- ============================================

INSERT INTO users (name, email, password, role_id)
VALUES (
    'Administrador',
    'admin@crud.com',
    'admin123',
    1
);

-- ============================================
-- 9. TABLA DE ENFERMEDADES
-- ============================================

CREATE TABLE Enfermedades (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    nombreCientifico VARCHAR(100) NOT NULL,
    nivelGravedad VARCHAR(20) NOT NULL CHECK (nivelGravedad IN('Leve', 'Moderada', 'Grave', 'Critica')),
    sintomas VARCHAR(500) NOT NULL,
    medicamentos VARCHAR(200) NOT NULL,
    esContagiosa BOOLEAN NOT NULL DEFAULT FALSE,
    esCubiertaPorPos BOOLEAN NOT NULL DEFAULT FALSE,
    requiereIncapacidad BOOLEAN NOT NULL DEFAULT FALSE
);


-- ============================================
-- 10. INSETAR DATOS EN ENFERMEDADES
-- ============================================

INSERT INTO Enfermedades
(nombre, nombreCientifico, nivelGravedad, sintomas, medicamentos, esContagiosa, esCubiertaPorPos, requiereIncapacidad)
VALUES
    ('Gripe común', 'Influenza', 'Leve', 'Fiebre, tos, congestión nasal, dolor de garganta', 'Paracetamol, Loratadina', TRUE, TRUE, FALSE),
    ('COVID-19', 'SARS-CoV-2', 'Grave', 'Fiebre, tos seca, dificultad respiratoria, anosmia', 'Paracetamol, Oxígeno suplementario', TRUE, TRUE, TRUE),
    ('Varicela', 'Varicella zoster', 'Moderada', 'Erupción cutánea, picazón, fiebre', 'Aciclovir, Antihistamínicos', TRUE, TRUE, TRUE),
    ('Hipertensión arterial', 'Hipertensión esencial', 'Moderada', 'Dolor de cabeza, mareo, zumbido en los oídos', 'Losartán, Enalapril', FALSE, TRUE, FALSE),
    ('Diabetes tipo 2', 'Diabetes mellitus tipo 2', 'Grave', 'Sed excesiva, fatiga, visión borrosa', 'Metformina, Insulina', FALSE, TRUE, TRUE),
    ('Resfriado común', 'Rhinovirus', 'Leve', 'Estornudos, congestión nasal, malestar leve', 'Descongestionante, Vitamina C', TRUE, FALSE, FALSE)