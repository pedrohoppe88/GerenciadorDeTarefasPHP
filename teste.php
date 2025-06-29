<?php
session_start();
// Verifica login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'Model/Conexao.php';

$conexao = new Conexao();
$conn = $conexao->getConnection();

// Consulta tarefas por mês para o técnico logado
$stmt = $conn->prepare("
    SELECT MONTH(data) AS mes, COUNT(*) AS total
    FROM tarefas
    WHERE tecnico_id = :tecnico_id AND YEAR(data) = YEAR(CURDATE())
    GROUP BY MONTH(data)
");

$stmt->bindParam(':tecnico_id', $_SESSION['user_id']);
$stmt->execute();

$dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Prepara os arrays para o gráfico
$meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
$quantidades = array_fill(0, 12, 0); // Inicializa com zeros

foreach ($dados as $row) {
    $quantidades[$row['mes'] - 1] = (int)$row['total'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Técnico</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="#">Painel do Técnico</a>
    </div>
  </nav>

  <div class="container">
    <h2>Desempenho no Ano</h2>
    <canvas id="graficoDesempenho" height="100"></canvas>
  </div>

  <script>
    const ctx = document.getElementById('graficoDesempenho').getContext('2d');
    const grafico = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?= json_encode($meses) ?>,
        datasets: [{
          label: 'Tarefas realizadas',
          data: <?= json_encode($quantidades) ?>,
          backgroundColor: 'rgba(25, 135, 84, 0.7)'
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false },
          title: { display: true, text: 'Tarefas por mês (ano atual)' }
        }
      }
    });
  </script>

</body>
</html>
