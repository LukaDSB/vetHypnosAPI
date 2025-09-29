<?php
require_once __DIR__ . '/EstadoDTO.php';

class CidadeDTO {
    public function __construct(
        public ?string $cidade_nome,
        public ?EstadoDTO $estado
    ) {}

    public static function fromArray(array $data): self {
        $estadoDTO = isset($data['estado']) ? EstadoDTO::fromArray($data['estado']) : null;
        
        return new self(
            $data['cidade_nome'] ?? null,
            $estadoDTO
        );
    }
}