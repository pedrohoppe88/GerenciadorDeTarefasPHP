<?php
require_once 'Model/Conexao.php';

$conexao = new Conexao();
$conn = $conexao->getConnection();

$stmt = $conn->prepare("SELECT nome, localizacao FROM secoes");
$stmt->execute();
$sessoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Sessões</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        
        .session-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-blue-600 text-white shadow-md">
            <div class="container mx-auto px-4 py-6">
                <h1 class="text-2xl font-bold">Cadastro de Sessões</h1>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Form Section -->
                <div class="lg:col-span-1 bg-white rounded-lg shadow-md p-6 h-fit">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Cadastrar Nova Sessão</h2>
                    
                    <form id="sessionForm" class="space-y-4" method="POST" action="Controller/ControllerSessoes.php">
                        <div>
                            <label for="sessionName" class="block text-sm font-medium text-gray-700 mb-1">Nome da Sessão *</label>
                            <input type="text" id="sessionName" name="nome" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="Ex: Reunião Trimestral" required>
                        </div>
                        
                        <div>
                            <label for="sessionLocation" class="block text-sm font-medium text-gray-700 mb-1">Local *</label>
                            <input type="text" id="sessionLocation" name="localizacao" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="Ex: Sala de Reuniões A" required>
                        </div>
                        
                        <div class="flex justify-end space-x-2">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md font-medium hover:bg-blue-700 transition-colors flex-1">
                                Cadastrar
                            </button>
                            <button type="reset" class="bg-gray-200 text-gray-800 px-6 py-2 rounded-md font-medium hover:bg-gray-300 transition-colors flex-1">
                                Limpar
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Sessions List Section -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Sessões Cadastradas</h2>
                        
                        <div id="sessionsContainer" class="space-y-4">
                            <?php if (count($sessoes) > 0): ?>
                                <?php foreach ($sessoes as $sessao): ?>
                                <div class="session-card bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-all duration-200 ease-in-out relative fade-in">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="font-semibold text-lg text-gray-800"><?= htmlspecialchars($sessao['nome']) ?></h3>
                                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Cadastrada</span>
                                    </div>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-3">
                                        <div>
                                            <p class="text-xs text-gray-500">Local</p>
                                            <p class="text-sm font-medium"><?= htmlspecialchars($sessao['localizacao']) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex justify-end space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">Editar</button>
                                        <button class="text-red-600 hover:text-red-800 text-sm font-medium">Excluir</button>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div id="emptyState" class="text-center py-12">
                                    <img src="https://placehold.co/150x150" alt="Nenhuma sessão cadastrada" class="mx-auto mb-4" />
                                    <h3 class="text-lg font-medium text-gray-700">Nenhuma sessão cadastrada</h3>
                                    <p class="text-gray-500 mt-1">Comece cadastrando sua primeira sessão utilizando o formulário ao lado.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
