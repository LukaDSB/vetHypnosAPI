<?php
class Clinica{
    private ?int $id;
    private ?string $nome;
    private ?int $endereco_id;
    private ?int $contato_id;


    public function __construct(
        ?int $id, 
        ?string $nome, 
        ?int $endereco_id, 
        ?int $contato_id
        ){
        $this->id = $id;
        $this->nome = $nome;
        $this->endereco_id = $endereco_id;
        $this->contato_id = $contato_id;
        }

    
    public static function fromArray($data): self {

        return new self(
    isset($data["clinica_id"]) ? (int) $data["clinica_id"] : null,
        $data["nome"],
$data['endereco_id'],
$data["contato_id"]
        );
    }

    public function toArray(){
         return [
            "clinica_id"=>$this->getId(),
            "nome"=>$this->getNome(),
            "endereco_id"=>$this->getEnderecoId(),
            "contato_id"=>$this->getContatoId(),
        ];
    }

    public function getId():?int{return $this->id;}
    public function getNome():?string{return $this->nome;}
    public function getEnderecoId():?int{return $this->endereco_id;}
    public function getContatoId():?int{return $this->contato_id;}

}