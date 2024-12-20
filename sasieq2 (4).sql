-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 20-Dez-2024 às 19:24
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
-- Banco de dados: `sasieq2`
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
  `tamanho` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id_entrada`),
  KEY `fk_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `entrada`
--

INSERT INTO `entrada` (`id_entrada`, `data_entrada`, `id_usuario`, `deferido`, `quantidade`, `descricao`, `tamanho`) VALUES
(13, '2024-11-14 16:28:00', 11, 1, 1, 'sadfafsd', NULL),
(14, '2024-11-14 16:29:00', 11, 1, 2, 'sadfadafdfasfs', 'GG'),
(15, '2024-11-14 16:29:00', 11, 1, 1, 'fsdfsdfsad121', 'GG'),
(16, '2024-11-14 16:40:00', 11, 1, 1, '12', NULL),
(17, '2024-11-14 16:46:00', 11, 1, 1121, '12121212', NULL),
(18, '2024-11-14 16:46:00', 11, NULL, 13444, '09765', 'GG'),
(19, '2024-11-26 14:49:00', 11, NULL, 0, '', NULL),
(20, '2024-11-26 15:31:00', 11, 1, 0, '', NULL),
(21, '2024-11-26 15:32:00', 11, NULL, 0, '', NULL),
(22, '2024-11-26 16:40:00', 11, NULL, 0, '', NULL),
(23, '2024-11-26 17:00:00', 11, NULL, 2, 'fsd', NULL),
(25, '2024-11-26 17:03:00', 11, 1, 1, 'q1', 'GG'),
(26, '2024-11-28 15:43:00', 11, 1, 2, '', NULL),
(27, '2024-11-28 15:45:00', 11, 1, 22, '', NULL),
(28, '2024-11-28 15:46:00', 11, 1, 22, '', NULL),
(29, '2024-11-28 15:47:00', 11, 1, 3, 'fsd', NULL),
(30, '2024-11-28 15:47:00', 11, 1, 1, '1', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

DROP TABLE IF EXISTS `estoque`;
CREATE TABLE IF NOT EXISTS `estoque` (
  `id_estoque` int NOT NULL AUTO_INCREMENT,
  `id_produto` int DEFAULT NULL,
  `data_validade` date DEFAULT NULL,
  PRIMARY KEY (`id_estoque`),
  KEY `id_produto` (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`id_estoque`, `id_produto`, `data_validade`) VALUES
(1, 13, '2025-12-09'),
(2, 6, '2026-09-02'),
(3, 7, '2026-10-03'),
(4, 14, '2026-11-04'),
(5, 15, '2026-12-05'),
(6, 16, '2027-01-06'),
(7, 14, '2027-02-07'),
(10, 14, '1200-11-12'),
(11, 21, '1200-11-12'),
(12, 11, '0000-00-00'),
(15, 2, '0000-00-00'),
(16, 2, '0000-00-00'),
(17, 27, '1300-12-12'),
(18, 5, '0000-00-00');

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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `itens_entrada`
--

INSERT INTO `itens_entrada` (`id_item_entrada`, `quantidade`, `id_estoque`, `id_entrada`) VALUES
(1, 1, 18, 30),
(2, 10, 12, 18),
(3, 10, 2, 14),
(4, 10, 2, 13),
(5, 10, 2, 20),
(6, 10, 2, 14),
(7, 10, 2, 13),
(8, 10, 2, 20),
(9, 10, 2, 14),
(10, 10, 2, 13),
(11, 10, 2, 20),
(22, 10, 2, 29),
(32, 9, 10, 28),
(33, 9, 10, 29),
(34, 9, 10, 30),
(35, 9, 10, 28),
(36, 9, 10, 29),
(37, 9, 10, 30),
(38, 9, 10, 28),
(39, 9, 10, 29),
(40, 9, 10, 30),
(41, 9, 10, 29),
(42, 9, 10, 28),
(43, 9, 7, 28),
(44, 9, 7, 29),
(45, 9, 7, 30),
(46, 9, 4, 28),
(47, 9, 4, 29),
(48, 9, 4, 30),
(49, 9, 4, 28),
(50, 9, 7, 29),
(51, 9, 4, 30),
(52, 9, 4, 29),
(53, 9, 4, 28),
(54, 10, 3, 26);

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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `itens_saida`
--

INSERT INTO `itens_saida` (`id_item_pedido`, `quantidade`, `id_pedido`, `id_estoque`) VALUES
(1, 10, 14, 18),
(13, 12, 18, 10),
(14, 12, 18, 7),
(15, 12, 18, 4),
(16, 12, 18, 10),
(17, 12, 18, 7),
(18, 12, 18, 4),
(19, 12, 18, 10),
(20, 12, 18, 7),
(21, 12, 18, 4),
(22, 12, 18, 7),
(23, 12, 18, 4),
(44, 9, 15, 2),
(45, 9, 16, 2),
(46, 9, 17, 2),
(47, 9, 15, 2),
(48, 9, 16, 2),
(49, 9, 17, 2),
(50, 9, 15, 2),
(51, 9, 16, 2),
(52, 9, 17, 2),
(53, 9, 15, 2);

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
  `kit` varchar(24) NOT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `fk_usuario_pedido` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `data_pedido`, `deferido`, `id_usuario`, `quantidade`, `kit`) VALUES
(1, '2024-11-07 00:00:00', 0, 1, NULL, 'alimento'),
(14, '2024-11-09 17:28:00', NULL, 1, NULL, 'alimento'),
(15, '2024-11-09 17:28:00', 1, 1, NULL, 'roupa'),
(16, '2024-11-09 18:11:00', 1, 1, NULL, 'roupa'),
(17, '2024-12-02 09:43:00', 1, 11, 1, 'alimento'),
(18, '2024-12-12 00:00:00', 1, 6, 10, 'alimento');

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `tipo_produto`, `subtipo_produto`) VALUES
(1, 'alimento', 'arroz'),
(2, 'outro', NULL),
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(10, 'Patricia Martins', '111', 'patricia.martins@email.com', 'Rua J, 707, Goiânia', '62987654321', 1, 'user.png'),
(11, 'Administrador', '111', 'admin@gmail.com', '', '', 0, 'user.png'),
(12, 'camison', '111', 'camison@gmail.com', 'rua do camison', '99-9 1234-5678', 1, 'user.png'),
(13, 'jecaTatu', '111', 'jeca@gmail.com', 'andratatu', '88-8 4321-4321', 1, 'user.png');

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
