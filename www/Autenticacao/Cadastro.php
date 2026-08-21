<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Criar Conta - Apollo</title>

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

                <!-- Nome -->

                <div class="mb-3">

                    <label class="form-label">

                        Nome

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Digite seu nome">

                </div>

                <!-- Usuário -->

                <div class="mb-3">

                    <label class="form-label">

                        Nome de usuário

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Digite seu nome de usuário">

                </div>

                <!-- Data de nascimento -->

                <div class="mb-3">

                    <label class="form-label">

                        Data de nascimento

                    </label>

                    <input
                        type="date"
                        class="form-control">

                </div>

                <!-- Email -->

                <div class="mb-3">

                    <label class="form-label">

                        E-mail

                    </label>

                    <input
                        type="email"
                        class="form-control"
                        placeholder="Digite seu e-mail">

                </div>

                <!-- Senha -->

                <div class="mb-3">

                    <label class="form-label">

                        Senha

                    </label>

                    <input
                        type="password"
                        class="form-control"
                        placeholder="Digite sua senha">

                </div>

                <!-- Confirmar senha -->

                <div class="mb-4">

                    <label class="form-label">

                        Confirmar senha

                    </label>

                    <input
                        type="password"
                        class="form-control"
                        placeholder="Confirme sua senha">

                </div>

                <!-- Botão -->

                <div class="d-grid mb-4">

                    <button
                        type="button"
                        class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalConfirmacao">

                        Criar Conta

                    </button>

                </div>

                <hr>

                <div class="text-center mt-4">

                    Já possui uma conta?

                    <a href="login.php" class="login-link">

                        Entrar

                    </a>

                </div>

            </form>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<!-- Modal Confirmação -->

<div class="modal fade" id="modalConfirmacao" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content bg-dark text-white border border-primary">

            <div class="modal-header">

                <h5 class="modal-title">

                    Confirmação de E-mail

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <p>

                    Sua conta foi criada com sucesso!

                </p>

                <p>

                    Um código de confirmação será enviado para o e-mail informado durante o cadastro.

                </p>

                <p>

                    Informe esse código na próxima tela para confirmar seu e-mail e ativar sua conta no Apollo.

                </p>

            </div>

            <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                            Cancelar

                        </button>

                        <a href="Codigo.php" class="btn btn-primary">

                            Continuar

                        </a>

                    </div>

                </div>

            </div>

        </div>


</body>

</html>