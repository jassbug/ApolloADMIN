<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/autenticacao.php';

$generos = buscarGeneros();

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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gêneros | Apollo</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/catalogo.css">
</head>

<body>

    <?php include __DIR__ . '/menu.php'; ?>

    <main class="generos-pagina">
        <div class="generos-container">

            <header class="generos-cabecalho">

                <span class="generos-etiqueta">
                    <i class="bi bi-collection"></i>
                    EXPLORE O APOLLO
                </span>

                <h1 class="generos-titulo">
                    Explore por gênero
                </h1>

                <p class="generos-descricao">
                    Descubra filmes, séries e animes de acordo com seus gêneros favoritos.
                    Escolha uma categoria para encontrar novas obras.
                </p>

            </header>

            <div class="generos-contagem">
                <i class="bi bi-grid"></i>

                <?= count($generos) ?>

                <?= count($generos) === 1 ? 'gênero disponível' : 'gêneros disponíveis' ?>
            </div>

            <?php if (!empty($generos)): ?>

                <div class="generos-grade">

                    <?php foreach ($generos as $genero): ?>

                        <?php
                        $nomeGenero = trim($genero['nome']);
                        $nomeGeneroMinusculo = mb_strtolower($nomeGenero);

                        $icone = $iconesGeneros[$nomeGeneroMinusculo] ?? 'bi-collection-play';
                        ?>

                        <a
                            href="/GeneroID.php?genero=<?= (int) $genero['id'] ?>"
                            class="generos-card"
                        >

                            <div class="generos-card-icone">
                                <i class="bi <?= e($icone) ?>"></i>
                            </div>

                            <div class="generos-card-conteudo">

                                <h2 class="generos-card-nome">
                                    <?= e($nomeGenero) ?>

                                    <i class="bi bi-arrow-up-right generos-card-seta"></i>
                                </h2>

                            </div>

                        </a>

                    <?php endforeach; ?>

                </div>

            <?php else: ?>

                <div class="generos-vazio">

                    <i class="bi bi-collection"></i>

                    <h2>Nenhum gênero disponível</h2>

                    <p>
                        Ainda não existem gêneros cadastrados no catálogo.
                    </p>

                </div>

            <?php endif; ?>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>