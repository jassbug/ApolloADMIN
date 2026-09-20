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
    // EDITAR USUÁRIO
    // --------------------------------------------------------

    if ($acao === 'editar') {

        $id = (int) ($_POST['id'] ?? 0);
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $tipo = $_POST['tipo'] ?? 'usuario';
        $emailVerificado = isset($_POST['email_verificado']) ? 1 : 0;
        $bio = $_POST['bio'] ?? '';

        $resultado = atualizarUsuario(
            $id,
            $nome,
            $email,
            $tipo,
            $emailVerificado,
            $bio
        );

        $mensagem = $resultado['mensagem'];
        $tipoMensagem = $resultado['sucesso'] ? 'sucesso' : 'erro';
    }

    // --------------------------------------------------------
    // EXCLUIR USUÁRIO
    // --------------------------------------------------------

    if ($acao === 'excluir') {

        $id = (int) ($_POST['id'] ?? 0);

        $resultado = excluirUsuario($id);

        $mensagem = $resultado['mensagem'];
        $tipoMensagem = $resultado['sucesso'] ? 'sucesso' : 'erro';
    }
}

// ============================================================
// FILTROS
// ============================================================

$busca = trim($_GET['busca'] ?? '');
$filtroTipo = $_GET['tipo'] ?? '';
$filtroVerificado = $_GET['verificado'] ?? '';

$usuarios = buscarTodosUsuarios();

