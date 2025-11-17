<?php
namespace App\Entity;

class Especialidade {
    private ?int $id;
    private ?string $nome;
    private ?string $descricao;

    public function __construct(?int $id, ?string $nome, ?string $descricao) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
    }

    public static function fromArray(array $data): self {
        return new self(
            $data['id'] ?? null,
            $data['nome'] ?? null,
            $data['descricao'] ?? null
        );
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
        ];
    }
}