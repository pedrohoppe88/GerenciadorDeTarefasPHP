-- Criação da tabela 'tecnicos' para cadastro de usuários

CREATE TABLE tecnicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    graduacao VARCHAR(50) NOT NULL
);
