<?php
// Em dto/CidadeDTO.php

require_once __DIR__ . '/../entity/Cidade.php';
require_once __DIR__ . '/../entity/Estado.php'; // Use a entidade, não o DTO, para criar o objeto

class CidadeDTO extends Cidade {

    // CORREÇÃO: O construtor deve ser compatível com o do pai
    public function __construct(
        ?int $id,
        ?string $nome,
        ?Estado $estado // Recebe o objeto Estado
    ) {
        // CORREÇÃO: Passa o objeto Estado para o construtor do pai
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
            $estado // Passa o objeto Estado criado
        );
    }

    // CORREÇÃO: Adiciona o tipo de retorno ": array" para ser compatível
    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            // Usa o getter da classe pai para pegar o objeto e serializá-lo
            'estado' => $this->getEstado() ? $this->getEstado()->toArray() : null
        ];
    }
}