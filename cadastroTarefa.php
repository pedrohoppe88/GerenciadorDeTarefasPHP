<form action="Controller/TarefaController.php" method="POST">
  <label>Descrição:</label>
  <input type="text" name="descricao" required placeholder="Descreva a tarefa">

  <label>Status:</label>
  <select name="status" required>
    <option value="pendente" selected>Pendente</option>
    <option value="concluido">Concluído</option>
  </select>

  <button type="submit">Adicionar Tarefa</button>
</form>
