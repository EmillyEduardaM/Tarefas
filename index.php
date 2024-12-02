<?php

    // Inclui o arquivo de conexão com o banco de dados
    include 'db.php';

    // Verifica se o formulário foi enviado para registrar o usuário
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_tarefa = $_POST['id_tarefa'];
    $id_usuario = $_POST['id_usuario'];
    $descricao_tarefa = $_POST['descricao_tarefa'];
    $nome_setor = $_POST['nome_setor'];
    $prioridade = $_POST['prioridade'];
    $status_tarefa = $_POST['status_tarefa'];
    $data_cadastro = $_POST['data_cadastro'];

    // Insere o usuario no banco de dados
    $sql = "INSERT INTO tarefa (id_usuario, id_tarefa, descricao_tarefa, nome_setor, prioridade, status_tarefa, data_cadastro)
            VALUES (:id_usuario :id_tarefa, :descricao_tarefa, :nome_setor, :prioridade, :status_tarefa, :data_cadastro)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->bindParam(':id_tarefa', $id_tarefa);
    $stmt->bindParam(':descricao_tarefa', $descricao_tarefa);
    $stmt->bindParam(':prioridade', $prioridade);
    $stmt->bindParam(':nome_setor', $nome_setor);
    $stmt->bindParam(':status_tarefa', $status_tarefa);
    $stmt->bindParam(':data_cadastro', $data_cadastro);


    $stmt->execute();

    // Redireciona para a página de visualização de tarefas
    header('Location: tarefas.php');
    exit;
}

    // Consulta todos os usuarios cadastrados
    $sql = "SELECT * FROM usuario";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $usuario = $stmt->fetchAll();
?>

    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Tarefa - Tarefas</title>
    <link rel="stylesheet" href="style.css">
    <script>
        
    // Função para preencher os campos de e-mail automaticamente ao selecionar o cliente
    function preencherDadosUsuario() {
            var usuarioid = document.getElementById("id_usuario").value;
            var nomeusuario = document.getElementById("nome_usuario");
            var emailusuario = document.getElementById("email_usuario");

            <?php foreach ($clientes as $cliente): ?>
                if (usuarioid == <?php echo $usuario['id_usuario']; ?>) {
                    nomeusuario.value = "<?php echo $cliente['nome_usuario']; ?>";
                    emailusuario.value = "<?php echo $cliente['email_usuario']; ?>";
                }
            <?php endforeach; ?>
        }
    </script>
    </head>
    <body>
    <!-- Menu de Navegação -->
    <nav>
        <a href="index.php">Registrar Tarefa</a>
        <a href="tarefas.php">Visualizar Tarefa</a>
        <a href="cadastro_usuario.php">Cadastrar Usuário</a>
    </nav>

    <h1>Registrar Tarefas</h1>
    <form action="index.php" method="POST">
        <label for="id_usuario">Selecione o Usuario:</label>
        <select id="id_usuario" name="id_usuario" onchange="preencherDadosUsuario()" required>
            <option value="">Escolha o Usuario</option>
            <?php foreach ($usuarios as $usuario): ?>
                <option value="<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['nome_usuario']; ?></option>
            <?php endforeach; ?>
        </select><br>


        <label for="nome_usuario">Nome:</label>
        <input type="text" id="nome_usuario" name="nome_usuario" disabled><br>

        <label for="email_usuario">Nome:</label>
        <input type="text" id="email_usuario" name="email_usuario" disabled><br>

        <label for="descricao_tarefa">Descrição da Tarefa:</label>
        <input type="text" id="descricao_tarefa" name="descricao_tarefa" disabled><br>

        <label for="prioridade">Prioridade:</label>
        <select name="select">
        <option value="baixa">Baixa</option>
        <option value="média" selected>Média</option>
        <option value="alta">Alta</option>
        </select>

        <label for="nome_setor">Nome do Setor:</label>
        <input type="text" id="nome_setor" name="nome_setor" required><br>

        <label for="status_tarefa">Status Tarefa:</label>
        <select name="select">
        <option value="A fazer">A fazer</option>
        <option value="Fazendo" selected>Fazendo</option>
        <option value="Pronto">Pronto</option>
        </select>

        <label for="data_cadastro">Quantidade:</label>
        <input type="date" id="data_cadastro" name="data_cadastro" required><br>

        <button type="submit">Registrar Tarefa</button>
    </form>
</body>
</html>
















