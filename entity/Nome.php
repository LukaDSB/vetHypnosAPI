<?php
declare(strict_types=1);
namespace App\Entity;

final class Nome
{
    private string $nome;

    public function __construct(string $nome)
    {
        $nomeLimpo = trim($nome);
        $this->validar($nomeLimpo);
        $this->nome = $nomeLimpo;
    }

    private function validar(string $nome): void
    {
        if ($nome === '') {
            throw new \InvalidArgumentException("O nome não pode ser vazio.");
        }

        if (!preg_match('/^[\p{L}\s]+$/u', $nome)) {
            throw new \InvalidArgumentException("O nome deve conter apenas letras e espaços.");
        }
    }

    public function getValue(): string
    {
        return $this->nome;
    }

    public function __toString(): string
    {
        return $this->nome;
    }
}