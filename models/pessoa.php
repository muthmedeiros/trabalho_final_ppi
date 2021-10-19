<?php
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
