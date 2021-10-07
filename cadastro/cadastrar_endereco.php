<?php
require '../conexao_bd/conexao_bd.php';
$pdo = openDb();

$cep = $_POST['cep'] ?? '';
$logradouro = $_POST['logradouro'] ?? '';
$cidade = $_POST['cidade'] ?? '';
$estado = $_POST['estado'] ?? '';

try {
    $sqlEndereco = <<<SQL
    INSERT INTO BaseDeEnderecoAjax (cep, logradouro, cidade, estado)
    VALUES (?, ?, ?, ?)
    SQL;

    $stm = $pdo->prepare($sqlEndereco);
    $stm->execute([$cep, $logradouro, $cidade, $estado]);

    //header("location: ../novo_paciente/index.html");
    exit();
} catch (Exception $e) {
    exit('Falha ao cadastrar o endereço: ' . $e->getMessage());
}
