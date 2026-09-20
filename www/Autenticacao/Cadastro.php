<?php

require_once __DIR__ . '/../includes/autenticacao.php';

if (usuarioLogado()) {
    header('Location: /index.php');
    exit;
}

$mensagem = '';
$tipoMensagem = '';
$nome = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $resultado = cadastrarUsuario($nome, $email, $senha);

    if ($resultado['sucesso']) {
        header('Location: /Autenticacao/login.php?cadastro=sucesso');
        exit;
    }

    $mensagem = $resultado['mensagem'];
    $tipoMensagem = 'erro';
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Criar conta | Apollo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body class="pagina-autenticacao">

    <main class="container">

        <div class="caixa-autenticacao">

            <a href="/index.php" class="logo-apollo">
                APOLLO<span>.</span>
            </a>

            <p class="etiqueta-autenticacao">
                <i class="bi bi-stars"></i> CRIE SUA CONTA
            </p>

            <h1>Seu universo começa aqui.</h1>

            <p class="texto-autenticacao">
                Crie sua conta para favoritar obras, criar listas e participar da comunidade.
            </p>

            <?php if (!empty($mensagem)): ?>
                <div class="mensagem-autenticacao <?= $tipoMensagem ?>">
                    <i class="bi bi-exclamation-circle"></i>
                    <?= e($mensagem) ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="formulario-autenticacao">

                <div class="campo-formulario">
                    <label for="nome">Nome</label>

                    <div>
                        <i class="bi bi-person"></i>
                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            value="<?= e($nome) ?>"
                            placeholder="Seu nome"
                            required>
                    </div>
                </div>

                <div class="campo-formulario">
                    <label for="email">E-mail</label>

                    <div>
                        <i class="bi bi-envelope"></i>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="<?= e($email) ?>"
                            placeholder="voce@email.com"
                            required>
                    </div>
                </div>

                <div class="campo-formulario">
                    <label for="senha">Senha</label>

                    <div>
                        <i class="bi bi-lock"></i>
                        <input
                            type="password"
                            id="senha"
                            name="senha"
                            placeholder="Mínimo de 6 caracteres"
                            minlength="6"
                            required>
                    </div>
                </div>

                <button type="submit" class="btn botao-roxo botao-autenticacao">
                    Criar minha conta
                    <i class="bi bi-arrow-right"></i>
                </button>

            </form>

            <p class="link-autenticacao">
                Já possui uma conta?
                <a href="/Autenticacao/login.php">Entrar</a>
            </p>

        </div>

    </main>

</body>
</html>