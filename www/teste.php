<?php
try {
    $pdo = new PDO(
        "mysql:host=mysql;port=3306;dbname=pi_apollo;charset=utf8mb4",
        "root",
        "1234"
    );
    echo "CONEXAO WEB OK";
} catch (PDOException $e) {
    echo "ERRO: " . $e->getMessage();
}
?>
