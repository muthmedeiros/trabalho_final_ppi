<?php
class Funcionario extends Pessoa
{
    public $dataInicioContrato;
    public $salario;
    public $senha;

    function __construct($dataInicioContrato, $salario, $senha)
    {
        $this->dataInicioContrato = $dataInicioContrato;
        $this->salario = $salario;
        $this->senha = $senha;
    }
}
