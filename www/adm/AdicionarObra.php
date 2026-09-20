<?php

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/autenticacao.php';

exigirAdministrador();

$mensagem = '';
$tipoMensagem = '';

$titulo = '';
$descricao = '';
$tipo = '';
$anoLancamento = '';
$classificacao = '';
$duracao = '';
$estudio = '';

$generosSelecionados = [];

$emAlta = 0;
$lancamento = 0;


/* ============================================================
   BUSCAR GÊNEROS
   ============================================================ */

$generos = buscarGeneros();


/* ============================================================
   CADASTRAR OBRA
   ============================================================ */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = trim($_POST['titulo'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $tipo = trim($_POST['tipo'] ?? '');
    $anoLancamento = trim($_POST['ano_lancamento'] ?? '');
    $classificacao = trim($_POST['classificacao'] ?? '');
    $duracao = trim($_POST['duracao'] ?? '');
    $estudio = trim($_POST['estudio'] ?? '');

    $generosSelecionados = $_POST['generos'] ?? [];

    $emAlta = isset($_POST['em_alta']) ? 1 : 0;
    $lancamento = isset($_POST['lancamento']) ? 1 : 0;


    if (!is_array($generosSelecionados)) {
        $generosSelecionados = [];
    }


    /* ========================================================
       VALIDAÇÕES
       ======================================================== */

    if (
        empty($titulo) ||
        empty($descricao) ||
        empty($tipo) ||
        empty($anoLancamento) ||
        empty($classificacao) ||
        empty($duracao) ||
        empty($estudio)
    ) {

        $mensagem = 'Preencha todos os campos obrigatórios.';
        $tipoMensagem = 'erro';

    } elseif (!in_array($tipo, ['Filme', 'Série', 'Anime'], true)) {

        $mensagem = 'Selecione um tipo de obra válido.';
        $tipoMensagem = 'erro';

    } elseif (empty($generosSelecionados)) {

        $mensagem = 'Selecione pelo menos um gênero.';
        $tipoMensagem = 'erro';

    }


    /* ========================================================
       UPLOAD DA CAPA
       ======================================================== */

    $capa = '';

    if (empty($mensagem)) {

        if (
            !isset($_FILES['capa']) ||
            $_FILES['capa']['error'] === UPLOAD_ERR_NO_FILE
        ) {

            $mensagem = 'Selecione uma imagem para a capa.';
            $tipoMensagem = 'erro';

        } elseif ($_FILES['capa']['error'] !== UPLOAD_ERR_OK) {

            $mensagem = 'Não foi possível enviar a imagem.';
            $tipoMensagem = 'erro';

        } elseif ($_FILES['capa']['size'] > 5 * 1024 * 1024) {

            $mensagem = 'A imagem deve ter no máximo 5 MB.';
            $tipoMensagem = 'erro';

        } else {

            $tiposPermitidos = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp'
            ];


            $finfo = finfo_open(FILEINFO_MIME_TYPE);

            $tipoArquivo = finfo_file(
                $finfo,
                $_FILES['capa']['tmp_name']
            );

            


            if (!isset($tiposPermitidos[$tipoArquivo])) {

                $mensagem = 'Envie apenas imagens JPG, PNG ou WEBP.';
                $tipoMensagem = 'erro';

            } else {

                $pastaCapas = __DIR__ . '/../img/obras';


                if (!is_dir($pastaCapas)) {

                    mkdir(
                        $pastaCapas,
                        0755,
                        true
                    );
                }


                $nomeArquivo =
                    uniqid('obra_', true)
                    . '.'
                    . $tiposPermitidos[$tipoArquivo];


                $caminhoArquivo =
                    $pastaCapas
                    . DIRECTORY_SEPARATOR
                    . $nomeArquivo;


                if (
                    !move_uploaded_file(
                        $_FILES['capa']['tmp_name'],
                        $caminhoArquivo
                    )
                ) {

                    $mensagem = 'Não foi possível salvar a imagem.';
                    $tipoMensagem = 'erro';

                } else {

                    $capa = '/img/obras/' . $nomeArquivo;
                }
            }
        }
    }


    /* ========================================================
       SALVAR NO BANCO
       ======================================================== */

    if (empty($mensagem)) {

        $resultado = cadastrarObra(
            $titulo,
            $descricao,
            $tipo,
            $anoLancamento,
            $classificacao,
            $duracao,
            $estudio,
            $capa,
            $generosSelecionados,
            $emAlta,
            $lancamento
        );


        if ($resultado['sucesso']) {

            header(
                'Location: /adm/GerenciarObras.php?cadastro=sucesso'
            );

            exit;
        }


        $mensagem = $resultado['mensagem'];
        $tipoMensagem = 'erro';
    }
}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Adicionar obra | Apollo</title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <!-- Bootstrap Icons -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- CSS Apollo -->

    <link
        rel="stylesheet"
        href="../css/styles.css">

