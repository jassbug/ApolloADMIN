-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Tempo de geração: 22/10/2026 às 19:19
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.3.36

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
-- Estrutura para tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `id` int UNSIGNED NOT NULL,
  `obra_id` int UNSIGNED NOT NULL,
  `usuario_id` int UNSIGNED NOT NULL,
  `nota` tinyint UNSIGNED NOT NULL,
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `data_atualizacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `avisos`
--

CREATE TABLE `avisos` (
  `id` int NOT NULL,
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
(1, 'Percy Jackson e o mar de monstros', 'Na série Percy Jackson e os Olimpianos, do Disney+, Percy e seus amigos embarcam em uma perigosa aventura pelo Mar de Monstros para encontrar o lendário Velocino de Ouro e salvar o Acampamento Meio-Sangue. Durante a jornada, eles enfrentam criaturas mitológicas, desafios inesperados e inimigos poderosos, enquanto Percy descobre mais sobre suas origens e o destino que o aguarda.', '/img/avisos/aviso_6ad63b1da4a7d6.96099440.jpg', NULL, 1, '2026-10-19 15:45:33');

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
(1, 'F1 O filme', 'F1: O Filme é um drama de ação dirigido por Joseph Kosinski e estrelado por Brad Pitt que retrata o universo da Fórmula 1 com grande realismo.', 'Filme', '2025', '12', '2 horas e 36 minutos', 'Apple Studios', '/img/obras/obra_6aaf415b212769.84322066.png', 1, 1, 1, '2026-09-20 02:13:47'),
(3, 'As Crônicas de Nárnia: A Viagem do Peregrino da Alvorada', 'Lúcia e Edmundo Pevensie, junto com o chato primo Eustáquio, vão parar em Nárnia por meio de um quadro mágico. Eles embarcam no navio Peregrino da Alvorada com o Rei Caspian para achar sete fidalgos (lordes) desaparecidos e derrotar uma névoa mágica que ameaça Nárnia', 'Filme', '2010', '10', '1 hora e 53 minutos', '20th Century Fox', '/img/obras/obra_6aafce652a6911.11106112.png', 1, 1, 1, '2026-09-20 12:15:33'),
(5, 'Percy Jackson e os Olimpianos', 'Percy Jackson e seus amigos retornam ao Acampamento Meio-Sangue e descobrem que ele está ameaçado após a árvore de Thalia, responsável por proteger o local, ser envenenada. Para salvar o acampamento, Percy precisa encontrar o lendário Velocino de Ouro, capaz de restaurar sua proteção. Ao lado de Annabeth, Grover e seu meio-irmão Tyson, ele embarca em uma perigosa jornada pelo Mar de Monstros, enfrentando criaturas mitológicas, desafios inesperados e inimigos poderosos. Durante a aventura, Percy também precisa descobrir mais sobre seu destino e provar sua coragem para impedir que uma grande ameaça destrua tudo aquilo que ele deseja proteger.', 'Série', '2025', '12', '2 Temporadas', 'Disney', '/img/obras/obra_6ad640b48e9402.08683144.jpg', 1, 1, 1, '2026-09-26 21:40:02'),
(6, 'My Hero Academia', 'Em um mundo onde a maioria das pessoas possui superpoderes chamados Individualidades, Izuku Midoriya, conhecido como Deku, luta para se tornar o maior herói. Na temporada final, a batalha decisiva entre heróis e vilões atinge seu clímax, enquanto Deku enfrenta Shigaraki em um confronto que determinará o futuro da humanidade. Ao lado de seus aliados, ele precisa superar seus limites, proteger aqueles que ama e lutar para construir um mundo onde todos possam viver em segurança.', 'Anime', '2014', '14', '7 Temporadas', 'Studio Bones', '/img/obras/obra_6ad647de594703.16486143.jpg', 1, 0, 1, '2026-10-19 16:39:58'),
(7, 'Witch Hat Atelier', 'Coco é uma garota fascinada por magia que sonha em se tornar uma bruxa. Após descobrir um segredo sobre como a magia realmente funciona, ela acaba entrando em um mundo cheio de encantamentos, mistérios e descobertas. Ao lado de outros aprendizes, Coco inicia uma jornada para dominar a magia e desvendar os segredos que cercam esse universo.', 'Anime', '2026', '12', '1 Temporada', 'BUG FILMS', '/img/obras/obra_6ad6486ea6da57.73412366.jpg', 1, 0, 1, '2026-10-19 16:42:22'),
(8, 'Dandadan', 'Momo Ayase e Ken Takakura, conhecido como Okarun, se envolvem em aventuras sobrenaturais após discordarem sobre a existência de fantasmas e alienígenas. Ao descobrirem que ambos existem, os dois enfrentam criaturas bizarras, fenômenos paranormais e situações perigosas, desenvolvendo uma amizade marcada por ação, humor e mistérios.', 'Anime', '2024', '14', '2 Temporadas', 'Science SARU', '/img/obras/obra_6ad648bc85a260.47872897.jpg', 0, 0, 1, '2026-10-19 16:43:40'),
(9, 'The Mentalist (O Mentalista)', 'Patrick Jane é um consultor independente que trabalha com a equipe de investigação criminal da CBI, na Califórnia. Com uma capacidade extraordinária de observação, dedução e leitura do comportamento humano, ele ajuda a solucionar assassinatos e crimes complexos. No entanto, sua principal motivação é encontrar Red John, o serial killer responsável pela morte de sua esposa e filha. Ao longo da série, Patrick utiliza sua inteligência e suas habilidades psicológicas para desvendar mistérios enquanto busca vingança.', 'Série', '2008', '14', '7 Temporadas', 'Warner Bros. Television', '/img/obras/obra_6ad649920cab72.06312312.jpg', 1, 0, 1, '2026-10-19 16:47:14'),
(10, 'F1: Dirigir para Viver (Formula 1: Drive to Survive)', 'A série documental acompanha os bastidores da Fórmula 1, revelando os desafios, as rivalidades e as estratégias dos pilotos, das equipes e dos chefes de equipe ao longo das temporadas. Com acesso exclusivo aos bastidores, mostra a pressão das competições, as disputas por vitórias, as decisões estratégicas e os acontecimentos que marcam o campeonato mundial de automobilismo.', 'Série', '2019', '12', '8 Temporadas', 'Box to Box Films', '/img/obras/obra_6ad64a0b1ad2e3.35077133.jpg', 1, 0, 1, '2026-10-19 16:49:15');

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
(5, 4),
(5, 3),
(5, 2),
(6, 4),
(6, 3),
(6, 2),
(6, 7),
(7, 4),
(7, 6),
(7, 2),
(7, 21),
(8, 4),
(8, 3),
(8, 5),
(8, 7),
(8, 8),
(8, 21),
(9, 4),
(9, 3),
(9, 5),
(9, 7),
(9, 15),
(9, 10),
(10, 12),
(10, 6),
(10, 16),
(1, 4),
(1, 16);

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
-- Índices de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `avaliacao_unica` (`obra_id`,`usuario_id`),
  ADD KEY `fk_avaliacao_usuario` (`usuario_id`);

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
-- Índices de tabela `obras`
--
ALTER TABLE `obras`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `avisos`
--
ALTER TABLE `avisos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `obras`
--
ALTER TABLE `obras`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD CONSTRAINT `fk_avaliacao_obra` FOREIGN KEY (`obra_id`) REFERENCES `obras` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_avaliacao_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
