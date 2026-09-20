<?php

require_once __DIR__ . '/../includes/autenticacao.php';

sairDaConta();

header('Location: /index.php');
exit;