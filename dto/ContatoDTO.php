<?php
class ContatoDTO
{
    private ?string $descricao;
    private ?int $tipoContatoId;

    public function __construct(?string $descricao, ?int $tipoContatoId)
    {
        $this->descricao = $descricao;
        $this->tipoContatoId = $tipoContatoId;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['descricao'] ?? null,
            $data['tipo_contato_id'] ?? null
        );
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function getTipoContatoId(): ?int
    {
        return $this->tipoContatoId;
    }
}