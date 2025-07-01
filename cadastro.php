<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form action="Controller/CadastroController.php" method="POST">

            <input type="text" name="name" placeholder="Nome do Técnico" required>

            <input type="password" name="password" placeholder="Senha" required>
            <select name="graduacao" required>
                <option value="" disabled selected>Selecione a Graduação</option>
                <option value="Iniciante">Iniciante</option>
                <option value="Intermediário">Intermediário</option>
                <option value="Avançado">Avançado</option>
            </select>
            <input type="submit" value="Cadastrar">

        </form>
</body>
</html>