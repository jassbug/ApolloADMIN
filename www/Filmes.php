<?php

require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/autenticacao.php';

// RECEBER O GÊNERO SELECIONADO
$genero = $_GET['genero'] ?? '';

if (
    $genero !== '' &&
    (!ctype_digit((string) $genero) || (int) $genero <= 0)
) {
    $genero = '';
}

// RECEBER O TEXTO DA BUSCA
$busca = trim($_GET['busca'] ?? '');

// BUSCAR GÊNEROS
$generos = buscarGeneros();

// BUSCAR OBRAS DO CATÁLOGO
$obras = buscarObrasCatalogo([
    'genero' => $genero,
    'busca' => $busca
]);

// MANTER SOMENTE FILMES
$obras = array_values(array_filter($obras, function ($obra) {
    return mb_strtolower(trim($obra['tipo'])) === 'filme';
}));

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Filmes | Apollo</title>

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

    <main class="catalogo-pagina">

        <div class="catalogo-container">

            <!-- CABEÇALHO -->

            <header class="catalogo-cabecalho">

                <span class="catalogo-etiqueta">
                    <i class="bi bi-film"></i>
                    Universo Apollo
                </span>

                <h1 class="catalogo-titulo">
                    Filmes
                </h1>

                <p class="catalogo-descricao">
                    Explore filmes de diferentes gêneros e descubra
                    sua próxima história favorita.
                </p>

            </header>

            <!-- FILTRO POR GÊNERO -->

            <nav
                class="catalogo-generos-barra"
                aria-label="Filtrar filmes por gênero">

                <a
                    href="/filmes.php<?= $busca !== '' ? '?busca=' . urlencode($busca) : '' ?>"
                    class="catalogo-genero-botao <?= $genero === '' ? 'ativo' : '' ?>">

                    Todos

                </a>

                <?php foreach ($generos as $itemGenero): ?>

                    <a
                        href="/filmes.php?genero=<?= (int) $itemGenero['id'] ?><?= $busca !== '' ? '&busca=' . urlencode($busca) : '' ?>"
                        class="catalogo-genero-botao <?= $genero !== '' && (int) $genero === (int) $itemGenero['id'] ? 'ativo' : '' ?>">

                        <?= e($itemGenero['nome']) ?>

                    </a>

                <?php endforeach; ?>

            </nav>

            <!-- RESULTADOS -->

            <section aria-labelledby="tituloResultados">

                <div class="catalogo-resultados">

                    <div>

                        <h2 id="tituloResultados">

                            <?php if ($busca !== ''): ?>

                                Resultados para "<?= e($busca) ?>"

                            <?php elseif ($genero !== ''): ?>

                                <?php
                                $nomeGeneroSelecionado = 'Filmes por gênero';

                                foreach ($generos as $itemGenero) {
                                    if ((int) $itemGenero['id'] === (int) $genero) {
                                        $nomeGeneroSelecionado = $itemGenero['nome'];
                                        break;
                                    }
                                }
                                ?>

                                <?= e($nomeGeneroSelecionado) ?>

                            <?php else: ?>

                                Todos os filmes

                            <?php endif; ?>

                        </h2>

                        <p class="catalogo-subtitulo">
                            Confira os filmes disponíveis no Apollo.
                        </p>

                    </div>

                    <span class="catalogo-contagem">

                        <?= count($obras) ?>

                        <?= count($obras) === 1 ? 'filme encontrado' : 'filmes encontrados' ?>

                    </span>

                </div>

                <?php if (!empty($obras)): ?>

                    <div class="catalogo-grade">

                        <?php foreach ($obras as $obra): ?>

                            <article class="catalogo-card">

                                <!-- CAPA -->

                                <div class="catalogo-card-capa">

                                    <?php if (!empty($obra['capa'])): ?>

                                        <img
                                            src="<?= e($obra['capa']) ?>"
                                            alt="Capa de <?= e($obra['titulo']) ?>"
                                            loading="lazy">

                                    <?php else: ?>

                                        <div class="catalogo-sem-capa">

                                            <i class="bi bi-film"></i>

                                            <span>Capa indisponível</span>

                                        </div>

                                    <?php endif; ?>

                                    <?php if (!empty($obra['em_alta'])): ?>

                                        <span class="catalogo-selo">

                                            <i class="bi bi-fire"></i>

                                            Em alta

                                        </span>

                                    <?php endif; ?>

                                </div>

                                <!-- INFORMAÇÕES -->

                                <div class="catalogo-card-info">

                                    <div class="catalogo-card-tipo">
                                        <?= e($obra['tipo']) ?>
                                    </div>

                                    <h3 class="catalogo-card-titulo">
                                        <?= e($obra['titulo']) ?>
                                    </h3>

                                    <div class="catalogo-card-detalhes">

                                        <?php if (!empty($obra['ano_lancamento'])): ?>

                                            <span>

                                                <i class="bi bi-calendar3"></i>

                                                <?= (int) $obra['ano_lancamento'] ?>

                                            </span>

                                        <?php endif; ?>

                                        <?php if (!empty($obra['classificacao'])): ?>

                                            <span class="catalogo-classificacao">

                                                <?= e($obra['classificacao']) ?>

                                            </span>

                                        <?php endif; ?>

                                    </div>

                                    <?php if (!empty($obra['generos'])): ?>

                                        <div class="catalogo-card-generos">

                                            <?php foreach ($obra['generos'] as $itemGenero): ?>

                                                <span class="catalogo-genero-tag">
                                                    <?= e($itemGenero['nome']) ?>
                                                </span>

                                            <?php endforeach; ?>

                                        </div>

                                    <?php endif; ?>

                                </div>

                            </article>

                        <?php endforeach; ?>

                    </div>

                <?php else: ?>

                    <div class="catalogo-vazio">

                        <i class="bi bi-film"></i>

                        <h3>Nenhum filme encontrado</h3>

                        <p>
                            Não encontramos filmes com os filtros selecionados.
                            Experimente pesquisar outro título ou escolher
                            um gênero diferente.
                        </p>

                        <a
                            href="/filmes.php"
                            class="catalogo-botao-voltar">

                            <i class="bi bi-arrow-left"></i>

                            Ver todos os filmes

                        </a>

                    </div>

                <?php endif; ?>

            </section>

        </div>

    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>