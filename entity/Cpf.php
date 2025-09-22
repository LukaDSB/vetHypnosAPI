<?php

declare(strict_types=1);

final class Cpf
{
    private string $numero;

    public function __construct(string $cpf)
    {
        $numeroLimpo = $this->limpar($cpf);
        $this->validar($numeroLimpo);
        $this->numero = $numeroLimpo;
    }

    private function validar(string $cpf): void
    {
        if (strlen($cpf) !== 11) {
            throw new InvalidArgumentException("CPF deve conter 11 dígitos.");
        }

        if (preg_match('/^(\d)\1{10}$/', $cpf)) {
            throw new InvalidArgumentException("CPF com todos os dígitos repetidos é inválido.");
        }

        $primeiroDigito = $this->calcularDigitoVerificador(substr($cpf, 0, 9));
        $segundoDigito = $this->calcularDigitoVerificador(substr($cpf, 0, 10));

        if ($primeiroDigito != $cpf[9] || $segundoDigito != $cpf[10]) {
            throw new InvalidArgumentException("CPF com dígito verificador inválido.");
        }
    }
    
    private function calcularDigitoVerificador(string $base): int
    {
        $soma = 0;
        $multiplicador = strlen($base) + 1;

        for ($i = 0; $i < strlen($base); $i++) {
            $soma += (int)$base[$i] * $multiplicador;
            $multiplicador--;
        }

        $resto = $soma % 11;

        return ($resto < 2) ? 0 : 11 - $resto;
    }

    private function limpar(string $cpf): string
    {
        return preg_replace('/\D/', '', $cpf);
    }
    
    public function getValue(): string
    {
        return $this->numero;
    }
    
    public function getNumeroFormatado(): string
    {
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $this->numero);
    }

    public function __toString(): string
    {
        return $this->getNumeroFormatado();
    }
    
    public function equals(Cpf $outroCpf): bool
    {
        return $this->getValue() === $outroCpf->getValue();
    }
}