<?php
class Endereco{
    private ?int $id;
    private ?string $rua;
    private ?string $numero;
    private ?string $bairro;
    private ?int $cidade_id;


    public function __construct(
        ?int $id, 
        ?string $rua, 
        ?string $numero,
        ?string $bairro, 
        ?int $cidade_id
        ){
        $this->id = $id;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade_id = $cidade_id;
        }

    
    public static function fromArray($data): self {
        return new self(
        isset($data["endereco_id"]) ? (int) $data["endereco_id"] : null,
        $data["endereco_rua"],
        $data['endereco_numero'],
        $data["endereco_bairro"],
        $data["cidade_id"]

        );
    }

    public function toArray(){
         return [
            "endereco_id"=>$this->getId(),
            "endereco_rua"=>$this->getRua(),
            "endereco_numero"=>$this->getNumero(),
            "endereco_bairro"=>$this->getBairro(),
            "cidade_id"=>$this->getCidade(),
        ];
    }

    public function getId():?int{return $this->id;}
    public function getRua():?string{return $this->rua;}
    public function getNumero():?string{return $this->numero;}
    public function getBairro():?string{return $this->bairro;}
    public function getCidade():?string{return $this->cidade_id;}

}