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
) ENGINE=InnoDB AUTO_INCREMENT=1;

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
) ENGINE=InnoDB AUTO_INCREMENT=1;

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
) ENGINE=InnoDB AUTO_INCREMENT=1;

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
) ENGINE=InnoDB AUTO_INCREMENT=1;

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
) ENGINE=InnoDB AUTO_INCREMENT=1;

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
) ENGINE=InnoDB AUTO_INCREMENT=1;

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
) ENGINE=InnoDB AUTO_INCREMENT=1;

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
