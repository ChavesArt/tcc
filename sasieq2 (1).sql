-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Nov-2024 às 23:28
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

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

CREATE TABLE `entrada` (
  `id_entrada` int(11) NOT NULL,
  `data_entrada` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `detalhamento` text NOT NULL,
  `deferido` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `entrada`
--

INSERT INTO `entrada` (`id_entrada`, `data_entrada`, `id_usuario`, `detalhamento`, `deferido`) VALUES
(1, '2024-11-07 00:00:00', 4, 'Isso é um teste', 1),
(2, '2024-11-07 20:03:00', 4, 'Alimento: alface;\r\nQuantidade: 7;\r\nData de validade:2024-11-13\r\nDescrição: teste teste teeste', 0),
(3, '2024-11-07 20:07:00', 4, 'Alimento: arroz; <br> Quantidade: 9; <br> Data de validade:2024-12-07 <br> Descrição: Arroz Requinte fresquinha', 0),
(4, '2024-11-07 20:08:00', 4, 'Roupa: ; <br> Quantidade: 2; <br> Tamanho: GG <br> Descrição: Casaco preto', NULL),
(6, '2024-11-07 20:13:00', 4, 'Doação: ; <br> Quantidade: 32; <br> Data de validade: <br> Tamanho:  <br> Data de validade:  <br> Descrição: copo 20cm', NULL),
(7, '2024-11-09 17:24:00', 1, 'Alimento: abóbora;Quantidade: 1;Data de validade:2024-11-29Descrição: doce', 1),
(8, '2024-11-09 17:25:00', 1, 'Alimento: farinha;Quantidade: 6;Data de validade:2024-12-07Descrição: vem do trigo', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE `estoque` (
  `id_estoque` int(11) NOT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `tamanho` varchar(4) DEFAULT NULL,
  `data_validade` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `itens_entrada` (
  `id_item_entrada` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `id_estoque` int(11) DEFAULT NULL,
  `id_entrada` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_saida`
--

CREATE TABLE `itens_saida` (
  `id_item_pedido` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_estoque` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `data_pedido` datetime DEFAULT NULL,
  `deferido` tinyint(1) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `detalhamento` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `data_pedido`, `deferido`, `id_usuario`, `detalhamento`) VALUES
(1, '2024-11-07 00:00:00', 0, 1, ''),
(14, '2024-11-09 17:28:00', NULL, 1, 'Alimento: abóbora;#Quantidade: 2;#Descrição: Que seja doce'),
(15, '2024-11-09 17:28:00', NULL, 1, 'Alimento: maionese;#Quantidade: 1;#Descrição: Helmanns'),
(16, '2024-11-09 18:11:00', NULL, 1, 'Alimento: leite#Quantidade: 2#Descrição: aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `tipo_produto` varchar(255) DEFAULT NULL,
  `subtipo_produto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `recuperar_senha` (
  `email` varchar(255) NOT NULL,
  `token` char(100) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `usado` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `recuperar_senha`
--

INSERT INTO `recuperar_senha` (`email`, `token`, `data_criacao`, `usado`) VALUES
('teste02082024@gmail.com', '2d17ea1bb3ee68c9fcd8afe1105d2e9716fe7e1cd8c2f21655fad67d6f33f4be41d87b4376b9c5d00506ea465a2eb68dc7e5', '2024-08-02 13:23:17', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `tipo_cliente` int(11) DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `fk_usuario` (`id_usuario`);

--
-- Índices para tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id_estoque`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices para tabela `itens_entrada`
--
ALTER TABLE `itens_entrada`
  ADD PRIMARY KEY (`id_item_entrada`),
  ADD KEY `id_entrada` (`id_entrada`),
  ADD KEY `fk_id_estoque` (`id_estoque`);

--
-- Índices para tabela `itens_saida`
--
ALTER TABLE `itens_saida`
  ADD PRIMARY KEY (`id_item_pedido`),
  ADD KEY `fk_pedido_item` (`id_pedido`),
  ADD KEY `id_estoque` (`id_estoque`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_usuario_pedido` (`id_usuario`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id_estoque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `itens_entrada`
--
ALTER TABLE `itens_entrada`
  MODIFY `id_item_entrada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `itens_saida`
--
ALTER TABLE `itens_saida`
  MODIFY `id_item_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
