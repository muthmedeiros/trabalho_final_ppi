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
$peso = $_POST['peso'] ?? '';
$altura = $_POST['altura'] ?? '';
$tipoSanguineo = $_POST['tipoSanguineo'] ?? '';

$hashsenha = password_hash($senha, PASSWORD_DEFAULT);

try {
    $sqlPessoa = <<<SQL
    INSERT INTO Pessoa (nome, sexo, email, telefone, cep, logradouro, cidade, estado)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    SQL;

    $sqlPaciente = <<<SQL
    INSERT INTO Paciente (peso, altura, tipoSanguineo)
    VALUES (?, ?, ?)
    SQL;

    $stm = $pdo->prepare($sqlPessoa);
    $stm->execute([
        $nome, $sexo, $email,
        $telefone, $cep, $logradouro,
        $cidade, $estado
    ]);

    $stm = $pdo->prepare($sqlPaciente);
    $stm->execute([$peso, $altura, $tipoSanguineo]);

    header("location: ../novo_paciente/index.html");
    exit();
} catch (Exception $e) {
    exit('Falha ao cadastrar os dados do paciente: ' . $e->getMessage());
}
