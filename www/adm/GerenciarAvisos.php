<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gerenciar Avisos - Apollo</title>

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

    <h1 class="mb-4">

        Avisos

    </h1>


    <div class="gerenciar-avisos">


        <!-- CABEÇALHO -->

        <div class="titulo-avisos">

            <i class="bi bi-list"></i>

            <h3>

                Avisos

            </h3>

        </div>


        <!-- ADICIONAR AVISO -->

        <div class="adicionar-aviso">

            <a href="AdicionarAviso.php">

                Adicionar aviso

            </a>

        </div>


        <!-- AVISOS -->

        <div class="row g-3">


            <!-- AVISO 1 -->

            <div class="col-lg-4 col-md-6">

                <div class="aviso-card">

                    <ul>

                        <li>

                            <strong>Nome:</strong>
                            Aviso 1

                        </li>

                        <li>

                            <strong>Status:</strong>
                            Ativo

                        </li>

                        <li>

                            <strong>Data de início:</strong>
                            01/08/2026

                        </li>

                        <li>

                            <strong>Data de fim:</strong>
                            31/08/2026

                        </li>

                    </ul>


                    <div class="aviso-acoes">

                        <button
                            type="button"
                            class="btn btn-outline-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#modalDesativar">

                            Desativar

                        </button>


                        <button
                            type="button"
                            class="btn btn-outline-light"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditarAviso">

                            Editar

                        </button>

                    </div>

                </div>

            </div>


            <!-- AVISO 2 -->

            <div class="col-lg-4 col-md-6">

                <div class="aviso-card">

                    <ul>

                        <li>

                            <strong>Nome:</strong>
                            Aviso 2

                        </li>

                        <li>

                            <strong>Status:</strong>
                            Ativo

                        </li>

                        <li>

                            <strong>Data de início:</strong>
                            05/08/2026

                        </li>

                        <li>

                            <strong>Data de fim:</strong>
                            05/09/2026

                        </li>

                    </ul>


                    <div class="aviso-acoes">

                        <button
                            type="button"
                            class="btn btn-outline-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#modalDesativar">

                            Desativar

                        </button>


                        <button
                            type="button"
                            class="btn btn-outline-light"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditarAviso">

                            Editar

                        </button>

                    </div>

                </div>

            </div>


            <!-- AVISO 3 -->

            <div class="col-lg-4 col-md-6">

                <div class="aviso-card">

                    <ul>

                        <li>

                            <strong>Nome:</strong>
                            Aviso 3

                        </li>

                        <li>

                            <strong>Status:</strong>
                            Inativo

                        </li>

                        <li>

                            <strong>Data de início:</strong>
                            10/08/2026

                        </li>

                        <li>

                            <strong>Data de fim:</strong>
                            10/09/2026

                        </li>

                    </ul>


                    <div class="aviso-acoes">

                        <button
                            type="button"
                            class="btn btn-outline-success"
                            data-bs-toggle="modal"
                            data-bs-target="#modalAtivar">

                            Ativar

                        </button>


                        <button
                            type="button"
                            class="btn btn-outline-light"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditarAviso">

                            Editar

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>


<!-- MODAL DESATIVAR -->

<div
    class="modal fade"
    id="modalDesativar"
    tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content bg-dark text-white border border-warning">

            <div class="modal-header">

                <h5 class="modal-title">

                    Desativar aviso

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">

                </button>

            </div>

            <div class="modal-body">

                Tem certeza que deseja desativar este aviso?

                <br><br>

                O aviso deixará de ser exibido na plataforma.

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Cancelar

                </button>

                <button
                    class="btn btn-warning"
                    data-bs-dismiss="modal">

                    Confirmar

                </button>

            </div>

        </div>

    </div>

</div>


<!-- MODAL ATIVAR -->

<div
    class="modal fade"
    id="modalAtivar"
    tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content bg-dark text-white border border-success">

            <div class="modal-header">

                <h5 class="modal-title">

                    Ativar aviso

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">

                </button>

            </div>

            <div class="modal-body">

                Deseja ativar este aviso?

                <br><br>

                Ele poderá voltar a ser exibido na plataforma.

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Cancelar

                </button>

                <button
                    class="btn btn-success"
                    data-bs-dismiss="modal">

                    Confirmar

                </button>

            </div>

        </div>

    </div>

</div>


<!-- MODAL EDITAR -->

<div
    class="modal fade"
    id="modalEditarAviso"
    tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content bg-dark text-white">

            <div class="modal-header">

                <h5 class="modal-title">

                    Editar aviso

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">

                </button>

            </div>

            <div class="modal-body">

                <label class="form-label">

                    Nome

                </label>

                <input
                    type="text"
                    class="form-control mb-3"
                    value="Aviso 1">


                <label class="form-label">

                    Data de início

                </label>

                <input
                    type="date"
                    class="form-control mb-3"
                    value="2026-08-01">


                <label class="form-label">

                    Data de fim

                </label>

                <input
                    type="date"
                    class="form-control"
                    value="2026-08-31">

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Cancelar

                </button>

                <button
                    class="btn btn-primary"
                    data-bs-dismiss="modal">

                    Salvar

                </button>

            </div>

        </div>

    </div>

</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>