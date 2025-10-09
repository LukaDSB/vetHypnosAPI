<?php
namespace App\DTO;

use App\Entity\Clinica;
use App\Entity\Endereco;
use App\Entity\Contato;

class ClinicaDTO extends Clinica {

    public function __construct(
        ?int $id,
        ?string $nome,
        ?Endereco $endereco,
        ?Contato $contato
    ) {
        parent::__construct($id, $nome, $endereco, $contato);
    }

    public static function fromArray($data): self {
        $endereco = null;
        if (!empty($data['endereco_id_ref'])) {
            $endereco = Endereco::fromArray($data);
        }

        $contato = null;
        if (!empty($data['contato_id_ref'])) {
            $contato = Contato::fromArray($data);
        }

        return new self(
            $data['clinica_id_ref'] ?? null,
            $data['clinica_nome'] ?? null,
            $endereco, 
            $contato   
        );
    }

    public function toArray(): array {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'endereco' => $this->getEndereco() ? $this->getEndereco()->toArray() : null,
            'contato' => $this->getContato() ? $this->getContato()->toArray() : null
        ];
    }
}