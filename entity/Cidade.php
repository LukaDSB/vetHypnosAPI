<?php
class Cidade{
    private ?int $id;
    private ?string $nome;
    private ?int $estado_id;

    public function __construct(?int $id, ?string $nome, ?int $estado_id){
        $this->id = $id;
        $this->nome = $nome;
        $this->estado_id = $estado_id;
    }

    
    public static function fromArray(array $data): self {

        return new self(
            isset($data['cidade_id']) ? (int) $data['cidade_id'] : null,
            $data['cidade_nome'],
            $data["estado_id"]

        );
    }

    public function toArray(){
         return [
            'cidade_id' => $this->id,
            'cidade_nome' => $this->nome,
            'estado_id'=> $this->estado_id

        ];
    }

    public function getId(){return $this->id;}
    public function getNome(){return $this->nome;}
    public function getEstado_id(){return $this->estado_id;}
}