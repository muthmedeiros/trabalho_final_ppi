<?php
require '../conexao_bd/conexao_bd.php';
$pdo = openDb();

try {
    $sql = <<<SQL
    SELECT PE.nome, PE.sexo, PE.email, PE.telefone, 
    PE.cep, PE.logradouro, PE.cidade, PE.estado, 
    PA.peso, PA.altura, PA.tipoSanguineo
    FROM Pessoa AS PE, Paciente AS PA
    SQL;

    $stmt = $pdo->query($sql);

    header("location: ../listagem_funcionarios/index.html");
    exit();
} catch (Exception $e) {
    exit('Ocorreu uma falha ao listar os pacientes: ' . $e->getMessage());
}
