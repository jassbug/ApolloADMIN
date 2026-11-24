<?php

require_once __DIR__ . '/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function usuarioLogado()
{
    return isset($_SESSION['usuario_id']);
}

function idUsuarioLogado()
{
    return $_SESSION['usuario_id'] ?? null;
}

function usuarioAtual()
{
    static $usuario = null;
    static $buscouUsuario = false;

    if (!usuarioLogado()) {
        return null;
    }

    if ($buscouUsuario) {
        return $usuario;
    }

    $buscouUsuario = true;

    $conexao = conectarBanco();

    $sql = "
        SELECT id, nome, email, foto, bio, tipo
        FROM usuarios
        WHERE id = :id
    ";

    $consulta = $conexao->prepare($sql);

    $consulta->execute([
        ':id' => idUsuarioLogado()
    ]);

    $usuario = $consulta->fetch();

    if (!$usuario) {
        sairDaConta();
    }

    return $usuario;
}

function usuarioEhAdmin()
{
    $usuario = usuarioAtual();

    return $usuario && $usuario['tipo'] === 'admin';
}

function cadastrarUsuario($nome, $email, $senha, $confirmarSenha)
{
    // VALIDAR OS TIPOS DOS DADOS RECEBIDOS
    if (
        !is_string($nome) ||
        !is_string($email) ||
        !is_string($senha) ||
        !is_string($confirmarSenha)
    ) {
        return [
            'sucesso' => false,
            'mensagem' => 'Dados inválidos.'
        ];
    }

    // LIMPAR OS DADOS
    $nome = trim($nome);
    $email = trim($email);

    // VERIFICAR CAMPOS OBRIGATÓRIOS
    if (
        $nome === '' ||
        $email === '' ||
        $senha === '' ||
        $confirmarSenha === ''
    ) {
        return [
            'sucesso' => false,
            'mensagem' => 'Preencha todos os campos.'
        ];
    }

    // VALIDAR O NOME
    if (strlen($nome) > 120) {
        return [
            'sucesso' => false,
            'mensagem' => 'O nome deve ter no máximo 120 caracteres.'
        ];
    }

    // VALIDAR O E-MAIL
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 150) {
        return [
            'sucesso' => false,
            'mensagem' => 'Digite um e-mail válido.'
        ];
    }

    // VERIFICAR SE AS SENHAS SÃO IGUAIS
    if (!hash_equals($senha, $confirmarSenha)) {
        return [
            'sucesso' => false,
            'mensagem' => 'As senhas não coincidem.'
        ];
    }

    // VALIDAR O TAMANHO DA SENHA
    if (strlen($senha) < 6) {
        return [
            'sucesso' => false,
            'mensagem' => 'A senha deve ter pelo menos 6 caracteres.'
        ];
    }

    if (strlen($senha) > 72) {
        return [
            'sucesso' => false,
            'mensagem' => 'A senha deve ter no máximo 72 bytes.'
        ];
    }

    $conexao = conectarBanco();

    // VERIFICAR SE O E-MAIL JÁ ESTÁ CADASTRADO
    $verificarEmail = $conexao->prepare("
        SELECT id
        FROM usuarios
        WHERE email = :email
    ");

    $verificarEmail->execute([
        ':email' => $email
    ]);

    if ($verificarEmail->fetch()) {
        return [
            'sucesso' => false,
            'mensagem' => 'Este e-mail já está cadastrado.'
        ];
    }

    // CRIPTOGRAFAR A SENHA
    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    try {

        $conexao->beginTransaction();

        // CADASTRAR USUÁRIO
        $consulta = $conexao->prepare("
            INSERT INTO usuarios (nome, email, senha, tipo)
            VALUES (:nome, :email, :senha, 'usuario')
        ");

        $consulta->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senhaCriptografada
        ]);

        $usuarioId = $conexao->lastInsertId();

        // CRIAR LISTAS PADRÃO
        $listasPadrao = [
            'Favoritos',
            'Assistindo',
            'Quero assistir',
            'Concluídos'
        ];

        $consultaLista = $conexao->prepare("
            INSERT INTO listas_usuario (usuario_id, nome)
            VALUES (:usuario_id, :nome)
        ");

        foreach ($listasPadrao as $nomeLista) {
            $consultaLista->execute([
                ':usuario_id' => $usuarioId,
                ':nome' => $nomeLista
            ]);
        }

        $conexao->commit();

        return [
            'sucesso' => true,
            'mensagem' => 'Cadastro realizado com sucesso.'
        ];

    } catch (PDOException $erro) {

        if ($conexao->inTransaction()) {
            $conexao->rollBack();
        }

        error_log($erro->getMessage());

        return [
            'sucesso' => false,
            'mensagem' => 'Não foi possível realizar o cadastro.'
        ];
    }
}

function fazerLogin($email, $senha)
{
    $conexao = conectarBanco();

    $consulta = $conexao->prepare("
        SELECT id, nome, senha, tipo
        FROM usuarios
        WHERE email = :email
    ");

    $consulta->execute([
        ':email' => trim($email)
    ]);

    $usuario = $consulta->fetch();

    if (!$usuario || !password_verify($senha, $usuario['senha'])) {
        return [
            'sucesso' => false,
            'mensagem' => 'E-mail ou senha incorretos.'
        ];
    }

    session_regenerate_id(true);

    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome'];
    $_SESSION['usuario_tipo'] = $usuario['tipo'];

    return [
        'sucesso' => true,
        'mensagem' => 'Login realizado com sucesso.'
    ];
}

function exigirLogin()
{
    if (!usuarioLogado()) {
        header('Location: /Autenticacao/login.php');
        exit;
    }
}

function exigirAdministrador()
{
    exigirLogin();

    if (!usuarioEhAdmin()) {
        header('Location: /index.php');
        exit;
    }
}

function sairDaConta()
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $parametros = session_get_cookie_params();

        setcookie(
            session_name(),
            '',
            time() - 42000,
            $parametros['path'],
            $parametros['domain'],
            $parametros['secure'],
            $parametros['httponly']
        );
    }

    session_destroy();
}

function atualizarPerfilUsuario($id, $nome, $email, $bio, $foto)
{
    $nome = trim($nome);
    $email = trim($email);
    $bio = trim($bio);

    if (empty($nome) || empty($email)) {
        return [
            'sucesso' => false,
            'mensagem' => 'Nome e e-mail são obrigatórios.'
        ];
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return [
            'sucesso' => false,
            'mensagem' => 'Digite um e-mail válido.'
        ];
    }

    if (strlen($bio) > 255) {
        return [
            'sucesso' => false,
            'mensagem' => 'A biografia pode ter no máximo 255 caracteres.'
        ];
    }

    $conexao = conectarBanco();

    $verificarEmail = $conexao->prepare("
        SELECT id
        FROM usuarios
        WHERE email = :email
        AND id != :id
    ");

    $verificarEmail->execute([
        ':email' => $email,
        ':id' => $id
    ]);

    if ($verificarEmail->fetch()) {
        return [
            'sucesso' => false,
            'mensagem' => 'Este e-mail já está sendo usado por outra conta.'
        ];
    }

    $consulta = $conexao->prepare("
        UPDATE usuarios
        SET nome = :nome,
            email = :email,
            bio = :bio,
            foto = :foto
        WHERE id = :id
    ");

    $consulta->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':bio' => $bio ?: null,
        ':foto' => $foto ?: null,
        ':id' => $id
    ]);

    $_SESSION['usuario_nome'] = $nome;

    return [
        'sucesso' => true,
        'mensagem' => 'Perfil atualizado com sucesso.'
    ];
}