<?php
session_start();
require_once '../Model/Conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = trim($_POST['descricao']);
    $status = $_POST['status'];
    $tecnico_id = $_SESSION['user_id']; // Usuário logado

    $data = date('Y-m-d'); // Data de hoje, mês atual

    if (empty($descricao) || empty($status)) {
        echo "<script>alert('Preencha todos os campos.');</script>";
        exit;
    }

    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    $stmt = $conn->prepare("INSERT INTO tarefas (tecnico_id, descricao, data, status) VALUES (:tecnico_id, :descricao, :data, :status)");
    $stmt->bindParam(':tecnico_id', $tecnico_id);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        echo "<script>alert('Tarefa adicionada com sucesso!'); window.location.href = '../teste.php';</script>";
    } else {
        echo "<script>alert('Erro ao adicionar tarefa.');</script>";
    }
}
?>
