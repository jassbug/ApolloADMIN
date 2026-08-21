<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Perfil - Apollo</title>

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

    <div class="card p-5">

        <div class="row">

            <!-- Foto -->

            <div class="col-lg-3 text-center">

                <div class="foto-perfil mb-4">

                </div>

                <button class="btn btn-outline-light">

                    Editar foto

                </button>

            </div>

            <!-- Formulário -->

            <div class="col-lg-6">

                <form>

                    <div class="mb-4">

                        <label class="form-label">

                            Nome

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="Digite seu nome">

                    </div>

                    <div class="mb-4">

                        <label class="form-label">

                            Descrição

                        </label>

                        <textarea
                            class="form-control"
                            rows="4"
                            placeholder="Conte um pouco sobre você"></textarea>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">

                            E-mail

                        </label>

                        <input
                            type="email"
                            class="form-control"
                            placeholder="Digite seu e-mail">

                    </div>

                    <div class="mb-5">

                        <label class="form-label">

                            Nova senha

                        </label>

                        <input
                            type="password"
                            class="form-control"
                            placeholder="Digite sua nova senha">

                    </div>

                    <div class="row">

                        <div class="col-6">

                            <a href="Perfil.php" class="btn btn-outline-light w-100">

                                Cancelar

                            </a>

                        </div>

                        <div class="col-6">

                            <button
                                type="button"
                                class="btn btn-primary w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#modalSalvar">

                                Salvar

                            </button>

                        </div>

                    </div>

                </form>

            </div>

            <!-- Aviso -->

            <div class="col-lg-3">

                <div class="card h-100">

                    <div class="card-body d-flex align-items-center text-center">

                        <small>

                            A descrição pode ser definida durante o cadastro
                            e alterada posteriormente nesta tela.
                            A foto de perfil é alterada nessa tela

                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

<!-- Modal -->

<div class="modal fade" id="modalSalvar" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content bg-dark text-white border border-primary">

            <div class="modal-header">

                <h5 class="modal-title">

                    Alterações Salvas

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                Suas informações foram atualizadas com sucesso.

            </div>

            <div class="modal-footer">

                <a href="Perfil.php" class="btn btn-primary">

                    OK

                </a>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>