<?php

require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/autenticacao.php';

$avisos = buscarAvisos();

$avisos = buscarAvisos();
$emAlta = buscarObrasEmAlta();
$lancamentos = buscarLancamentos();
$generos = buscarGeneros();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Apollo | Descubra novas histórias</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <header>
        <?php include 'menu.php'; ?>
    </header>

    <main>

        <section class="hero-apollo">
            <div class="hero-luz"></div>

            <div class="container position-relative">
                <div class="row align-items-center min-vh-75">

                    <div class="col-lg-7">
                        <p class="hero-etiqueta">
                            <i class="bi bi-stars"></i> SEU UNIVERSO DE ENTRETENIMENTO
                        </p>

                        <h1>
                            Histórias que ficam
                            <span>na sua órbita.</span>
                        </h1>

                        <p class="hero-texto">
                            Descubra filmes, séries e animes. Organize suas listas,
                            favorite suas obras e compartilhe opiniões com a comunidade.
                        </p>

                        <a href="#em-alta" class="btn botao-roxo">
                            Explorar agora
                            <i class="bi bi-arrow-down"></i>
                        </a>
                    </div>

                    <div class="col-lg-5 d-none d-lg-flex justify-content-center">
                        <div class="planeta-apollo">
                            <i class="bi bi-play-fill"></i>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="container secao-home" id="avisos">

            <div class="titulo-secao">
                <div>
                    <p>FIQUE POR DENTRO</p>
                    <h2>Avisos</h2>
                </div>
                <i class="bi bi-megaphone-fill"></i>
            </div>

            <?php if (!empty($avisos)): ?>

                <div id="carouselAvisos" class="carousel slide carousel-fade carousel-apollo" data-bs-ride="carousel">

                    <div class="carousel-indicators">

                        <?php foreach ($avisos as $indice => $aviso): ?>
                            <button
                                type="button"
                                data-bs-target="#carouselAvisos"
                                data-bs-slide-to="<?= $indice ?>"
                                class="<?= $indice === 0 ? 'active' : '' ?>"
                                aria-label="Aviso <?= $indice + 1 ?>">
                            </button>
                        <?php endforeach; ?>

                    </div>

                    <div class="carousel-inner">

                        <?php foreach ($avisos as $indice => $aviso): ?>

                            <div class="carousel-item <?= $indice === 0 ? 'active' : '' ?>">

                                <img
                                    src="<?= e($aviso['imagem']) ?>"
                                    class="d-block w-100"
                                    alt="<?= e($aviso['titulo']) ?>">

                                <div class="carousel-caption">
                                    <span>DESTAQUE</span>
                                    <h2><?= e($aviso['titulo']) ?></h2>
                                    <p><?= e($aviso['descricao']) ?></p>

                                    <?php if (!empty($aviso['link'])): ?>
                                        <a href="<?= e($aviso['link']) ?>" class="btn botao-roxo">
                                            Ver detalhes
                                        </a>
                                    <?php endif; ?>
                                </div>

                            </div>

                        <?php endforeach; ?>

                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselAvisos" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#carouselAvisos" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>

                </div>

            <?php else: ?>
                <p class="mensagem-vazia">Nenhum aviso publicado ainda.</p>
            <?php endif; ?>

        </section>

        <section class="container secao-home" id="em-alta">

            <div class="titulo-secao">
                <div>
                    <p>ESCOLHAS DA COMUNIDADE</p>
                    <h2><i class="bi bi-fire"></i> Em alta</h2>
                </div>

                <a href="Obras.php" class="link-secao">
                    Ver todas <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="row g-4">

                <?php foreach ($emAlta as $obra): ?>

                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <article class="card obra-card h-100">

                            <img
                                src="<?= e($obra['capa']) ?>"
                                class="card-img-top"
                                alt="<?= e($obra['titulo']) ?>">

                            <div class="card-body">
                                <span class="tipo-obra"><?= e($obra['tipo']) ?></span>

                                <h3 class="card-title">
                                    <?= e($obra['titulo']) ?>
                                </h3>

                                <a href="Obras.php?id=<?= (int) $obra['id'] ?>" class="btn botao-card w-100">
                                    Ver detalhes
                                </a>
                            </div>

                        </article>
                    </div>

                <?php endforeach; ?>

            </div>

            <?php if (empty($emAlta)): ?>
                <p class="mensagem-vazia">Ainda não há obras em alta.</p>
            <?php endif; ?>

        </section>

        <section class="container secao-home">

            <div class="titulo-secao">
                <div>
                    <p>NOVIDADES PARA EXPLORAR</p>
                    <h2><i class="bi bi-rocket-takeoff"></i> Lançamentos</h2>
                </div>

                <a href="Obras.php" class="link-secao">
                    Ver todas <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="row g-4">

                <?php foreach ($lancamentos as $obra): ?>

                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <article class="card obra-card h-100">

                            <img
                                src="<?= e($obra['capa']) ?>"
                                class="card-img-top"
                                alt="<?= e($obra['titulo']) ?>">

                            <div class="card-body">
                                <span class="tipo-obra"><?= e($obra['tipo']) ?></span>

                                <h3 class="card-title">
                                    <?= e($obra['titulo']) ?>
                                </h3>

                                <a href="Obras.php?id=<?= (int) $obra['id'] ?>" class="btn botao-card w-100">
                                    Ver detalhes
                                </a>
                            </div>

                        </article>
                    </div>

                <?php endforeach; ?>

            </div>

            <?php if (empty($lancamentos)): ?>
                <p class="mensagem-vazia">Ainda não há lançamentos cadastrados.</p>
            <?php endif; ?>

        </section>

        <section class="container secao-home mb-5">

            <div class="titulo-secao">
                <div>
                    <p>ENCONTRE O SEU TIPO DE HISTÓRIA</p>
                    <h2><i class="bi bi-grid-fill"></i> Gêneros</h2>
                </div>
            </div>

            <div class="generos-lista">

                <?php foreach ($generos as $genero): ?>
                    <a href="Generos.php?id=<?= (int) $genero['id'] ?>" class="genero-btn">
                        
                        <?= e($genero['nome']) ?>
                    </a>
                <?php endforeach; ?>

            </div>

            <?php if (empty($generos)): ?>
                <p class="mensagem-vazia">Nenhum gênero cadastrado ainda.</p>
            <?php endif; ?>

        </section>

    </main>

    <footer>
        <div class="container">
            <p>© <?= date('Y') ?> Apollo — seu universo de histórias.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

</body>
</html>