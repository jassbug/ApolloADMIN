<?php

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/autenticacao.php';

// Verificar se o usuário está logado.
exigirLogin();

// Buscar o ID da lista pela URL.
$idLista = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$idLista || $idLista <= 0) {
    header('Location: MinhasListas.php');
    exit;
}

// Buscar a lista e suas obras.
$resultado = buscarListaComObras($idLista, idUsuarioLogado());

// Verificar se a lista existe e pertence ao usuário.
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

    <title><?= e($lista['nome']) ?> - Apollo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/styles.css">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<header>

    <?php include '../menu.php'; ?>

</header>

<main class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-5">

        <h1>
            <?= e($lista['nome']) ?>
        </h1>

        <a href="MinhasListas.php" class="btn btn-primary">

            <i class="bi bi-arrow-left me-2"></i>

            Voltar

        </a>

    </div>

    <div class="row g-4">

        <?php if (empty($obras)): ?>

            <div class="col-12">

                <p>Esta lista ainda não possui obras.</p>

            </div>

        <?php else: ?>

            <?php foreach ($obras as $obra): ?>

                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">

                    <a href="../Obras.php?id=<?= (int) $obra['id'] ?>"
                        class="obra-lista">

                        <img
                            src="<?= e($obra['capa']) ?>"
                            alt="<?= e($obra['titulo']) ?>">

                    </a>

                </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
