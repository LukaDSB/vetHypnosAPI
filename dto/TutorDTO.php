<?php
require_once __DIR__ . '/../entity/Nome.php';
require_once __DIR__ . '/../entity/Cpf.php';

class TutorDTO
{
    private Nome $nome;
    private Cpf $cpf;

    public function __construct(Nome $nome, Cpf $cpf)
    {
        $this->nome = $nome;
        $this->cpf = $cpf;
    }

    public function getNome(): Nome
    {
        return $this->nome;
    }

    public function getCpf(): Cpf
    {
        return $this->cpf;
    }
}