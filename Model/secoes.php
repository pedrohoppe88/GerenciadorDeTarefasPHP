<?php
require_once 'Conexao.php';

class Secoes {

private $conn;


public function __construct() {
    $conexao = new Conexao();
    $this->conn = $conexao->getConnection();
}

public function cadastrarSecao($nome, $localizacao) {

    $stmt = $this->conn->prepare("INSERT INTO secoes (nome, localizacao) VALUES (:nome, :localizacao)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':localizacao', $localizacao);

    $check = $this->conn->prepare("SELECT id FROM secoes WHERE nome = :nome");
    $check->bindParam(':nome', $nome);
    $check->execute();  

    if ($check->rowCount() > 0) {
        return "Sessão já cadastrada!";
        return false;
    }

    if ($stmt->execute()) {
        return "Sessão cadastrada com sucesso!";
    } else {
        return "Erro ao cadastrar sessão.";
    }


}

}

?>