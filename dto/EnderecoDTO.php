<?php
namespace App\DTO;

use App\DTO\CidadeDTO;

class EnderecoDTO {
    public function __construct(
        public ?string $rua,
        public ?string $numero,
        public ?string $bairro,
        public ?CidadeDTO $cidade
    ) {}

    public static function fromArray(array $data): self {
        $cidadeDTO = isset($data['cidade']) ? CidadeDTO::fromArray($data['cidade']) : null;
        
        return new self(
            $data['rua'] ?? null,
            $data['numero'] ?? null,
            $data['bairro'] ?? null,
            $cidadeDTO
        );
    }
}