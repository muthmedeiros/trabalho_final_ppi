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
$peso = $_POST['inputPeso'] ?? '';
$altura = $_POST['inputAltura'] ?? '';
$tipoSanguineo = $_POST['inputTipoSanguineo'] ?? '';

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

    $sqlPaciente = <<<SQL
    INSERT INTO Paciente (codigo, peso, altura, tipoSanguineo)
    VALUES (?, ?, ?, ?)
    SQL;
   
    $stmt = $pdo->prepare($sqlPaciente);
    $result2 = $stmt->execute([$lastInsertedId, $peso, $altura, $tipoSanguineo]);
    if(!$result2) {
        throw new Exception('Falha na operação em Paciente.');
    }

    $pdo->commit();

    header("location: ../../src/listagem_pacientes.php");
    exit();
} catch (Exception $e) {
    exit('Falha ao cadastrar os dados do paciente: ' . $e->getMessage());
}
