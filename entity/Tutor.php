<?php
require_once __DIR__ . '/Endereco.php';
require_once __DIR__ . '/Contato.php';

class Tutor
{
    private ?int $id;
    private ?string $nome;
    private ?string $cpf;
    private ?int $endereco_id;
    private ?Endereco $endereco;
    private array $contatos = [];

    public function __construct(
        ?int $id,
        ?string $nome,
        ?string $cpf,
        ?int $endereco_id,
        ?Endereco $endereco,
        array $contatos = []
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->endereco_id = $endereco_id;
        $this->endereco = $endereco;
        $this->contatos = $contatos;
    }


    public static function fromArray(array $data): self
    {
        $endereco = null;
        if (!empty($data['endereco_id'])) {

            $endereco = Endereco::fromArray($data);
        }

        $contatos = [];

        if (!empty($data['contatos']) && is_array($data['contatos'])) {
            foreach ($data['contatos'] as $contatoData) {
                $contatos[] = Contato::fromArray($contatoData);
            }
        }

        return new self(
            $data['tutor_id'] ?? null,
            $data['tutor_nome'] ?? null,
            $data['tutor_cpf'] ?? null,
            $data['endereco_id'] ?? null,
            $endereco,
            $contatos
        );
    }


    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'endereco' => $this->endereco ? $this->endereco->toArray() : null,
            'contatos' => array_map(fn($contato) => $contato->toArray(), $this->contatos),
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
    public function getCpf(): ?string
    {
        return $this->cpf;
    }
    public function getEnderecoId(): ?int
    {
        return $this->endereco_id;
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