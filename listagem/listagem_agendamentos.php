<?php
require '../conexao_bd/conexao_bd.php';
$pdo = openDb();

try {
    $sql = <<<SQL
    SELECT codigo, data, horario, nome, sexo, email, codigoMedico
    FROM Agenda
    SQL;

    $stmt = $pdo->query($sql);

    header("location: ../listagem_agendamentos/index.html");
    exit();
} catch (Exception $e) {
    exit('Ocorreu uma falha ao listar os agendamentos: ' . $e->getMessage());
}
