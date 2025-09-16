<?php
class Endereco{
    private ?int $id;
    private ?string $rua;
    private ?string $numero;
    private ?string $bairro;
    private ?Cidade $cidade;


    public function __construct(
        ?int $id, 
        ?string $rua, 
        ?string $numero,
        ?string $bairro, 
        ?Cidade $cidade
        ){
        $this->id = $id;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        }

    
    public static function fromArray($data): self {
        $cidade = null;
        if (!empty($data['cidade_id_ref'])) {
            $cidade = Cidade::fromArray($data);
        }
        return new self(
            $data["endereco_id_ref"] ?? null,
            $data["endereco_rua"] ?? null,
            $data['endereco_numero'] ?? null,
            $data["endereco_bairro"] ?? null,
            $cidade
        );
    }

    public function toArray(): array {
    return [
        "id" => $this->id,
        "rua" => $this->rua,
        "numero" => $this->numero,
        "bairro" => $this->bairro,
        "cidade" => $this->cidade ? $this->cidade->toArray() : null,
    ];
}

    public function getId():?int{return $this->id;}
    public function getRua():?string{return $this->rua;}
    public function getNumero():?string{return $this->numero;}
    public function getBairro():?string{return $this->bairro;}
    public function getCidade():?Cidade { return $this->cidade; }

}