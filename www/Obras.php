<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Obra - Apollo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">

     <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

    <!-- Menu lateral -->
     <header>

        <?php include 'menu.php'; ?>

    </header>

    <!-- Conteúdo -->
    <main class="container my-5">

        <div class="row">

            <!-- Poster -->
            <div class="col-lg-3 text-center">

                <!-- Poster da obra -->
                <img src="img/cdz.jpeg"
                    class="img-fluid rounded shadow mb-3"
                    alt="Poster">

            </div>

            <!-- Informações -->
            <div class="col-lg-9">

                <!-- Nome -->
                <h1 class="fw-bold">
                    Nome da Obra
                </h1>
                   
                <!-- Informações rápidas -->
                <p class="text-secondary mb-3">

                    Ano de Lançamento • Studio • Episódios

                </p>

                <!-- Avaliação -->
                <h2 class="text-warning mb-3">
                    ★★★★☆
                </h2>

                <!-- Sinopse -->
                <p>
                    Aqui ficará a descrição da obra cadastrada no banco de dados.
                    Quando o sistema estiver conectado ao MySQL, esta descrição será
                    carregada automaticamente.
                </p>


                <!-- Botões -->
                <div class="d-flex gap-3 mt-4">

                <button
                    class="btn btn-outline-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#modalLista">

                    ➕ Minha Lista

                </button>

                <button
                    class="btn btn-outline-danger"
                    data-bs-toggle="modal"
                    data-bs-target="#modalFavorito">

                    ❤️ Favoritar

                </button>

                <button
                    class="btn btn-outline-success"
                    data-bs-toggle="collapse"
                    data-bs-target="#formComentario">

                    💬 Comentar

                </button>

            </div>

            <!-- COLE O FORMULÁRIO AQUI -->

            <div class="collapse mt-4" id="formComentario">

                <div class="card comentario-form">

                    <div class="card-body">

                        <h3 class="mb-4">
                            Avaliar Obra
                        </h3>

                        <div class="mb-3">

                            <label class="form-label">
                                Sua nota
                            </label>

                            <input
                                type="number"
                                class="form-control"
                                min="1"
                                max="10"
                                placeholder="Digite uma nota de 1 a 10">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Comentário
                            </label>

                            <textarea
                                class="form-control"
                                rows="5"
                                placeholder="Escreva seu comentário..."></textarea>

                        </div>

                        <button class="btn btn-primary">
                            Salvar Comentário
                        </button>

                    </div>

                </div>

            </div>
            
        </div> <!-- fecha col-lg-9 -->
    </div> <!-- fecha row -->

        <hr class="my-5">

        <!-- Abas -->
        <ul class="nav nav-tabs" id="obraTab" role="tablist">

            <li class="nav-item">

                <button class="nav-link active"
                    data-bs-toggle="tab"
                    data-bs-target="#comentarios">

                    Comentários

                </button>

            </li>

            <li class="nav-item">

                <button class="nav-link"
                    data-bs-toggle="tab"
                    data-bs-target="#informacoes">

                    Informações

                </button>

            </li>

        </ul>

        <div class="tab-content border border-top-0 p-4">

            <!-- Comentários -->
            <div class="tab-pane fade show active"
                id="comentarios">

                <div class="card comentario-card mb-3">

                    <div class="card-body comentario">

                        <span class="texto-comentario">
                            Aqui aparecerá um comentário do usuário.
                        </span>

                        <div class="acoes-comentario">

                            <button class="btn btn-sm btn-outline-danger">
                                ❤️ 128
                            </button>

                            <button
                                type="button"
                                class="btn btn-outline-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#modalDenuncia">

                                <i class="bi bi-exclamation-triangle"></i>

                            </button>

                        </div>

                    </div>

                </div>

                <div class="card comentario-card mb-3">

                    <div class="card-body comentario">

                        <span class="texto-comentario">
                            Aqui aparecerá um comentário do usuário.
                        </span>

                        <div class="acoes-comentario">

                            <button class="btn btn-sm btn-outline-danger">
                                ❤️ 0
                            </button>

                            <button
                                type="button"
                                class="btn btn-outline-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#modalDenuncia">

                                <i class="bi bi-exclamation-triangle"></i>

                            </button>

                        </div>

                    </div>

                </div>

                <div class="card comentario-card mb-3">

                    <div class="card-body comentario">

                        <span class="texto-comentario">
                            Aqui aparecerá um comentário do usuário.
                        </span>

                        <div class="acoes-comentario">

                            <button class="btn btn-sm btn-outline-danger">
                                ❤️ 128
                            </button>

                            <button
                                type="button"
                                class="btn btn-outline-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#modalDenuncia">

                                <i class="bi bi-exclamation-triangle"></i>

                            </button>
                            </button>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Informações -->
            <div class="tab-pane fade"
                id="informacoes">

                <table class="table table-dark table-hover align-middle">

                    <tr>
                        <th>Título</th>
                        <td>Nome da Obra</td>
                    </tr>
                    

                    <tr>
                        <th>Categoria</th>
                        <td>Filme / Série / Anime</td>
                    </tr>

                    <tr>
                        <th>Gênero</th>
                        <td>Ação, Drama...</td>
                    </tr>

                    <tr>
                        <th>Ano</th>
                        <td>2026</td>
                    </tr>

                    <tr>
                        <th>Duração</th>
                        <td>..h ...min</td>
                    </tr>

                    <tr>
                        <th>Classificação</th>
                        <td>tantos anos</td>
                    </tr>

                    <tr>
                        <th>Avaliação</th>
                        <td>9,5 / 10</td>
                    </tr>

                </table>

            </div>

        </div>

    </main>

    <!-- Rodapé -->
    <footer class="bg-dark text-white text-center py-3">

        © 2026 Apollo

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Modal Minha Lista -->

