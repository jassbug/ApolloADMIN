<?php
$paginaAtual = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar menu-superior">

    <div class="container-fluid">

        <!-- LADO ESQUERDO -->
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

            <a href="/index.php" class="logo-apollo">
                APOLLO<span>.</span>
            </a>

        </div>

        <!-- MENU SUPERIOR -->
        <div class="links-menu d-none d-lg-flex">

            <a
                class="<?= $paginaAtual === 'Filmes.php' ? 'ativo' : '' ?>"
                href="/filmes.php">

                Filmes

            </a>

            <a
                class="<?= $paginaAtual === 'Series.php' ? 'ativo' : '' ?>"
                href="/series.php">

                Séries

            </a>

            <a
                class="<?= $paginaAtual === 'Animes.php' ? 'ativo' : '' ?>"
                href="/animes.php">

                Animes

            </a>

            <a
                class="<?= $paginaAtual === 'Generos.php' ? 'ativo' : '' ?>"
                href="/Generos.php">

                Gêneros

            </a>

        </div>

        <!-- BARRA DE BUSCA -->
        <form
            class="busca-menu"
            action="/catalogo.php"
            method="GET">

            <input
                type="search"
                name="busca"
                placeholder="Busque uma obra..."
                aria-label="Buscar obra">

            <button
                type="submit"
                aria-label="Pesquisar">

                <i class="bi bi-search"></i>

            </button>

        </form>

    </div>

</nav>


<!-- MENU LATERAL -->
<div
    class="offcanvas offcanvas-start menu-lateral"
    tabindex="-1"
    id="menuLateral"
    aria-labelledby="tituloMenuLateral">

    <!-- CABEÇALHO -->
    <div class="offcanvas-header">

        <a
            href="/index.php"
            class="logo-apollo"
            id="tituloMenuLateral">

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


    <!-- CONTEÚDO -->
    <div class="offcanvas-body">

        <p class="titulo-menu-lateral">
            NAVEGAÇÃO
        </p>

        <!-- LINKS PRINCIPAIS -->
        <nav class="links-laterais">

            <a
                class="<?= $paginaAtual === 'filmes.php' ? 'ativo' : '' ?>"
                href="/filmes.php">

                <i class="bi bi-film"></i>

                Filmes

            </a>

            <a
                class="<?= $paginaAtual === 'Series.php' ? 'ativo' : '' ?>"
                href="/series.php">

                <i class="bi bi-collection-play"></i>

                Séries

            </a>

            <a
                class="<?= $paginaAtual === 'animes.php' ? 'ativo' : '' ?>"
                href="/animes.php">

                <i class="bi bi-tv"></i>

                Animes

            </a>

            <a
                class="<?= $paginaAtual === 'Generos.php' ? 'ativo' : '' ?>"
                href="/Generos.php">

                <i class="bi bi-grid"></i>

                Gêneros

            </a>

        </nav>


        <div class="linha-menu"></div>


        <!-- CONTA DO USUÁRIO -->
        <p class="titulo-menu-lateral">
            SUA CONTA
        </p>

        <nav class="links-laterais">

            <?php if (usuarioLogado()): ?>

                <a
                    class="<?= $paginaAtual === 'perfil.php' ? 'ativo' : '' ?>"
                    href="/Usuario/perfil.php">

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


    <!-- RODAPÉ -->
    <div class="rodape-menu">

        <i class="bi bi-stars"></i>

        Descubra sua próxima história.

    </div>

</div>