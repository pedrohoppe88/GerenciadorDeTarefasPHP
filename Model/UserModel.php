<?php
require_once 'Conexao.php';

class UserModel
{
    public $conn;
    public $id;
    public $nome;
    public $password;
    public $graduacao;

    public function __construct($nome = null, $password = null, $graduacao = null)
    {
        $this->id = null;
        $this->nome = $nome;
        $this->password = $password;
        $this->graduacao = $graduacao;

        $conexao = new Conexao();
        $this->conn = $conexao->getConnection();
    }

    public function cadastrar()
    {
        // Verifica se já existe usuário com o mesmo nome
        $check = $this->conn->prepare("SELECT * FROM tecnicos WHERE name = :nome");
        $check->bindParam(':nome', $this->nome);
        $check->execute();

        if ($check->rowCount() > 0) {
            echo "<script>alert('Usuário já está cadastrado');</script>";
            return false;
        }

        $hashedSenha = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO tecnicos (nome, password, graduacao) VALUES (:nome, :password, :graduacao)");
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':password', $hashedSenha);
        $stmt->bindParam(':graduacao', $this->graduacao);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao cadastrar: " . $e->getMessage() . "');</script>";
            // Para depuração, descomente a linha abaixo:
            // var_dump($e->getMessage());
            return false;
        }
    }
}