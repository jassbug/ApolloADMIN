<?php

require_once __DIR__ . '/../includes/autenticacao.php';

exigirLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /Usuario/perfil.php');
    exit;
}

$usuario = usuarioAtual();
$foto = $usuario['foto'];

if (
    isset($_FILES['foto']) &&
    $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE
) {
    if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
        header('Location: /Usuario/perfil.php?erro=Não foi possível enviar a imagem.');
        exit;
    }

    if ($_FILES['foto']['size'] > 2 * 1024 * 1024) {
        header('Location: /Usuario/perfil.php?erro=A imagem deve ter no máximo 2 MB.');
        exit;
    }

    $tiposPermitidos = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp'
    ];

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $tipoArquivo = finfo_file($finfo, $_FILES['foto']['tmp_name']);
    finfo_close($finfo);

    if (!isset($tiposPermitidos[$tipoArquivo])) {
        header('Location: /Usuario/perfil.php?erro=Envie apenas imagens JPG, PNG ou WEBP.');
        exit;
    }

    $pastaFotos = __DIR__ . '/../img/perfis';

    if (!is_dir($pastaFotos)) {
        mkdir($pastaFotos, 0755, true);
    }

    $nomeArquivo = uniqid('perfil_', true) . '.' . $tiposPermitidos[$tipoArquivo];
    $caminhoArquivo = $pastaFotos . '/' . $nomeArquivo;

    if (!move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoArquivo)) {
        header('Location: /Usuario/perfil.php?erro=Não foi possível salvar a imagem.');
        exit;
    }

    $foto = '/img/perfis/' . $nomeArquivo;
}

$resultado = atualizarPerfilUsuario(
    idUsuarioLogado(),
    $_POST['nome'] ?? '',
    $_POST['email'] ?? '',
    $_POST['bio'] ?? '',
    $foto
);

if ($resultado['sucesso']) {
    header('Location: /Usuario/perfil.php?perfil=atualizado');
    exit;
}

$mensagem = urlencode($resultado['mensagem']);

header("Location: /Usuario/perfil.php?erro=$mensagem");
exit;