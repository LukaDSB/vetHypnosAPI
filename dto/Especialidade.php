<?php
class Especialidade{
    private ? int $id;
    private ? string $nome;
    private ? string $descricao;
 

    public function __construct(
        ?int $id,
        ?string $nome,
        ?string $descricao,
    
        ){ 
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
    
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'nome'=> $this->nome,
            'descricao' => $this->descricao,
        ];
    }

    public static function fromArray(array $data): self {
        return new self(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['nome'],
            $data['descricao'],
            
        );
    }
    public function getId() { return $this->id; }
    public function getNome(){return $this->nome;}
    public function getDescricao(){return $this->descricao;}

    public function setId($id){ $this -> $id = $id;}
    public function setNome($nome){ $this -> $nome = $nome;}
    public function setDescricao($descricao){ $this -> $descricao = $descricao;}
    
    
}