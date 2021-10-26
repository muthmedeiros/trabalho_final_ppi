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

    header("location: ../../src/listagem_pacientes.php");
    exit();
} catch (Exception $e) {
    exit('Falha ao cadastrar os dados do paciente: ' . $e->getMessage());
}
