<?php

class Cidade {
    public function __construct(
        public ?int $id,
        public ?string $nome,
        public ?Estado $estado
    ) {}

    public static function fromArray(array $data): self {
        $estado = null;
        if (!empty($data['estado_id_ref'])) {
            $estado = Estado::fromArray($data);
        }
        return new self(
            $data['cidade_id_ref'] ?? null,
            $data['cidade_nome'] ?? null,
            $estado
        );
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'estado' => $this->estado ? $this->estado->toArray() : null,
        ];
    }
    
    public function getId(): ?int { return $this->id; }
    public function getNome(): ?string { return $this->nome; }
    public function getEstado(): ?Estado { return $this->estado; }
}