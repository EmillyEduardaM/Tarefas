CREATE TABLE usuario (
    id_usuario INTEGER PRIMARY KEY AUTO_INCREMENT,
    email_usuario VARCHAR (100) NOT NULL,
    nome_usuario VARCHAR (100)  NOT NULL
);

CREATE TABLE tarefa (
    id_tarefa INTEGER PRIMARY KEY AUTO_INCREMENT,
    descricao_tarefa VARCHAR (300) NOT NULL,
    nome_setor VARCHAR (100) NOT NULL,
    prioridade VARCHAR (50) NOT NULL,
    status_tarefa VARCHAR (300) NOT NULL,
    data_cadastro DATE NOT NULL,
    id_usuario INTEGER NOT NULL -- Transforemei em FK direto no banco de dados 
);

    