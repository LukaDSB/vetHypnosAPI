<?php
class ProntuarioDetalhadoDTO {
    public $id;
    public $nome_usuario;
    public $nome_animal;
    public $data_prontuario;
    public $procedimento;
    public $status;

    public static function fromArray(array $data): self {
        $dto = new self();

        $dto->id = $data['id'] ?? null;
        $dto->nome_usuario = $data['nome_usuario'] ?? $data['nome_usuario'] ?? null;
        $dto->nome_animal = $data['nome_animal'] ?? $data['nome_animal'] ?? null;
        $dto->data_prontuario = $data['data_prontuario'] ?? null;
        $dto->procedimento = $data['procedimento'] ?? null;
        $dto->status = $data['status'] ?? null;

        return $dto;
    }

    public function toArray(): array {
        return get_object_vars($this);
    }
}
