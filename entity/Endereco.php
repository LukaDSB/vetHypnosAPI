<?php
class Endereco{
    private ?int $id;
    private ?string $rua;
    private ?string $numero;
    private ?string $bairro;
    private ?int $cidadeId;
    private ?Cidade $cidade;


    public function __construct(
        ?int $id, 
        ?string $rua, 
        ?string $numero,
        ?string $bairro, 
        ?int $cidadeId,
        ?Cidade $cidade
        ){
        $this->id = $id;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidadeId = $cidadeId;
        $this->cidade = $cidade;
        }

    
    public static function fromArray(array $data): self
    {
        $cidade = null;
        if (isset($data['cidade_id'])) {
            $cidade = new Cidade(
                $data['cidade_id'] ?? null,
                $data['cidade_nome'] ?? null,
                isset($data['estado_id']) ? new Estado($data['estado_id'] ?? null, $data['estado_nome'] ?? null, $data['estado_sigla'] ?? null) : null
            );
        }
        
        return new self(
            $data['endereco_id'] ?? null,
            $data['endereco_rua'] ?? null,
            $data['endereco_numero'] ?? null,
            $data['endereco_bairro'] ?? null,
            $data['cidade_id'] ?? null,
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