
<?php
require_once 'Model/Conexao.php';
$conexao = new Conexao();
$conn = $conexao->getConnection();
$stmt = $conn->prepare("SELECT id, nome FROM secoes");
$stmt->execute();
$secoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Tarefa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #5cb85c;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>

<form action="Controller/TarefaController.php" method="POST">
    <label for="descricao">Descrição da Tarefa:</label>
    <input type="text" name="descricao" required>

    <label for="status">Status:</label>
    <select name="status" required>
        <option value="pendente">Pendente</option>
        <option value="em andamento">Em andamento</option>
        <option value="concluida">Concluída</option>
    </select>

    <label for="secao_id">Sessão:</label>
    <select name="secao_id" required>
        <option value="">Selecione a Sessão</option>
        <?php foreach ($secoes as $secao): ?>
            <option value="<?= $secao['id'] ?>"><?= htmlspecialchars($secao['nome']) ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Cadastrar Tarefa</button>
</form>

</body>
</html>
