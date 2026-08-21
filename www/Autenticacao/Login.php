<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Apollo</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/styles.css">

</head>

<body>

    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark">

        <div class="container">

            <a class="navbar-brand fw-bold" href="/index.php">
                APOLLO
            </a>

        </div>

    </nav>

    <!-- Login -->

    <main class="container d-flex justify-content-center align-items-center py-5">

        <div class="login-card">

            <h1 class="text-center mb-2">
                APOLLO
            </h1>

            <p class="text-center text-secondary mb-4">
                Faça login para continuar
            </p>

            <form>

                <div class="mb-3">

                    <label class="form-label">
                        E-mail
                    </label>

                    <input
                        type="email"
                        class="form-control"
                        placeholder="Digite seu e-mail">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Senha
                    </label>

                    <input
                        type="password"
                        class="form-control"
                        placeholder="Digite sua senha">

                </div>

                <div class="text-end mb-4">

                    <a href="Recuperacao-senha.php" class="login-link">
                        Esqueci minha senha
                    </a>

                </div>

                <div class="d-grid">

                    <button
                        type="button"
                        class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalLogin">

                        Entrar

                    </button>

                </div>

            </form>

            <hr>

            <p class="text-center mb-0">

                Não possui uma conta?

                <a href="Cadastro.php" class="login-link">
                    Criar conta
                </a>

            </p>

        </div>

    </main>

    <!-- Modal -->

    <div class="modal fade" id="modalLogin" tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content bg-dark text-white border border-primary">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Login
                    </h5>

                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <p>
                        Esta funcionalidade será implementada no back-end.
                    </p>

                    <p>
                        Quando o sistema estiver conectado ao banco de dados,
                        o usuário poderá entrar utilizando seu e-mail e senha.
                    </p>

                </div>

                <div class="modal-footer">

                    <button
                        class="btn btn-primary"
                        data-bs-dismiss="modal">

                        Entendi

                    </button>

                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>