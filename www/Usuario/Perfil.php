<?php

require_once __DIR__ . '/../includes/autenticacao.php';

exigirLogin();

$usuario = usuarioAtual();

$inicial = strtoupper(substr($usuario['nome'], 0, 1));
$tipoConta = $usuario['tipo'] === 'admin' ? 'Administrador' : 'Usuário';

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Meu perfil | Apollo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>

    <header>
        <?php include '../menu.php'; ?>
    </header>

    <main class="container pagina-perfil">

        <section class="cabecalho-perfil">

            <div>

                <p class="etiqueta-autenticacao">
                    <i class="bi bi-person-circle"></i> MINHA CONTA
                </p>

                <h1>Olá, <?= e($usuario['nome']) ?>.</h1>

                <p>Este é o seu espaço no Apollo.</p>

            </div>

            <button
                type="button"
                class="btn botao-roxo"
                data-bs-toggle="modal"
                data-bs-target="#modalEditarPerfil"

                <i class="bi bi-pencil-square"></i>
                Editar perfil
            </button>

        </section>

        <section class="cartao-perfil">

            <div class="foto-perfil">

                <?php if (!empty($usuario['foto'])): ?>

                    <img
                        src="<?= e($usuario['foto']) ?>"
                        alt="Foto de <?= e($usuario['nome']) ?>">

                <?php else: ?>

                    <span><?= e($inicial) ?></span>

                <?php endif; ?>

            </div>

            <div class="dados-perfil">

                <div class="nome-perfil">
                    <h2><?= e($usuario['nome']) ?></h2>
                    <span class="selo-tipo <?= $usuario['tipo'] === 'admin' ? 'administrador' : '' ?>">
                        <i class="bi <?= $usuario['tipo'] === 'admin' ? 'bi-shield-lock' : 'bi-person' ?>"></i>
                        <?= $tipoConta ?>
                    </span>
                </div>

                <p class="email-perfil">
                    <i class="bi bi-envelope"></i>
                    <?= e($usuario['email']) ?>
                </p>

                <p class="bio-perfil">
                    <?= !empty($usuario['bio'])
                        ? e($usuario['bio'])
                        : 'Você ainda não adicionou uma biografia.' ?>
                </p>

            </div>

        </section>

        <section class="row g-4 mt-1">

            <div class="col-md-6">

                <article class="card painel-perfil h-100">
                    <div class="card-body">

                        <div class="icone-painel">
                            <i class="bi bi-collection-play"></i>
                        </div>

                        <h2>Minhas listas</h2>

                        <p>
                            Organize filmes, séries e animes para assistir depois.
                        </p>

                        <a href="Listas.php" class="link-secao">
                            Ver minhas listas
                            <i class="bi bi-arrow-right"></i>
                        </a>

                    </div>
                </article>

            </div>

            <div class="col-md-6">

                <article class="card painel-perfil h-100">
                    <div class="card-body">

                        <div class="icone-painel">
                            <i class="bi bi-heart"></i>
                        </div>

                        <h2>Favoritos</h2>

                        <p>
                            Encontre rapidamente todas as obras que você favoritou.
                        </p>

                        <a href="Favoritos.php" class="link-secao">
                            Ver favoritos
                            <i class="bi bi-arrow-right"></i>
                        </a>

                    </div>
                </article>

            </div>

        </section>

        <?php if ($usuario['tipo'] === 'admin'): ?>

            <section class="painel-admin">

                <div>
                    <p class="etiqueta-autenticacao">
                        <i class="bi bi-shield-lock"></i> ÁREA ADMINISTRATIVA
                    </p>

                    <h2>Você possui acesso ao controle do site.</h2>

                    <p>
                        Gerencie obras, avisos, gêneros e os conteúdos do Apollo.
                    </p>
                </div>

                <a href="/adm/index.php" class="btn botao-roxo">
                    Controle do site
                    <i class="bi bi-arrow-right"></i>
                </a>

            </section>

        <?php endif; ?>

    </main>

    <?php include 'EditarPerfilModal.php'; ?>
    <footer>
        <div class="container">
            <p>© <?= date('Y') ?> Apollo — seu universo de histórias.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>