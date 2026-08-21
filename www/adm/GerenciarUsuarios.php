<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gerenciar Usuários - Apollo</title>

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

        Usuários

    </h1>

    <div class="admin-usuarios">

        <h3 class="mb-4">

            Gerenciar usuários

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

                        Gênero

                    </option>

                    <option>

                        Masculino

                    </option>

                    <option>

                        Feminino

                    </option>

                    <option>

                        Outro

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

                                <th>Usuário</th>

                                <th>Nome</th>

                                <th>Email</th>

                                <th>Data de cadastro</th>

                                <th>Ações</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>

                                    <div class="usuario-foto">

                                        Foto

                                    </div>

                                </td>

                                <td>

                                    Usuário 1

                                </td>

                                <td>

                                    usuario@email.com

                                </td>

                                <td>

                                    01/08/2026

                                </td>

                                <td>

                                    <div class="acoes-usuario">

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

                                    <div class="usuario-foto">

                                        Foto

                                    </div>

                                </td>

                                <td>

                                    Usuário 2

                                </td>

                                <td>

                                    usuario2@email.com

                                </td>

                                <td>

                                    05/08/2026

                                </td>

                                <td>

                                    <div class="acoes-usuario">

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

                                    <div class="usuario-foto">

                                        Foto

                                    </div>

                                </td>

                                <td>

                                    Usuário 3

                                </td>

                                <td>

                                    usuario3@email.com

                                </td>

                                <td>

                                    10/08/2026

                                </td>

                                <td>

                                    <div class="acoes-usuario">

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

            <!-- Dados do usuário -->

            <div class="col-lg-3">

                <div class="dados-usuario">

                    <h5>

                        Dados do usuário

                    </h5>

                    <div class="usuario-detalhes">

                        <div class="usuario-foto-grande">

                        </div>

                        <p>

                            <strong>Nome:</strong>

                            Nome do usuário

                        </p>

                        <p>

                            <strong>Email:</strong>

                            email@email.com

                        </p>

                        <p>

                            Número de obras favoritas

                        </p>

                        <p>

                            Número de comentários

                        </p>

                        <p>

                            Número de avaliações

                        </p>

                    </div>

                    <h6 class="mt-4">

                        Ações rápidas

                    </h6>

                    <button class="btn btn-outline-light w-100 mb-2">

                        Editar status

                    </button>

                    <button class="btn btn-outline-warning w-100 mb-2">

                        Banir usuário

                    </button>

                    <button class="btn btn-outline-danger w-100">

                        Excluir usuário

                    </button>

                </div>

            </div>

        </div>

    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>