<?php
namespace App\Entity;

class TipoContato {
    private $id;
    private $descricao;

    public function __construct($id, $descricao) {
        $this->id = $id;
        $this->descricao = $descricao;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'descricao' => $this->descricao,
        ];
    }

    public static function fromArray(array $data): self {
        return new self(
            $data['tipo_contato_id_ref'] ?? null,
            $data['tipo_contato_descricao'] ?? null
        );
    }
}