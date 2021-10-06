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
