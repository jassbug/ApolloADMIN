-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Tempo de geração: 25/11/2026 às 00:19
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

--
-- Despejando dados para a tabela `avaliacoes`
--

INSERT INTO `avaliacoes` (`id`, `obra_id`, `usuario_id`, `nota`, `data_criacao`, `data_atualizacao`) VALUES
(1, 9, 4, 2, '2026-10-30 16:12:59', '2026-11-22 23:55:46'),
(17, 10, 4, 6, '2026-11-23 23:52:50', '2026-11-23 23:52:59');

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
(2, 'Percy Jackson e os Olimpianos', 'A terceira temporada está em lançamento, a  história acompanha Percy, Grover, Thalia e as Caçadoras em uma missão para resgatar Annabeth e a deusa Ártemis, impedindo os planos de Cronos e do titã Atlas.', '/img/avisos/aviso_6b0627de90c771.49630826.png', 'http://localhost:8080/Obras.php?id=5', 1, '2026-11-24 23:58:02'),
(3, 'Vingadores: Doutor Destino', 'Vingadores: Doutor Destino (Avengers: Doomsday) estreia nos cinemas do Brasil em 16 de dezembro de 2026 e reúne heróis de três universos contra a ameaça multiversal de Victor von Doom, interpretado por Robert Downey Jr.', '/img/avisos/aviso_6b062861738971.73769363.png', 'http://localhost:8080/Obras.php?id=11', 1, '2026-11-25 00:14:25');

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
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int UNSIGNED NOT NULL,
  `obra_id` int UNSIGNED NOT NULL,
  `usuario_id` int UNSIGNED NOT NULL,
  `comentario` text NOT NULL,
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `comentarios`
--

INSERT INTO `comentarios` (`id`, `obra_id`, `usuario_id`, `comentario`, `data_criacao`) VALUES
(15, 9, 4, 'hh', '2026-11-22 23:55:46'),
(16, 10, 4, 'jjj', '2026-11-23 23:52:59');

-- --------------------------------------------------------

--
-- Estrutura para tabela `curtidas_comentarios`
--

