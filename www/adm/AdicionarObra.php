<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Adicionar Obra - Apollo</title>

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

        Adicionar obras

    </h1>

    <form>

        <div class="row g-4">

            <!-- Informações principais -->

            <div class="col-lg-8">

                <div class="admin-form-card">

                    <h4>

                        Informações principais

                    </h4>

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label">

                                Título da obra

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                placeholder="Digite o título">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Tipo

                            </label>

                            <select class="form-select">

                                <option selected>

                                    Selecionar tipo

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

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Descrição

                            </label>

                            <textarea
                                class="form-control"
                                rows="3"
                                placeholder="Digite a descrição"></textarea>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">

                                Ano de lançamento

                            </label>

                            <input
                                type="date"
                                class="form-control">

                        </div>

                    </div>

                </div>

                <!-- Adicionais -->

                <div class="admin-form-card mt-4">

                    <h4>

                        Adicionais

                    </h4>

                    <div class="row g-3">

                        <div class="col-md-4">

                            <label class="form-label">

                                Classificação

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                placeholder="Ex.: 12">

                        </div>

                        <div class="col-md-8">

                            <label class="form-label">

                                Gêneros

                            </label>

                            <select class="form-select">

                                <option selected>

                                    Selecionar gênero

                                </option>

                                <!--
                                Os gêneros serão carregados do banco de dados
                                pelo PHP no back-end.
                                -->

                            </select>

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">

                                Duração

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                placeholder="Ex.: 120 min">

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">

                                Estúdio

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                placeholder="Nome do estúdio">

                        </div>

                    </div>

                </div>

            </div>

            <!-- Imagem -->

            <div class="col-lg-4">

                <div class="admin-imagem-card">

                    <h4>

                        Imagem

                    </h4>

                    <label class="upload-area">

                        <i class="bi bi-cloud-arrow-up"></i>

                        <span>

                            Upload

                        </span>

                        <input
                            type="file"
                            accept="image/*"
                            hidden>

                    </label>

                    <button
                        type="submit"
                        class="btn btn-primary w-100 mt-4">

                        Salvar

                    </button>

                </div>

            </div>

        </div>

    </form>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>