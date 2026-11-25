<?php

require_once __DIR__ . '/../includes/autenticacao.php';

exigirLogin();

// VERIFICAR SE O FORMULÁRIO FOI ENVIADO
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /Usuario/Perfil.php');
    exit;
}

// BUSCAR DADOS DO USUÁRIO
$usuario = usuarioAtual();
$foto = $usuario['foto'];

// VERIFICAR SE UMA NOVA FOTO FOI ENVIADA
if (
    isset($_FILES['foto']) &&
    $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE
) {

    // VERIFICAR ERROS NO ENVIO
    if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
        header('Location: /Usuario/Perfil.php?erro=' . urlencode('Não foi possível enviar a imagem.'));
        exit;
    }

    // VERIFICAR TAMANHO DA IMAGEM
    if ($_FILES['foto']['size'] > 2 * 1024 * 1024) {
        header('Location: /Usuario/Perfil.php?erro=' . urlencode('A imagem deve ter no máximo 2 MB.'));
        exit;
    }

    // TIPOS DE IMAGEM PERMITIDOS
    $tiposPermitidos = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp'
    ];

    // VERIFICAR O TIPO REAL DO ARQUIVO
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $tipoArquivo = finfo_file($finfo, $_FILES['foto']['tmp_name']);
    finfo_close($finfo);

    if (!isset($tiposPermitidos[$tipoArquivo])) {
        header('Location: /Usuario/Perfil.php?erro=' . urlencode('Envie apenas imagens JPG, PNG ou WEBP.'));
        exit;
    }

    // DEFINIR A PASTA DE DESTINO
    $pastaFotos = __DIR__ . '/../img/perfis';

    // CRIAR A PASTA CASO NÃO EXISTA
    if (!is_dir($pastaFotos)) {
        if (!mkdir($pastaFotos, 0755, true)) {
            header('Location: /Usuario/Perfil.php?erro=' . urlencode('Não foi possível criar a pasta de imagens.'));
            exit;
        }
    }

    // GERAR UM NOME ÚNICO PARA A IMAGEM
    $nomeArquivo = uniqid('perfil_', true) . '.' . $tiposPermitidos[$tipoArquivo];

    $caminhoArquivo = $pastaFotos . '/' . $nomeArquivo;

    // SALVAR A IMAGEM
    if (!move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoArquivo)) {
        header('Location: /Usuario/Perfil.php?erro=' . urlencode('Não foi possível salvar a imagem.'));
        exit;
    }

    // DEFINIR O CAMINHO DA FOTO
    $foto = '/img/perfis/' . $nomeArquivo;
}

// ATUALIZAR OS DADOS DO PERFIL
$resultado = atualizarPerfilUsuario(
    idUsuarioLogado(),
    $_POST['nome'] ?? '',
    $_POST['email'] ?? '',
    $_POST['bio'] ?? '',
    $foto
);

// VERIFICAR O RESULTADO
if ($resultado['sucesso']) {
    header('Location: /Usuario/Perfil.php?perfil=atualizado');
    exit;
}

// REDIRECIONAR COM MENSAGEM DE ERRO
$mensagem = urlencode($resultado['mensagem']);

header("Location: /Usuario/Perfil.php?erro=$mensagem");
exit;

?>