</head>


<body>


<header>

    <?php include '../menu.php'; ?>

</header>


<main class="container py-5">


    <!-- ========================================================
         CABEÇALHO
         ======================================================== -->

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-5">

        <div>

            <p class="hero-etiqueta mb-2">

                <i class="bi bi-plus-circle"></i>

                CONTROLE DO SITE

            </p>


            <h1>

                Adicionar obra

            </h1>


            <p class="text-secondary mb-0">

                Cadastre uma nova obra no catálogo do Apollo.

            </p>

        </div>


        <a
            href="GerenciarObras.php"
            class="btn botao-cancelar">

            <i class="bi bi-arrow-left"></i>

            Voltar

        </a>

    </div>


    <!-- ========================================================
         MENSAGEM
         ======================================================== -->

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


    <!-- ========================================================
         FORMULÁRIO
         ======================================================== -->

    <form
        method="POST"
        enctype="multipart/form-data"
        class="formulario-obra">


        <div class="row g-4">


            <!-- ==================================================
                 COLUNA ESQUERDA
                 ================================================== -->

            <div class="col-lg-8">


                <!-- ==================================================
                     INFORMAÇÕES PRINCIPAIS
                     ================================================== -->

                <section class="card admin-form-card mb-4">

                    <div class="card-body">

                        <div class="mb-4">

                            <p class="hero-etiqueta mb-1">
                                INFORMAÇÕES PRINCIPAIS
                            </p>

                            <h2 class="h4 mb-0">
                                Dados da obra
                            </h2>

                        </div>


                        <div class="row g-4">


                            <!-- TÍTULO -->

                            <div class="col-md-6">

                                <div class="campo-formulario">

                                    <label for="titulo">
                                        Título da obra
                                    </label>


                                    <div>

                                        <i class="bi bi-film"></i>

                                        <input
                                            type="text"
                                            id="titulo"
                                            name="titulo"
                                            value="<?= e($titulo) ?>"
                                            maxlength="150"
                                            placeholder="Ex.: Interestelar"
                                            required>

                                    </div>

                                </div>

                            </div>


                            <!-- TIPO -->

                            <div class="col-md-6">

                                <div class="campo-formulario">

                                    <label>
                                        Tipo
                                    </label>


                                    <div class="dropdown-apollo">

                                        <input
                                            type="hidden"
                                            name="tipo"
                                            id="tipo"
                                            value="<?= e($tipo) ?>">


                                        <button
                                            type="button"
                                            class="dropdown-apollo-botao"
                                            data-dropdown="tipoDropdown">

                                            <i class="bi bi-collection-play"></i>


                                            <span class="dropdown-apollo-texto">

                                                <?= !empty($tipo)
                                                    ? e($tipo)
                                                    : 'Selecionar tipo'
                                                ?>

                                            </span>


                                            <i class="bi bi-chevron-down dropdown-apollo-seta"></i>

                                        </button>


                                        <div
                                            class="dropdown-apollo-menu"
                                            id="tipoDropdown">


                                            <button
                                                type="button"
                                                data-value=""
                                                class="dropdown-apollo-opcao">

                                                Selecionar tipo

                                            </button>


                                            <button
                                                type="button"
                                                data-value="Filme"
                                                class="dropdown-apollo-opcao">

                                                Filme

                                            </button>


                                            <button
                                                type="button"
                                                data-value="Série"
                                                class="dropdown-apollo-opcao">

                                                Série

                                            </button>


                                            <button
                                                type="button"
                                                data-value="Anime"
                                                class="dropdown-apollo-opcao">

                                                Anime

                                            </button>


                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- DESCRIÇÃO -->

                            <div class="col-md-8">

                                <div class="campo-formulario">

                                    <label for="descricao">
                                        Descrição
                                    </label>


                                    <textarea
                                        id="descricao"
                                        name="descricao"
                                        rows="5"
                                        placeholder="Digite a descrição da obra..."
                                        required><?= e($descricao) ?></textarea>

                                </div>

                            </div>


                            <!-- ANO -->

                            <div class="col-md-4">

                                <div class="campo-formulario">

                                    <label for="ano_lancamento">
                                        Ano de lançamento
                                    </label>


                                    <div>

                                        <i class="bi bi-calendar3"></i>

                                        <input
                                            type="number"
                                            id="ano_lancamento"
                                            name="ano_lancamento"
                                            value="<?= e($anoLancamento) ?>"
                                            min="1800"
                                            max="<?= date('Y') ?>"
                                            placeholder="<?= date('Y') ?>"
                                            required>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>



                <!-- ==================================================
                     INFORMAÇÕES ADICIONAIS
                     ================================================== -->

                <section class="card admin-form-card mb-4">

                    <div class="card-body">

                        <div class="mb-4">

                            <p class="hero-etiqueta mb-1">
                                INFORMAÇÕES ADICIONAIS
                            </p>

                            <h2 class="h4 mb-0">
                                Características
                            </h2>

                        </div>


                        <div class="row g-4">


                            <!-- CLASSIFICAÇÃO -->

                            <div class="col-md-4">

                                <div class="campo-formulario">

                                    <label>
                                        Classificação
                                    </label>


                                    <div class="dropdown-apollo">

                                        <input
                                            type="hidden"
                                            name="classificacao"
                                            id="classificacao"
                                            value="<?= e($classificacao) ?>">


                                        <button
                                            type="button"
                                            class="dropdown-apollo-botao"
                                            data-dropdown="classificacaoDropdown">

                                            <i class="bi bi-person-badge"></i>


                                            <span class="dropdown-apollo-texto">

                                                <?php

                                                if (!empty($classificacao)) {

                                                    echo e(
                                                        $classificacao === 'Livre'
                                                            ? 'Livre'
                                                            : $classificacao . ' anos'
                                                    );

                                                } else {

                                                    echo 'Selecionar';
                                                }

                                                ?>

                                            </span>


                                            <i class="bi bi-chevron-down dropdown-apollo-seta"></i>

                                        </button>


                                        <div
                                            class="dropdown-apollo-menu"
                                            id="classificacaoDropdown">


                                            <button
                                                type="button"
                                                data-value=""
                                                class="dropdown-apollo-opcao">

                                                Selecionar

                                            </button>


                                            <button
                                                type="button"
                                                data-value="Livre"
                                                class="dropdown-apollo-opcao">

                                                Livre

                                            </button>


                                            <button
                                                type="button"
                                                data-value="10"
                                                class="dropdown-apollo-opcao">

                                                10 anos

                                            </button>


                                            <button
                                                type="button"
                                                data-value="12"
                                                class="dropdown-apollo-opcao">

                                                12 anos

                                            </button>


                                            <button
                                                type="button"
                                                data-value="14"
                                                class="dropdown-apollo-opcao">

                                                14 anos

                                            </button>


                                            <button
                                                type="button"
                                                data-value="16"
                                                class="dropdown-apollo-opcao">

                                                16 anos

                                            </button>


                                            <button
                                                type="button"
                                                data-value="18"
                                                class="dropdown-apollo-opcao">

                                                18 anos

                                            </button>


                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- DURAÇÃO -->

                            <div class="col-md-4">

                                <div class="campo-formulario">

                                    <label for="duracao">
                                        Duração
                                    </label>


                                    <div>

                                        <i class="bi bi-clock"></i>

                                        <input
                                            type="text"
                                            id="duracao"
                                            name="duracao"
                                            value="<?= e($duracao) ?>"
                                            maxlength="50"
                                            placeholder="Ex.: 2h 49min"
                                            required>

                                    </div>

                                </div>

                            </div>


                            <!-- ESTÚDIO -->

                            <div class="col-md-4">

                                <div class="campo-formulario">

                                    <label for="estudio">
                                        Estúdio
                                    </label>


                                    <div>

                                        <i class="bi bi-building"></i>

                                        <input
                                            type="text"
                                            id="estudio"
                                            name="estudio"
                                            value="<?= e($estudio) ?>"
                                            maxlength="150"
                                            placeholder="Ex.: Warner Bros."
                                            required>

                                    </div>

                                </div>

                            </div>


                            <!-- ==================================================
                                 GÊNEROS
                                 ================================================== -->

                            <div class="col-12">

                                <div class="campo-formulario">

                                    <label>
                                        Gêneros
                                    </label>


                                    <p class="texto-ajuda mb-3">

                                        Selecione um ou mais gêneros para esta obra.

                                    </p>


                                    <div class="generos-selecao">


                                        <?php if (!empty($generos)): ?>


                                            <?php foreach ($generos as $genero): ?>


                                                <label class="genero-checkbox">

                                                    <input
                                                        type="checkbox"
                                                        name="generos[]"
                                                        value="<?= (int) $genero['id'] ?>"
                                                        <?= in_array(
                                                            (int) $genero['id'],
                                                            array_map(
                                                                'intval',
                                                                $generosSelecionados
                                                            ),
                                                            true
                                                        )
                                                            ? 'checked'
                                                            : ''
                                                        ?>>


                                                    <span>
                                                        <?= e($genero['nome']) ?>
                                                    </span>

                                                </label>


                                            <?php endforeach; ?>


                                        <?php else: ?>


                                            <p class="mensagem-vazia">

                                                Nenhum gênero cadastrado.

                                            </p>


                                        <?php endif; ?>


                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>



                <!-- ==================================================
                     DESTAQUES
                     ================================================== -->

                <section class="card admin-form-card mb-4">

                    <div class="card-body">

                        <div class="mb-4">

                            <p class="hero-etiqueta mb-1">
                                DESTAQUES
                            </p>

                            <h2 class="h4 mb-0">
                                Organização do catálogo
                            </h2>

                        </div>


                        <div class="row g-3">


                            <!-- EM ALTA -->

                            <div class="col-md-6">

                                <label class="opcao-checkbox">

                                    <input
                                        type="checkbox"
                                        name="em_alta"
                                        value="1"
                                        <?= $emAlta ? 'checked' : '' ?>>


                                    <span>

                                        <i class="bi bi-fire"></i>

                                        <strong>
                                            Em alta
                                        </strong>

                                        <small>
                                            Exibir na seção "Em alta".
                                        </small>

                                    </span>

                                </label>

                            </div>


                            <!-- LANÇAMENTO -->

                            <div class="col-md-6">

                                <label class="opcao-checkbox">

                                    <input
                                        type="checkbox"
                                        name="lancamento"
                                        value="1"
                                        <?= $lancamento ? 'checked' : '' ?>>


                                    <span>

                                        <i class="bi bi-rocket-takeoff"></i>

                                        <strong>
                                            Lançamento
                                        </strong>

                                        <small>
                                            Exibir na seção "Lançamentos".
                                        </small>

                                    </span>

                                </label>

                            </div>


                        </div>

                    </div>

                </section>

            </div>



            <!-- ==================================================
                 COLUNA DIREITA
                 ================================================== -->

            <div class="col-lg-4">


                <!-- ==================================================
                     CAPA
                     ================================================== -->

                <section class="card admin-form-card imagem-obra-card">

                    <div class="card-body">


                        <div class="mb-4">

                            <p class="hero-etiqueta mb-1">
                                IMAGEM
                            </p>

                            <h2 class="h4 mb-0">
                                Capa da obra
                            </h2>

                        </div>


                        <!-- PRÉVIA -->

                        <div class="preview-capa">


                            <img
                                id="previewCapa"
                                src=""
                                alt="Prévia da capa"
                                style="display: none;">


                            <div
                                id="placeholderCapa"
                                class="placeholder-capa">

                                <i class="bi bi-image"></i>

                                <span>
                                    Nenhuma imagem selecionada
                                </span>

                            </div>


                        </div>


                        <!-- UPLOAD -->

                        <div class="campo-formulario mt-4">

                            <label for="capa">
                                Selecionar imagem
                            </label>


                            <input
                                type="file"
                                id="capa"
                                name="capa"
                                accept=".jpg,.jpeg,.png,.webp"
                                required>


                        </div>


                        <small class="texto-ajuda d-block mt-2">

                            JPG, PNG ou WEBP.
                            Tamanho máximo: 5 MB.

                        </small>


                    </div>

                </section>



                <!-- ==================================================
                     BOTÕES
                     ================================================== -->

                <div class="d-grid gap-2 mt-4">


                    <button
                        type="submit"
                        class="btn botao-roxo btn-lg">

                        <i class="bi bi-check-lg"></i>

                        Salvar obra

                    </button>


                    <a
                        href="GerenciarObras.php"
                        class="btn botao-cancelar">

                        Cancelar

                    </a>


                </div>

            </div>


        </div>

    </form>

