<?php

require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/autenticacao.php';

// VERIFICAR SE O USUÁRIO ESTÁ LOGADO
exigirLogin();

// ACEITAR SOMENTE POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /index.php');
    exit;
}

// RECEBER OS DADOS
$comentarioId = filter_input(
    INPUT_POST,
    'comentario_id',
    FILTER_VALIDATE_INT
);

$obraId = filter_input(
    INPUT_POST,
    'obra_id',
    FILTER_VALIDATE_INT
);

$token = $_POST['csrf_token'] ?? '';

// VERIFICAR O TOKEN DE SEGURANÇA
if (
    empty($token) ||
    empty($_SESSION['csrf_denuncias']) ||
    !hash_equals($_SESSION['csrf_denuncias'], $token)
) {

    $_SESSION['mensagem_denuncia'] = 'Solicitação inválida.';
    $_SESSION['tipo_denuncia'] = 'danger';

} elseif (!$comentarioId || !$obraId) {

    $_SESSION['mensagem_denuncia'] = 'Comentário inválido.';
    $_SESSION['tipo_denuncia'] = 'danger';

} else {

    try {

        // REGISTRAR A DENÚNCIA
        $resultado = denunciarComentario(
            $comentarioId,
            idUsuarioLogado()
        );

        $_SESSION['mensagem_denuncia'] = $resultado['mensagem'];

        $_SESSION['tipo_denuncia'] = $resultado['sucesso']
            ? 'success'
            : 'warning';

    } catch (PDOException $erro) {

        error_log($erro->getMessage());

        $_SESSION['mensagem_denuncia'] =
            'Não foi possível registrar a denúncia.';

        $_SESSION['tipo_denuncia'] = 'danger';
    }
}

// VOLTAR PARA A OBRA
header('Location: /obras.php?id=' . (int) $obraId);
exit;
