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

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$codigoMedico]);

    header("location: ../pages/listagem_meus_agendamentos.html");
    exit();
} catch (Exception $e) {
    exit('Ocorreu uma falha ao listar os agendamentos: ' . $e->getMessage());
}
