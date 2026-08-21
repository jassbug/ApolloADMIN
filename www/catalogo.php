<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catálogo - Apollo</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="css/styles.css">

     <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

    <!-- Menu lateral -->
     <header>

        <?php include 'menu.php'; ?>

    </header>

   <!-- Conteúdo -->
    <main class="container py-5">

    <h1 class="mb-2">
        📚 Pagina generica
    </h1>

    <p class="text-secondary mb-4">
        dependendo do que o usuario clicar, ele vai ser redirecionado para essa pagina que vai mudar entre animes, filmes e series, agora sendo só uma generica
        As tres paginas vão ter o mesmo layout, mas com conteudos diferentes
    </p>

    <!-- Pesquisa e Filtros -->
    <div class="row mb-5">

        <div class="col-lg-5 col-md-6 mb-3">

            <input
                type="text"
                class="form-control"
                placeholder="Pesquisar obra...">

        </div>


        <div class="col-lg-4 col-md-3 mb-3">

            <select class="form-select">

                <option selected>Todos os gêneros</option>
                <option>Ação</option>
                <option>Aventura</option>
                <option>Drama</option>
                <option>Fantasia</option>
                <option>Ficção Científica</option>
                <option>Suspense</option>

            </select>

        </div>

    </div>

<!-- Cards -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

    <div class="col">
        <div class="card obra-card">

        <img src="https://image.tmdb.org/t/p/w500/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg"
             class="card-img-top"
             alt="Interestelar">

        <div class="card-body">

            <h5 class="card-title">
                Interestelar
            </h5>

            <p class="card-text">
                Filme
            </p>

            <a href="Obras.php" class="btn btn-primary w-100">
                Ver detalhes
            </a>

        </div>

    </div>
    
    </div>
    <!-- Breaking Bad -->
        <div class="col">
            <div class="card obra-card">

            <img src="https://image.tmdb.org/t/p/w500/ztkUQFLlC19CCMYHW9o1zWhJRNq.jpg"
                class="card-img-top"
                alt="Breaking Bad">

            <div class="card-body">

                <h5 class="card-title">
                    Breaking Bad
                </h5>

                <p class="card-text">
                    Série
                </p>

                <a href="Obras.php" class="btn btn-primary w-100">
                    Ver detalhes
                </a>

            </div>

        </div>
        </div>

    <!-- Os Cavaleiros do Zodíaco -->
        <div class="col">
            <!-- Card 3 -->
            <div class="card obra-card">

            <img src="img/cdz.jpeg"
                class="card-img-top"
                alt="Os Cavaleiros do Zodíaco">

            <div class="card-body">

                <h5 class="card-title">
                    Os Cavaleiros do Zodíaco
                </h5>

                <p class="card-text">
                    Anime
                </p>

                <a href="Obras.php" class="btn btn-primary w-100">
                    Ver detalhes
                </a>

            </div>

        </div>
        </div>
    <!-- Oppenheimer -->
        <div class="col">
            <div class="card obra-card">

            <img src="https://image.tmdb.org/t/p/w500/ptpr0kGAckfQkJeJIt8st5dglvd.jpg"
                class="card-img-top"
                alt="Oppenheimer">

            <div class="card-body">

                <h5 class="card-title">
                    Oppenheimer
                </h5>

                <p class="card-text">
                    Filme
                </p>

                <a href="Obras.php" class="btn btn-primary w-100">
                    Ver detalhes
                </a>

            </div>

        </div>
        </div>
    
    <!-- Superman -->
        <div class="col">

            <div class="card obra-card">

                <img src="https://image.tmdb.org/t/p/w500/ombsmhYUqR4qqOLOxAyr5V8hbyv.jpg"
                    class="card-img-top"
                    alt="Superman">

                <div class="card-body">

                    <h5 class="card-title">
                        Superman
                    </h5>

                    <p class="card-text">
                        Filme
                    </p>

                    <a href="Obras.php" class="btn btn-primary w-100">
                        Ver detalhes
                    </a>

                </div>

            </div>

        </div>

    <!-- The Last of Us -->
        <div class="col">

            <div class="card obra-card">

                <img src="https://image.tmdb.org/t/p/w500/uKvVjHNqB5VmOrdxqAt2F7J78ED.jpg"
                    class="card-img-top"
                    alt="The Last of Us">

                <div class="card-body">

                    <h5 class="card-title">
                        The Last of Us
                    </h5>

                    <p class="card-text">
                        Série
                    </p>

                    <a href="Obras.php" class="btn btn-primary w-100">
                        Ver detalhes
                    </a>

                </div>

            </div>

        </div>

    <!-- Demon Slayer -->
        <div class="col">

            <div class="card obra-card">

                <img src="https://image.tmdb.org/t/p/w500/xUfRZu2mi8jH6SzQEJGP6tjBuYj.jpg"
                    class="card-img-top"
                    alt="Demon Slayer">

                <div class="card-body">

                    <h5 class="card-title">
                        Demon Slayer
                    </h5>

                    <p class="card-text">
                        Anime
                    </p>

                    <a href="Obras.php" class="btn btn-primary w-100">
                        Ver detalhes
                    </a>

                </div>

            </div>

        </div>

    <!-- Jurassic World -->
        <div class="col">

            <div class="card obra-card">

                <img src="https://image.tmdb.org/t/p/w500/q0fGCmjLu42MPlSO9OYWpI5w86I.jpg"
                    class="card-img-top"
                    alt="Jurassic World">

                <div class="card-body">

                    <h5 class="card-title">
                        Jurassic World
                    </h5>

                    <p class="card-text">
                        Filme
                    </p>

                    <a href="Obras.php" class="btn btn-primary w-100">
                        Ver detalhes
                    </a>

                </div>

            </div>

        </div>

    <!-- Stranger Things -->
        <div class="col">

            <div class="card obra-card">

                <img src="https://image.tmdb.org/t/p/w500/49WJfeN0moxb9IPfGn8AIqMGskD.jpg"
                    class="card-img-top"
                    alt="Stranger Things">

                <div class="card-body">

                    <h5 class="card-title">
                        Stranger Things
                    </h5>

                    <p class="card-text">
                        Série
                    </p>

                    <a href="Obras.php" class="btn btn-primary w-100">
                        Ver detalhes
                    </a>

                </div>

            </div>

        </div>

    <!-- The Boys -->
        <div class="col">

            <div class="card obra-card">

                <img src="https://image.tmdb.org/t/p/w500/2zmTngn1tYC1AvfnrFLhxeD82hz.jpg"
                    class="card-img-top"
                    alt="The Boys">

                <div class="card-body">

                    <h5 class="card-title">
                        The Boys
                    </h5>

                    <p class="card-text">
                        Série
                    </p>

                    <a href="Obras.php" class="btn btn-primary w-100">
                        Ver detalhes
                    </a>

                </div>

            </div>

        </div>

    <!-- One Piece -->
        <div class="col">

            <div class="card obra-card">

                <img src="img/one-pice.jpg"
                    class="card-img-top"
                    alt="One Piece">

                <div class="card-body">

                    <h5 class="card-title">
                        One Piece
                    </h5>

                    <p class="card-text">
                        Anime
                    </p>

                    <a href="Obras.php" class="btn btn-primary w-100">
                        Ver detalhes
                    </a>

                </div>

            </div>

        </div>

    <!-- Attack on Titan -->
        <div class="col">

            <div class="card obra-card">

                <img src="https://image.tmdb.org/t/p/w500/hTP1DtLGFamjfu8WqjnuQdP1n4i.jpg"
                    class="card-img-top"
                    alt="Attack on Titan">

                <div class="card-body">

                    <h5 class="card-title">
                        Attack on Titan
                    </h5>

                    <p class="card-text">
                        Anime
                    </p>

                    <a href="Obras.php" class="btn btn-primary w-100">
                        Ver detalhes
                    </a>

                </div>

            </div>

        </div>

</div>

    </main>

    <!-- Footer -->
    <footer>

        <div class="container">

            <p>
                © 2026 Apollo
            </p>

        </div>

    </footer>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>