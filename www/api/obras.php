<?php

require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json; charset=utf-8');

try {

    $obras = buscarObrasEmAlta();

    echo json_encode([
        'sucesso' => true,
        'obras' => $obras
    ], JSON_UNESCAPED_UNICODE);

} catch (Throwable $erro) {

    http_response_code(500);

    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Erro ao buscar obras.'
    ], JSON_UNESCAPED_UNICODE);
}