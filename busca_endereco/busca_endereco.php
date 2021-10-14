<?php
class BaseDeEndereco
{
    public $cep;
    public $logradouro;
    public $cidade;
    public $estado;

    function __construct($cep, $logradouro, $cidade, $estado)
    {
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->cidade = $cidade;
        $this->estado = $estado;
    }
}

require '../conexao_bd/conexao_bd.php';
$pdo = openDb();

$cep = $_GET['inputCep'] ?? '';

try {
    $sql = <<<SQL
    SELECT logradouro, cidade, estado
    FROM BaseDeEnderecoAjax
    WHERE cep = ?
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cep]);

    $data = $stmt->fetchAll();

    return $data;
} catch (Exception $e) {
    exit('Ocorreu uma falha ao listar os endereços: ' . $e->getMessage());
}
