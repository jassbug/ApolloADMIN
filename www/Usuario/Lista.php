<?php

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/autenticacao.php';

// VERIFICAR SE O USUÁRIO ESTÁ LOGADO
exigirLogin();

// BUSCAR O ID DA LISTA PELA URL
$idLista = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$idLista || $idLista <= 0) {
    header('Location: MinhasListas.php');
    exit;
}

// BUSCAR A LISTA E SUAS OBRAS
$resultado = buscarListaComObras($idLista, idUsuarioLogado());

// VERIFICAR SE A LISTA EXISTE E PERTENCE AO USUÁRIO
if (!$resultado) {
    header('Location: MinhasListas.php');
    exit;
}

$lista = $resultado['lista'];
$obras = $resultado['obras'];

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= e($lista['nome']) ?> | Apollo</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../css/styles.css">

</head>

<body>

    <?php include '../menu.php'; ?>

    <main class="container pagina-lista">

        <!-- CABEÇALHO DA LISTA -->

        <header class="cabecalho-lista">

            <div>

                <span class="etiqueta-lista">
                    <i class="bi bi-bookmark-heart"></i>
                    MINHA COLEÇÃO
                </span>

                <h1>
                    <?= e($lista['nome']) ?>
                </h1>

                <p>
                    <?= count($obras) ?>
                    <?= count($obras) === 1 ? 'obra salva' : 'obras salvas' ?>
                </p>

            </div>

            <a href="MinhasListas.php" class="botao-voltar-lista">

                <i class="bi bi-arrow-left"></i>

                Voltar

            </a>

        </header>

        <!-- OBRAS DA LISTA -->

        <?php if (!empty($obras)): ?>

            <section class="grade-lista">

                <?php foreach ($obras as $obra): ?>

                    <a
                        href="../Obras.php?id=<?= (int) $obra['id'] ?>"
                        class="card-lista-link"
                        aria-label="Ver obra: <?= e($obra['titulo']) ?>">

                        <article class="card-lista">

                            <div class="card-lista-capa">

                                <?php if (!empty($obra['capa'])): ?>

                                    <img
                                        src="<?= e($obra['capa']) ?>"
                                        alt="Capa de <?= e($obra['titulo']) ?>"
                                        loading="lazy">

                                <?php else: ?>

                                    <div class="lista-sem-capa">

                                        <i class="bi bi-image"></i>

                                        <span>Capa indisponível</span>

                                    </div>

                                <?php endif; ?>

                            </div>

                            <div class="card-lista-info">

                                <h2>
                                    <?= e($obra['titulo']) ?>
                                </h2>

                            </div>

                        </article>

                    </a>

                <?php endforeach; ?>

            </section>

        <?php else: ?>

            <section class="lista-vazia">

                <i class="bi bi-bookmark-heart"></i>

                <h2>Esta lista ainda está vazia</h2>

                <p>
                    Explore o Apollo e adicione obras à sua coleção.
                </p>

                <a href="/index.php" class="botao-explorar-lista">
                    Explorar obras
                </a>

            </section>

        <?php endif; ?>

    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>
