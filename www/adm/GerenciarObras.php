<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gerenciar Obras - Apollo</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="../css/styles.css">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    

</head>

<body>

    <!-- MENU -->

    <header>

        <?php include '../menu.php'; ?>

    </header>


    <!-- CONTEÚDO -->

    <main class="container py-4">

        <h1 class="mb-4">

            Obras

        </h1>


        <div class="gerenciar-obras">


            <!-- TÍTULO -->

            <div class="titulo-gerenciar">

                <i class="bi bi-list"></i>

                <h3>

                    Gerenciar obras

                </h3>

            </div>


            <!-- FILTROS -->

            <div class="filtros-obras">

                <input
                    type="text"
                    class="form-control"
                    placeholder="Buscar">


                <select class="form-select">

                    <option selected>

                        Tipo

                    </option>

                    <option>

                        Filme

                    </option>

                    <option>

                        Série

                    </option>

                    <option>

                        Anime

                    </option>

                </select>


                <select class="form-select">

                    <option selected>

                        Gênero

                    </option>

                    <option>

                        Ação

                    </option>

                    <option>

                        Drama

                    </option>

                    <option>

                        Romance

                    </option>

                </select>


                <button
                    type="button"
                    class="btn btn-outline-light">

                    Limpar filtros

                </button>


                <a
                    href="AdicionarObra.php"
                    class="btn btn-primary">

                    Adicionar obra

                </a>

            </div>


            <!-- TABELA -->

            <div class="table-responsive">

                <table class="table table-dark table-bordered align-middle tabela-obras">

                    <thead>

                        <tr>

                            <th>

                                Capa

                            </th>

                            <th>

                                Título

                            </th>

                            <th>

                                Gêneros

                            </th>

                            <th>

                                Ano

                            </th>

                            <th>

                                Avaliação média

                            </th>

                            <th>

                                Ações

                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        <!-- OBRA 1 -->

                        <tr>

                            <td>

                                <div class="capa-obra">

                                    Capa

                                </div>

                            </td>


                            <td>

                                Interestelar

                            </td>


                            <td>

                                Ficção<br>

                                Drama

                            </td>


                            <td>

                                2014

                            </td>


                            <td>

                                <div class="avaliacao-obra">

                                    <i class="bi bi-star-fill"></i>

                                    <span>

                                        4.8

                                    </span>

                                </div>

                            </td>


                            <td>

                                <div class="acoes-obra">


                                    <!-- EDITAR -->

                                    <button
                                        type="button"
                                        class="btn btn-outline-light"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditar">

                                        <i class="bi bi-pencil"></i>

                                    </button>


                                    <!-- VISUALIZAR -->

                                    <button
                                        type="button"
                                        class="btn btn-outline-light"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalVisualizar">

                                        <i class="bi bi-eye"></i>

                                    </button>


                                    <!-- EXCLUIR -->

                                    <button
                                        type="button"
                                        class="btn btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalExcluir">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </div>

                            </td>

                        </tr>


                        <!-- OBRA 2 -->

                        <tr>

                            <td>

                                <div class="capa-obra">

                                    Capa

                                </div>

                            </td>


                            <td>

                                Breaking Bad

                            </td>


                            <td>

                                Drama<br>

                                Crime

                            </td>


                            <td>

                                2008

                            </td>


                            <td>

                                <div class="avaliacao-obra">

                                    <i class="bi bi-star-fill"></i>

                                    <span>

                                        4.9

                                    </span>

                                </div>

                            </td>


                            <td>

                                <div class="acoes-obra">


                                    <button
                                        type="button"
                                        class="btn btn-outline-light"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditar">

                                        <i class="bi bi-pencil"></i>

                                    </button>


                                    <button
                                        type="button"
                                        class="btn btn-outline-light"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalVisualizar">

                                        <i class="bi bi-eye"></i>

                                    </button>


                                    <button
                                        type="button"
                                        class="btn btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalExcluir">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </div>

                            </td>

                        </tr>


                        <!-- OBRA 3 -->

                        <tr>

                            <td>

                                <div class="capa-obra">

                                    Capa

                                </div>

                            </td>


                            <td>

                                Os Cavaleiros do Zodíaco

                            </td>


                            <td>

                                Anime<br>

                                Ação

                            </td>


                            <td>

                                1986

                            </td>


                            <td>

                                <div class="avaliacao-obra">

                                    <i class="bi bi-star-fill"></i>

                                    <span>

                                        4.5

                                    </span>

                                </div>

                            </td>


                            <td>

                                <div class="acoes-obra">


                                    <button
                                        type="button"
                                        class="btn btn-outline-light"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditar">

                                        <i class="bi bi-pencil"></i>

                                    </button>


                                    <button
                                        type="button"
                                        class="btn btn-outline-light"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalVisualizar">

                                        <i class="bi bi-eye"></i>

                                    </button>


                                    <button
                                        type="button"
                                        class="btn btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalExcluir">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </div>

                            </td>

                        </tr>


                    </tbody>

                </table>

            </div>

        </div>

    </main>



    <!-- ==========================================
                  MODAL EDITAR OBRA
    =========================================== -->

    <div
        class="modal fade"
        id="modalEditar"
        tabindex="-1">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content bg-dark text-white">


                <div class="modal-header">

                    <h5 class="modal-title">

                        Editar obra

                    </h5>

                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">

                    </button>

                </div>


                <div class="modal-body">

                    <div class="row g-3">


                        <div class="col-md-6">

                            <label class="form-label">

                                Título

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="Interestelar">

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">

                                Tipo

                            </label>

                            <select class="form-select">

                                <option selected>

                                    Filme

                                </option>

                                <option>

                                    Série

                                </option>

                                <option>

                                    Anime

                                </option>

                            </select>

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">

                                Ano

                            </label>

                            <input
                                type="number"
                                class="form-control"
                                value="2014">

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">

                                Gênero

                            </label>

                            <select class="form-select">

                                <option selected>

                                    Ficção

                                </option>

                                <option>

                                    Drama

                                </option>

                                <option>

                                    Ação

                                </option>

                            </select>

                        </div>


                        <div class="col-12">

                            <label class="form-label">

                                Descrição

                            </label>

                            <textarea
                                class="form-control"
                                rows="4">Uma equipe viaja pelo espaço em busca de um novo planeta habitável.</textarea>

                        </div>


                    </div>

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

                        Salvar alterações

                    </button>

                </div>


            </div>

        </div>

    </div>



    <!-- ==========================================
               MODAL VISUALIZAR OBRA
    =========================================== -->

    <div
        class="modal fade"
        id="modalVisualizar"
        tabindex="-1">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content bg-dark text-white">


                <div class="modal-header">

                    <h5 class="modal-title">

                        Informações da obra

                    </h5>


                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">

                    </button>

                </div>


                <div class="modal-body">

                    <div class="row">


                        <div class="col-md-4 text-center">

                            <div class="capa-modal">

                                Capa

                            </div>

                        </div>


                        <div class="col-md-8">

                            <h3>

                                Interestelar

                            </h3>


                            <p>

                                <strong>

                                    Tipo:

                                </strong>

                                Filme

                            </p>


                            <p>

                                <strong>

                                    Ano:

                                </strong>

                                2014

                            </p>


                            <p>

                                <strong>

                                    Gêneros:

                                </strong>

                                Ficção, Drama

                            </p>


                            <p>

                                <strong>

                                    Avaliação média:

                                </strong>

                                ⭐ 4.8

                            </p>


                            <p>

                                <strong>

                                    Duração:

                                </strong>

                                169 minutos

                            </p>

                        </div>

                    </div>


                    <hr>


                    <h5>

                        Descrição

                    </h5>


                    <p>

                        Uma equipe viaja pelo espaço em busca de um novo planeta habitável para garantir a sobrevivência da humanidade.

                    </p>


                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-primary"
                        data-bs-dismiss="modal">

                        Fechar

                    </button>

                </div>


            </div>

        </div>

    </div>



    <!-- ==========================================
                  MODAL EXCLUIR OBRA
    =========================================== -->

    <div
        class="modal fade"
        id="modalExcluir"
        tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content bg-dark text-white border border-danger">


                <div class="modal-header">

                    <h5 class="modal-title">

                        Excluir obra

                    </h5>


                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">

                    </button>

                </div>


                <div class="modal-body">

                    <p>

                        Tem certeza que deseja excluir esta obra?

                    </p>


                    <p class="text-secondary">

                        Essa ação removerá a obra da plataforma.

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

                        Confirmar exclusão

                    </button>

                </div>


            </div>

        </div>

    </div>



    <!-- BOOTSTRAP -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">

    </script>

</body>

</html>