<?php
require_once __DIR__ . '/Endereco.php';
require_once __DIR__ . '/Contato.php';
require_once __DIR__ . '/Nome.php';
require_once __DIR__ . '/Cpf.php';

class Tutor
{
    private ?int $id;
    private Nome $nome;
    private Cpf $cpf;
    private string $rua;
    private string $numero;
    private string $bairro;
    private string $cidade_nome;
    private string $estado_nome;
    private ?int $endereco_id;
    private ?Endereco $endereco;
    private array $contatos = [];

    public function __construct(
        ?int $id,
        Nome $nome,
        Cpf $cpf,
        ?int $endereco_id,
        ?Endereco $endereco,
        ?array $contatos = []
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->endereco_id = $endereco_id;
        $this->endereco = $endereco;
        $this->contatos = $contatos;
    }


    public static function fromArray(array $data): static
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

        $nome = new Nome($data['tutor_nome'] ?? '');
        $cpf = new Cpf($data['tutor_cpf'] ?? '');


        return new static(
            $data['tutor_id'] ?? null,
            $nome,
            $cpf,
            $data['endereco_id'] ?? null,
            $endereco,
            $contatos
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome->getValue(),
            'cpf' => $this->cpf->getValue(),
            'endereco' => $this->endereco ? $this->endereco->toArray() : null,
            'contatos' => array_map(fn($contato) => $contato->toArray(), $this->contatos),
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNome(): Nome
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