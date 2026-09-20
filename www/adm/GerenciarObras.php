<?php

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/autenticacao.php';

exigirAdministrador();

$mensagem = '';
$tipoMensagem = '';

/*
|--------------------------------------------------------------------------
| AÇÕES DA PÁGINA
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $acao = $_POST['acao'] ?? '';
    $id = (int) ($_POST['id'] ?? 0);


    /*
    |--------------------------------------------------------------------------
    | EXCLUIR OBRA
    |--------------------------------------------------------------------------
    */

    if ($acao === 'excluir') {

        $resultado = excluirObra($id);

        $mensagem = $resultado['mensagem'];
        $tipoMensagem = $resultado['sucesso']
            ? 'sucesso'
            : 'erro';
    }


    /*
    |--------------------------------------------------------------------------
    | ATIVAR / DESATIVAR OBRA
    |--------------------------------------------------------------------------
    */

    elseif ($acao === 'status') {

        $ativo = isset($_POST['ativo'])
            ? (int) $_POST['ativo']
            : 0;

        $resultado = alterarStatusObra($id, $ativo);

        $mensagem = $resultado['mensagem'];
        $tipoMensagem = $resultado['sucesso']
            ? 'sucesso'
            : 'erro';
    }
}


/*
|--------------------------------------------------------------------------
| BUSCAR OBRAS
|--------------------------------------------------------------------------
*/

$obras = buscarTodasObras();


/*
|--------------------------------------------------------------------------
| CONTADORES
|--------------------------------------------------------------------------
*/

$totalObras = count($obras);

$obrasAtivas = 0;
$obrasEmAlta = 0;

