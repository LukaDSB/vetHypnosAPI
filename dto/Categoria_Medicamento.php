<?php
    class Categoria_Medicamento{
        private ? int $id;
        private ?string $descricao;


    public function __construct(?int $id, ?string $descricao){
        $this->id = $id;
        $this->descricao = $descricao;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'descricao' => $this->descricao
        ];
    }

    public static function fromArray(array $data): self {
        return new self(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['descricao']
        );
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    public function getdescricao(){return $this->descricao;}
    public function setdescricao($descricao){$this->descricao = $descricao;}
}