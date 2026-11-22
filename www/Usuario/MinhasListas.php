<?php

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/autenticacao.php';

exigirLogin();

$conexao = conectarBanco();
$usuarioId = idUsuarioLogado();

/* TOKEN DE SEGURANÇA */

if (empty($_SESSION['csrf_listas'])) {
    $_SESSION['csrf_listas'] = bin2hex(random_bytes(32));
}

/* MENSAGENS */

$mensagem = $_SESSION['mensagem_listas'] ?? '';
$tipoMensagem = $_SESSION['tipo_mensagem_listas'] ?? '';

unset(
    $_SESSION['mensagem_listas'],
    $_SESSION['tipo_mensagem_listas']
);

/* CRIAR OU EXCLUIR LISTA */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $token = $_POST['csrf_token'] ?? '';

    if (
        empty($token) ||
        !hash_equals($_SESSION['csrf_listas'], $token)
    ) {

        $_SESSION['mensagem_listas'] = 'Solicitação inválida.';
        $_SESSION['tipo_mensagem_listas'] = 'danger';

    } else {

        /* CRIAR LISTA */

        if (isset($_POST['criar_lista'])) {

            $nomeLista = trim($_POST['nome_lista'] ?? '');

            if ($nomeLista === '') {

                $_SESSION['mensagem_listas'] = 'Digite o nome da lista.';
                $_SESSION['tipo_mensagem_listas'] = 'danger';

            } elseif (strlen($nomeLista) > 100) {

                $_SESSION['mensagem_listas'] = 'O nome deve ter no máximo 100 caracteres.';
                $_SESSION['tipo_mensagem_listas'] = 'danger';

            } else {

                try {

                    $consulta = $conexao->prepare("
                        INSERT INTO listas_usuario (usuario_id, nome)
                        VALUES (:usuario_id, :nome)
                    ");

                    $consulta->execute([
                        ':usuario_id' => $usuarioId,
                        ':nome' => $nomeLista
                    ]);

                    $_SESSION['mensagem_listas'] = 'Lista criada com sucesso!';
                    $_SESSION['tipo_mensagem_listas'] = 'success';

                } catch (PDOException $erro) {

                    error_log($erro->getMessage());

                    $_SESSION['mensagem_listas'] = 'Não foi possível criar a lista.';
                    $_SESSION['tipo_mensagem_listas'] = 'danger';
                }
            }
        }

        /* EXCLUIR LISTA */

        elseif (isset($_POST['excluir_lista'])) {

            $listaId = filter_input(
                INPUT_POST,
                'lista_id',
                FILTER_VALIDATE_INT
            );

            if (!$listaId) {

                $_SESSION['mensagem_listas'] = 'Lista inválida.';
                $_SESSION['tipo_mensagem_listas'] = 'danger';

            } else {

                try {

                    $consulta = $conexao->prepare("
                        DELETE FROM listas_usuario
                        WHERE id = :id
                          AND usuario_id = :usuario_id
                    ");

                    $consulta->execute([
                        ':id' => $listaId,
                        ':usuario_id' => $usuarioId
                    ]);

                    if ($consulta->rowCount() > 0) {

                        $_SESSION['mensagem_listas'] = 'Lista excluída com sucesso!';
                        $_SESSION['tipo_mensagem_listas'] = 'success';

                    } else {

                        $_SESSION['mensagem_listas'] = 'Lista não encontrada.';
                        $_SESSION['tipo_mensagem_listas'] = 'warning';
                    }

                } catch (PDOException $erro) {

                    error_log($erro->getMessage());

                    $_SESSION['mensagem_listas'] = 'Não foi possível excluir a lista.';
                    $_SESSION['tipo_mensagem_listas'] = 'danger';
                }
            }
        }
    }

    header('Location: MinhasListas.php');
    exit;
}

/* BUSCAR LISTAS DO USUÁRIO */

$consulta = $conexao->prepare("
    SELECT
        listas_usuario.id,
        listas_usuario.nome,
        listas_usuario.data_criacao,
        COUNT(itens_lista.id) AS quantidade_obras
    FROM listas_usuario
    LEFT JOIN itens_lista
        ON listas_usuario.id = itens_lista.lista_id
    WHERE listas_usuario.usuario_id = :usuario_id
    GROUP BY
        listas_usuario.id,
        listas_usuario.nome,
        listas_usuario.data_criacao
    ORDER BY listas_usuario.id ASC
");

$consulta->execute([
    ':usuario_id' => $usuarioId
]);

$listas = $consulta->fetchAll(PDO::FETCH_ASSOC);

/* PROTEÇÃO DE TEXTO */

function escaparLista($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Minhas Listas - Apollo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/styles.css">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<header>

    <?php include __DIR__ . '/../menu.php'; ?>

</header>

<main class="container py-5">

    <!-- CABEÇALHO -->

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>

            <h1 class="mb-2">Minhas listas</h1>

            <p class="text-secondary mb-0">
                Organize seus filmes, séries e animes.
            </p>

        </div>

        <button
            class="btn-criar-lista"
            data-bs-toggle="modal"
            data-bs-target="#modalLista">

            <i class="bi bi-plus-lg"></i>
            Criar lista

        </button>

    </div>

    <!-- MENSAGEM -->

    <?php if ($mensagem !== ''): ?>

        <div class="alert alert-<?= escaparLista($tipoMensagem) ?>">

            <?= escaparLista($mensagem) ?>

        </div>

    <?php endif; ?>

    <!-- LISTAS -->

    <?php if (!empty($listas)): ?>

        <div class="listas-box">

            <?php foreach ($listas as $lista): ?>

                <div class="lista-opcao">

                    <a
                        href="Lista.php?id=<?= (int) $lista['id'] ?>"
                        class="text-decoration-none">

                        <strong>
                            <?= escaparLista($lista['nome']) ?>
                        </strong>

                        <span>
                            <?= (int) $lista['quantidade_obras'] ?>
                            <?= (int) $lista['quantidade_obras'] === 1
                                ? 'obra'
                                : 'obras' ?>
                        </span>

                    </a>

                    <form
                        method="POST"
                        onsubmit="return confirm('Tem certeza de que deseja excluir esta lista? Todas as obras adicionadas a ela também serão removidas da lista.');">

                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?= escaparLista($_SESSION['csrf_listas']) ?>">

                        <input
                            type="hidden"
                            name="lista_id"
                            value="<?= (int) $lista['id'] ?>">

                        <button
                            type="submit"
                            name="excluir_lista"
                            class="btn btn-sm btn-outline-danger"
                            title="Excluir lista">

                            <i class="bi bi-trash"></i>

                        </button>

                    </form>

                </div>

            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <div class="text-center py-5">

            <i class="bi bi-collection fs-1"></i>

            <h3 class="mt-3">Você ainda não possui listas</h3>

            <p class="text-secondary">
                Crie sua primeira lista para organizar suas obras.
            </p>

        </div>

    <?php endif; ?>

</main>

<!-- MODAL CRIAR LISTA -->

<div class="modal fade" id="modalLista" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content bg-dark text-white border border-primary">

            <form method="POST">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Criar lista
                    </h5>

                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <input
                        type="hidden"
                        name="csrf_token"
                        value="<?= escaparLista($_SESSION['csrf_listas']) ?>">

                    <label class="form-label" for="nome_lista">
                        Nome da lista
                    </label>

                    <input
                        type="text"
                        id="nome_lista"
                        name="nome_lista"
                        class="form-control"
                        placeholder="Digite o nome da lista"
                        maxlength="100"
                        required>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancelar

                    </button>

                    <button
                        type="submit"
                        name="criar_lista"
                        class="btn btn-primary">

                        <i class="bi bi-plus-lg"></i>
                        Criar lista

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
