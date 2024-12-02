<?php
    // Inclui o arquivo de conexão com o banco de dados
    include 'db.php';

    // Verifica se a tarefa foi excluída
    if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $sql = "DELETE FROM tarefa WHERE id_tarefa = :id_tarefa";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_tarefa', $id_tarefa);
    $stmt->execute();

    header('Location: tarefas.php');
    exit;
}

    // Verifica se o status da tarefa foi alterado
    if (isset($_GET['atualizar_status'])) {
    $id = $_GET['atualizar_status'];
    $sql = "UPDATE tarefa SET status = CASE 
                WHEN status = 'A fazer' THEN 'Em preparação' 
                WHEN status = 'Em preparação' THEN 'Pronto' 
                WHEN status = 'Pronto' THEN 'A fazer' 
            END WHERE id_tarefa = :id_tarefa";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_tarefa', $id_tarefa);
    $stmt->execute();

    header('Location: tarefas.php');
    exit;
}

// Consulta as tarefas e os dados dos udusriod
$sql = "SELECT tarefa.*, usuario.nome_usuario, usuario.email_usuario
        FROM tarefa 
        JOIN usuario ON tarefa.id_tarefa = usuario.id_usuario";
$stmt = $conn->prepare($sql);
$stmt->execute();
$tarefas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas - Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Menu de Navegação -->
    <nav>
        <a href="index.php">Registrar Tarefas</a>
        <a href="tarefas.php">Visualizar Tarefas</a>
        <a href="cadastro_usuario.php">Cadastrar Usuário</a>
    </nav>

    <h1>Tarefas</h1>
    <div class="colunas">
        <!-- Tarefas a fazer -->
        <div class="coluna">
            <h2>Tarefas a Fazer</h2>
            <?php foreach ($tarefas as $tarefa): ?>   <!-- tinha s na 1 tarefa -->
                <?php if ($tarefa['status'] == 'A fazer'): ?>
                    <div class="tarefa">
                        <p><strong>Usuário:</strong> <?php echo $tarefa['nome_usuario']; ?></p>
                        <p><strong>E-mail:</strong> <?php echo $tarefa['email_usuario']; ?></p>
                        <p><strong>Descrição:</strong> <?php echo $tarefa['descricao_tarefa']; ?></p>
                        <p><strong>Nome do Setor:</strong> <?php echo $tarefa['nome_setor']; ?></p>
                        <p><strong>prioridade:</strong> <?php echo $tarefa['prioridade']; ?></p>
                        <p><strong>status_tarefa:</strong> <?php echo $tarefa['status_tarefa']; ?></p>
                        <p><strong>Data Cadastro:</strong> <?php echo $tarefa['data_cadastro']; ?></p>
                        <a href="?atualizar_status=<?php echo $tarefa['id_tarefa']; ?>">Alterar Status</a>
                        <a href="?excluir=<?php echo $tarefa['id_tarefa']; ?>">Excluir Tarefa</a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Pedidos em preparação -->
        <div class="coluna">
            <h2>Tarefas em Preparação</h2>
            <?php foreach ($tarefas as $tarefa): ?>  <!-- tinha s na 1 tarefa -->
                <?php if ($tarefa['status'] == 'Em preparação'): ?>
                    <div class="tarefa">
                    <p><strong>Usuário:</strong> <?php echo $tarefa['nome_usuario']; ?></p>
                        <p><strong>E-mail:</strong> <?php echo $tarefa['email_usuario']; ?></p>
                        <p><strong>Descrição:</strong> <?php echo $tarefa['descricao_tarefa']; ?></p>
                        <p><strong>Nome do Setor:</strong> <?php echo $tarefa['nome_setor']; ?></p>
                        <p><strong>prioridade:</strong> <?php echo $tarefa['prioridade']; ?></p>
                        <p><strong>status_tarefa:</strong> <?php echo $tarefa['status_tarefa']; ?></p>
                        <p><strong>Data Cadastro:</strong> <?php echo $tarefa['data_cadastro']; ?></p>
                        <a href="?atualizar_status=<?php echo $tarefa['id_tarefa']; ?>">Alterar Status</a>
                        <a href="?excluir=<?php echo $tarefa['id_tarefa']; ?>">Excluir Tarefa</a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Pedidos prontos -->
        <div class="coluna">
            <h2>Tarefas Prontos</h2>
            <?php foreach ($tarefas as $tarefa): ?>  <!-- tinha s na 1 tarefa -->
                <?php if ($tarefa['status'] == 'Pronto'): ?>
                    <div class="tarefa">
                    <p><strong>Usuário:</strong> <?php echo $tarefa['nome_usuario']; ?></p>
                        <p><strong>E-mail:</strong> <?php echo $tarefa['email_usuario']; ?></p>
                        <p><strong>Descrição:</strong> <?php echo $tarefa['descricao_tarefa']; ?></p>
                        <p><strong>Nome do Setor:</strong> <?php echo $tarefa['nome_setor']; ?></p>
                        <p><strong>prioridade:</strong> <?php echo $tarefa['prioridade']; ?></p>
                        <p><strong>status_tarefa:</strong> <?php echo $tarefa['status_tarefa']; ?></p>
                        <p><strong>Data Cadastro:</strong> <?php echo $tarefa['data_cadastro']; ?></p>
                        <a href="?atualizar_status=<?php echo $tarefa['id_tarefa']; ?>">Alterar Status</a>
                        <a href="?excluir=<?php echo $tarefa['id_tarefa']; ?>">Excluir Tarefa</a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>