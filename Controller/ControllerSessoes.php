<?php
require_once '../Model/secoes.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validação básica
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $localizacao = isset($_POST['localizacao']) ? trim($_POST['localizacao']) : '';

    // Formata a data e hora para o formato correto

    if (empty($nome) || empty($localizacao)) {
        echo "<script>alert('Preencha todos os campos.');</script>";
    } else {
        $secoes = new Secoes();
        $result = $secoes->cadastrarSecao($nome, $localizacao);

        if ($result === "Sessão cadastrada com sucesso!") {
            header("Location: ../testesecoes.php");
            exit();
        } else {
            echo "<script>alert('$result');</script>";
        }
    }
}
{

}



?>