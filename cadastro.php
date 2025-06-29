<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 500px;
        }
        
        .form-title {
            color: #333;
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
            font-weight: 600;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-size: 14px;
            font-weight: 500;
        }
        
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .form-group input:focus,
        .form-group select:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
            outline: none;
        }
        
        .form-group input::placeholder {
            color: #aaa;
        }
        
        .btn-submit {
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        
        .btn-submit:hover {
            background-color: #3a7bc8;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
            display: none;
        }
        
        input:invalid[focused="true"] {
            border-color: #e74c3c;
        }
        
        input:invalid[focused="true"] ~ .error-message {
            display: block;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1 class="form-title">Formulário de Cadastro</h1>
        
        <form id="registrationForm" action="Controller/CadastroController.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome completo*</label>
                <input 
                    type="text" 
                    id="nome" 
                    name="name" 
                    placeholder="Digite seu nome completo" 
                    required
                />
                <span class="error-message">Este campo é obrigatório</span>
            </div>
            
            <div class="form-group">
                <label for="senha">Senha*</label>
                <input 
                    type="password" 
                    id="senha" 
                    name="password" 
                    placeholder="Digite sua senha" 
                    minlength="6"
                    required
                />
                <span class="error-message">Senha deve ter pelo menos 6 caracteres</span>
            </div>
            
            <div class="form-group">
                <label for="graduacao">Graduação*</label>
                <select id="graduacao" name="graduacao" required>
                    <option value="" disabled selected>Selecione sua graduação</option>
                    <option value="bacharelado">Bacharelado</option>
                    <option value="licenciatura">Licenciatura</option>
                    <option value="tecnologo">Tecnólogo</option>
                    <option value="mestrado">Mestrado</option>
                    <option value="doutorado">Doutorado</option>
                </select>
                <span class="error-message">Selecione uma opção</span>
            </div>
            
            <button type="submit" class="btn-submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>

