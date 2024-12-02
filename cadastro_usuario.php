<?php

    // Inclui o arquivo de conexão com o banco de dados
    include 'db.php';

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Coleta os dados do formulário  
    $email_usuario = $_POST['email_usuario'];
    $nome_usuario = $_POST['nome_usuario'];
  

    // Insere os dados no banco de dados
    $sql = "INSERT INTO usuario (email_usuario,nome_usuario)
     VALUES (:email_usuario, :nome_usuario)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email_usuario', $email_usuario);
    $stmt->bindParam(':nome_usuario', $nome_usuario);
    

    $stmt->execute();

    // Redireciona para a página de tarefas
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário - Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Menu de Navegação -->
    <nav>
        <a href="index.php">Registrar Tarefas</a>
        <a href="tarefas.php">Visualizar Tarefas</a>
        <a href="cadastro_usuario.php">Cadastrar Usuário</a>
    </nav>

    <h1>Cadastro de Usuário</h1>
    <form action="cadastro_usuario.php" method="POST"> 
        
        <label for="email_usuario">E-mail:</label>
        <input type="text" id="email_usuario" name="email_usuario" required><br>
        <label for="nome_usuario">Nome do Usuário:</label>
        <input type="text" id="nome_usuario" name="nome_usuario" required><br>

       

        <button type="submit">Cadastrar Usuário</button>
    </form>
</body>
</html>