<div class="modal fade" id="modalLista" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content bg-dark text-white border border-primary">

            <div class="modal-header">

                <h5 class="modal-title">
                    Adicionar à Minha Lista (Se ele estiver logado se não aparece uma mensagem para logar)
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <p>Selecione uma lista:</p>

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="radio"
                        name="lista"
                        id="assistindo">

                    <label class="form-check-label" for="assistindo">
                        Assistindo
                    </label>

                </div>

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="radio"
                        name="lista"
                        id="quero">

                    <label class="form-check-label" for="quero">
                        Quero Assistir
                    </label>

                </div>

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="radio"
                        name="lista"
                        id="concluido">

                    <label class="form-check-label" for="concluido">
                        Concluído
                    </label>

                </div>

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="radio"
                        name="lista"
                        id="pausado">

                    <label class="form-check-label" for="pausado">
                        Pausado
                    </label>

                </div>

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="radio"
                        name="lista"
                        id="abandonado">

                    <label class="form-check-label" for="abandonado">
                        Abandonado
                    </label>

                </div>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Cancelar

                </button>

                <button
                    class="btn btn-primary">

                    Salvar

                </button>

            </div>

        </div>

    </div>

</div>

    <!-- Modal Favoritar -->

<div class="modal fade" id="modalFavorito" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content bg-dark text-white border border-danger">

            <div class="modal-header">

                <h5 class="modal-title">
                    ❤️ Favoritar Obra
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <p>
                    Esta funcionalidade será implementada no back-end.
                </p>

                <p>
                    Quando o usuário estiver <strong>logado</strong>, ao clicar em
                    <strong>Favoritar</strong> o coração ficará vermelho e a obra será
                    adicionada automaticamente à lista de favoritos do seu perfil.
                </p>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-danger"
                    data-bs-dismiss="modal">

                    Entendi

                </button>

            </div>

        </div>

    </div>

</div>


<!-- Modal Denúncia -->

<div class="modal fade" id="modalDenuncia" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content bg-dark text-white border border-warning">

            <div class="modal-header">

                <h4 class="modal-title">

                    Denunciar Comentário

                </h4>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">

                </button>

            </div>

            <div class="modal-body">

                <label class="form-label mb-3">

                    Comentário denunciado

                </label>

                <textarea
                    class="form-control mb-4"
                    rows="3"
                    readonly>Comentário selecionado para denúncia.</textarea>

                <h6 class="mb-3">

                    Motivo da denúncia

                </h6>

                <div class="form-check mb-2">

                    <input class="form-check-input"
                        type="radio"
                        name="motivo"
                        id="motivo1">

                    <label class="form-check-label" for="motivo1">

                        Linguagem ofensiva

                    </label>

                </div>

                <div class="form-check mb-2">

                    <input class="form-check-input"
                        type="radio"
                        name="motivo"
                        id="motivo2">

                    <label class="form-check-label" for="motivo2">

                        Discurso de ódio

                    </label>

                </div>

                <div class="form-check mb-2">

                    <input class="form-check-input"
                        type="radio"
                        name="motivo"
                        id="motivo3">

                    <label class="form-check-label" for="motivo3">

                        Spam

                    </label>

                </div>

                <div class="form-check mb-2">

                    <input class="form-check-input"
                        type="radio"
                        name="motivo"
                        id="motivo4">

                    <label class="form-check-label" for="motivo4">

                        Informações falsas

                    </label>

                </div>

                <div class="form-check">

                    <input class="form-check-input"
                        type="radio"
                        name="motivo"
                        id="motivo5">

                    <label class="form-check-label" for="motivo5">

                        Outro

                    </label>

                </div>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Cancelar

                </button>

                <button
                    class="btn btn-warning"
                    data-bs-toggle="modal"
                    data-bs-target="#modalSucesso"
                    data-bs-dismiss="modal">

                    Enviar denúncia

                </button>

            </div>

        </div>

    </div>

</div>


<!-- Modal Sucesso -->

<div class="modal fade" id="modalSucesso" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content bg-dark text-white border border-success">

            <div class="modal-header">

                <h5 class="modal-title">

                    Denúncia enviada

                </h5>

            </div>

            <div class="modal-body">

                Sua denúncia foi enviada com sucesso.

                <br><br>

                Ela será analisada pela equipe de moderação do Apollo.

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-primary"
                    data-bs-dismiss="modal">

                    OK

                </button>

            </div>

        </div>

    </div>

</div>

</body>

</html>