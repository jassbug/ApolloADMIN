<?php

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/autenticacao.php';

exigirLogin();

// BUSCAR AS OBRAS FAVORITADAS PELO USUÁRIO
$favoritos = buscarFavoritosUsuario();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Meus favoritos | Apollo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>

    <?php include '../menu.php'; ?>

    <main class="container pagina-favoritos">

        <section class="cabecalho-favoritos">

            <p class="etiqueta-autenticacao">
                <i class="bi bi-heart-fill"></i>
                MINHA CONTA
            </p>

            <h1>Meus favoritos</h1>

            <p>
                Todas as obras que você escolheu guardar.
            </p>

        </section>

        <?php if (!empty($favoritos)): ?>

            <section class="row g-4">

                <?php foreach ($favoritos as $obra): ?>

                    <div class="col-6 col-md-4 col-lg-3">

                        <article class="card card-favorito h-100">

                            <a href="/Obras.php?id=<?= (int) $obra['id'] ?>">

                                <img
                                    src="<?= e($obra['capa']) ?>"
                                    class="card-img-top"
                                    alt="Capa de <?= e($obra['titulo']) ?>"
                                >

                            </a>

                            <div class="card-body">

                                <h2 class="card-title">
                                    <?= e($obra['titulo']) ?>
                                </h2>

                                <p class="card-text">
                                    <?= e($obra['tipo']) ?>
                                </p>

                                <a
                                    href="/Obras.php?id=<?= (int) $obra['id'] ?>"
                                    class="link-secao"
                                >
                                    Ver obra
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                            </div>

                        </article>

                    </div>

                <?php endforeach; ?>

            </section>

        <?php else: ?>

            <section class="favoritos-vazio">

                <i class="bi bi-heart"></i>

                <h2>Nenhum favorito ainda</h2>

                <p>
                    Você ainda não favoritou nenhuma obra.
                    Explore o Apollo e encontre suas favoritas!
                </p>

                <a href="/index.php" class="btn botao-roxo">
                    Explorar obras
                </a>

            </section>

        <?php endif; ?>

    </main>

    <footer>
        <div class="container">
            <p>© <?= date('Y') ?> Apollo — seu universo de histórias.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
