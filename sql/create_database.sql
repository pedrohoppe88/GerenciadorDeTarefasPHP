-- Criação do banco de dados e tabela principal para a aplicação

CREATE DATABASE IF NOT EXISTS secinfo_cibld DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE secinfo_cibld;

CREATE TABLE IF NOT EXISTS tecnicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    graduacao VARCHAR(50) NOT NULL
);
