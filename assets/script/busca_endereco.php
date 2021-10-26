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

require '../../connection.php';
$pdo = mysqlConnect();

$cep = $_GET["cep"];

try {
    $sql = <<<SQL
    SELECT cep, logradouro, cidade, estado
    FROM BaseDeEnderecoAjax
    WHERE cep = ?
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cep]);

    $resultado = $stmt->fetch();

    $endereco = new BaseDeEndereco($resultado['cep'], $resultado['logradouro'], $resultado['cidade'], $resultado['estado']);

    echo json_encode($endereco);
} catch (Exception $e) {
    exit('Ocorreu uma falha ao carregar endereço: ' . $e->getMessage());
}
