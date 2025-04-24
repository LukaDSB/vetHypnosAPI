<?php
class Especialidade {
    private ?int $id;
    private ?string $nome;
    private ?string $descricao;

    public function __construct(?int $id, ?string $nome, ?string $descricao) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
    }

    public static function fromArray(array $data): self {
        return new self(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['nome'],
            $data['descricao'],
            isset($data['usuario_id']) ? (int) $data['usuario_id'] : null
        );
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
        ];
    }
}