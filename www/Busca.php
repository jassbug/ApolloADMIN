<?php

require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/autenticacao.php';

// RECEBER O TERMO PESQUISADO
$busca = trim($_GET['busca'] ?? '');

// BUSCAR AS OBRAS
$obras = [];

if ($busca !== '') {
    $obras = buscarObrasCatalogo([
        'busca' => $busca
    ]);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pesquisa | Apollo</title>

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
                    <i class="bi bi-search"></i>
                    Universo Apollo
                </span>

                <h1 class="catalogo-titulo">
                    Pesquisa
                </h1>

                <p class="catalogo-descricao">

                    <?php if ($busca !== ''): ?>

                        Resultados encontrados para
                        "<?= e($busca) ?>".

                    <?php else: ?>

                        Pesquise filmes, séries e animes disponíveis no Apollo.

                    <?php endif; ?>

                </p>

            </header>

            <!-- RESULTADOS -->

            <?php if ($busca !== ''): ?>

                <section aria-labelledby="tituloResultados">

                    <div class="catalogo-resultados">

                        <div>

                            <h2 id="tituloResultados">
                                Resultados da pesquisa
                            </h2>

                            <p class="catalogo-subtitulo">
                                Obras encontradas no catálogo.
                            </p>

                        </div>

                        <span class="catalogo-contagem">

                            <?= count($obras) ?>

                            <?= count($obras) === 1
                                ? 'obra encontrada'
                                : 'obras encontradas' ?>

                        </span>

                    </div>

                    <?php if (!empty($obras)): ?>

                        <div class="catalogo-grade">

                            <?php foreach ($obras as $obra): ?>

                                <a
                                    href="/Obras.php?id=<?= (int) $obra['id'] ?>"
                                    class="catalogo-card"
                                    style="text-decoration: none;">

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

                                                <span>
                                                    Capa indisponível
                                                </span>

                                            </div>

                                        <?php endif; ?>

                                    </div>

                                    <!-- TÍTULO -->

                                    <div class="catalogo-card-info">

                                        <h3 class="catalogo-card-titulo">
                                            <?= e($obra['titulo']) ?>
                                        </h3>

                                    </div>

                                </a>

                            <?php endforeach; ?>

                        </div>

                    <?php else: ?>

                        <div class="catalogo-vazio">

                            <i class="bi bi-search"></i>

                            <h3>Nenhuma obra encontrada</h3>

                            <p>
                                Não encontramos obras com esse título.
                                Experimente pesquisar outro nome.
                            </p>

                            <a
                                href="/index.php"
                                class="catalogo-botao-voltar">

                                <i class="bi bi-arrow-left"></i>

                                Voltar ao início

                            </a>

                        </div>

                    <?php endif; ?>

                </section>

            <?php else: ?>

                <div class="catalogo-vazio">

                    <i class="bi bi-search"></i>

                    <h3>Digite algo para pesquisar</h3>

                    <p>
                        Utilize a barra de pesquisa para encontrar
                        filmes, séries e animes.
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
