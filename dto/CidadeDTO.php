<?php

require_once __DIR__ . '/../entity/Cidade.php';
require_once __DIR__ . '/../entity/Estado.php';

class CidadeDTO extends Cidade {

    public function __construct(
        ?int $id,
        ?string $nome,
        ?Estado $estado 
    ) {
        parent::__construct($id, $nome, $estado);
    }

    public static function fromArray($data): self {
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
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'estado' => $this->getEstado() ? $this->getEstado()->toArray() : null
        ];
    }
}