<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gerenciar Comentários - Apollo</title>

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

        Comentários

    </h1>

    <div class="admin-comentarios">

        <h3 class="mb-4">

            Gerenciar comentários

        </h3>

        <!-- Filtros -->

        <div class="row g-3 mb-4">

            <div class="col-md-4">

                <input
                    type="text"
                    class="form-control"
                    placeholder="Buscar">

            </div>

            <div class="col-md-3">

                <select class="form-select">

                    <option selected>

                        Status

                    </option>

                    <option>

                        Aprovado

                    </option>

                    <option>

                        Pendente

                    </option>

                    <option>

                        Denunciado

                    </option>

                    <option>

                        Rejeitado

                    </option>

                </select>

            </div>

            <div class="col-md-5 text-md-end">

                <button class="btn btn-outline-light">

                    Limpar filtros

                </button>

            </div>

        </div>

        <div class="row">

            <!-- Tabela -->

            <div class="col-lg-9">

                <div class="table-responsive">

                    <table class="table table-dark table-bordered align-middle">

                        <thead>

                            <tr>

                                <th>Obra</th>

                                <th>Usuário</th>

                                <th>Comentário</th>

                                <th>Status</th>

                                <th>Ações</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>

                                    <div class="obra-comentario">

                                        Obra

                                    </div>

                                </td>

                                <td>

                                    Usuário que comentou

                                </td>

                                <td>

                                    Comentário

                                </td>

                                <td>

                                    Pendente

                                </td>

                                <td>

                                    <div class="acoes-comentario-admin">

                                        <button
                                            class="btn btn-outline-light"
                                            title="Editar">

                                            <i class="bi bi-pencil"></i>

                                        </button>

                                        <button
                                            class="btn btn-outline-light"
                                            title="Visualizar">

                                            <i class="bi bi-eye"></i>

                                        </button>

                                        <button
                                            class="btn btn-outline-danger"
                                            title="Excluir">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                            <tr>

                                <td>

                                    <div class="obra-comentario">

                                        Obra

                                    </div>

                                </td>

                                <td>

                                    Usuário que comentou

                                </td>

                                <td>

                                    Comentário

                                </td>

                                <td>

                                    Denunciado

                                </td>

                                <td>

                                    <div class="acoes-comentario-admin">

                                        <button class="btn btn-outline-light">

                                            <i class="bi bi-pencil"></i>

                                        </button>

                                        <button class="btn btn-outline-light">

                                            <i class="bi bi-eye"></i>

                                        </button>

                                        <button class="btn btn-outline-danger">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                            <tr>

                                <td>

                                    <div class="obra-comentario">

                                        Obra

                                    </div>

                                </td>

                                <td>

                                    Usuário que comentou

                                </td>

                                <td>

                                    Comentário

                                </td>

                                <td>

                                    Aprovado

                                </td>

                                <td>

                                    <div class="acoes-comentario-admin">

                                        <button class="btn btn-outline-light">

                                            <i class="bi bi-pencil"></i>

                                        </button>

                                        <button class="btn btn-outline-light">

                                            <i class="bi bi-eye"></i>

                                        </button>

                                        <button class="btn btn-outline-danger">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- Detalhes -->

            <div class="col-lg-3">

                <div class="detalhes-comentario">

                    <h5>

                        Detalhes

                    </h5>

                    <div class="detalhes-obra">

                        <div class="obra-foto">

                            Obra

                        </div>

                        <p>

                            <strong>Nome:</strong>

                            Nome da obra

                        </p>

                        <p>

                            <strong>Tipo:</strong>

                            Tipo da obra

                        </p>

                    </div>

                    <div class="comentario-detalhes">

                        <p>

                            <strong>Nome do usuário</strong>

                        </p>

                        <p>

                            Motivo da denúncia

                        </p>

                        <p>

                            Comentário

                        </p>

                    </div>

                    <h6 class="mt-3">

                        Ações rápidas

                    </h6>

                    

                    <button class="btn btn-outline-warning w-100 mb-2">

                        Rejeitar denúncia

                    </button>

                    <button
                        type="button"
                        class="btn btn-outline-danger w-100"
                        data-bs-toggle="modal"
                        data-bs-target="#modalBanir">

                        Banir usuário

                    </button>

                </div>

            </div>

        </div>

    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<!-- Modal Banir Usuário -->

<div class="modal fade" id="modalBanir" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content bg-dark text-white border border-danger">

            <div class="modal-header">

                <h5 class="modal-title">

                    Banir usuário

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">

                </button>

            </div>

            <div class="modal-body">

                <p>

                    Tem certeza que deseja banir este usuário?

                </p>

                <p class="text-secondary">

                    O usuário perderá o acesso à plataforma após o banimento.

                </p>

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
                    class="btn btn-danger"
                    data-bs-dismiss="modal">

                    Confirmar banimento

                </button>

            </div>

        </div>

    </div>

</div>
</body>

</html>