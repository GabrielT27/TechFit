-- Geração de Modelo físico
-- Sql ANSI 2003 - brModelo.



CREATE TABLE PLANOS (
beneficios varchar(80),
valor decimal(10,2),
id_plano int auto_increment PRIMARY KEY,
tipo varchar(60)
)

CREATE TABLE ALUNOS (
id_plano int,
status varchar(5),
email varchar(200),
senha varchar(20),
sexo char(1),
id_aluno int auto_increment PRIMARY KEY,
cpf char(11),
dtn date,
telefone char(11),
endereco varchar(200),
nome varchar(100)
)

CREATE TABLE PAGAMENTOS (
id_aluno int,
tipo_pagamento varchar(40),
valor decimal(10,2),
id_pagamento int auto_increment PRIMARY KEY,
data date
)

CREATE TABLE UNIDADES (
id_aluno int,
id_func int,
id_und int auto_increment PRIMARY KEY,
endereco varchar(200),
nome varchar(60)
)

CREATE TABLE MODALIDADES (
horarios datetime,
id_modalidade int auto_increment PRIMARY KEY,
nome varchar(80),
id_func int
)

CREATE TABLE FUNCIONARIO (
id_func int auto_increment PRIMARY KEY,
cargo varchar(50),
endereco varchar(200),
nome varchar(50),
turno char(1),
login varchar(200),
id_modalidade int,
dtn date,
cpf char(11),
telefone char(11),
dt_adm date,
salario decimal(10,2)
)

CREATE TABLE PERTENCEM (
id_und int auto_increment,
id_func int auto_increment,
FOREIGN KEY(id_und) REFERENCES UNIDADES (id_und),
FOREIGN KEY(id_func) REFERENCES FUNCIONARIO (id_func)
)

CREATE TABLE EXECUTADAS (
id_modalidade int auto_increment,
id_func int auto_increment,
FOREIGN KEY(id_modalidade) REFERENCES MODALIDADES (id_modalidade),
FOREIGN KEY(id_func) REFERENCES FUNCIONARIO (id_func)
)

CREATE TABLE EXISTEM (
id_plano int auto_increment,
id_und int auto_increment,
FOREIGN KEY(id_plano) REFERENCES PLANOS (id_plano),
FOREIGN KEY(id_und) REFERENCES UNIDADES (id_und)
)

CREATE TABLE REALIZAM (
id_pagamento int auto_increment,
id_aluno int auto_increment,
FOREIGN KEY(id_pagamento) REFERENCES PAGAMENTOS (id_pagamento)/*falha: chave estrangeira*/
)

