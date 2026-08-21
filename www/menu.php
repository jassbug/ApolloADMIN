<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark">

    <div class="container-fluid">

        <!-- Botão Menu -->

        <button class="btn btn-menu me-3"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#menuLateral">

            <i class="bi bi-list"></i>

        </button>

        <!-- Logo -->

        <a class="navbar-brand fw-bold" href="/index.php">

            APOLLO

        </a>

        <!-- Busca -->

        <form class="d-flex mx-auto w-50">

            <input
                class="form-control me-2"
                type="search"
                placeholder="Buscar">

            <button class="btn btn-outline-light">

                Buscar

            </button>

        </form>

        <!-- Perfil -->


    </div>

</nav>

<!-- Menu Lateral -->

<div class="offcanvas offcanvas-start text-bg-dark"
    tabindex="-1"
    id="menuLateral">

    <div class="offcanvas-header">

        <h4 class="fw-bold text-primary">

            APOLLO

        </h4>

        <button
            type="button"
            class="btn-close btn-close-white"
            data-bs-dismiss="offcanvas">
        </button>

    </div>

    <div class="offcanvas-body">

        <ul class="navbar-nav">

            <li class="nav-item mb-3">

                <a href="/index.php" class="nav-link">

                    <i class="bi bi-house-door-fill me-2"></i>

                    Início

                </a>

            </li>

            <li class="nav-item mb-3">

                <a href="/Usuario/Perfil.php" class="nav-link">

                    <i class="bi bi-person-fill me-2"></i>

                    Perfil

                </a>

            </li>

            <li class="nav-item mb-3">

                <a href="/Usuario/Listas.php" class="nav-link">

                    <i class="bi bi-heart-fill me-2"></i>

                    Minha Lista

                </a>

            </li>

            <li class="nav-item mb-3">

                <a href="/catalogo.php" class="nav-link">

                    <i class="bi bi-film me-2"></i>

                    Filmes

                </a>

            </li>

            <li class="nav-item mb-3">

                <a href="/catalogo.php" class="nav-link">

                    <i class="bi bi-tv-fill me-2"></i>

                    Séries

                </a>

            </li>

            <li class="nav-item mb-3">

                <a href="/catalogo.php" class="nav-link">

                    <i class="bi bi-play-circle-fill me-2"></i>

                    Animes

                </a>

            </li>

            <li class="nav-item mb-3">

                <a href="/Generos.php" class="nav-link">

                    <i class="bi bi-grid-fill me-2"></i>

                    Gêneros

                </a>

            </li>

            <hr>

            <li class="nav-item mb-3">

                <a href="../Autenticacao/login.php" class="nav-link text-danger">

                    <i class="bi bi-box-arrow-in-right me-2"></i>

                    Login

                </a>

            </li>

            <hr>

            <li class="nav-item">

                <a href="../Autenticacao/login.php" class="nav-link text-danger">

                    <i class="bi bi-box-arrow-right me-2"></i>

                    Sair

                </a>

            </li>

            <li class="nav-item mb-3">

                <a href="/Adm/Dashboard.php" class="nav-link">

                    <i class="bi bi-speedometer2 me-2"></i>

                    Administração

                </a>

            </li>

        </ul>

    </div>

</div>