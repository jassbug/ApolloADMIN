<?php

require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/autenticacao.php';

// VERIFICAR SE O USUÁRIO ESTÁ LOGADO
if (!usuarioLogado()) {
    header('Location: Autenticacao/login.php');
    exit;
}

// VERIFICAR SE O FORMULÁRIO FOI ENVIADO
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /index.php');
    exit;
}

// RECEBER OS DADOS
$obraId = filter_input(INPUT_POST, 'obra_id', FILTER_VALIDATE_INT);
$nota = filter_input(INPUT_POST, 'nota', FILTER_VALIDATE_INT);
$comentario = trim($_POST['comentario'] ?? '');

// VALIDAR OS DADOS
if (!$obraId || $obraId <= 0 || !$nota || $nota < 1 || $nota > 10 || strlen($comentario) > 2000) {
    header('Location: /index.php');
    exit;
}

// BUSCAR O USUÁRIO LOGADO
$usuarioId = idUsuarioLogado();

$conexao = conectarBanco();

try {

    // VERIFICAR SE A OBRA EXISTE
    $consultaObra = $conexao->prepare("
        SELECT id
        FROM obras
        WHERE id = :id
          AND ativo = 1
    ");

    $consultaObra->execute([
        ':id' => $obraId
    ]);

    if (!$consultaObra->fetch()) {
        header('Location: /index.php');
        exit;
    }

    // SALVAR OU ATUALIZAR A AVALIAÇÃO
    $consultaAvaliacao = $conexao->prepare("
        INSERT INTO avaliacoes (obra_id, usuario_id, nota)
        VALUES (:obra_id, :usuario_id, :nota)
        ON DUPLICATE KEY UPDATE
            nota = VALUES(nota),
            data_atualizacao = CURRENT_TIMESTAMP
    ");

    $consultaAvaliacao->execute([
        ':obra_id' => $obraId,
        ':usuario_id' => $usuarioId,
        ':nota' => $nota
    ]);


    if ($comentario !== '') {

        $consultaComentario = $conexao->prepare("
            INSERT INTO comentarios (obra_id, usuario_id, comentario)
            VALUES (:obra_id, :usuario_id, :comentario)
            ON DUPLICATE KEY UPDATE
                comentario = VALUES(comentario),
                data_criacao = CURRENT_TIMESTAMP
        ");

        $consultaComentario->execute([
            ':obra_id' => $obraId,
            ':usuario_id' => $usuarioId,
            ':comentario' => $comentario
        ]);
    }


    // VOLTAR PARA A PÁGINA DA OBRA
    header('Location: /obras.php?id=' . $obraId);
    exit;

} catch (PDOException $erro) {

    error_log('Erro ao salvar avaliação: ' . $erro->getMessage());

    header('Location: /obras.php?id=' . $obraId);
    exit;
}
