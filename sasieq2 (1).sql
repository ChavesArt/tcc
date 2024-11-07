-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 07-Nov-2024 às 16:33
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
  `id_entrada` int NOT NULL,
  `data_entrada` date DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`id_entrada`),
  KEY `fk_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `entrada`
--

INSERT INTO `entrada` (`id_entrada`, `data_entrada`, `id_usuario`) VALUES
(0, '2024-12-10', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

DROP TABLE IF EXISTS `estoque`;
CREATE TABLE IF NOT EXISTS `estoque` (
  `id_estoque` int NOT NULL,
  `id_produto` int DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `tamanho` varchar(4) DEFAULT NULL,
  `data_validade` date DEFAULT NULL,
  PRIMARY KEY (`id_estoque`),
  KEY `id_produto` (`id_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`id_estoque`, `id_produto`, `descricao`, `tamanho`, `data_validade`) VALUES
(0, 1, 'requisição de 1Kg de arroz', NULL, '2025-10-10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_entrada`
--

DROP TABLE IF EXISTS `itens_entrada`;
CREATE TABLE IF NOT EXISTS `itens_entrada` (
  `id_item_entrada` int NOT NULL,
  `quantidade` int DEFAULT NULL,
  `id_estoque` int DEFAULT NULL,
  `id_entrada` int DEFAULT NULL,
  PRIMARY KEY (`id_item_entrada`),
  KEY `id_estoque` (`id_estoque`),
  KEY `id_entrada` (`id_entrada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_saida`
--

DROP TABLE IF EXISTS `itens_saida`;
CREATE TABLE IF NOT EXISTS `itens_saida` (
  `id_item_pedido` int NOT NULL,
  `quantidade` int DEFAULT NULL,
  `id_pedido` int DEFAULT NULL,
  PRIMARY KEY (`id_item_pedido`),
  KEY `fk_pedido_item` (`id_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `id_pedido` int NOT NULL AUTO_INCREMENT,
  `data_pedido` date DEFAULT NULL,
  `analisado` tinyint(1) NOT NULL,
  `deferido` tinyint(1) NOT NULL,
  `id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `fk_usuario_pedido` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `data_pedido`, `analisado`, `deferido`, `id_usuario`) VALUES
(1, '2024-11-07', 1, 1, 1);

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
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `senha`, `email`, `endereco`, `telefone`, `tipo_cliente`) VALUES
(1, 'João Silva', '111', 'joao.silva@email.com', 'Rua A, 123, São Paulo', '11987654321', 1),
(2, 'Maria Oliveira', '111', 'maria.oliveira@email.com', 'Rua B, 456, Rio de Janeiro', '21987654321', 1),
(3, 'Carlos Santos', '111', 'carlos.santos@email.com', 'Rua C, 789, Belo Horizonte', '31987654321', 1),
(4, 'Ana Costa', '111', 'ana.costa@email.com', 'Rua D, 101, Curitiba', '41987654321', 1),
(5, 'Pedro Souza', '111', 'pedro.souza@email.com', 'Rua E, 202, Porto Alegre', '51987654321', 1),
(6, 'Juliana Lima', '111', 'juliana.lima@email.com', 'Rua F, 303, Salvador', '61987654321', 1),
(7, 'Roberto Pereira', '111', 'roberto.pereira@email.com', 'Rua G, 404, Fortaleza', '71987654321', 1),
(8, 'Fernanda Rodrigues', '111', 'fernanda.rodrigues@email.com', 'Rua H, 505, Recife', '81987654321', 1),
(9, 'Ricardo Almeida', '111', 'ricardo.almeida@email.com', 'Rua I, 606, Brasília', '91987654321', 1),
(10, 'Patricia Martins', '111', 'patricia.martins@email.com', 'Rua J, 707, Goiânia', '62987654321', 1),
(11, 'Administrador', '111', 'admin@gmail.com', '', '', 0);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `id_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`);

--
-- Limitadores para a tabela `itens_entrada`
--
ALTER TABLE `itens_entrada`
  ADD CONSTRAINT `itens_entrada_ibfk_1` FOREIGN KEY (`id_estoque`) REFERENCES `estoque` (`id_estoque`),
  ADD CONSTRAINT `itens_entrada_ibfk_2` FOREIGN KEY (`id_entrada`) REFERENCES `entrada` (`id_entrada`);

--
-- Limitadores para a tabela `itens_saida`
--
ALTER TABLE `itens_saida`
  ADD CONSTRAINT `fk_pedido_item` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_usuario_pedido` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
