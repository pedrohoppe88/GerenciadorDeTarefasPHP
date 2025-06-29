-- Banco: secinfo (exemplo de nome)

CREATE DATABASE IF NOT EXISTS secinfo;
USE secinfo;

-- Tabela de técnicos (usuários)
CREATE TABLE tecnicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    graduacao VARCHAR(50) NOT NULL,
    permission ENUM('admin', 'tecnico', 'usuario') DEFAULT 'tecnico'
);

-- Tabela de tarefas
CREATE TABLE tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tecnico_id INT NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    data DATE NOT NULL,
    FOREIGN KEY (tecnico_id) REFERENCES tecnicos(id) ON DELETE CASCADE
);

 -- dados de exemplo
INSERT INTO tecnicos (name, password, graduacao, permission) VALUES
('João', '$2y$10$EXEMPLOSENHAHASH', 'Sargento', 'tecnico'),
('Maria', '$2y$10$OUTROSENHAHASH', 'Tenente', 'admin');

INSERT INTO tarefas (tecnico_id, descricao, data) VALUES
(1, 'Manutenção preventiva no setor A', '2025-06-05'),
(1, 'Atualização de software na seção B', '2025-06-15'),
(1, 'Verificação de hardware na seção C', '2025-07-03'),
(2, 'Supervisão geral', '2025-07-10');
