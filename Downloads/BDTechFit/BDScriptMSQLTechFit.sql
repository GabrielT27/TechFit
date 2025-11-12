-- Geração de Modelo Físico
-- SQL ANSI 2003 - brModelo

CREATE DATABASE TechFit;
USE TechFit;


-- TABELA: PLANOS

CREATE TABLE PLANOS (
    id_plano INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(60),
    beneficios VARCHAR(80),
    valor DECIMAL(10,2)
);

-- TABELA: ALUNOS

CREATE TABLE ALUNOS (
    id_aluno INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    cpf CHAR(11),
    dtn DATE,
    sexo CHAR(1),
    telefone CHAR(11),
    endereco VARCHAR(200),
    email VARCHAR(200),
    senha VARCHAR(20),
    status VARCHAR(5),
    id_plano INT,
    FOREIGN KEY (id_plano) REFERENCES PLANOS(id_plano)
);


-- TABELA: PAGAMENTOS

CREATE TABLE PAGAMENTOS (
    id_pagamento INT AUTO_INCREMENT PRIMARY KEY,
    tipo_pagamento VARCHAR(40),
    valor DECIMAL(10,2),
    data DATE,
    id_aluno INT,
    FOREIGN KEY (id_aluno) REFERENCES ALUNOS(id_aluno)
);


-- TABELA: FUNCIONARIO

CREATE TABLE FUNCIONARIO (
    id_func INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    cargo VARCHAR(50),
    turno CHAR(1),
    login VARCHAR(200),
    endereco VARCHAR(200),
    cpf CHAR(11),
    telefone CHAR(11),
    dtn DATE,
    dt_adm DATE,
    salario DECIMAL(10,2),
    id_modalidade INT
);


-- TABELA: MODALIDADES

CREATE TABLE MODALIDADES (
    id_modalidade INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(80),
    horarios DATETIME,
    id_func INT,
    FOREIGN KEY (id_func) REFERENCES FUNCIONARIO(id_func)
);


-- TABELA: UNIDADES

CREATE TABLE UNIDADES (
    id_und INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(60),
    endereco VARCHAR(200),
    id_func INT,
    FOREIGN KEY (id_func) REFERENCES FUNCIONARIO(id_func)
);


-- TABELA: PERTENCEM


CREATE TABLE PERTENCEM (
    id_und INT,
    id_func INT,
    PRIMARY KEY (id_und, id_func),
    FOREIGN KEY (id_und) REFERENCES UNIDADES(id_und),
    FOREIGN KEY (id_func) REFERENCES FUNCIONARIO(id_func)
);



-- TABELA: EXECUTADAS


CREATE TABLE EXECUTADAS (
    id_modalidade INT,
    id_func INT,
    PRIMARY KEY (id_modalidade, id_func),
    FOREIGN KEY (id_modalidade) REFERENCES MODALIDADES(id_modalidade),
    FOREIGN KEY (id_func) REFERENCES FUNCIONARIO(id_func)
);


-- TABELA: EXISTEM
-- (Relacionamento N:N entre PLANOS e UNIDADES)

CREATE TABLE EXISTEM (
    id_plano INT,
    id_und INT,
    PRIMARY KEY (id_plano, id_und),
    FOREIGN KEY (id_plano) REFERENCES PLANOS(id_plano),
    FOREIGN KEY (id_und) REFERENCES UNIDADES(id_und)
);


-- TABELA: REALIZAM

CREATE TABLE REALIZAM (
    id_pagamento INT,
    id_aluno INT,
    PRIMARY KEY (id_pagamento, id_aluno),
    FOREIGN KEY (id_pagamento) REFERENCES PAGAMENTOS(id_pagamento),
    FOREIGN KEY (id_aluno) REFERENCES ALUNOS(id_aluno)
);
