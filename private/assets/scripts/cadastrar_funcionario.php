<?php
require '../../../connection.php';
$pdo = mysqlConnect();

$nome = $_POST['inputNome'] ?? '';
$sexo = $_POST['inputSexo'] ?? '';
$email = $_POST['inputEmail'] ?? '';
$telefone = $_POST['inputTelefone'] ?? '';
$cep = $_POST['inputCep'] ?? '';
$logradouro = $_POST['inputLogradouro'] ?? '';
$cidade = $_POST['inputCidade'] ?? '';
$estado = $_POST['inputEstado'] ?? '';
$dataContrato = $_POST['inputDataContrato'] ?? '';
$salario = $_POST['inputSalario'] ?? '';
$senha = $_POST['inputSenha'] ?? '';

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

try {
    $pdo->beginTransaction();
    
    $sqlPessoa = <<<SQL
    INSERT INTO Pessoa (nome, sexo, email, telefone, cep, logradouro, cidade, estado)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    SQL;

    $stmt = $pdo->prepare($sqlPessoa);
    $result1 = $stmt->execute([
        $nome, $sexo, $email,
        $telefone, $cep, $logradouro,
        $cidade, $estado
    ]);
    if(!$result1) {
        throw new Exception('Falha na operação em Pessoa.');
    }

    $lastInsertedId = $pdo->lastInsertId();

    $sqlFuncionario = <<<SQL
    INSERT INTO Funcionario (codigo, dataContrato, salario, senhaHash)
    VALUES (?, ?, ?, ?)
    SQL;

    $stm = $pdo->prepare($sqlFuncionario);
    $result2 = $stm->execute([
        $lastInsertedId, $dataContrato, $salario, $senhaHash
    ]);
    if(!$result2) {
        throw new Exception('Falha na operação em Funcionário.');
    }

    $pdo->commit();

    header("location: ../../src/listagem_funcionarios.php");
    exit();
} catch (Exception $e) {
    exit('Falha ao cadastrar os dados do funcionário: ' . $e->getMessage());
}
