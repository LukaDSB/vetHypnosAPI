<?php
namespace App\Entity;

class Estado{
   public function __construct(public ?int $id, public ?string $nome) {}
    public static function fromArray(array $data): self {
        return new self($data['estado_id_ref'] ?? null, $data['estado_nome'] ?? null);
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
        ];
    }

    public function getId(): ?int { return $this->id; }
    public function getNome(): ?string { return $this->nome; }
}