// Aplica os filtros
$usuariosFiltrados = array_filter(
    $usuarios,
    function ($usuario) use ($busca, $filtroTipo, $filtroVerificado) {

        // Busca por nome ou e-mail
        if ($busca !== '') {

            $textoBusca = mb_strtolower($busca, 'UTF-8');

            $nome = mb_strtolower($usuario['nome'] ?? '', 'UTF-8');
            $email = mb_strtolower($usuario['email'] ?? '', 'UTF-8');

            if (
                mb_strpos($nome, $textoBusca, 0, 'UTF-8') === false &&
                mb_strpos($email, $textoBusca, 0, 'UTF-8') === false
            ) {
                return false;
            }
        }

        // Filtro por tipo
        if ($filtroTipo !== '') {

            if (($usuario['tipo'] ?? '') !== $filtroTipo) {
                return false;
            }
        }

        // Filtro por e-mail verificado
        if ($filtroVerificado !== '') {

            $verificado = (int) ($usuario['email_verificado'] ?? 0);

            if ($filtroVerificado === '1' && $verificado !== 1) {
                return false;
            }

            if ($filtroVerificado === '0' && $verificado !== 0) {
                return false;
            }
        }

        return true;
    }
);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gerenciar Usuários - Apollo</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
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

    <div class="admin-cabecalho">

        <h1>
            <i class="bi bi-people"></i>
            Gerenciar Usuários
        </h1>

        <p>
            Visualize e gerencie os usuários cadastrados no Apollo.
        </p>

    </div>


    <?php if ($mensagem !== ''): ?>

        <div class="mensagem-admin <?= $tipoMensagem === 'sucesso' ? 'mensagem-sucesso' : 'mensagem-erro' ?>">

            <i class="bi <?= $tipoMensagem === 'sucesso' ? 'bi-check-circle' : 'bi-exclamation-circle' ?>"></i>

            <?= e($mensagem) ?>

        </div>

    <?php endif; ?>


    <section class="admin-secao">

        <!-- =================================================
             FILTROS
        ================================================== -->

        <form method="GET" class="filtros-usuarios">

            <div class="campo-filtro">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    name="busca"
                    placeholder="Buscar por nome ou e-mail..."
                    value="<?= e($busca) ?>"
                >

            </div>


            <div class="campo-filtro">

                <select name="tipo">

                    <option value="">Todos os tipos</option>

                    <option
                        value="usuario"
                        <?= $filtroTipo === 'usuario' ? 'selected' : '' ?>
                    >
                        Usuários
                    </option>

                    <option
                        value="admin"
                        <?= $filtroTipo === 'admin' ? 'selected' : '' ?>
                    >
                        Administradores
                    </option>

                </select>

            </div>


            <div class="campo-filtro">

                <select name="verificado">

                    <option value="">Todos os e-mails</option>

                    <option
                        value="1"
                        <?= $filtroVerificado === '1' ? 'selected' : '' ?>
                    >
                        Verificados
                    </option>

                    <option
                        value="0"
                        <?= $filtroVerificado === '0' ? 'selected' : '' ?>
                    >
                        Não verificados
                    </option>

                </select>

            </div>


            <div>

                <a
                    href="GerenciarUsuarios.php"
                    class="botao-limpar"
                >
                    <i class="bi bi-x-lg"></i>
                    Limpar
                </a>

            </div>

        </form>


        <!-- =================================================
             CONTADOR
        ================================================== -->

        <div class="usuarios-info">

            <span>
                Exibindo
                <strong><?= count($usuariosFiltrados) ?></strong>
                de
                <strong><?= count($usuarios) ?></strong>
                usuários
            </span>

        </div>


        <!-- =================================================
             TABELA
        ================================================== -->

        <div class="tabela-usuarios">

            <div class="tabela-usuarios-cabecalho">

                <div>Usuário</div>
                <div>E-mail</div>
                <div>Tipo</div>
                <div>Verificação</div>
                <div class="coluna-data">Cadastro</div>
                <div>Ações</div>

            </div>


            <?php if (empty($usuariosFiltrados)): ?>

                <div class="sem-usuarios">

                    <i class="bi bi-person-x"></i>

                    <div>
                        Nenhum usuário encontrado.
                    </div>

                </div>

            <?php else: ?>

                <?php foreach ($usuariosFiltrados as $usuario): ?>

                    <?php

                    $id = (int) $usuario['id'];

                    $nome = $usuario['nome'] ?? '';
                    $email = $usuario['email'] ?? '';
                    $tipo = $usuario['tipo'] ?? 'usuario';

                    $verificado = (int) ($usuario['email_verificado'] ?? 0);

                    $foto = $usuario['foto'] ?? null;
                    $bio = $usuario['bio'] ?? '';

                    $criadoEm = $usuario['criado_em'] ?? null;

                    $inicial = mb_strtoupper(
                        mb_substr($nome, 0, 1, 'UTF-8'),
                        'UTF-8'
                    );

                    ?>

                    <div class="tabela-usuarios-linha">

                        <!-- USUÁRIO -->

                        <div class="usuario-nome">

                            <div class="usuario-avatar">

                                <?php if (!empty($foto)): ?>

                                    <img
                                        src="<?= e($foto) ?>"
                                        alt="Foto de <?= e($nome) ?>"
                                    >

                                <?php else: ?>

                                    <?= e($inicial) ?>

                                <?php endif; ?>

                            </div>


                            <div class="usuario-nome-texto">

                                <strong>
                                    <?= e($nome) ?>
                                </strong>

                                <span class="usuario-id">
                                    ID #<?= $id ?>
                                </span>

                            </div>

                        </div>


                        <!-- E-MAIL -->

                        <div class="usuario-email">

                            <?= e($email) ?>

                        </div>


                        <!-- TIPO -->

                        <div>

                            <?php if ($tipo === 'admin'): ?>

                                <span class="badge-tipo badge-admin">
                                    <i class="bi bi-shield-lock"></i>
                                    Admin
                                </span>

                            <?php else: ?>

                                <span class="badge-tipo badge-usuario">
                                    <i class="bi bi-person"></i>
                                    Usuário
                                </span>

                            <?php endif; ?>

                        </div>


                        <!-- VERIFICAÇÃO -->

                        <div>

                            <?php if ($verificado === 1): ?>

                                <span class="badge-verificado">
                                    <i class="bi bi-check-circle"></i>
                                    Verificado
                                </span>

                            <?php else: ?>

                                <span class="badge-nao-verificado">
                                    <i class="bi bi-x-circle"></i>
                                    Pendente
                                </span>

                            <?php endif; ?>

                        </div>


                        <!-- DATA -->

                        <div class="coluna-data data-cadastro">

                            <?php

                            if (!empty($criadoEm)) {
                                echo date('d/m/Y', strtotime($criadoEm));
                            } else {
                                echo '-';
                            }

                            ?>

                        </div>


                        <!-- AÇÕES -->

                        <div class="acoes-usuario">

                            <button
                                type="button"
                                class="botao-acao-usuario botao-visualizar"
                                title="Visualizar"
                                data-bs-toggle="modal"
                                data-bs-target="#modalVisualizar<?= $id ?>"
                            >
                                <i class="bi bi-eye"></i>
                            </button>


                            <button
                                type="button"
                                class="botao-acao-usuario botao-editar"
                                title="Editar"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditar<?= $id ?>"
                            >
                                <i class="bi bi-pencil"></i>
                            </button>


                            <button
                                type="button"
                                class="botao-acao-usuario botao-excluir"
                                title="Excluir"
                                data-bs-toggle="modal"
                                data-bs-target="#modalExcluir<?= $id ?>"
                            >
                                <i class="bi bi-trash"></i>
                            </button>

                        </div>

                    </div>


                    <!-- =================================================
                         MODAL VISUALIZAR
                    ================================================== -->

                    <div
                        class="modal fade modal-apollo"
                        id="modalVisualizar<?= $id ?>"
                        tabindex="-1"
                        aria-hidden="true"
                    >

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title">
                                        <i class="bi bi-person-circle"></i>
                                        Dados do usuário
                                    </h5>

                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                    ></button>

                                </div>


                                <div class="modal-body">

                                    <div class="dados-visualizacao">

                                        <div class="dado-usuario">

                                            <span class="dado-usuario-label">
                                                ID
                                            </span>

                                            <div class="dado-usuario-valor">
                                                #<?= $id ?>
                                            </div>

                                        </div>


                                        <div class="dado-usuario">

                                            <span class="dado-usuario-label">
                                                Nome
                                            </span>

                                            <div class="dado-usuario-valor">
                                                <?= e($nome) ?>
                                            </div>

                                        </div>


                                        <div class="dado-usuario">

                                            <span class="dado-usuario-label">
                                                E-mail
                                            </span>

                                            <div class="dado-usuario-valor">
                                                <?= e($email) ?>
                                            </div>

                                        </div>


                                        <div class="dado-usuario">

                                            <span class="dado-usuario-label">
                                                Tipo de conta
                                            </span>

                                            <div class="dado-usuario-valor">

                                                <?php if ($tipo === 'admin'): ?>

                                                    <span class="badge-tipo badge-admin">
                                                        Administrador
                                                    </span>

                                                <?php else: ?>

                                                    <span class="badge-tipo badge-usuario">
                                                        Usuário
                                                    </span>

                                                <?php endif; ?>

                                            </div>

                                        </div>


                                        <div class="dado-usuario">

                                            <span class="dado-usuario-label">
                                                E-mail verificado
                                            </span>

                                            <div class="dado-usuario-valor">

                                                <?php if ($verificado === 1): ?>

                                                    <span class="badge-verificado">
                                                        <i class="bi bi-check-circle"></i>
                                                        Sim
                                                    </span>

                                                <?php else: ?>

                                                    <span class="badge-nao-verificado">
                                                        <i class="bi bi-x-circle"></i>
                                                        Não
                                                    </span>

                                                <?php endif; ?>

                                            </div>

                                        </div>


                                        <div class="dado-usuario">

                                            <span class="dado-usuario-label">
                                                Bio
                                            </span>

                                            <div class="dado-usuario-valor">

                                                <?php if ($bio !== ''): ?>

                                                    <?= nl2br(e($bio)) ?>

                                                <?php else: ?>

                                                    <span style="color:#777;">
                                                        Nenhuma bio cadastrada.
                                                    </span>

                                                <?php endif; ?>

                                            </div>

                                        </div>


                                        <div class="dado-usuario">

                                            <span class="dado-usuario-label">
                                                Cadastrado em
                                            </span>

                                            <div class="dado-usuario-valor">

                                                <?php

                                                if (!empty($criadoEm)) {

                                                    echo date(
                                                        'd/m/Y \à\s H:i',
                                                        strtotime($criadoEm)
                                                    );

                                                } else {

                                                    echo '-';

                                                }

                                                ?>

                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class="modal-footer">

                                    <button
                                        type="button"
                                        class="btn botao-modal-cancelar"
                                        data-bs-dismiss="modal"
                                    >
                                        Fechar
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         MODAL EDITAR
                    ================================================== -->

                    <div
                        class="modal fade modal-apollo"
                        id="modalEditar<?= $id ?>"
                        tabindex="-1"
                        aria-hidden="true"
                    >

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <form method="POST">

                                    <div class="modal-header">

                                        <h5 class="modal-title">
                                            <i class="bi bi-pencil-square"></i>
                                            Editar usuário
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
                                                Nome
                                            </label>

                                            <input
                                                type="text"
                                                name="nome"
                                                value="<?= e($nome) ?>"
                                                maxlength="120"
                                                required
                                            >

                                        </div>


                                        <div class="campo-admin">

                                            <label>
                                                E-mail
                                            </label>

                                            <input
                                                type="email"
                                                name="email"
                                                value="<?= e($email) ?>"
                                                maxlength="150"
                                                required
                                            >

                                        </div>


                                        <div class="campo-admin">

                                            <label>
                                                Tipo de conta
                                            </label>

                                            <select name="tipo">

                                                <option
                                                    value="usuario"
                                                    <?= $tipo === 'usuario' ? 'selected' : '' ?>
                                                >
                                                    Usuário
                                                </option>

                                                <option
                                                    value="admin"
                                                    <?= $tipo === 'admin' ? 'selected' : '' ?>
                                                >
                                                    Administrador
                                                </option>

                                            </select>

                                        </div>


                                        <div class="campo-admin">

                                            <label>
                                                Bio
                                            </label>

                                            <textarea
                                                name="bio"
                                                maxlength="255"
                                                placeholder="Bio do usuário..."
                                            ><?= e($bio) ?></textarea>

                                        </div>


                                        <div class="campo-admin">

                                            <label class="check-admin">

                                                <input
                                                    type="checkbox"
                                                    name="email_verificado"
                                                    value="1"
                                                    <?= $verificado === 1 ? 'checked' : '' ?>
                                                >

                                                E-mail verificado

                                            </label>

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
                        id="modalExcluir<?= $id ?>"
                        tabindex="-1"
                        aria-hidden="true"
                    >

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <form method="POST">

                                    <div class="modal-header">

                                        <h5 class="modal-title">
                                            <i class="bi bi-exclamation-triangle"></i>
                                            Excluir usuário
                                        </h5>

                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                        ></button>

                                    </div>


                                    <div class="modal-body">

                                        <p style="color:#ddd; margin-bottom:8px;">
                                            Tem certeza que deseja excluir este usuário?
                                        </p>

                                        <strong>
                                            <?= e($nome) ?>
                                        </strong>

                                        <p style="color:#888; margin-top:12px; margin-bottom:0;">
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
                                            Excluir usuário
                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

    </section>

</main>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
></script>

</body>

</html>