<?php
namespace App\DTO;

use App\DTO\EstadoDTO;

class CidadeDTO {
    public function __construct(
        public ?int $id,
        public ?string $cidade_nome,
        public ?EstadoDTO $estado
    ) {}

    public static function fromArray(array $data): self {
        $estadoDTO = isset($data['estado']) ? EstadoDTO::fromArray($data['estado']) : null;
        
        return new self(
            $data['id'] ?? null,
            $data['cidade_nome'] ?? null,
            $estadoDTO
        );
    }
}