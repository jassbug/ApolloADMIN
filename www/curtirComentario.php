<?php

require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/autenticacao.php';

// VERIFICAR SE O USUÁRIO ESTÁ LOGADO
if (!usuarioLogado()) {
    header('Location: /login.php');
    exit;
}

// VERIFICAR O ENVIO DO FORMULÁRIO
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /index.php');
    exit;
}

// BUSCAR O ID DO COMENTÁRIO
$comentarioId = filter_input(INPUT_POST, 'comentario_id', FILTER_VALIDATE_INT);

if (!$comentarioId || $comentarioId <= 0) {
    header('Location: /index.php');
    exit;
}

$conexao = conectarBanco();

try {

    // BUSCAR A OBRA DO COMENTÁRIO
    $consultaComentario = $conexao->prepare("
        SELECT obra_id
        FROM comentarios
        WHERE id = :id
    ");

    $consultaComentario->execute([
        ':id' => $comentarioId
    ]);

    $obraId = $consultaComentario->fetchColumn();

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
        ':usuario_id' => idUsuarioLogado()
    ]);

    $curtida = $consultaCurtida->fetchColumn();

    if ($curtida) {

        // REMOVER CURTIDA
        $consultaRemover = $conexao->prepare("
            DELETE FROM curtidas_comentarios
            WHERE comentario_id = :comentario_id
              AND usuario_id = :usuario_id
        ");

        $consultaRemover->execute([
            ':comentario_id' => $comentarioId,
            ':usuario_id' => idUsuarioLogado()
        ]);

    } else {

        // ADICIONAR CURTIDA
        $consultaAdicionar = $conexao->prepare("
            INSERT INTO curtidas_comentarios
                (comentario_id, usuario_id)
            VALUES
                (:comentario_id, :usuario_id)
        ");

        $consultaAdicionar->execute([
            ':comentario_id' => $comentarioId,
            ':usuario_id' => idUsuarioLogado()
        ]);
    }

    header('Location: /Obras.php?id=' . $obraId);
    exit;

} catch (PDOException $erro) {

    error_log('Erro ao curtir comentário: ' . $erro->getMessage());

    header('Location: /Obras.php?id=' . $obraId);
    exit;
}
