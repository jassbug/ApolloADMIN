-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Tempo de geração: 13/10/2026 às 23:30
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pi_apollo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `avisos`
--

CREATE TABLE `avisos` (
  `id` int UNSIGNED NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(500) NOT NULL,
  `link` varchar(500) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `avisos`
--

INSERT INTO `avisos` (`id`, `titulo`, `descricao`, `imagem`, `link`, `ativo`, `data_criacao`) VALUES
(1, 'As Crônicas de Nárnia: A Viagem do Peregrino da Alvorada', 'dfadadsdfs', '/img/avisos/aviso_6aafd67608dcf2.13242271.jpg', 'http://localhost:8080/Usuario/perfil.php', 1, '2026-09-20 12:49:58');

-- --------------------------------------------------------

--
-- Estrutura para tabela `codigos_email`
--

CREATE TABLE `codigos_email` (
  `id` int UNSIGNED NOT NULL,
  `usuario_id` int UNSIGNED NOT NULL,
  `finalidade` enum('verificar_email','recuperar_senha') NOT NULL,
  `codigo_hash` varchar(255) NOT NULL,
  `expira_em` datetime NOT NULL,
  `usado_em` datetime DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `generos`
--

CREATE TABLE `generos` (
  `id` int UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `generos`
--

INSERT INTO `generos` (`id`, `nome`, `ativo`) VALUES
(2, 'Fantasia', 1),
(3, 'Aventura', 1),
(4, 'Ação', 1),
(5, 'Comédia', 1),
(6, 'Drama', 1),
(7, 'Ficção científica', 1),
(8, 'Romance', 1),
(9, 'Terror', 1),
(10, 'Suspense', 1),
(11, 'Mistério', 1),
(12, 'Documentário', 1),
(13, 'Musical', 1),
(14, 'Histórico', 1),
(15, 'Policial', 1),
(16, 'Esporte', 1),
(17, 'Slice of Life', 1),
(18, 'Isekai', 1),
(19, 'Mecha', 1),
(20, 'Psicológico', 1),
(21, 'Sobrenatural', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `obras`
--

CREATE TABLE `obras` (
  `id` int UNSIGNED NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` text,
  `tipo` varchar(50) NOT NULL,
  `ano_lancamento` year DEFAULT NULL,
  `classificacao` varchar(20) DEFAULT NULL,
  `duracao` varchar(50) DEFAULT NULL,
  `estudio` varchar(150) DEFAULT NULL,
  `capa` varchar(500) NOT NULL,
  `em_alta` tinyint(1) NOT NULL DEFAULT '0',
  `lancamento` tinyint(1) NOT NULL DEFAULT '0',
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `obras`
--

INSERT INTO `obras` (`id`, `titulo`, `descricao`, `tipo`, `ano_lancamento`, `classificacao`, `duracao`, `estudio`, `capa`, `em_alta`, `lancamento`, `ativo`, `data_criacao`) VALUES
(1, 'F1 O filme', 'F1: O Filme é um drama de ação dirigido por Joseph Kosinski e estrelado por Brad Pitt que retrata o universo da Fórmula 1 com grande realismo.', 'Anime', '2025', '12', '2 horas e 36 minutos', 'Apple Studios', '/img/obras/obra_6aaf415b212769.84322066.png', 1, 1, 1, '2026-09-20 02:13:47'),
(3, 'As Crônicas de Nárnia: A Viagem do Peregrino da Alvorada', 'Lúcia e Edmundo Pevensie, junto com o chato primo Eustáquio, vão parar em Nárnia por meio de um quadro mágico. Eles embarcam no navio Peregrino da Alvorada com o Rei Caspian para achar sete fidalgos (lordes) desaparecidos e derrotar uma névoa mágica que ameaça Nárnia', 'Filme', '2010', '10', '1 hora e 53 minutos', '20th Century Fox', '/img/obras/obra_6aafce652a6911.11106112.png', 1, 1, 1, '2026-09-20 12:15:33'),
(5, '007 Sem Tempo para Morrerç~~´´--==**--/++!!@@##$$%%¨¨', 'Um dos melhores filmes da franquiaç~~´´--==**--/++!!@@##$$%%¨¨', 'Filme', '1948', '12', '1 hora e 49 minutosç~~´´--==**--/++!!@@##$$%%¨¨', 'Filme 007', '/img/obras/obra_6ab83bb2b15d23.65169079.png', 1, 1, 1, '2026-09-26 21:40:02');

-- --------------------------------------------------------

--
-- Estrutura para tabela `obra_genero`
--

CREATE TABLE `obra_genero` (
  `obra_id` int UNSIGNED NOT NULL,
  `genero_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `obra_genero`
--

INSERT INTO `obra_genero` (`obra_id`, `genero_id`) VALUES
(3, 2),
(3, 3),
(1, 4),
(5, 9),
(5, 10),
(1, 16),
(5, 20),
(5, 21);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int UNSIGNED NOT NULL,
  `nome` varchar(120) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('usuario','admin') NOT NULL DEFAULT 'usuario',
  `email_verificado` tinyint(1) NOT NULL DEFAULT '0',
  `foto` varchar(500) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`, `email_verificado`, `foto`, `bio`, `criado_em`) VALUES
(4, 'jasmini', 'jasminibecker2@gmail.com', '$2y$10$egJMVNMTGESzDz3pyRgg5eRTDEikS4rlHZ5sy2gXtyM7DEWbn1Jrq', 'admin', 0, NULL, NULL, '2026-09-26 21:24:57'),
(5, 'Jasmini Becker Rohr', 'jasbecker2@gmail.com', '$2y$10$7AG3wZnPjJxY6Pk/037QG.7u8D90Cabv8dNeWhQXl2UtRbp5dQMAq', 'usuario', 0, '/img/perfis/perfil_6ab83912e75364.93721726.jpg', NULL, '2026-09-26 21:28:17'),
(6, 'João Thiago da Silva de Borba', 'joao.thiago@adm.educadventista.org', '$2y$10$lQCBTG6Fdch/sDZi8ezJ7OqxiYthYwrV3igXtlbuKSMCUrjgbkbEy', 'usuario', 1, '/img/perfis/perfil_6ab83aa0e76609.49891284.jpg', 'Sou incrivel e', '2026-09-26 21:34:12');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `avisos`
--
ALTER TABLE `avisos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `codigos_email`
--
ALTER TABLE `codigos_email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_codigos_usuario` (`usuario_id`);

--
-- Índices de tabela `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `obras`
--
ALTER TABLE `obras`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `obra_genero`
--
ALTER TABLE `obra_genero`
  ADD PRIMARY KEY (`obra_id`,`genero_id`),
  ADD KEY `fk_obra_genero_genero` (`genero_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avisos`
--
ALTER TABLE `avisos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `codigos_email`
--
ALTER TABLE `codigos_email`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `obras`
--
ALTER TABLE `obras`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `codigos_email`
--
ALTER TABLE `codigos_email`
  ADD CONSTRAINT `fk_codigos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `obra_genero`
--
ALTER TABLE `obra_genero`
  ADD CONSTRAINT `fk_obra_genero_genero` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_obra_genero_obra` FOREIGN KEY (`obra_id`) REFERENCES `obras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
