<?php
require_once 'Conexao.php';

class UserModel
{
    public $conn;
    public $id;
    public $name;
    public $password;
    public $graduacao;

    public function __construct($name = null, $password = null, $graduacao = null)
    {
        $this->id = null;
        $this->name = $name;
        $this->password = $password;
        $this->graduacao = $graduacao;

        $conexao = new Conexao();
        $this->conn = $conexao->getConnection();
    }

    public function cadastrar()
    {
        // Verifica se já existe usuário com o mesmo name
        $check = $this->conn->prepare("SELECT * FROM tecnicos WHERE name = :name");
        $check->bindParam(':name', $this->name);
        $check->execute();

        if ($check->rowCount() > 0) {
            echo "<script>alert('Usuário já está cadastrado');</script>";
            return false;
        }

        $hashedSenha = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO tecnicos (name, password, graduacao) VALUES (:name, :password, :graduacao)");
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':password', $hashedSenha);
        $stmt->bindParam(':graduacao', $this->graduacao);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao cadastrar: " . $e->getMessage() . "');</script>";
            return false;
        }
    }
}