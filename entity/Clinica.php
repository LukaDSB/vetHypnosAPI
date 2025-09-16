<?php
class Clinica{
    private ?int $id;
    private ?string $nome;
    private ?Endereco $endereco;

    private ?Contato $contato;


    public function __construct(
        ?int $id, 
        ?string $nome, 
        ?Endereco $endereco,
        ?Contato $contato
        ){
        $this->id = $id;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->contato = $contato;
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
            $data["clinica_id_ref"] ?? null,
            $data["clinica_nome"] ?? null,
            $endereco,
            $contato
        );
    }

    public function toArray(): array {
        return [
            "id" => $this->id,
            "nome" => $this->nome,
            // Se o objeto endereco existir, chama o toArray() dele. Senão, null.
            "endereco" => $this->endereco ? $this->endereco->toArray() : null,
            // Se o objeto contato existir, chama o toArray() dele. Senão, null.
            "contato" => $this->contato ? $this->contato->toArray() : null,
        ];
    }

    public function getId():?int{return $this->id;}
    public function getNome():?string{return $this->nome;}
    public function getEndereco(): ?Endereco { return $this->endereco; }
    public function getContato(): ?Contato { return $this->contato; }

}