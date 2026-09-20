<?php

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/autenticacao.php';

exigirAdministrador();

$mensagem = '';
$tipoMensagem = '';


// ============================================================
// AÇÕES
// ============================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $acao = $_POST['acao'] ?? '';

    // --------------------------------------------------------
    // EDITAR
    // --------------------------------------------------------

    if ($acao === 'editar') {

        $id = (int) ($_POST['id'] ?? 0);

        $titulo = $_POST['titulo'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $imagem = $_POST['imagem'] ?? '';
        $link = $_POST['link'] ?? '';

        $resultado = atualizarAviso(
            $id,
            $titulo,
            $descricao,
            $imagem,
            $link
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

        $id = (int) ($_POST['id'] ?? 0);

        $resultado = alterarStatusAviso($id);

        $mensagem = $resultado['mensagem'];
        $tipoMensagem = $resultado['sucesso']
            ? 'sucesso'
            : 'erro';
    }


    // --------------------------------------------------------
    // EXCLUIR
    // --------------------------------------------------------

    elseif ($acao === 'excluir') {

        $id = (int) ($_POST['id'] ?? 0);

        $resultado = excluirAviso($id);

        $mensagem = $resultado['mensagem'];
        $tipoMensagem = $resultado['sucesso']
            ? 'sucesso'
            : 'erro';
    }
}


// ============================================================
// BUSCAR AVISOS
// ============================================================

$avisos = buscarTodosAvisos();

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Gerenciar Avisos - Apollo</title>


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <link
        rel="stylesheet"
        href="../css/styles.css"
    >

</head>


<body>

<header>

    <?php include '../menu.php'; ?>

</header>


<main class="container py-5">


    <!-- =====================================================
         CABEÇALHO
    ====================================================== -->

    <div class="admin-cabecalho">

        <h1>

            <i class="bi bi-megaphone"></i>

            Gerenciar Avisos

        </h1>

        <p>
            Crie, edite e gerencie os avisos exibidos no Apollo.
        </p>

    </div>


    <!-- =====================================================
         MENSAGEM
    ====================================================== -->

    <?php if ($mensagem !== ''): ?>

        <div
            class="mensagem-admin
            <?= $tipoMensagem === 'sucesso'
                ? 'mensagem-sucesso'
                : 'mensagem-erro'
            ?>"
        >

            <i
                class="bi
                <?= $tipoMensagem === 'sucesso'
                    ? 'bi-check-circle'
                    : 'bi-exclamation-circle'
                ?>"
            ></i>

            <?= e($mensagem) ?>

        </div>

    <?php endif; ?>


    <!-- =====================================================
         ÁREA PRINCIPAL
    ====================================================== -->

    <section class="admin-secao avisos-admin">


        <!-- BOTÃO ADICIONAR -->

        <div class="cabecalho-avisos">

            <div>

                <h2>
                    Avisos cadastrados
                </h2>

                <p>
                    <?= count($avisos) ?>
                    aviso(s) cadastrado(s)
                </p>

            </div>


            <a
                href="AdicionarAviso.php"
                class="botao-adicionar-admin"
            >

                <i class="bi bi-plus-lg"></i>

                Adicionar aviso

            </a>

        </div>


        <!-- =================================================
             LISTA DE AVISOS
        ================================================== -->

        <?php if (empty($avisos)): ?>

            <div class="sem-avisos">

                <i class="bi bi-megaphone"></i>

                <h3>
                    Nenhum aviso cadastrado
                </h3>

                <p>
                    Adicione um aviso para começar.
                </p>

                <a
                    href="AdicionarAviso.php"
                    class="botao-adicionar-admin"
                >

                    <i class="bi bi-plus-lg"></i>

                    Adicionar primeiro aviso

                </a>

            </div>

        <?php else: ?>


            <div class="lista-avisos-admin">

                <?php foreach ($avisos as $aviso): ?>

                    <?php

                    $id = (int) $aviso['id'];

                    $titulo = $aviso['titulo'] ?? '';

                    $descricao = $aviso['descricao'] ?? '';

                    $imagem = $aviso['imagem'] ?? '';

                    $link = $aviso['link'] ?? '';

                    $ativo = (int) ($aviso['ativo'] ?? 0);

                    $dataCriacao = $aviso['data_criacao'] ?? null;

                    ?>

                    <article class="card-aviso-admin">


                        <!-- IMAGEM -->

                        <div class="imagem-aviso-admin">

                            <?php if (!empty($imagem)): ?>

                                <img
                                    src="<?= e($imagem) ?>"
                                    alt="<?= e($titulo) ?>"
                                >

                            <?php else: ?>

                                <div class="sem-imagem-aviso">

                                    <i class="bi bi-image"></i>

                                </div>

                            <?php endif; ?>

                        </div>


                        <!-- CONTEÚDO -->

                        <div class="conteudo-aviso-admin">


                            <div class="topo-aviso-admin">

                                <div>

                                    <span class="id-aviso-admin">
                                        ID #<?= $id ?>
                                    </span>

                                    <h3>
                                        <?= e($titulo) ?>
                                    </h3>

                                </div>


                                <?php if ($ativo === 1): ?>

                                    <span class="status-admin ativo">

                                        <i class="bi bi-check-circle"></i>

                                        Ativo

                                    </span>

                                <?php else: ?>

                                    <span class="status-admin inativo">

                                        <i class="bi bi-x-circle"></i>

                                        Inativo

                                    </span>

                                <?php endif; ?>

                            </div>


                            <!-- DESCRIÇÃO -->

                            <p class="descricao-aviso-admin">

                                <?= e($descricao) ?>

                            </p>


                            <!-- INFORMAÇÕES -->

                            <div class="info-aviso-admin">

                                <span>

                                    <i class="bi bi-calendar3"></i>

                                    <?php

                                    if (!empty($dataCriacao)) {

                                        echo date(
                                            'd/m/Y',
                                            strtotime($dataCriacao)
                                        );

                                    } else {

                                        echo '-';

                                    }

                                    ?>

                                </span>


                                <?php if (!empty($link)): ?>

                                    <span>

                                        <i class="bi bi-link-45deg"></i>

                                        Link configurado

                                    </span>

                                <?php else: ?>

                                    <span>

                                        <i class="bi bi-link-45deg"></i>

                                        Sem link

                                    </span>

                                <?php endif; ?>

                            </div>


                            <!-- AÇÕES -->

                            <div class="acoes-aviso-admin">


                                <!-- STATUS -->

                                <form method="POST">

                                    <input
                                        type="hidden"
                                        name="acao"
                                        value="status"
                                    >

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= $id ?>"
                                    >

                                    <button
                                        type="submit"
                                        class="botao-aviso-status"
                                    >

                                        <?php if ($ativo === 1): ?>

                                            <i class="bi bi-eye-slash"></i>

                                            Desativar

                                        <?php else: ?>

                                            <i class="bi bi-eye"></i>

                                            Ativar

                                        <?php endif; ?>

                                    </button>

                                </form>


                                <!-- EDITAR -->

                                <button
                                    type="button"
                                    class="botao-aviso-editar"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditarAviso<?= $id ?>"
                                >

                                    <i class="bi bi-pencil"></i>

                                    Editar

                                </button>


                                <!-- EXCLUIR -->

                                <button
                                    type="button"
                                    class="botao-aviso-excluir"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalExcluirAviso<?= $id ?>"
                                >

                                    <i class="bi bi-trash"></i>

                                    Excluir

                                </button>

                            </div>

                        </div>

                    </article>


                    <!-- =================================================
                         MODAL EDITAR
                    ================================================== -->

                    <div
                        class="modal fade modal-apollo"
                        id="modalEditarAviso<?= $id ?>"
                        tabindex="-1"
                        aria-hidden="true"
                    >

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">


                                <form method="POST">


                                    <div class="modal-header">

                                        <h5 class="modal-title">

                                            <i class="bi bi-pencil-square"></i>

                                            Editar aviso

                                        </h5>

                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                        ></button>

                                    </div>


                                    <div class="modal-body">


                                        <input
                                            type="hidden"
                                            name="acao"
                                            value="editar"
                                        >

                                        <input
                                            type="hidden"
                                            name="id"
                                            value="<?= $id ?>"
                                        >


                                        <div class="campo-admin">

                                            <label>
                                                Título
                                            </label>

                                            <input
                                                type="text"
                                                name="titulo"
                                                value="<?= e($titulo) ?>"
                                                maxlength="150"
                                                required
                                            >

                                        </div>


                                        <div class="campo-admin">

                                            <label>
                                                Descrição
                                            </label>

                                            <textarea
                                                name="descricao"
                                                maxlength="1000"
                                                required
                                            ><?= e($descricao) ?></textarea>

                                        </div>


                                        <div class="campo-admin">

                                            <label>
                                                Caminho da imagem
                                            </label>

                                            <input
                                                type="text"
                                                name="imagem"
                                                value="<?= e($imagem) ?>"
                                                maxlength="500"
                                                required
                                            >

                                        </div>


                                        <div class="campo-admin">

                                            <label>
                                                Link
                                            </label>

                                            <input
                                                type="url"
                                                name="link"
                                                value="<?= e($link) ?>"
                                                maxlength="500"
                                                placeholder="https://..."
                                            >

                                        </div>

                                    </div>


                                    <div class="modal-footer">

                                        <button
                                            type="button"
                                            class="btn botao-modal-cancelar"
                                            data-bs-dismiss="modal"
                                        >

                                            Cancelar

                                        </button>


                                        <button
                                            type="submit"
                                            class="btn botao-modal-salvar"
                                        >

                                            <i class="bi bi-check-lg"></i>

                                            Salvar alterações

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         MODAL EXCLUIR
                    ================================================== -->

                    <div
                        class="modal fade modal-apollo"
                        id="modalExcluirAviso<?= $id ?>"
                        tabindex="-1"
                        aria-hidden="true"
                    >

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">


                                <form method="POST">


                                    <div class="modal-header">

                                        <h5 class="modal-title">

                                            <i class="bi bi-exclamation-triangle"></i>

                                            Excluir aviso

                                        </h5>

                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                        ></button>

                                    </div>


                                    <div class="modal-body">

                                        <p style="color:#ddd;">

                                            Tem certeza que deseja excluir este aviso?

                                        </p>


                                        <strong>

                                            <?= e($titulo) ?>

                                        </strong>


                                        <p
                                            style="
                                                color:#888;
                                                margin-top:12px;
                                                margin-bottom:0;
                                            "
                                        >

                                            Essa ação não poderá ser desfeita.

                                        </p>


                                        <input
                                            type="hidden"
                                            name="acao"
                                            value="excluir"
                                        >

                                        <input
                                            type="hidden"
                                            name="id"
                                            value="<?= $id ?>"
                                        >

                                    </div>


                                    <div class="modal-footer">

                                        <button
                                            type="button"
                                            class="btn botao-modal-cancelar"
                                            data-bs-dismiss="modal"
                                        >

                                            Cancelar

                                        </button>


                                        <button
                                            type="submit"
                                            class="btn botao-modal-excluir"
                                        >

                                            <i class="bi bi-trash"></i>

                                            Excluir aviso

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


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
></script>

</body>

</html>