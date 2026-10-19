<?php

require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/autenticacao.php';

// BUSCAR GÊNEROS CADASTRADOS NO BANCO
$generos = buscarGeneros();

// ÍCONES PARA OS GÊNEROS
$iconesGeneros = [
    'ação' => 'bi-lightning-charge',
    'aventura' => 'bi-compass',
    'animação' => 'bi-palette',
    'anime' => 'bi-stars',
    'comédia' => 'bi-emoji-laughing',
    'documentário' => 'bi-camera-reels',
    'drama' => 'bi-mask',
    'esporte' => 'bi-trophy',
    'fantasia' => 'bi-magic',
    'ficção científica' => 'bi-rocket-takeoff',
    'histórico' => 'bi-hourglass-split',
    'isekai' => 'bi-door-open',
    'mecha' => 'bi-robot',
    'mistério' => 'bi-search',
    'musical' => 'bi-music-note-beamed',
    'policial' => 'bi-shield',
    'psicológico' => 'bi-brain',
    'romance' => 'bi-heart',
    'slice of life' => 'bi-house-heart',
    'sobrenatural' => 'bi-moon-stars',
    'suspense' => 'bi-eye',
    'terror' => 'bi-emoji-dizzy'
];

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gêneros | Apollo</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/catalogo.css">

</head>

<body>

    <?php include __DIR__ . '/menu.php'; ?>

    <main class="generos-pagina">

        <div class="generos-container">

            <!-- CABEÇALHO -->

            <header class="generos-cabecalho">

                <span class="generos-etiqueta">
                    <i class="bi bi-grid"></i>
                    Explore o Apollo
                </span>

                <h1 class="generos-titulo">
                    Gêneros
                </h1>

                <p class="generos-descricao">
                    Do romance à ação, da fantasia ao suspense:
                    encontre histórias que combinam com você.
                </p>

            </header>

            <!-- CONTAGEM DE GÊNEROS -->

            <div class="generos-contagem">

                <?= count($generos) ?>

                <?= count($generos) === 1
                    ? 'gênero disponível'
                    : 'gêneros disponíveis' ?>

            </div>

            <!-- LISTA DE GÊNEROS -->

            <?php if (!empty($generos)): ?>

                <section
                    class="generos-grade"
                    aria-label="Lista de gêneros">

                    <?php foreach ($generos as $genero): ?>

                        <?php
                        $nomeGenero = trim($genero['nome']);

                        $chaveGenero = mb_strtolower(
                            $nomeGenero,
                            'UTF-8'
                        );

                        $icone = $iconesGeneros[$chaveGenero]
                            ?? 'bi-collection-play';
                        ?>

                        <a
                            href="/catalogo.php?genero=<?= (int) $genero['id'] ?>"
                            class="generos-card">

                            <div>

                                <div class="generos-card-icone">
                                    <i class="bi <?= e($icone) ?>"></i>
                                </div>

                                <h2 class="generos-card-nome">

                                    <?= e($nomeGenero) ?>

                                    <i class="bi bi-arrow-up-right generos-card-seta"></i>

                                </h2>

                            </div>

                        </a>

                    <?php endforeach; ?>

                </section>

            <?php else: ?>

                <!-- NENHUM GÊNERO CADASTRADO -->

                <div class="generos-vazio">

                    <i class="bi bi-grid"></i>

                    <h2 class="h4 mt-3">
                        Nenhum gênero cadastrado
                    </h2>

                    <p class="mt-2">
                        Os gêneros disponíveis aparecerão aqui
                        quando forem cadastrados.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>