foreach ($obras as $obra) {

    if ((int) $obra['ativo'] === 1) {
        $obrasAtivas++;
    }

    if ((int) $obra['em_alta'] === 1) {
        $obrasEmAlta++;
    }
}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Gerenciar obras | Apollo</title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Bootstrap Icons -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <!-- CSS do Apollo -->

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


    <!-- ==========================================================
         CABEÇALHO
    =========================================================== -->

    <section class="admin-cabecalho mb-5">

        <div>

            <p class="hero-etiqueta mb-2">

                <i class="bi bi-film"></i>

                CONTROLE DO SITE

            </p>


            <h1>

                Gerenciar obras

            </h1>


            <p class="texto-autenticacao">

                Cadastre, edite, visualize e gerencie as obras
                disponíveis no Apollo.

            </p>

        </div>


        <a
            href="AdicionarObra.php"
            class="btn botao-roxo"
        >

            <i class="bi bi-plus-lg"></i>

            Adicionar obra

        </a>

    </section>



    <!-- ==========================================================
         MENSAGEM
    =========================================================== -->

    <?php if (!empty($mensagem)): ?>

        <div class="mensagem-autenticacao <?= e($tipoMensagem) ?> mb-4">

            <i class="bi
                <?= $tipoMensagem === 'sucesso'
                    ? 'bi-check-circle'
                    : 'bi-exclamation-circle'
                ?>">
            </i>

            <?= e($mensagem) ?>

        </div>

    <?php endif; ?>



    <!-- ==========================================================
         RESUMO
    =========================================================== -->

    <section class="mb-5">

        <div class="row g-4">


            <!-- TOTAL -->

            <div class="col-md-4">

                <div class="admin-info-card">

                    <div class="admin-info-icone">

                        <i class="bi bi-film"></i>

                    </div>


                    <div>

                        <span>
                            Total de obras
                        </span>

                        <strong>
                            <?= $totalObras ?>
                        </strong>

                    </div>

                </div>

            </div>



            <!-- ATIVAS -->

            <div class="col-md-4">

                <div class="admin-info-card">

                    <div class="admin-info-icone">

                        <i class="bi bi-check-circle"></i>

                    </div>


                    <div>

                        <span>
                            Obras ativas
                        </span>

                        <strong>
                            <?= $obrasAtivas ?>
                        </strong>

                    </div>

                </div>

            </div>



            <!-- EM ALTA -->

            <div class="col-md-4">

                <div class="admin-info-card">

                    <div class="admin-info-icone">

                        <i class="bi bi-fire"></i>

                    </div>


                    <div>

                        <span>
                            Em alta
                        </span>

                        <strong>
                            <?= $obrasEmAlta ?>
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- ==========================================================
         TÍTULO DA LISTA
    =========================================================== -->

    <section class="mb-4">

        <div class="titulo-secao">

            <div>

                <p>
                    CATÁLOGO
                </p>

                <h2>
                    Obras cadastradas
                </h2>

            </div>


            <i class="bi bi-collection-play"></i>

        </div>

    </section>



    <!-- ==========================================================
         LISTA DE OBRAS
    =========================================================== -->

    <?php if (empty($obras)): ?>


        <!-- NENHUMA OBRA -->

        <div class="mensagem-vazia">

            <i class="bi bi-film fs-1 d-block mb-3"></i>


            <h3>
                Nenhuma obra cadastrada
            </h3>


            <p>
                Comece adicionando a primeira obra ao Apollo.
            </p>


            <a
                href="AdicionarObra.php"
                class="btn botao-roxo"
            >

                <i class="bi bi-plus-lg"></i>

                Adicionar obra

            </a>

        </div>


    <?php else: ?>


        <div class="row g-4">


            <?php foreach ($obras as $obra): ?>


                <div class="col-12">


                    <!-- ==================================================
                         CARD DA OBRA
                    =================================================== -->

                    <article class="admin-obra-card">


                        <!-- ==================================================
                             CAPA
                        =================================================== -->

                        <div class="admin-obra-capa">

                            <img
                                src="<?= e($obra['capa']) ?>"
                                alt="<?= e($obra['titulo']) ?>"
                            >

                        </div>



                        <!-- ==================================================
                             INFORMAÇÕES DA OBRA
                        =================================================== -->

                        <div class="admin-obra-conteudo">


                            <!-- STATUS -->

                            <div class="admin-obra-topo">


                                <!-- TIPO -->

                                <span class="admin-obra-tipo">

                                    <?= e($obra['tipo']) ?>

                                </span>



                                <!-- ATIVA / INATIVA -->

                                <?php if ((int) $obra['ativo'] === 1): ?>

                                    <span class="admin-obra-status ativa">

                                        <i class="bi bi-check-circle"></i>

                                        Ativa

                                    </span>

                                <?php else: ?>

                                    <span class="admin-obra-status inativa">

                                        <i class="bi bi-eye-slash"></i>

                                        Inativa

                                    </span>

                                <?php endif; ?>



                                <!-- EM ALTA -->

                                <?php if ((int) $obra['em_alta'] === 1): ?>

                                    <span class="admin-obra-status alta">

                                        <i class="bi bi-fire"></i>

                                        Em alta

                                    </span>

                                <?php endif; ?>



                                <!-- LANÇAMENTO -->

                                <?php if ((int) $obra['lancamento'] === 1): ?>

                                    <span class="admin-obra-status lancamento">

                                        <i class="bi bi-rocket-takeoff"></i>

                                        Lançamento

                                    </span>

                                <?php endif; ?>


                            </div>



                            <!-- TÍTULO -->

                            <h2 class="admin-obra-titulo">

                                <?= e($obra['titulo']) ?>

                            </h2>



                            <!-- DESCRIÇÃO -->

                            <p class="admin-obra-descricao">

                                <?= e($obra['descricao']) ?>

                            </p>



                            <!-- ==================================================
                                 INFORMAÇÕES
                            =================================================== -->

                            <div class="admin-obra-informacoes">


                                <div>

                                    <span>
                                        Ano
                                    </span>

                                    <strong>
                                        <?= e($obra['ano_lancamento']) ?>
                                    </strong>

                                </div>


                                <div>

                                    <span>
                                        Classificação
                                    </span>

                                    <strong>
                                        <?= e($obra['classificacao']) ?>
                                    </strong>

                                </div>


                                <div>

                                    <span>
                                        Duração
                                    </span>

                                    <strong>
                                        <?= e($obra['duracao']) ?>
                                    </strong>

                                </div>


                                <div>

                                    <span>
                                        Estúdio
                                    </span>

                                    <strong>
                                        <?= e($obra['estudio']) ?>
                                    </strong>

                                </div>


                            </div>



                            <!-- ==================================================
                                 GÊNEROS
                            =================================================== -->

                            <div class="admin-obra-generos">


                                <span class="admin-obra-generos-titulo">

                                    Gêneros

                                </span>



                                <?php if (!empty($obra['generos'])): ?>


                                    <div class="admin-obra-generos-lista">


                                        <?php foreach ($obra['generos'] as $genero): ?>


                                            <span class="admin-obra-genero">

                                                <?= e($genero['nome']) ?>

                                            </span>


                                        <?php endforeach; ?>


                                    </div>


                                <?php else: ?>


                                    <small class="text-secondary">

                                        Nenhum gênero associado.

                                    </small>


                                <?php endif; ?>


                            </div>


                        </div>



                        <!-- ==================================================
                             AÇÕES
                        =================================================== -->

                        <div class="admin-obra-acoes">


                            <!-- EDITAR -->

                            <a
                                href="EditarObra.php?id=<?= (int) $obra['id'] ?>"
                                class="btn botao-editar"
                            >

                                <i class="bi bi-pencil"></i>

                                Editar

                            </a>



                            <!-- ATIVAR / DESATIVAR -->

                            <form
                                method="POST"
                                class="w-100"
                            >

                                <input
                                    type="hidden"
                                    name="acao"
                                    value="status"
                                >


                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int) $obra['id'] ?>"
                                >


                                <input
                                    type="hidden"
                                    name="ativo"
                                    value="<?= (int) $obra['ativo'] === 1 ? 0 : 1 ?>"
                                >


                                <button
                                    type="submit"
                                    class="btn botao-desativar"
                                >

                                    <?php if ((int) $obra['ativo'] === 1): ?>

                                        <i class="bi bi-eye-slash"></i>

                                        Desativar

                                    <?php else: ?>

                                        <i class="bi bi-eye"></i>

                                        Ativar

                                    <?php endif; ?>

                                </button>

                            </form>



                            <!-- EXCLUIR -->

                            <button
                                type="button"
                                class="btn botao-excluir"
                                data-bs-toggle="modal"
                                data-bs-target="#modalExcluir<?= (int) $obra['id'] ?>"
                            >

                                <i class="bi bi-trash"></i>

                                Excluir

                            </button>


                        </div>


                    </article>


                </div>



                <!-- ==========================================================
                     MODAL DE EXCLUSÃO
                =========================================================== -->

                <div
                    class="modal fade modal-apollo"
                    id="modalExcluir<?= (int) $obra['id'] ?>"
                    tabindex="-1"
                    aria-hidden="true"
                >

                    <div class="modal-dialog modal-dialog-centered">


                        <div class="modal-content">


                            <!-- CABEÇALHO -->

                            <div class="modal-header">


                                <div>

                                    <p class="etiqueta-autenticacao">

                                        <i class="bi bi-exclamation-triangle"></i>

                                        ATENÇÃO

                                    </p>


                                    <h2 class="modal-title">

                                        Excluir obra

                                    </h2>

                                </div>



                                <button
                                    type="button"
                                    class="botao-fechar-modal"
                                    data-bs-dismiss="modal"
                                    aria-label="Fechar"
                                >

                                    <i class="bi bi-x-lg"></i>

                                </button>


                            </div>



                            <!-- CORPO -->

                            <div class="modal-body">


                                <p>

                                    Tem certeza que deseja excluir a obra

                                    <strong>
                                        <?= e($obra['titulo']) ?>
                                    </strong>?

                                </p>


                                <p class="text-secondary mb-0">

                                    Essa ação não poderá ser desfeita.

                                </p>


                            </div>



                            <!-- RODAPÉ -->

                            <div class="modal-footer">


                                <button
                                    type="button"
                                    class="btn botao-cancelar"
                                    data-bs-dismiss="modal"
                                >

                                    Cancelar

                                </button>



                                <form method="POST">

                                    <input
                                        type="hidden"
                                        name="acao"
                                        value="excluir"
                                    >


                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= (int) $obra['id'] ?>"
                                    >


                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                    >

                                        <i class="bi bi-trash"></i>

                                        Excluir obra

                                    </button>

                                </form>


                            </div>


                        </div>

                    </div>

                </div>


            <?php endforeach; ?>


        </div>


    <?php endif; ?>


</main>



<!-- ==========================================================
     JAVASCRIPT
========================================================== -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>