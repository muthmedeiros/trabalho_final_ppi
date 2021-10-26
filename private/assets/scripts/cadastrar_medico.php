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
$especialidade = $_POST['inputEspecialidade'] ?? '';
$crm = $_POST['inputCrm'] ?? '';

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

    header("location: ../../src/listagem_funcionarios.php");
    exit();
} catch (Exception $e) {
    exit('Falha ao cadastrar os dados do médico: ' . $e->getMessage());
}
