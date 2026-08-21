<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Apollo</title>

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

    <section class="hero">

        <div class="container">

            <h1>
                Descubra novos filmes, séries e animes
            </h1>

            <p>
                Organize suas listas, favorite obras e compartilhe opiniões com a comunidade.
            </p>

        </div>

    </section>

    <section class="container mt-5">

    <h2 class="mb-4">
        📢 Avisos
    </h2>

    <div id="carouselAvisos" class="carousel slide carousel-fade shadow rounded" data-bs-ride="carousel">

        <div class="carousel-indicators">

            <button type="button" data-bs-target="#carouselAvisos" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselAvisos" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselAvisos" data-bs-slide-to="2"></button>

        </div>

        <div class="carousel-inner rounded">

            <!-- Interestelar -->
            <div class="carousel-item active">

                <img src="https://image.tmdb.org/t/p/original/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg"
                    class="d-block w-100"
                    alt="Interestelar">

                <div class="carousel-caption">

                    <h2>Interestelar</h2>

                    <p>
                        Explore um dos maiores sucessos da ficção científica.
                    </p>

                    <a href="Obras.php" class="btn btn-primary">
                        Ver deatalhes
                    </a>

                </div>

            </div>

            <!-- Superman -->
            <div class="carousel-item">

                <img src="https://image.tmdb.org/t/p/original/ombsmhYUqR4qqOLOxAyr5V8hbyv.jpg"
                    class="d-block w-100"
                    alt="Superman">

                <div class="carousel-caption">

                    <h2>Superman</h2>

                    <p>
                        Confira um dos lançamentos em destaque da plataforma.
                    </p>

                    <a href="Obras.php" class="btn btn-primary">
                        Ver deatalhes
                    </a>

                </div>

            </div>

            <!-- Demon Slayer -->
            <div class="carousel-item">

                <img src="https://image.tmdb.org/t/p/original/aFRDH3P7TX61FVGpaLhKr6QiOC1.jpg"
                    class="d-block w-100"
                    alt="Demon Slayer">

                <div class="carousel-caption">

                    <h2>Demon Slayer</h2>

                    <p>
                        Os animes mais populares estão aqui.
                    </p>

                    <a href="Obras.php" class="btn btn-primary">
                       Ver deatalhes
                    </a>

                </div>

            </div>

        </div>

        <button class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselAvisos"
            data-bs-slide="prev">

            <span class="carousel-control-prev-icon"></span>

        </button>

        <button class="carousel-control-next"
            type="button"
            data-bs-target="#carouselAvisos"
            data-bs-slide="next">

            <span class="carousel-control-next-icon"></span>

        </button>

    </div>

</section>

   <section class="container mt-5">

    <h2 class="mb-4">
        🔥 Em Alta
    </h2>

    <div class="row">

        <!-- Card 1 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">

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

        <!-- Card 2 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">

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

        <!-- Card 3 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">

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

        <!-- Card 4 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">

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

    </div>

</section>

<section class="container mt-5">

    <h2 class="mb-4">
        🎬 Lançamentos
    </h2>

    <div class="row">

        <!-- Card 1 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">

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

        <!-- Card 2 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">

            <div class="card obra-card">

                <img src="https://image.tmdb.org/t/p/w500/x26MtUlwtWD26d0G0FXcppxCJio.jpg"
                     class="card-img-top"
                     alt="Quarteto Fantástico">

                <div class="card-body">

                    <h5 class="card-title">
                        Quarteto Fantástico
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

        <!-- Card 3 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">

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

        <!-- Card 4 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">

            <div class="card obra-card">

                <img src="https://image.tmdb.org/t/p/w500/aFRDH3P7TX61FVGpaLhKr6QiOC1.jpg"
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

    </div>

</section>

<section class="container mt-5 mb-5">

    <h2 class="mb-4">
        🎭 Gêneros
    </h2>

    <div class="d-flex flex-wrap gap-3 justify-content-center">

        <a href="Generos.php" class="btn btn-outline-primary genero-btn">🎬 Ação</a>

        <a href="Generos.php" class="btn btn-outline-primary genero-btn">😂 Comédia</a>

        <a href="Generos.php" class="btn btn-outline-primary genero-btn">❤️ Romance</a>

        <a href="Generos.php" class="btn btn-outline-primary genero-btn">😱 Terror</a>

        <a href="Generos.php" class="btn btn-outline-primary genero-btn">🚀 Ficção</a>

        <a href="Generos.php" class="btn btn-outline-primary genero-btn">🕵 Suspense</a>

        <a href="Generos.php" class="btn btn-outline-primary genero-btn">🎭 Drama</a>

        <a href="Generos.php" class="btn btn-outline-primary genero-btn">👨‍👩‍👧 Família</a>

        <a href="Generos.php" class="btn btn-outline-primary genero-btn">🎌 Anime</a>

        <a href="Generos.php" class="btn btn-outline-primary genero-btn">📺 Série</a>

        <a href="Generos.php" class="btn btn-outline-primary genero-btn">🎞 Filme</a>

        <a href="Generos.php" class="btn btn-outline-primary genero-btn">🧙 Fantasia</a>

    </div>

</section>


    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <footer>

        <div class="container">
            <p>
                © 2026 Apollo
            </p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="js/script.js"></script>

</body>

</html>