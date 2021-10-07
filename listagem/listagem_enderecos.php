<?php
require '../conexao_bd/conexao_bd.php';
$pdo = openDb();

try {
    $sql = <<<SQL
    SELECT cep, logradouro, cidade, estado
    FROM BaseDeEnderecoAjax
    SQL;

    $stmt = $pdo->query($sql);

    header("location: ../listagem_enderecos/index.html");
    exit();
} catch (Exception $e) {
    exit('Ocorreu uma falha ao listar os endereços: ' . $e->getMessage());
}
