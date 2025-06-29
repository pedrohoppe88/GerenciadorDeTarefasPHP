<?php
session_start();
require_once 'Model/Conexao.php';

$conexao = new Conexao();
$conn = $conexao->getConnection();

$stmt = $conn->prepare("
    SELECT MONTH(data) AS mes, status, COUNT(*) AS total
    FROM tarefas
    WHERE tecnico_id = :tecnico_id AND YEAR(data) = YEAR(CURDATE())
    GROUP BY MONTH(data), status
");
$stmt->bindParam(':tecnico_id', $_SESSION['user_id']);
$stmt->execute();

$dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Inicializa arrays
$meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
$pendentes = array_fill(0, 12, 0);
$concluidas = array_fill(0, 12, 0);

foreach ($dados as $row) {
    $index = $row['mes'] - 1;
    if ($row['status'] === 'pendente') {
        $pendentes[$index] = (int)$row['total'];
    } else {
        $concluidas[$index] = (int)$row['total'];
    }
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

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('graficoDesempenho').getContext('2d');

const grafico = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?= json_encode($meses) ?>,
    datasets: [
      {
        label: 'Pendentes',
        data: <?= json_encode($pendentes) ?>,
        backgroundColor: 'rgba(220, 53, 69, 0.7)' // vermelho
      },
      {
        label: 'Concluídas',
        data: <?= json_encode($concluidas) ?>,
        backgroundColor: 'rgba(25, 135, 84, 0.7)' // verde
      }
    ]
  },
  options: {
    responsive: true,
    plugins: {
      title: { display: true, text: 'Tarefas por mês (pendentes e concluídas)' },
      legend: { position: 'top' }
    }
  }
});
</script>

</body>
</html>
