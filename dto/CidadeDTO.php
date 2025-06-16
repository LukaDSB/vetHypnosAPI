<?php
require_once __DIR__ .'/../dto/EstadoDTO.php';
require_once __DIR__ .'/../entity/Cidade.php';
class CidadeDTO extends Cidade {
    private ?EstadoDTO $estado;

    public function __construct(?int $id, ?string $nome, ?int $estado_id, ?EstadoDTO $estado) {
        parent::__construct($id, $nome, $estado_id);
        $this->estado = $estado;
    }
    public static function fromArray($data): self {
        $estado = null;
        if (isset($data['estado_id'] )&& isset($data["estado_nome"])) {
            $estado = EstadoDTO::fromArray($data);
        }
        return new self(
            $data['cidade_id'] ?? null,
            $data['cidade_nome'],
            $data['estado_id'],
            $estado
        );
    }

    public function toArray() {
        return [
            'cidade_id'=> $this->getId(),
            'cidade_nome'=> $this->getNome(),
            'estado_id'=> $this->getEstado_id(),
            'estado' => $this->estado ? $this->estado->toArray() : null
        ];
    }
}