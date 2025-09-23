<?php
class EnderecoDTO
{
    private ?int $id;
    private ?string $rua;
    private ?string $numero;
    private ?string $bairro;
    private ?int $cidadeId;

    public function __construct(
        ?int $id,
        ?string $rua,
        ?string $numero,
        ?string $bairro,
        ?int $cidadeId
    ) {
        $this->id = $id;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidadeId = $cidadeId;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['rua'] ?? null,
            $data['numero'] ?? null,
            $data['bairro'] ?? null,
            $data['cidade_id'] ?? null
        );
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRua(): ?string
    {
        return $this->rua;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function getBairro(): ?string
    {
        return $this->bairro;
    }

    public function getCidadeId(): ?int
    {
        return $this->cidadeId;
    }
}