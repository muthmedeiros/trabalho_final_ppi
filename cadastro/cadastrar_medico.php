<?php
require '../conexao_bd/conexao_bd.php';
$pdo = openDb();

$nome = $_POST['nome'] ?? '';
$sexo = $_POST['sexo'] ?? '';
$email = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$cep = $_POST['cep'] ?? '';
$logradouro = $_POST['logradouro'] ?? '';
$cidade = $_POST['cidade'] ?? '';
$estado = $_POST['estado'] ?? '';
$especialidade = $_POST['especialidade'] ?? '';
$crm = $_POST['crm'] ?? '';

$hashsenha = password_hash($senha, PASSWORD_DEFAULT);

try {
    $sqlPessoa = <<<SQL
    INSERT INTO Pessoa (nome, sexo, email, telefone, cep, logradouro, cidade, estado)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
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

    $stm = $pdo->prepare($sqlMedico);
    $stm->execute([$especialidade, $crm]);

    header("location: ../novo_funcionario/index.html");
    exit();
} catch (Exception $e) {
    exit('Falha ao cadastrar os dados do médico: ' . $e->getMessage());
}
