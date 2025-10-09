<?php
namespace App\DTO;

class EstadoDTO {
    public function __construct(
        public ?string $estado_nome
    ) {}

    public static function fromArray(array $data): self {
        return new self(
            $data['estado_nome'] ?? null
        );
    }
}