CREATE TABLE `curtidas_comentarios` (
  `id` int UNSIGNED NOT NULL,
  `comentario_id` int UNSIGNED NOT NULL,
  `usuario_id` int UNSIGNED NOT NULL,
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `curtidas_comentarios`
--

INSERT INTO `curtidas_comentarios` (`id`, `comentario_id`, `usuario_id`, `data_criacao`) VALUES
(13, 15, 4, '2026-11-22 23:55:48');

-- --------------------------------------------------------

--
-- Estrutura para tabela `denuncias_comentarios`
--

CREATE TABLE `denuncias_comentarios` (
  `id` int UNSIGNED NOT NULL,
  `comentario_id` int UNSIGNED NOT NULL,
  `usuario_id` int UNSIGNED NOT NULL,
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `analisada` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `denuncias_comentarios`
--

INSERT INTO `denuncias_comentarios` (`id`, `comentario_id`, `usuario_id`, `data_criacao`, `analisada`) VALUES
(6, 15, 4, '2026-11-22 23:55:51', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int UNSIGNED NOT NULL,
  `usuario_id` int UNSIGNED NOT NULL,
  `obra_id` int UNSIGNED NOT NULL,
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `favoritos`
--

INSERT INTO `favoritos` (`id`, `usuario_id`, `obra_id`, `data_criacao`) VALUES
(2, 4, 10, '2026-11-23 23:52:25'),
(3, 4, 9, '2026-11-23 23:53:04'),
(4, 4, 7, '2026-11-24 00:10:35');

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
(16, 'Esporte', 1),
(17, 'Slice of Life', 1),
(18, 'Isekai', 1),
(19, 'Mecha', 1),
(20, 'Psicológico', 1),
(21, 'Sobrenatural', 1),
(23, 'Ação', 1),
(25, 'Policial', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_lista`
--

CREATE TABLE `itens_lista` (
  `id` int UNSIGNED NOT NULL,
  `lista_id` int UNSIGNED NOT NULL,
  `obra_id` int UNSIGNED NOT NULL,
  `data_adicao` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `itens_lista`
--

INSERT INTO `itens_lista` (`id`, `lista_id`, `obra_id`, `data_adicao`) VALUES
(9, 10, 10, '2026-11-23 23:40:02'),
(14, 11, 9, '2026-11-23 23:41:31'),
(15, 10, 9, '2026-11-23 23:41:31'),
(16, 9, 7, '2026-11-24 00:10:40');

-- --------------------------------------------------------

--
-- Estrutura para tabela `listas_usuario`
--

CREATE TABLE `listas_usuario` (
  `id` int UNSIGNED NOT NULL,
  `usuario_id` int UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `listas_usuario`
--

INSERT INTO `listas_usuario` (`id`, `usuario_id`, `nome`, `data_criacao`) VALUES
(1, 8, 'Favoritos', '2026-11-22 20:14:53'),
(2, 8, 'Assistindo', '2026-11-22 20:14:53'),
(4, 8, 'Concluídos', '2026-11-22 20:14:53'),
(9, 4, 'jasmini', '2026-11-23 23:26:51'),
(10, 4, 'teste', '2026-11-23 23:33:38'),
(11, 4, 'series', '2026-11-23 23:33:44'),
(12, 9, 'Favoritos', '2026-11-24 23:55:18'),
(13, 9, 'Assistindo', '2026-11-24 23:55:18'),
(14, 9, 'Quero assistir', '2026-11-24 23:55:18'),
(15, 9, 'Concluídos', '2026-11-24 23:55:18');

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
(10, 'F1: Dirigir para Viver (Formula 1: Drive to Survive)', 'A série documental acompanha os bastidores da Fórmula 1, revelando os desafios, as rivalidades e as estratégias dos pilotos, das equipes e dos chefes de equipe ao longo das temporadas. Com acesso exclusivo aos bastidores, mostra a pressão das competições, as disputas por vitórias, as decisões estratégicas e os acontecimentos que marcam o campeonato mundial de automobilismo.', 'Série', '2019', '12', '8 Temporadas', 'Box to Box Films', '/img/obras/obra_6ad64a0b1ad2e3.35077133.jpg', 1, 0, 1, '2026-10-19 16:49:15'),
(11, 'Vingadores: Doutor Destino', 'O filme coloca heróis de três realidades em rota de colisão enquanto a Saga do Multiverso caminha para seu desfecho, com as Incursões ameaçando destruir universos inteiros.', 'Filme', '2026', '14', '2h29min', 'Marvel Studios', '/img/obras/obra_6b06290d8b6d95.13488374.png', 1, 0, 1, '2026-11-25 00:17:17');

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
(10, 12),
(10, 6),
(10, 16),
(1, 4),
(1, 16),
(9, 3),
(9, 5),
(9, 7),
(9, 25),
(9, 10),
(11, 23),
(11, 3),
(11, 6),
(11, 2),
(11, 11);

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
(4, 'jasmini', 'jasminibecker2@gmail.com', '$2y$10$egJMVNMTGESzDz3pyRgg5eRTDEikS4rlHZ5sy2gXtyM7DEWbn1Jrq', 'admin', 0, '/img/perfis/perfil_6b04d69555cb24.35021892.png', 'Um pouco de tudo', '2026-09-26 21:24:57'),
(8, 'nicoli', 'nicoli1@gmail.com', '$2y$10$R2NOwKw3y4gkewMTcuGzXegzCm8OrD66IPzElJlH0QVmYDE6BARU6', 'usuario', 1, NULL, NULL, '2026-11-22 20:14:53'),
(9, 'Larissa', 'larissa@gmail.com', '$2y$10$iVIMFlQKwI/0nD/CM26FhehxHLWqNFbJbRzUgfdfztqLOF6QiZKtm', 'usuario', 0, NULL, NULL, '2026-11-24 23:55:18');

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
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `comentario_unico` (`obra_id`,`usuario_id`),
  ADD KEY `obra_id` (`obra_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `curtidas_comentarios`
--
ALTER TABLE `curtidas_comentarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `curtida_unica` (`comentario_id`,`usuario_id`),
  ADD KEY `fk_curtida_usuario` (`usuario_id`);

--
-- Índices de tabela `denuncias_comentarios`
--
ALTER TABLE `denuncias_comentarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `denuncia_unica` (`comentario_id`,`usuario_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `favorito_unico` (`usuario_id`,`obra_id`),
  ADD KEY `fk_favorito_obra` (`obra_id`);

--
-- Índices de tabela `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `itens_lista`
--
ALTER TABLE `itens_lista`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_unico` (`lista_id`,`obra_id`),
  ADD KEY `idx_itens_obra` (`obra_id`);

--
-- Índices de tabela `listas_usuario`
--
ALTER TABLE `listas_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_listas_usuario` (`usuario_id`);

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `avisos`
--
ALTER TABLE `avisos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `curtidas_comentarios`
--
ALTER TABLE `curtidas_comentarios`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `denuncias_comentarios`
--
ALTER TABLE `denuncias_comentarios`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `itens_lista`
--
ALTER TABLE `itens_lista`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `listas_usuario`
--
ALTER TABLE `listas_usuario`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `obras`
--
ALTER TABLE `obras`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD CONSTRAINT `fk_avaliacao_obra` FOREIGN KEY (`obra_id`) REFERENCES `obras` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_avaliacao_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_comentario_obra` FOREIGN KEY (`obra_id`) REFERENCES `obras` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comentario_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `curtidas_comentarios`
--
ALTER TABLE `curtidas_comentarios`
  ADD CONSTRAINT `fk_curtida_comentario` FOREIGN KEY (`comentario_id`) REFERENCES `comentarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_curtida_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `denuncias_comentarios`
--
ALTER TABLE `denuncias_comentarios`
  ADD CONSTRAINT `denuncias_comentarios_ibfk_1` FOREIGN KEY (`comentario_id`) REFERENCES `comentarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `denuncias_comentarios_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `fk_favorito_obra` FOREIGN KEY (`obra_id`) REFERENCES `obras` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_favorito_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `itens_lista`
--
ALTER TABLE `itens_lista`
  ADD CONSTRAINT `fk_itens_lista` FOREIGN KEY (`lista_id`) REFERENCES `listas_usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_itens_obra` FOREIGN KEY (`obra_id`) REFERENCES `obras` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `listas_usuario`
--
ALTER TABLE `listas_usuario`
  ADD CONSTRAINT `fk_listas_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
