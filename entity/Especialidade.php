<?php

class Especialidade {
    private ?int $id;
    private string $nome;
    private ?string $descricao;

    public function __construct(?int $id, string $nome, ?string $descricao) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
    }

    public static function fromArray(array $data): self {
        return new self(
            isset($data['e_id']) ? (int) $data['e_id'] : null,
            $data['e_nome'],
            isset($data['e_descricao']) ? (string) $data['e_descricao'] : null
        );
    }

    public function toArray(): array {
        return [
            'e_id' => $this->id,
            'e_nome' => $this->nome,
            'e_descricao' => $this->descricao
        ];
        }



    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getDescricao(): ?string { return $this->descricao; }
}