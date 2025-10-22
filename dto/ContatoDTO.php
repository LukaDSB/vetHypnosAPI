<?php
namespace App\DTO;

class ContatoDTO
{
    public ?int $id;
    private ?string $descricao;
    private ?int $tipoContatoId;

    public function __construct(?int $id, ?string $descricao, ?int $tipoContatoId)
    {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->tipoContatoId = $tipoContatoId;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "descricao" => $this->descricao,
            "tipo_contato_id" => $this->tipoContatoId,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['descricao'] ?? null,
            $data['tipo_contato_id'] ?? null
        );
    }

    public function getId(): ?int {
        return $this->id;
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