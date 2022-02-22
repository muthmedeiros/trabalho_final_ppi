<?php
class Paciente extends Pessoa
{
    public $peso;
    public $altura;
    public $tipoSangue;

    function __construct($peso, $altura, $tipoSangue)
    {
        $this->peso = $peso;
        $this->altura = $altura;
        $this->tipoSangue = $tipoSangue;
    }
}
