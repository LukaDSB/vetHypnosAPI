<?php
// Em dto/ContatoDTO.php

// A classe ContatoDTO não precisa herdar da entidade Contato
// Ela é uma classe de transferência de dados simples e não deve conter
// a lógica de negócio ou estrutura da entidade completa.

class ContatoDTO
{
    private ?string $descricao;
    private ?int $tipoContatoId; // Corrigido para camelCase para seguir a convenção de código

    public function __construct(?string $descricao, ?int $tipoContatoId)
    {
        $this->descricao = $descricao;
        $this->tipoContatoId = $tipoContatoId;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['descricao'] ?? null,
            $data['tipo_contato_id'] ?? null
        );
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function getTipoContatoId(): ?int
    {
        return $this->tipoContatoId;
    }
}