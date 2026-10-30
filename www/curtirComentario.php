<?php

require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/autenticacao.php';

// VERIFICAR SE O USUÁRIO ESTÁ LOGADO
if (!usuarioLogado()) {
    header('Location: /index.php');
    exit;
}

// VERIFICAR SE A REQUISIÇÃO É POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /index.php');
    exit;
}

$conexao = conectarBanco();
$usuarioId = idUsuarioLogado();

// IDENTIFICAR A AÇÃO
$acao = $_POST['acao'] ?? 'curtir';

// EXCLUIR COMENTÁRIO
if ($acao === 'excluir') {

    $obraId = filter_input(INPUT_POST, 'obra_id', FILTER_VALIDATE_INT);

    if (!$obraId || $obraId <= 0) {
        header('Location: /index.php');
        exit;
    }

    // EXCLUIR SOMENTE O COMENTÁRIO DO USUÁRIO LOGADO
    $consulta = $conexao->prepare("
        DELETE FROM comentarios
        WHERE obra_id = :obra_id
          AND usuario_id = :usuario_id
    ");

    $consulta->execute([
        ':obra_id' => $obraId,
        ':usuario_id' => $usuarioId
    ]);

    header('Location: /obras.php?id=' . $obraId);
    exit;
}

// CURTIR OU REMOVER CURTIDA
if ($acao === 'curtir') {

    $comentarioId = filter_input(INPUT_POST, 'comentario_id', FILTER_VALIDATE_INT);

    if (!$comentarioId || $comentarioId <= 0) {
        header('Location: /index.php');
        exit;
    }

    // BUSCAR A OBRA DO COMENTÁRIO
    $consultaObra = $conexao->prepare("
        SELECT obra_id
        FROM comentarios
        WHERE id = :comentario_id
    ");

    $consultaObra->execute([
        ':comentario_id' => $comentarioId
    ]);

    $obraId = $consultaObra->fetchColumn();

    if (!$obraId) {
        header('Location: /index.php');
        exit;
    }

    // VERIFICAR SE O USUÁRIO JÁ CURTIU
    $consultaCurtida = $conexao->prepare("
        SELECT id
        FROM curtidas_comentarios
        WHERE comentario_id = :comentario_id
          AND usuario_id = :usuario_id
    ");

    $consultaCurtida->execute([
        ':comentario_id' => $comentarioId,
        ':usuario_id' => $usuarioId
    ]);

    $curtida = $consultaCurtida->fetchColumn();

    if ($curtida) {

        // REMOVER CURTIDA
        $consulta = $conexao->prepare("
            DELETE FROM curtidas_comentarios
            WHERE comentario_id = :comentario_id
              AND usuario_id = :usuario_id
        ");

        $consulta->execute([
            ':comentario_id' => $comentarioId,
            ':usuario_id' => $usuarioId
        ]);

    } else {

        // ADICIONAR CURTIDA
        $consulta = $conexao->prepare("
            INSERT INTO curtidas_comentarios
                (comentario_id, usuario_id)
            VALUES
                (:comentario_id, :usuario_id)
        ");

        $consulta->execute([
            ':comentario_id' => $comentarioId,
            ':usuario_id' => $usuarioId
        ]);
    }

    header('Location: /obras.php?id=' . $obraId);
    exit;
}

// AÇÃO INVÁLIDA
header('Location: /index.php');
exit;