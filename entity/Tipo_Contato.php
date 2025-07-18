<?php
class Tipo_Contato {
    private $id;
    private $descricao;

    public function __construct($id, $descricao) {
        $this->id = $id;
        $this->descricao = $descricao;
    }

    public function toArray(): array {
        return [
            'tipo_contato_id' => $this->id,
            'tipo_contato_descricao' => $this->descricao,
        ];
    }

    public static function fromArray(array $data): self {
        return new self(
            isset($data['tipo_contato_id']) ? (int) $data['tipo_contato_id'] : null,
            $data['tipo_contato_descricao'],
        );
    }
}