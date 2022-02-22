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
