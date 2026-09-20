<?php

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/autenticacao.php';

exigirAdministrador();

$mensagem = '';
$tipoMensagem = '';


// ============================================================
// PROCESSAMENTO DAS AÇÕES
// ============================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $acao = $_POST['acao'] ?? '';


    // --------------------------------------------------------
    // CADASTRAR
    // --------------------------------------------------------

    if ($acao === 'cadastrar') {

        $resultado = cadastrarGenero(
            $_POST['nome'] ?? ''
        );

        $mensagem = $resultado['mensagem'];
        $tipoMensagem = $resultado['sucesso']
            ? 'sucesso'
            : 'erro';
    }


    // --------------------------------------------------------
    // EDITAR
    // --------------------------------------------------------

    elseif ($acao === 'editar') {

        $resultado = atualizarGenero(
            (int) ($_POST['id'] ?? 0),
            $_POST['nome'] ?? ''
        );

        $mensagem = $resultado['mensagem'];
        $tipoMensagem = $resultado['sucesso']
            ? 'sucesso'
            : 'erro';
    }


    // --------------------------------------------------------
    // ALTERAR STATUS
    // --------------------------------------------------------

    elseif ($acao === 'status') {

        $resultado = alterarStatusGenero(
            (int) ($_POST['id'] ?? 0)
        );

        $mensagem = $resultado['mensagem'];
        $tipoMensagem = $resultado['sucesso']
            ? 'sucesso'
            : 'erro';
    }


    // --------------------------------------------------------
    // EXCLUIR
    // --------------------------------------------------------

    elseif ($acao === 'excluir') {

        $resultado = excluirGenero(
            (int) ($_POST['id'] ?? 0)
        );

        $mensagem = $resultado['mensagem'];
        $tipoMensagem = $resultado['sucesso']
            ? 'sucesso'
            : 'erro';
    }
}


// ============================================================
// BUSCAR GÊNEROS
// ============================================================

$generos = buscarTodosGeneros();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Gerenciar gêneros | Apollo</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link
        rel="stylesheet"
        href="../css/styles.css">

</head>


<body>

<header>

    <?php include '../menu.php'; ?>

</header>


