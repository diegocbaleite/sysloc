-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS sysloc;

-- Seleção do banco de dados
USE sysloc;

-- Criação da tabela Municipio
CREATE TABLE IF NOT EXISTS Municipio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255)
);

-- Inserção de alguns municípios de exemplo
INSERT INTO Municipio (nome) VALUES ('Cuiabá');
INSERT INTO Municipio (nome) VALUES ('Várzea Grande');
-- Adicione mais municípios conforme necessário

-- Criação da tabela Operador
CREATE TABLE IF NOT EXISTS Operador (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255)
);

-- Inserção de alguns operadores de exemplo
INSERT INTO Operador (nome) VALUES ('Águas Cuiabá');
INSERT INTO Operador (nome) VALUES ('Energisa');
-- Adicione mais operadores conforme necessário

-- Criação da tabela Users
CREATE TABLE IF NOT EXISTS Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    username VARCHAR(255),
    password VARCHAR(255)
);

-- Inserção de usuários de exemplo
INSERT INTO Users (username, password) VALUES ('admin', '123');
-- Adicione mais usuários conforme necessário

-- Criação da tabela Fiscalizacao
CREATE TABLE `fiscalizacao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `municipio` varchar(255) DEFAULT NULL,
  `operador` varchar(255) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`)
);
