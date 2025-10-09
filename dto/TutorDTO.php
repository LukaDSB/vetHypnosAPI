<?php
namespace App\DTO;

use App\Entity\Nome;
use App\Entity\Cpf;

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