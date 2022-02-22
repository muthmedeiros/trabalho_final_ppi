<?php
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
