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
            'id' => $this->id,
            'descricao' => $this->descricao,
        ];
    }


    public static function fromArray(array $data): self {
        return new self(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['descricao'],
        );
    }
}

?>