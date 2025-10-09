<?php
namespace App\Entity;

use App\Entity\TipoContato;
class Contato
{
    private ?int $id;
    private ?string $descricao;
    private ?int $tipo_contato_id;
    private ?TipoContato $tipoContato;

    public function __construct(
        ?int $id,
        ?string $descricao,
        ?int $tipo_contato_id,
        ?TipoContato $tipoContato
    ) {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->tipo_contato_id = $tipo_contato_id;
        $this->tipoContato = $tipoContato;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "descricao" => $this->descricao,
            "tipoContato" => $this->tipoContato ? $this->tipoContato->toArray() : null,
        ];
    }

    public static function fromArray(array $data): self
    {
        $tipoContato = null;
        if (!empty($data['tipo_contato_id_ref'])) {
            $tipoContato = TipoContato::fromArray($data);
        }

        return new self(
            $data['contato_id_ref'] ?? null,
            $data['contato_descricao'] ?? null,
            $data['tipo_contato_id'] ?? null,
            $tipoContato
        );
    }
    public function getId()
    {
        return $this->id;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function getTipo_contato_id()
    {
        return $this->tipo_contato_id;
    }
}