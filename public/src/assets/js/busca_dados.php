<?php

class Agenda
{
    public $data;
    public $horario;
    public $nome;
    public $sexo;
    public $email;
    public $cdMedico;

    function __construct($data, $horario, $nome, $sexo, $email, $cdMedico)
    {
        $this->data = $data;
        $this->horario = $horario;
        $this->nome = $nome;
        $this->sexo = $sexo;
        $this->email = $email;
        $this->cdMedico = $cdMedico;
    }
}

class Medico extends Funcionario
{
    public $especialidade;
    public $crm;

    function __construct($especialidade, $crm)
    {
        $this->especialidade = $especialidade;
        $this->crm = $crm;
    }
}

class Pessoa
{
    public $nome;
    public $sexo;
    public $email;
    public $telefone;
    public $cep;
    public $logradouro;
    public $cidade;
    public $estado;

    function __construct($nome, $sexo, $email, $telefone, $cep, $logradouro, $cidade, $estado)
    {
        $this->nome = $nome;
        $this->sexo = $sexo;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->cidade = $cidade;
        $this->estado = $estado;
    }
}


require './PROJETO-FINAL/connection.php';
$pdo = mysqlConnect();

$especilidade = $_GET['especialidade'];

try {
    $sql = <<<SQL
    SELECT especialidade
    FROM Medico
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$especilidade]);

    $data = $stmt->fetchAll();

    return $data;
} catch (Exception $e) {
    exit('Ocorreu uma falha ao listar os endereços: ' . $e->getMessage());
}




try {
    $sql = <<<SQL
    SELECT nome
    FROM Pessoa
    WHERE nome = ?  
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$especilidade]);

    $data = $stmt->fetchAll();

    return $data;
} catch (Exception $e) {
    exit('Ocorreu uma falha ao listar os endereços: ' . $e->getMessage());
}
