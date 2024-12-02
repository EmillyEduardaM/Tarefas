<?php
// Inclui o arquivo de conexão com o banco de dados
include 'db.php';

// Verifica se o formulário foi enviado para cadastrar uma tarefa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descricao_tarefa = $_POST['descricao_tarefa'];

    // Insere a pizza no banco de dados
    $sql = "INSERT INTO tarefa (descricao_tarefa) VALUES (:descricao_tarefa)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':descricao_tarefa', $descricao_tarefa);
    $stmt->execute();

    // Redireciona para a página de cadastro de pizza
    header('Location: cadastrar_tarefa.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Tarefa - Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Menu de Navegação -->
    <nav>
        <a href="index.php">Registrar Pedido</a>
        <a href="tarefas.php">Visualizar Tarefas</a>
        <a href="cadastro_usuario.php">Cadastrar Usuário</a>
        <a href="cadastro_tarefa.php">Cadastrar Tarefas</a>
    </nav>

    <h1>Cadastrar Tarefa</h1>
    <form action="cadastro_tarefa.php" method="POST">
        <label for="descricao_tarefa">Descrição da Tarefa:</label>
        <input type="text" id="descricao_tarefa" name="descricao_tarefa" required><br>

        <button type="submit">Cadastrar Tarefa</button>
    </form>
</body>
</html>