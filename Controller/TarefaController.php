<?php
session_start();
require_once '../Model/Conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = trim($_POST['descricao']);
    $status = $_POST['status'];
    $secao_id = $_POST['secao_id'] ?? null; 
    $tecnico_id = $_SESSION['user_id']; 
    $data = date('Y-m-d'); 

    if (empty($descricao) || empty($status) || empty($secao_id)) {
        echo "<script>alert('Preencha todos os campos.');</script>";
        exit;
    }

    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    $stmt = $conn->prepare("INSERT INTO tarefas (tecnico_id, descricao, data, status, secao_id) VALUES (:tecnico_id, :descricao, :data, :status, :secao_id)");
    $stmt->bindParam(':tecnico_id', $tecnico_id);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':secao_id', $secao_id);

    if ($stmt->execute()) {
        echo "<script>alert('Tarefa adicionada com sucesso!'); window.location.href = '../teste.php';</script>";
    } else {
        echo "<script>alert('Erro ao adicionar tarefa.');</script>";
    }
}
?>