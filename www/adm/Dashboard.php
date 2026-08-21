<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Apollo</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="../css/styles.css">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<header>

    <?php include '../menu.php'; ?>

</header>

<main class="container py-4">

    <h1 class="text-center mb-5">

        Dashboard

    </h1>

    <div class="row">

        <!-- Informações do site -->

        <div class="col-lg-8">

            <h3 class="text-center mb-4">

                Informações do site

            </h3>

            <div class="row g-4">

                <div class="col-md-6">

                    <div class="admin-info-card">

                        Número de usuários

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="admin-info-card">

                        Número de obras

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="admin-info-card">

                        Número de comentários

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="admin-info-card">

                        Número de avaliações

                    </div>

                </div>

            </div>

        </div>

        <!-- Ações rápidas -->

        <div class="col-lg-4">

            <h3 class="text-center mb-4">

                Ações rápidas

            </h3>

            <div class="admin-acoes">

                <a href="GerenciarObras.php" class="admin-acao">

                    Gerenciar obras

                </a>

                <a href="GerenciarUsuarios.php" class="admin-acao">

                    Gerenciar usuários

                </a>

                <a href="GerenciarComentarios.php" class="admin-acao">

                    Moderar comentários

                </a>

                <a href="GerenciarAvisos.php" class="admin-acao">

                    Gerenciar avisos

                </a>

            </div>

        </div>

    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>