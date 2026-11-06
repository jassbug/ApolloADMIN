<?php

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/autenticacao.php';

exigirAdministrador();

/* TOKEN DE SEGURANÇA */

if (empty($_SESSION['csrf_comentarios'])) {
    $_SESSION['csrf_comentarios'] = bin2hex(random_bytes(32));
}

/* MENSAGENS */

$mensagem = $_SESSION['mensagem_comentarios'] ?? '';
$tipoMensagem = $_SESSION['tipo_mensagem_comentarios'] ?? '';

unset(
    $_SESSION['mensagem_comentarios'],
    $_SESSION['tipo_mensagem_comentarios']
);

/* EXCLUIR COMENTÁRIO */

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir_comentario'])) {

    $token = $_POST['csrf_token'] ?? '';
    $comentarioId = filter_input(
        INPUT_POST,
        'comentario_id',
        FILTER_VALIDATE_INT
    );

    if (
        !$token ||
        !hash_equals($_SESSION['csrf_comentarios'], $token)
    ) {

        $_SESSION['mensagem_comentarios'] = 'Solicitação inválida.';
        $_SESSION['tipo_mensagem_comentarios'] = 'danger';

    } elseif (!$comentarioId) {

        $_SESSION['mensagem_comentarios'] = 'Comentário inválido.';
        $_SESSION['tipo_mensagem_comentarios'] = 'danger';

    } else {

        try {

            if (excluirComentarioAdmin($comentarioId)) {
                $_SESSION['mensagem_comentarios'] = 'Comentário excluído com sucesso.';
                $_SESSION['tipo_mensagem_comentarios'] = 'success';
            } else {
                $_SESSION['mensagem_comentarios'] = 'Comentário não encontrado.';
                $_SESSION['tipo_mensagem_comentarios'] = 'warning';
            }

        } catch (PDOException $erro) {

            error_log($erro->getMessage());

            $_SESSION['mensagem_comentarios'] = 'Erro ao excluir o comentário.';
            $_SESSION['tipo_mensagem_comentarios'] = 'danger';
        }
    }

    header('Location: GerenciarComentarios.php');
    exit;
}

/* BUSCA */

$busca = trim($_GET['busca'] ?? '');

$comentarios = buscarComentariosAdmin($busca);

/* COMENTÁRIO SELECIONADO */

$idSelecionado = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

$comentarioDetalhes = null;

if ($idSelecionado) {
    $comentarioDetalhes = buscarComentarioAdminPorId($idSelecionado);
}

if (!$comentarioDetalhes && !empty($comentarios)) {
    $comentarioDetalhes = $comentarios[0];
}

/* FUNÇÃO DE EXIBIÇÃO */

