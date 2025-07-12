CREATE TABLE IF NOT EXISTS tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    priority ENUM('high','medium','low') NOT NULL DEFAULT 'medium',
    status ENUM('pending','in-progress','completed') NOT NULL DEFAULT 'pending',
    technician_id INT NOT NULL,
    deadline DATE,
    completed_date DATE,
    FOREIGN KEY (technician_id) REFERENCES tecnicos(id)
);
