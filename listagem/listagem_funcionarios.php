<?php
require '../conexao_bd/conexao_bd.php';
$pdo = openDb();

try {
    $sql = <<<SQL
    SELECT PE.nome, PE.sexo, PE.email, PE.telefone, 
    PE.cep, PE.logradouro, PE.cidade, PE.estado, 
    FU.dataContrato, FU.salario, FU.senhaHash
    FROM Pessoa AS PE, Funcionario AS FU
    SQL;

    $stmt = $pdo->query($sql);
} catch (Exception $e) {
    exit('Ocorreu uma falha ao listar os funcionarios: ' . $e->getMessage());
}
