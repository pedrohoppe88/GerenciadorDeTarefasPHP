<?php
require_once '../Model/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validação básica
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $graduacao = isset($_POST['graduacao']) ? trim($_POST['graduacao']) : '';

    if (empty($name) || empty($password) || empty($graduacao)) {
        echo "<script>alert('Preencha todos os campos.');</script>";
    } else {
        
        $usuario = new UserModel($name, $password, $graduacao);
        $result = $usuario->cadastrar();

        if ($result) {
            header("Location: ../login.php");
            exit();
        } else {
            echo "<script>alert('Erro ao cadastrar usuário.');</script>";
        }
    }
}
?>