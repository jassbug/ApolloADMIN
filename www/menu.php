<?php
$paginaAtual = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar menu-superior">

    <div class="container-fluid">

        <div class="menu-esquerda">

            <button
                class="botao-menu"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#menuLateral"
                aria-controls="menuLateral"
                aria-label="Abrir menu">

                <i class="bi bi-list"></i>
            </button>

            <a href="index.php" class="logo-apollo">
                APOLLO<span>.</span>
            </a>

        </div>

        <div class="links-menu d-none d-lg-flex">
            <a class="<?= $paginaAtual === '../index.php' ? 'ativo' : '' ?>" href="www/index.php">
                Início
            </a>

            <a class="<?= $paginaAtual === 'catalogo.php' ? 'ativo' : '' ?>" href="catalogo.php">
                Catálogo
            </a>

            <a class="<?= $paginaAtual === 'Obras.php' ? 'ativo' : '' ?>" href="Obras.php">
                Obras
            </a>

            <a class="<?= $paginaAtual === 'Generos.php' ? 'ativo' : '' ?>" href="Generos.php">
                Gêneros
            </a>
        </div>

        <form class="busca-menu" action="catalogo.php" method="GET">
            <input
                type="search"
                name="busca"
                placeholder="Busque uma obra..."
                aria-label="Buscar obra">

            <button type="submit" aria-label="Pesquisar">
                <i class="bi bi-search"></i>
            </button>
        </form>

    </div>

</nav>


<div
    class="offcanvas offcanvas-start menu-lateral"
    tabindex="-1"
    id="menuLateral"
    aria-labelledby="tituloMenuLateral">

    <div class="offcanvas-header">

        <a href="index.php" class="logo-apollo" id="tituloMenuLateral">
            APOLLO<span>.</span>
        </a>

        <button
            type="button"
            class="btn-fechar-menu"
            data-bs-dismiss="offcanvas"
            aria-label="Fechar menu">

            <i class="bi bi-x-lg"></i>
        </button>

    </div>

    <div class="offcanvas-body">

        <p class="titulo-menu-lateral">NAVEGAÇÃO</p>

        <nav class="links-laterais">

            <a class="<?= $paginaAtual === 'index.php' ? 'ativo' : '' ?>" href="index.php">
                <i class="bi bi-house-door"></i>
                Início
            </a>

            <a class="<?= $paginaAtual === 'catalogo.php' ? 'ativo' : '' ?>" href="catalogo.php">
                <i class="bi bi-collection-play"></i>
                Catálogo
            </a>

            <a class="<?= $paginaAtual === 'Obras.php' ? 'ativo' : '' ?>" href="Obras.php">
                <i class="bi bi-film"></i>
                Obras
            </a>

            <a class="<?= $paginaAtual === 'Generos.php' ? 'ativo' : '' ?>" href="Generos.php">
                <i class="bi bi-grid"></i>
                Gêneros
            </a>

            <a class="<?= $paginaAtual === 'Categoria.php' ? 'ativo' : '' ?>" href="Categoria.php">
                <i class="bi bi-tags"></i>
                Categorias
            </a>

        </nav>

        <div class="linha-menu"></div>

<p class="titulo-menu-lateral">SUA CONTA</p>

<nav class="links-laterais">

    <?php if (usuarioLogado()): ?>

        <a href="/Usuario/perfil.php">
            <i class="bi bi-person-circle"></i>
            Meu perfil
        </a>

        <?php if (usuarioEhAdmin()): ?>
            <a href="/adm/index.php">
                <i class="bi bi-shield-lock"></i>
                Controle do site
            </a>
        <?php endif; ?>

        <a href="/Autenticacao/sair.php">
            <i class="bi bi-box-arrow-right"></i>
            Sair
        </a>

    <?php else: ?>

        <a href="/Autenticacao/login.php">
            <i class="bi bi-box-arrow-in-right"></i>
            Entrar
        </a>

        <a href="/Autenticacao/cadastro.php">
            <i class="bi bi-person-plus"></i>
            Criar conta
        </a>

    <?php endif; ?>

</nav>

    </div>

    <div class="rodape-menu">
        <i class="bi bi-stars"></i>
        Descubra sua próxima história.
    </div>

</div>