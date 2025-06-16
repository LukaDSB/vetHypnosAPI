<?php

class Estado{
    private ?int $id;
    private ?string $nome;

    public function __construct(?int $id, ?string $nome){
        $this->id = $id;
        $this->nome = $nome;
    }

    
    public static function fromArray(array $data): self {
        return new self(
            isset($data['estado_id']) ? (int) $data['estado_id'] : null,
            $data['estado_nome'],
        );
    }

    public function toArray(){
         return [
            'estado_id' => $this->id,
            'estado_nome' => $this->nome
        ];
    }

    public function getId(): ?int{return $this->id;}
    public function getNome(): ?string{return $this->nome;}
}