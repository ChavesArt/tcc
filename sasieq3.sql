-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 14-Nov-2024 às 20:27
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sasieq3`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrada`
--

DROP TABLE IF EXISTS `entrada`;
CREATE TABLE IF NOT EXISTS `entrada` (
  `id_entrada` int NOT NULL AUTO_INCREMENT,
  `data_entrada` datetime DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `deferido` tinyint(1) DEFAULT NULL,
  `quantidade` int DEFAULT NULL,
  `descricao` text,
  `data_validade` date DEFAULT NULL,
  `tamanho` varchar(3) DEFAULT NULL,
  `subtipo_doacao` varchar(255) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id_entrada`),
  KEY `fk_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `entrada`
--

INSERT INTO `entrada` (`id_entrada`, `data_entrada`, `id_usuario`, `deferido`, `quantidade`, `descricao`, `data_validade`, `tamanho`, `subtipo_doacao`, `nome`) VALUES
(13, '2024-11-14 16:28:00', 11, NULL, 1, 'sadfafsd', '2024-12-07', NULL, 'alimento', 'açucar'),
(14, '2024-11-14 16:29:00', 11, NULL, 2, 'sadfadafdfasfs', '2024-11-28', 'GG', 'outro', 'avatar'),
(15, '2024-11-14 16:29:00', 11, NULL, 1, 'fsdfsdfsad121', NULL, 'GG', 'roupa', 'calça'),
(16, '2024-11-14 16:40:00', 11, NULL, 1, '12', '2024-11-30', NULL, 'alimento', 'abobora'),
(17, '2024-11-14 16:46:00', 11, NULL, 1121, '12121212', '2024-11-30', NULL, 'alimento', 'alface'),
(18, '2024-11-14 16:46:00', 11, NULL, 13444, '09765', NULL, 'GG', 'roupa', 'casaco');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

DROP TABLE IF EXISTS `estoque`;
CREATE TABLE IF NOT EXISTS `estoque` (
  `id_estoque` int NOT NULL AUTO_INCREMENT,
  `id_produto` int DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `tamanho` varchar(4) DEFAULT NULL,
  `data_validade` date DEFAULT NULL,
  PRIMARY KEY (`id_estoque`),
  KEY `id_produto` (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=8;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`id_estoque`, `id_produto`, `descricao`, `tamanho`, `data_validade`) VALUES
(1, 13, 'Camili', NULL, '2025-12-09'),
(2, 6, 'Integral', NULL, '2026-09-02'),
(3, 7, 'girassol', NULL, '2026-10-03'),
(4, 14, 'Spagheti', NULL, '2026-11-04'),
(5, 15, 'oliva', NULL, '2026-12-05'),
(6, 16, 'cristal', NULL, '2027-01-06'),
(7, 17, 'grosso', NULL, '2027-02-07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_entrada`
--

DROP TABLE IF EXISTS `itens_entrada`;
CREATE TABLE IF NOT EXISTS `itens_entrada` (
  `id_item_entrada` int NOT NULL AUTO_INCREMENT,
  `quantidade` int DEFAULT NULL,
  `id_estoque` int DEFAULT NULL,
  `id_entrada` int DEFAULT NULL,
  PRIMARY KEY (`id_item_entrada`),
  KEY `id_entrada` (`id_entrada`),
  KEY `fk_id_estoque` (`id_estoque`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_saida`
--

DROP TABLE IF EXISTS `itens_saida`;
CREATE TABLE IF NOT EXISTS `itens_saida` (
  `id_item_pedido` int NOT NULL AUTO_INCREMENT,
  `quantidade` int DEFAULT NULL,
  `id_pedido` int DEFAULT NULL,
  `id_estoque` int NOT NULL,
  PRIMARY KEY (`id_item_pedido`),
  KEY `fk_pedido_item` (`id_pedido`),
  KEY `id_estoque` (`id_estoque`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `id_pedido` int NOT NULL AUTO_INCREMENT,
  `data_pedido` datetime DEFAULT NULL,
  `deferido` tinyint(1) DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `quantidade` int DEFAULT NULL,
  `descricao` text,
  `data_validade` date DEFAULT NULL,
  `tamanho` varchar(3) DEFAULT NULL,
  `subtipo_doacao` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `fk_usuario_pedido` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=17;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `data_pedido`, `deferido`, `id_usuario`, `quantidade`, `descricao`, `data_validade`, `tamanho`, `subtipo_doacao`, `nome`) VALUES
(1, '2024-11-07 00:00:00', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '2024-11-09 17:28:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '2024-11-09 17:28:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '2024-11-09 18:11:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id_produto` int NOT NULL AUTO_INCREMENT,
  `tipo_produto` varchar(255) DEFAULT NULL,
  `subtipo_produto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=32;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `tipo_produto`, `subtipo_produto`) VALUES
(1, 'alimento', 'arroz'),
(2, 'roupa', 'camiseta de manga longa'),
(3, 'alimento', 'maionese'),
(4, 'roupa', 'camiseta de manga curta'),
(5, 'roupa', 'calça'),
(6, 'alimento', 'leite'),
(7, 'alimento', 'azeite'),
(10, 'alimento', 'molho de tomate'),
(11, 'roupa', 'casaco'),
(13, 'alimento', 'feijão'),
(14, 'alimento', 'macarrão'),
(15, 'alimento', 'óleo'),
(16, 'alimento', 'açúcar'),
(17, 'alimento', 'sal'),
(18, 'alimento', 'farinha de trigo'),
(19, 'alimento', 'milho'),
(20, 'alimento', 'batata'),
(21, 'alimento', 'cebola'),
(22, 'alimento', 'tomate'),
(23, 'alimento', 'alface'),
(24, 'alimento', 'cenoura'),
(25, 'alimento', 'pepino'),
(26, 'alimento', 'berinjela'),
(27, 'alimento', 'abóbora'),
(28, 'alimento', 'frango'),
(29, 'alimento', 'carne bovina'),
(30, 'alimento', 'peixe'),
(31, 'alimento', 'queijo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recuperar_senha`
--

DROP TABLE IF EXISTS `recuperar_senha`;
CREATE TABLE IF NOT EXISTS `recuperar_senha` (
  `email` varchar(255) NOT NULL,
  `token` char(100) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `usado` tinyint(1) NOT NULL
) ENGINE=MyISAM;

--
-- Extraindo dados da tabela `recuperar_senha`
--

INSERT INTO `recuperar_senha` (`email`, `token`, `data_criacao`, `usado`) VALUES
('teste02082024@gmail.com', '2d17ea1bb3ee68c9fcd8afe1105d2e9716fe7e1cd8c2f21655fad67d6f33f4be41d87b4376b9c5d00506ea465a2eb68dc7e5', '2024-08-02 13:23:17', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `tipo_cliente` int DEFAULT NULL,
  `foto` varchar(255) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `senha`, `email`, `endereco`, `telefone`, `tipo_cliente`, `foto`) VALUES
(1, 'João Silva', '111', 'joao.silva@email.com', 'Rua A, 123, São Paulo', '11987654321', 1, 'user.png'),
(2, 'Maria Oliveira', '111', 'maria.oliveira@email.com', 'Rua B, 456, Rio de Janeiro', '21987654321', 1, 'user.png'),
(3, 'Carlos Santos', '111', 'carlos.santos@email.com', 'Rua C, 789, Belo Horizonte', '31987654321', 1, 'user.png'),
(4, 'Ana Costa', '111', 'ana.costa@email.com', 'Rua D, 101, Curitiba', '41987654321', 1, 'user.png'),
(5, 'Pedro Souza', '111', 'pedro.souza@email.com', 'Rua E, 202, Porto Alegre', '51987654321', 1, 'user.png'),
(6, 'Juliana Lima', '111', 'juliana.lima@email.com', 'Rua F, 303, Salvador', '61987654321', 1, 'user.png'),
(7, 'Roberto Pereira', '111', 'roberto.pereira@email.com', 'Rua G, 404, Fortaleza', '71987654321', 1, 'user.png'),
(8, 'Fernanda Rodrigues', '111', 'fernanda.rodrigues@email.com', 'Rua H, 505, Recife', '81987654321', 1, 'user.png'),
(9, 'Ricardo Almeida', '111', 'ricardo.almeida@email.com', 'Rua I, 606, Brasília', '91987654321', 1, 'user.png'),
(10, 'Patricia Martins', '111', 'patricia.martins@email.com', 'Rua J, 707, Goiânia', '62987654321', 1, 'user.png'),
(11, 'Administrador', '111', 'admin@gmail.com', '', '', 0, 'user.png');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `id_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`);

--
-- Limitadores para a tabela `itens_entrada`
--
ALTER TABLE `itens_entrada`
  ADD CONSTRAINT `fk_id_estoque` FOREIGN KEY (`id_estoque`) REFERENCES `estoque` (`id_estoque`),
  ADD CONSTRAINT `id_entrada` FOREIGN KEY (`id_entrada`) REFERENCES `entrada` (`id_entrada`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `itens_saida`
--
ALTER TABLE `itens_saida`
  ADD CONSTRAINT `fk_pedido_item` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_estoque` FOREIGN KEY (`id_estoque`) REFERENCES `estoque` (`id_estoque`);

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_usuario_pedido` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
