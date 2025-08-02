<?php
session_start();
require_once '../Model/UserModel.php';


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validação básica
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    function checkLogin($name, $password, $conn) {
        $stmt = $conn->prepare("SELECT * FROM tecnicos WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (@password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    $conexao = new Conexao();
    $conn = $conexao->getConnection();

    $user = checkLogin($name, $password, $conn);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../AdicionarTarefa.php");
        exit();
    } else {
        echo "<script>alert('Usuário ou senha inválidos.');</script>";
    }
}
?>
