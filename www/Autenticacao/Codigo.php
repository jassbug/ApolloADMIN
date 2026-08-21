<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Confirmar Código - Apollo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/styles.css">

</head>

<body>

    <main class="container d-flex justify-content-center align-items-center min-vh-100">

        <div class="login-card">

            <div class="text-center mb-5">

                <img src="../img/logo.png" alt="Logo Apollo" class="logo-login">

            </div>

            <form>

                <div class="mb-5">

                    <label class="form-label">

                        Código de verificação

                    </label>

                    <input
                        type="text"
                        class="form-control text-center"
                        maxlength="6"
                        placeholder="Digite o código">

                </div>

                <div class="d-grid">

                    <div class="d-grid">

                    <button
                        type="button"
                        class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalSenha">

                        Confirmar

                    </button>

                </div>

                </div>

            </form>

            <div class="text-center mt-4">

                <a href="Recuperacao-senha.php" class="login-link">

                    Reenviar código

                </a>

            </div>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal Alterar Senha -->

<div class="modal fade" id="modalSenha" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content bg-dark text-white border border-primary">

            <div class="modal-header">

                <h5 class="modal-title">

                    Alterar Senha

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="mb-3">

                    <label class="form-label">

                        Nova senha

                    </label>

                    <input
                        type="password"
                        class="form-control"
                        placeholder="Digite a nova senha">

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Confirmar nova senha

                    </label>

                    <input
                        type="password"
                        class="form-control"
                        placeholder="Confirme a nova senha">

                </div>

            </div>

            <div class="modal-footer">

                <a href="../Usuario/Perfil.php" class="btn btn-primary">

                    Salvar

                </a>

            </div>

        </div>

    </div>

</div>
</body>

</html>