<main class="container py-5">


    <!-- =====================================================
         CABEÇALHO
    ====================================================== -->

    <section class="admin-cabecalho mb-5">

        <p class="hero-etiqueta">

            <i class="bi bi-grid-fill"></i>

            ÁREA ADMINISTRATIVA

        </p>


        <h1>
            Gerenciar gêneros
        </h1>


        <p class="texto-autenticacao">

            Cadastre, edite, ative ou desative os gêneros
            utilizados nas obras da plataforma.

        </p>

    </section>



    <!-- =====================================================
         MENSAGEM
    ====================================================== -->

    <?php if (!empty($mensagem)): ?>

        <div
            class="mensagem-autenticacao <?= e($tipoMensagem) ?> mb-4">

            <i
                class="bi
                <?= $tipoMensagem === 'sucesso'
                    ? 'bi-check-circle'
                    : 'bi-exclamation-circle' ?>">
            </i>

            <?= e($mensagem) ?>

        </div>

    <?php endif; ?>



    <!-- =====================================================
         CADASTRAR GÊNERO
    ====================================================== -->

    <section class="admin-secao mb-5">

        <div class="titulo-secao">

            <div>

                <p>
                    NOVO GÊNERO
                </p>

                <h2>
                    Adicionar gênero
                </h2>

            </div>

            <i class="bi bi-plus-circle"></i>

        </div>


        <form
            method="POST"
            class="row g-3 align-items-end">

            <input
                type="hidden"
                name="acao"
                value="cadastrar">


            <div class="col-md-9">

                <label
                    for="nome"
                    class="form-label">

                    Nome do gênero

                </label>

                <input
                    type="text"
                    class="form-control campo-admin"
                    id="nome"
                    name="nome"
                    placeholder="Ex.: Ficção científica"
                    maxlength="100"
                    required>

            </div>


            <div class="col-md-3">

                <button
                    type="submit"
                    class="btn botao-roxo w-100">

                    <i class="bi bi-plus-lg"></i>

                    Adicionar gênero

                </button>

            </div>

        </form>

    </section>



    <!-- =====================================================
         LISTA DE GÊNEROS
    ====================================================== -->

    <section>

        <div class="titulo-secao">

            <div>

                <p>
                    GÊNEROS CADASTRADOS
                </p>

                <h2>
                    Lista de gêneros
                </h2>

            </div>

            <span class="badge-admin">

                <?= count($generos) ?>

                <?= count($generos) === 1
                    ? 'gênero'
                    : 'gêneros' ?>

            </span>

        </div>



        <?php if (empty($generos)): ?>

            <div class="mensagem-vazia">

                <i class="bi bi-grid"></i>

                <p>
                    Nenhum gênero cadastrado ainda.
                </p>

            </div>

        <?php else: ?>


            <div class="tabela-admin">

                <div class="tabela-admin-cabecalho">

                    <span>
                        Gênero
                    </span>

                    <span>
                        Status
                    </span>

                    <span>
                        Ações
                    </span>

                </div>


                <?php foreach ($generos as $genero): ?>

                    <div class="tabela-admin-linha">


                        <!-- NOME -->

                        <div>

                            <strong>

                                <?= e($genero['nome']) ?>

                            </strong>

                        </div>


                        <!-- STATUS -->

                        <div>

                            <?php if ($genero['ativo']): ?>

                                <span class="status-admin ativo">
                                    Ativo
                                </span>

                            <?php else: ?>

                                <span class="status-admin inativo">
                                    Inativo
                                </span>

                            <?php endif; ?>

                        </div>


                        <!-- AÇÕES -->

                        <div class="acoes-admin">


                            <!-- EDITAR -->

                            <button
                                type="button"
                                class="btn btn-sm botao-admin-editar"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditarGenero<?= $genero['id'] ?>">

                                <i class="bi bi-pencil"></i>

                                Editar

                            </button>



                            <!-- ATIVAR / DESATIVAR -->

                            <form
                                method="POST"
                                class="d-inline">

                                <input
                                    type="hidden"
                                    name="acao"
                                    value="status">

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int) $genero['id'] ?>">


                                <button
                                    type="submit"
                                    class="btn btn-sm botao-admin-status">

                                    <?php if ($genero['ativo']): ?>

                                        <i class="bi bi-eye-slash"></i>
                                        Desativar

                                    <?php else: ?>

                                        <i class="bi bi-eye"></i>
                                        Ativar

                                    <?php endif; ?>

                                </button>

                            </form>



                            <!-- EXCLUIR -->

                            <form
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Tem certeza que deseja excluir este gênero?');">

                                <input
                                    type="hidden"
                                    name="acao"
                                    value="excluir">

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int) $genero['id'] ?>">


                                <button
                                    type="submit"
                                    class="btn btn-sm botao-admin-excluir">

                                    <i class="bi bi-trash"></i>

                                    Excluir

                                </button>

                            </form>


                        </div>

                    </div>



                    <!-- =================================================
                         MODAL EDITAR
                    ================================================== -->

                    <div
                        class="modal fade modal-apollo"
                        id="modalEditarGenero<?= $genero['id'] ?>"
                        tabindex="-1"
                        aria-hidden="true">

                        <div
                            class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">


                                <div class="modal-header">

                                    <div>

                                        <p class="etiqueta-autenticacao">

                                            <i class="bi bi-pencil-square"></i>

                                            GÊNERO

                                        </p>

                                        <h2 class="modal-title">

                                            Editar gênero

                                        </h2>

                                    </div>


                                    <button
                                        type="button"
                                        class="botao-fechar-modal"
                                        data-bs-dismiss="modal">

                                        <i class="bi bi-x-lg"></i>

                                    </button>

                                </div>



                                <form method="POST">

                                    <div class="modal-body">


                                        <input
                                            type="hidden"
                                            name="acao"
                                            value="editar">


                                        <input
                                            type="hidden"
                                            name="id"
                                            value="<?= (int) $genero['id'] ?>">


                                        <div class="campo-formulario">

                                            <label
                                                for="nome<?= $genero['id'] ?>">

                                                Nome do gênero

                                            </label>


                                            <div>

                                                <i class="bi bi-grid"></i>

                                                <input
                                                    type="text"
                                                    id="nome<?= $genero['id'] ?>"
                                                    name="nome"
                                                    value="<?= e($genero['nome']) ?>"
                                                    maxlength="100"
                                                    required>

                                            </div>

                                        </div>


                                    </div>



                                    <div class="modal-footer">

                                        <button
                                            type="button"
                                            class="btn botao-cancelar"
                                            data-bs-dismiss="modal">

                                            Cancelar

                                        </button>


                                        <button
                                            type="submit"
                                            class="btn botao-roxo">

                                            <i class="bi bi-check-lg"></i>

                                            Salvar alterações

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>


                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </section>

</main>



<footer>

    <div class="container">

        <p>
            © <?= date('Y') ?> Apollo — Controle do site.
        </p>

    </div>

</footer>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>