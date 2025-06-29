<?php
require_once 'Conexao.php';

class Usuario {
    private $conn;

    public function __construct() {
        $conexao = new Conexao();
        $this->conn = $conexao->getConnection();
    }

    public function register($name, $password, $graduacao) 
    {
        // Corrigido SELECT
        $check = $this->conn->prepare("SELECT id FROM tecnicos WHERE name = :name");
        $check->bindParam(':name', $name);
        $check->execute();

        if ($check->rowCount() > 0) {
            echo "<script>alert('Usuário já cadastrado!');</script>";
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Corrigido INSERT
        $stmt = $this->conn->prepare("INSERT INTO tecnicos (name, password, graduacao) VALUES (:name, :password, :graduacao)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':graduacao', $graduacao);

        if ($stmt->execute()) {
            return "Registro bem-sucedido.";
        } else {
            return "Erro durante o registro.";
        }
    }
}
?>
