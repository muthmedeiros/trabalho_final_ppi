<?php
require '../connection.php';
$pdo = mysqlConnect();

$nome = $_POST['nome'] ?? '';
$sexo = $_POST['sexo'] ?? '';
$email = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$cep = $_POST['cep'] ?? '';
$logradouro = $_POST['logradouro'] ?? '';
$cidade = $_POST['cidade'] ?? '';
$estado = $_POST['estado'] ?? '';
$dataContrato = $_POST['dataContrato'] ?? '';
$salario = $_POST['salario'] ?? '';
$senha = $_POST['senha'] ?? '';
$especialidade = $_POST['especialidade'] ?? '';
$crm = $_POST['crm'] ?? '';

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

try {
    $sqlPessoa = <<<SQL
    INSERT INTO Pessoa (nome, sexo, email, telefone, cep, logradouro, cidade, estado)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    SQL;

    $sqlFuncionario = <<<SQL
    INSERT INTO Funcionario (dataContrato, salario, senhaHash)
    VALUES (?, ?, ?)
    SQL;

    $sqlMedico = <<<SQL
    INSERT INTO Medico (especialidade, crm)
    VALUES (?, ?)
    SQL;

    $stm = $pdo->prepare($sqlPessoa);
    $stm->execute([
        $nome, $sexo, $email,
        $telefone, $cep, $logradouro,
        $cidade, $estado
    ]);

    $stm = $pdo->prepare($sqlFuncionario);
    $stm->execute([$dataContrato, $salario, $senhaHash]);

    $stm = $pdo->prepare($sqlMedico);
    $stm->execute([$especialidade, $crm]);

    header("location: ../pages/listagem_funcionarios.php");
    exit();
} catch (Exception $e) {
    exit('Falha ao cadastrar os dados do médico: ' . $e->getMessage());
}
