<?php

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/autenticacao.php';

exigirAdministrador();

$mensagem = '';
$tipoMensagem = '';

$titulo = '';
$descricao = '';
$link = '';


// ============================================================
// CADASTRAR AVISO
// ============================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = trim($_POST['titulo'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $link = trim($_POST['link'] ?? '');

    // --------------------------------------------------------
    // VALIDAÇÕES
    // --------------------------------------------------------

    if (empty($titulo)) {

        $mensagem = 'Informe o título do aviso.';
        $tipoMensagem = 'erro';

    } elseif (empty($descricao)) {

        $mensagem = 'Informe a descrição do aviso.';
        $tipoMensagem = 'erro';

    } elseif (
        !empty($link) &&
        !filter_var($link, FILTER_VALIDATE_URL)
    ) {

        $mensagem = 'Informe um link válido.';
        $tipoMensagem = 'erro';

    }


    // --------------------------------------------------------
    // UPLOAD DA IMAGEM
    // --------------------------------------------------------

    $imagem = '';

    if (empty($mensagem)) {

        if (
            !isset($_FILES['imagem']) ||
            $_FILES['imagem']['error'] === UPLOAD_ERR_NO_FILE
        ) {

            $mensagem = 'Selecione uma imagem para o aviso.';
            $tipoMensagem = 'erro';

        } elseif ($_FILES['imagem']['error'] !== UPLOAD_ERR_OK) {

            $mensagem = 'Não foi possível enviar a imagem.';
            $tipoMensagem = 'erro';

        } elseif ($_FILES['imagem']['size'] > 5 * 1024 * 1024) {

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
                $_FILES['imagem']['tmp_name']
            );


            if (!isset($tiposPermitidos[$tipoArquivo])) {

                $mensagem = 'Envie apenas imagens JPG, PNG ou WEBP.';
                $tipoMensagem = 'erro';

            } else {

                $pastaAvisos = __DIR__ . '/../img/avisos';


                if (!is_dir($pastaAvisos)) {

                    mkdir(
                        $pastaAvisos,
                        0755,
                        true
                    );
                }


                $nomeArquivo =
                    uniqid('aviso_', true)
                    . '.'
                    . $tiposPermitidos[$tipoArquivo];


                $caminhoArquivo =
                    $pastaAvisos
                    . DIRECTORY_SEPARATOR
                    . $nomeArquivo;


                if (
                    !move_uploaded_file(
                        $_FILES['imagem']['tmp_name'],
                        $caminhoArquivo
                    )
                ) {

                    $mensagem = 'Não foi possível salvar a imagem.';
                    $tipoMensagem = 'erro';

                } else {

                    $imagem = '/img/avisos/' . $nomeArquivo;
                }
            }
        }
    }


    // --------------------------------------------------------
    // SALVAR NO BANCO
    // --------------------------------------------------------

    if (empty($mensagem)) {

        $resultado = cadastrarAviso(
            $titulo,
            $descricao,
            $imagem,
            $link
        );


        if ($resultado['sucesso']) {

            header(
                'Location: /adm/GerenciarAvisos.php?cadastro=sucesso'
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
        content="width=device-width, initial-scale=1.0"
    >

    <title>Adicionar aviso - Apollo</title>


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


    <!-- CSS Apollo -->

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

    <div class="cabecalho-pagina-admin">

        <div>

            <p class="hero-etiqueta mb-2">

                <i class="bi bi-megaphone"></i>

                CONTROLE DO SITE

            </p>


            <h1>
                Adicionar aviso
            </h1>


            <p class="texto-cabecalho-admin">

                Crie um novo aviso para exibir no Apollo.

            </p>

        </div>


        <a
            href="GerenciarAvisos.php"
            class="botao-voltar-admin"
        >

            <i class="bi bi-arrow-left"></i>

            Voltar

        </a>

    </div>


    <!-- =====================================================
         MENSAGEM
    ====================================================== -->

    <?php if (!empty($mensagem)): ?>

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
         FORMULÁRIO
    ====================================================== -->

    <form
        method="POST"
        enctype="multipart/form-data"
        class="formulario-aviso-admin"
    >


        <!-- =================================================
             INFORMAÇÕES
        ================================================== -->

        <section class="admin-form-card">

            <div class="admin-form-card-cabecalho">

                <div>

                    <span class="etiqueta-form-admin">
                        INFORMAÇÕES DO AVISO
                    </span>

                    <h2>
                        Conteúdo
                    </h2>

                    <p>
                        Informe o título e a descrição que serão
                        apresentados aos usuários.
                    </p>

                </div>

            </div>


            <div class="admin-form-card-corpo">


                <!-- TÍTULO -->

                <div class="campo-formulario-admin">

                    <label for="titulo">
                        Título
                    </label>

                    <input
                        type="text"
                        id="titulo"
                        name="titulo"
                        value="<?= e($titulo) ?>"
                        maxlength="150"
                        placeholder="Ex.: Novidades no Apollo"
                        required
                    >

                    <span class="texto-ajuda-admin">
                        Dê um título curto e claro para o aviso.
                    </span>

                </div>


                <!-- DESCRIÇÃO -->

                <div class="campo-formulario-admin">

                    <label for="descricao">
                        Descrição
                    </label>

                    <textarea
                        id="descricao"
                        name="descricao"
                        maxlength="1000"
                        placeholder="Digite a mensagem que será apresentada aos usuários..."
                        required
                    ><?= e($descricao) ?></textarea>

                    <span class="texto-ajuda-admin">
                        Explique brevemente o conteúdo do aviso.
                    </span>

                </div>


                <!-- LINK -->

                <div class="campo-formulario-admin">

                    <label for="link">
                        Link
                        <span class="campo-opcional">
                            opcional
                        </span>
                    </label>

                    <div class="campo-com-icone-admin">

                        <i class="bi bi-link-45deg"></i>

                        <input
                            type="url"
                            id="link"
                            name="link"
                            value="<?= e($link) ?>"
                            maxlength="500"
                            placeholder="https://..."
                        >

                    </div>

                    <span class="texto-ajuda-admin">
                        Caso o aviso leve o usuário para outra página,
                        informe o endereço aqui.
                    </span>

                </div>

            </div>

        </section>


        <!-- =================================================
             IMAGEM
        ================================================== -->

        <section class="admin-form-card">

            <div class="admin-form-card-cabecalho">

                <div>

                    <span class="etiqueta-form-admin">
                        IMAGEM
                    </span>

                    <h2>
                        Imagem do aviso
                    </h2>

                    <p>
                        Escolha uma imagem para ilustrar o aviso.
                    </p>

                </div>

            </div>


            <div class="admin-form-card-corpo">


                <div class="upload-aviso-admin">


                    <!-- PREVIEW -->

                    <div
                        class="preview-imagem-aviso"
                        id="previewImagem"
                    >

                        <div class="preview-vazio-aviso">

                            <i class="bi bi-image"></i>

                            <span>
                                Pré-visualização
                            </span>

                        </div>

                    </div>


                    <!-- UPLOAD -->

                    <div class="area-upload-aviso">

                        <label
                            for="imagem"
                            class="botao-upload-aviso"
                        >

                            <i class="bi bi-cloud-arrow-up"></i>

                            Escolher imagem

                        </label>


                        <input
                            type="file"
                            id="imagem"
                            name="imagem"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            required
                        >


                        <p class="texto-upload-aviso">

                            JPG, PNG ou WEBP.
                            Tamanho máximo: 5 MB.

                        </p>

                    </div>

                </div>

            </div>

        </section>


        <!-- =================================================
             BOTÕES
        ================================================== -->

        <div class="acoes-formulario-admin">

            <a
                href="GerenciarAvisos.php"
                class="botao-cancelar-admin"
            >

                <i class="bi bi-x-lg"></i>

                Cancelar

            </a>


            <button
                type="submit"
                class="botao-salvar-admin"
            >

                <i class="bi bi-check-lg"></i>

                Cadastrar aviso

            </button>

        </div>


    </form>

</main>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
></script>


<script>

const inputImagem = document.getElementById('imagem');
const previewImagem = document.getElementById('previewImagem');

inputImagem.addEventListener('change', function () {

    const arquivo = this.files[0];

    if (!arquivo) {

        previewImagem.innerHTML = `
            <div class="preview-vazio-aviso">

                <i class="bi bi-image"></i>

                <span>
                    Pré-visualização
                </span>

            </div>
        `;

        return;
    }


    const leitor = new FileReader();


    leitor.onload = function (evento) {

        previewImagem.innerHTML = `
            <img
                src="${evento.target.result}"
                alt="Pré-visualização da imagem"
            >
        `;
    };


    leitor.readAsDataURL(arquivo);

});

</script>

</body>

</html>