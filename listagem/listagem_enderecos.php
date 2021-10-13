<?php
require '../conexao_bd/conexao_bd.php';
$pdo = openDb();

try {
    $sql = <<<SQL
    SELECT cep, logradouro, cidade, estado
    FROM BaseDeEnderecoAjax
    SQL;

    $stmt = $pdo->query($sql);

    header("location: ../pages/listagem_enderecos.php");
    exit();
} catch (Exception $e) {
    exit('Ocorreu uma falha ao listar os endereços: ' . $e->getMessage());
}