</main>



<!-- ============================================================
     BOOTSTRAP
     ============================================================ -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
</script>



<!-- ============================================================
     JAVASCRIPT
     ============================================================ -->

<script>

/* ============================================================
   PREVISUALIZAÇÃO DA CAPA
   ============================================================ */

const inputCapa = document.getElementById('capa');

const previewCapa = document.getElementById('previewCapa');

const placeholderCapa = document.getElementById('placeholderCapa');


inputCapa.addEventListener('change', function () {

    const arquivo = this.files[0];


    if (!arquivo) {

        previewCapa.style.display = 'none';

        placeholderCapa.style.display = 'flex';

        previewCapa.src = '';

        return;
    }


    const leitor = new FileReader();


    leitor.onload = function (evento) {

        previewCapa.src = evento.target.result;

        previewCapa.style.display = 'block';

        placeholderCapa.style.display = 'none';

    };


    leitor.readAsDataURL(arquivo);

});



/* ============================================================
   DROPDOWNS PERSONALIZADOS
   ============================================================ */

document.querySelectorAll('.dropdown-apollo').forEach(function (dropdown) {


    const botao =
        dropdown.querySelector('.dropdown-apollo-botao');


    const menu =
        dropdown.querySelector('.dropdown-apollo-menu');


    const input =
        dropdown.querySelector('input[type="hidden"]');


    const texto =
        dropdown.querySelector('.dropdown-apollo-texto');


    const opcoes =
        dropdown.querySelectorAll('.dropdown-apollo-opcao');


    /* --------------------------------------------------------
       ABRIR / FECHAR
       -------------------------------------------------------- */

    botao.addEventListener('click', function (evento) {

        evento.stopPropagation();


        document
            .querySelectorAll('.dropdown-apollo')
            .forEach(function (outro) {

                if (outro !== dropdown) {

                    outro.classList.remove('aberto');

                }

            });


        dropdown.classList.toggle('aberto');

    });


    /* --------------------------------------------------------
       SELECIONAR OPÇÃO
       -------------------------------------------------------- */

    opcoes.forEach(function (opcao) {


        opcao.addEventListener('click', function () {


            const valor =
                this.dataset.value;


            const nome =
                this.textContent.trim();


            input.value = valor;


            texto.textContent = nome;


            opcoes.forEach(function (item) {

                item.classList.remove('selecionada');

            });


            this.classList.add('selecionada');


            dropdown.classList.remove('aberto');

        });

    });


    /* --------------------------------------------------------
       MARCA A OPÇÃO QUE JÁ ESTAVA SELECIONADA
       -------------------------------------------------------- */

    opcoes.forEach(function (opcao) {

        if (opcao.dataset.value === input.value) {

            opcao.classList.add('selecionada');

        }

    });

});



/* ============================================================
   FECHAR DROPDOWN AO CLICAR FORA
   ============================================================ */

document.addEventListener('click', function () {

    document
        .querySelectorAll('.dropdown-apollo')
        .forEach(function (dropdown) {

            dropdown.classList.remove('aberto');

        });

});

</script>


</body>

</html>