function escaparAdmin($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$totalComentarios = count($comentarios);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gerenciar comentários - Apollo</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="../css/styles.css">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

</head>

<body>

<header>

    <?php include __DIR__ . '/../menu.php'; ?>

</header>

<main class="container-fluid admin-comentarios">

    <!-- CABEÇALHO -->

    <div class="admin-comentarios-cabecalho">

        <div>

            <h1>
                <i class="bi bi-chat-left-text"></i>
                Gerenciar comentários
            </h1>

            <p>
                Consulte e gerencie os comentários publicados no Apollo.
            </p>

        </div>

        <div class="admin-comentarios-total">

            <i class="bi bi-chat-dots"></i>

            <div>

                <strong><?= $totalComentarios ?></strong>

                <span>Comentários encontrados</span>

            </div>

        </div>

    </div>

    <!-- MENSAGEM -->

    <?php if ($mensagem !== ''): ?>

        <div class="alert alert-<?= escaparAdmin($tipoMensagem) ?>">

            <?= escaparAdmin($mensagem) ?>

        </div>

    <?php endif; ?>

    <!-- BUSCA -->

    <form method="GET" class="admin-comentarios-filtros">

        <div class="admin-comentarios-busca">

            <i class="bi bi-search"></i>

            <input
                type="text"
                name="busca"
                placeholder="Buscar por usuário, obra ou comentário..."
                value="<?= escaparAdmin($busca) ?>"
            >

        </div>

        <button type="submit" class="admin-comentarios-btn-buscar">
            Buscar
        </button>

        <a
            href="GerenciarComentarios.php"
            class="admin-comentarios-btn-limpar"
        >
            <i class="bi bi-arrow-counterclockwise"></i>
            Limpar
        </a>

    </form>

    <!-- LISTAGEM E DETALHES -->

    <div class="admin-comentarios-layout">

        <section class="admin-comentarios-lista">

            <div class="admin-comentarios-lista-titulo">

                <h2>Comentários cadastrados</h2>

                <span>
                    <?= $totalComentarios ?> resultado(s)
                </span>

            </div>

            <?php if (!empty($comentarios)): ?>

                <div class="admin-comentarios-tabela">

                    <?php foreach ($comentarios as $comentario): ?>

                        <a
                            href="GerenciarComentarios.php?id=<?= (int) $comentario['id'] ?>&busca=<?= urlencode($busca) ?>"
                            class="admin-comentario-item <?= $comentarioDetalhes && (int) $comentarioDetalhes['id'] === (int) $comentario['id'] ? 'selecionado' : '' ?>"
                        >

                            <!-- OBRA -->

                            <div class="admin-comentario-obra">

                                <?php if (!empty($comentario['capa_obra'])): ?>

                                    <img
                                        src="<?= escaparAdmin($comentario['capa_obra']) ?>"
                                        alt="Capa da obra"
                                    >

                                <?php else: ?>

                                    <div class="admin-comentario-sem-imagem">
                                        <i class="bi bi-film"></i>
                                    </div>

                                <?php endif; ?>

                                <span>
                                    <?= escaparAdmin($comentario['titulo_obra']) ?>
                                </span>

                            </div>

                            <!-- USUÁRIO -->

                            <div class="admin-comentario-usuario">

                                <?php if (!empty($comentario['foto_usuario'])): ?>

                                    <img
                                        src="<?= escaparAdmin($comentario['foto_usuario']) ?>"
                                        alt="Foto do usuário"
                                    >

                                <?php else: ?>

                                    <div class="admin-comentario-avatar">
                                        <i class="bi bi-person"></i>
                                    </div>

                                <?php endif; ?>

                                <span>
                                    <?= escaparAdmin($comentario['nome_usuario']) ?>
                                </span>

                            </div>

                            <!-- TEXTO -->

                            <div class="admin-comentario-texto">

                                <?= escaparAdmin($comentario['comentario']) ?>

                            </div>

                            <!-- DATA -->

                            <div class="admin-comentario-data">

                                <i class="bi bi-calendar3"></i>

                                <?= date(
                                    'd/m/Y H:i',
                                    strtotime($comentario['data_criacao'])
                                ) ?>

                            </div>

                            <!-- ÍCONE DE VISUALIZAÇÃO -->

                            <div class="admin-comentario-acoes">

                                <i class="bi bi-eye" title="Visualizar detalhes"></i>

                            </div>

                        </a>

                    <?php endforeach; ?>

                </div>

            <?php else: ?>

                <div class="admin-comentarios-vazio">

                    <i class="bi bi-chat-square-text"></i>

                    <h3>Nenhum comentário encontrado</h3>

                    <p>
                        Não existem comentários correspondentes à sua busca.
                    </p>

                </div>

            <?php endif; ?>

        </section>

        <!-- PAINEL DE DETALHES -->

        <aside class="admin-comentarios-detalhes">

            <h2>Detalhes do comentário</h2>

            <?php if ($comentarioDetalhes): ?>

                <div class="admin-comentario-detalhe-obra">

                    <?php if (!empty($comentarioDetalhes['capa_obra'])): ?>

                        <img
                            src="<?= escaparAdmin($comentarioDetalhes['capa_obra']) ?>"
                            alt="Capa da obra"
                        >

                    <?php endif; ?>

                    <div>

                        <span>Obra</span>

                        <strong>
                            <?= escaparAdmin($comentarioDetalhes['titulo_obra']) ?>
                        </strong>

                    </div>

                </div>

                <div class="admin-comentario-detalhe-usuario">

                    <?php if (!empty($comentarioDetalhes['foto_usuario'])): ?>

                        <img
                            src="<?= escaparAdmin($comentarioDetalhes['foto_usuario']) ?>"
                            alt="Foto do usuário"
                        >

                    <?php else: ?>

                        <div class="admin-comentario-avatar">
                            <i class="bi bi-person"></i>
                        </div>

                    <?php endif; ?>

                    <div>

                        <span>Usuário</span>

                        <strong>
                            <?= escaparAdmin($comentarioDetalhes['nome_usuario']) ?>
                        </strong>

                    </div>

                </div>

                <div class="admin-comentario-detalhe-data">

                    <span>Data do comentário</span>

                    <strong>
                        <?= date(
                            'd/m/Y H:i',
                            strtotime($comentarioDetalhes['data_criacao'])
                        ) ?>
                    </strong>

                </div>

                <div class="admin-comentario-detalhe-texto">

                    <span>Conteúdo</span>

                    <p>
                        <?= nl2br(escaparAdmin($comentarioDetalhes['comentario'])) ?>
                    </p>

                </div>

                <!-- EXCLUIR -->

                <div class="admin-comentario-detalhe-acoes">

                    <h3>Ações</h3>

                    <form
                        method="POST"
                        onsubmit="return confirm('Tem certeza de que deseja excluir este comentário? Esta ação não pode ser desfeita.');"
                    >

                        <input
                            type="hidden"
                            name="comentario_id"
                            value="<?= (int) $comentarioDetalhes['id'] ?>"
                        >

                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?= escaparAdmin($_SESSION['csrf_comentarios']) ?>"
                        >

                        <button
                            type="submit"
                            name="excluir_comentario"
                            class="admin-comentario-btn-excluir"
                        >

                            <i class="bi bi-trash3"></i>

                            Excluir comentário

                        </button>

                    </form>

                </div>

            <?php else: ?>

                <div class="admin-comentarios-detalhes-vazio">

                    <i class="bi bi-chat-square-text"></i>

                    <p>
                        Selecione um comentário para visualizar seus detalhes.
                    </p>

                </div>

            <?php endif; ?>

        </aside>

    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
