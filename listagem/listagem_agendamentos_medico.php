<?php
require '../conexao_bd/conexao_bd.php';
$pdo = openDb();

$codigoMedico = $_GET['codigoMedico'] ?? '';

try {
    $sql = <<<SQL
    SELECT codigo, data, horario, nome, sexo, email, codigoMedico
    FROM Agenda
    WHERE codigoMedico = ?
    SQL;

    $stm = $pdo->prepare($sql);
    $stm->execute([$codigoMedico]);

    header("location: ../listagem_meus_agendamentos/index.html");
    exit();
} catch (Exception $e) {
    exit('Ocorreu uma falha ao listar os agendamentos: ' . $e->getMessage());
}
