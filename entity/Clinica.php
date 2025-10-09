<?php
namespace App\Entity;

use App\Entity\Endereco;
use App\DTO\ContatoDTO;
class Clinica
{
    private ?int $id;
    private ?string $nome;
    private ?Endereco $endereco;
    private array $contatos = [];


    public function __construct(
        ?int $id,
        ?string $nome,
        ?Endereco $endereco,
        array $contatos = []
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->endereco = $endereco;

        $this->contatos = $contatos;
    }


    public static function fromArray($data): self
    {
        $endereco = null;
        if (!empty($data['endereco_id_ref'])) {
            $endereco = Endereco::fromArray($data);
        }

        return new self(
            $data["clinica_id_ref"] ?? null,
            $data["clinica_nome"] ?? null,
            $endereco,
            []
        );
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "nome" => $this->nome,
            "endereco" => $this->endereco ? $this->endereco->toArray() : null,
            "contatos" => array_map(fn($contato) => $contato->toArray(), $this->contatos),
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNome(): ?string
    {
        return $this->nome;
    }
    public function getEndereco(): ?Endereco
    {
        return $this->endereco;
    }
    public function getContatos(): array
    {
        return $this->contatos;
    }
    public function setContatos(array $contatos): void
    {
        $this->contatos = $contatos;
    }
}