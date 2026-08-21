<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Minhas Listas - Apollo</title>

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

    <h1 class="mb-4">

        Minhas listas

    </h1>

    <div class="listas-box">

        <a href="Lista.php" class="lista-opcao">

            Favoritos

        </a>

        <a href="Lista.php" class="lista-opcao">

            Assistindo

        </a>

        <a href="Lista.php" class="lista-opcao">

            Não gostei

        </a>

    </div>

    <button
        class="btn-criar-lista"
        data-bs-toggle="modal"
        data-bs-target="#modalLista">

        Criar Lista

    </button>

</main>

<!-- Modal Criar Lista -->

<div class="modal fade" id="modalLista" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content bg-dark text-white border border-primary">

            <div class="modal-header">

                <h5 class="modal-title">

                    Criar Lista

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">

                </button>

            </div>

            <div class="modal-body">

                <label class="form-label">

                    Nome da Lista

                </label>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Digite o nome da lista">

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Cancelar

                </button>

                <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-dismiss="modal">

                    Criar

                </button>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>