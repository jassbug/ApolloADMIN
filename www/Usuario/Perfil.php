<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Perfil - Apollo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

 <header>

    <?php include '../menu.php'; ?>

</header>

    <div class="container-fluid py-3">

        <!-- Informações do usuário -->

        <div class="card mb-4">

            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-md-2 text-center">

                        <div class="foto-perfil">

                        </div>

                    </div>

                    <div class="col-md-8">

                        <h4>

                            Visão Geral do Perfil

                        </h4>

                        <p>

                            Nome do usuário

                        </p>

                        <p>

                            E-mail

                        </p>

                

                    </div>

                    <div class="col-md-2 text-end">

                        <a href="Editar.php" class="btn btn-primary">

                            Editar

                        </a>

                    </div>

                </div>

            </div>

        </div>

        <!-- Minhas listas -->

        <div class="row g-4 mb-4">

            <div class="col-lg-2 col-md-4 col-6">

                 <a href="Lista.php" class="text-decoration-none">
                <div class="card lista-card">

                    <div class="card-body text-center">

                        Lista 1

                    </div>

                </div>
                </a>

            </div>

            <div class="col-lg-2 col-md-4 col-6">

                 <a href="Lista.php" class="text-decoration-none">
                <div class="card lista-card">

                    <div class="card-body text-center">

                        Lista 2

                    </div>

                </div>
                </a>

            </div>

            <div class="col-lg-2 col-md-4 col-6">

                 <a href="Lista.php" class="text-decoration-none">
                <div class="card lista-card">

                    <div class="card-body text-center">

                        Lista 3

                    </div>

                </div>
                </a>

            </div>

            <div class="col-lg-2 col-md-4 col-6">

                 <a href="Lista.php" class="text-decoration-none">
                <div class="card lista-card">

                    <div class="card-body text-center">

                        Lista 4

                    </div>

                </div>
                </a>

            </div>

            <div class="col-lg-2 col-md-4 col-6">

                 <a href="Lista.php" class="text-decoration-none">
                <div class="card lista-card">

                    <div class="card-body text-center">

                        Lista 5

                    </div>

                </div>
                </a>

            </div>

            <div class="col-lg-2 d-flex align-items-center justify-content-center">

                <a href="Listas.php" class="btn btn-primary">

                    Ver mais

                </a>

            </div>

        </div>

        <!-- Área inferior -->

        <div class="card">

            <div class="card-body">

                <h5>

                    Conteúdo do usuário

                </h5>

                <p>

                    Esta área poderá exibir informações como histórico, favoritos, comentários ou outras funcionalidades do Apollo.

                </p>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>