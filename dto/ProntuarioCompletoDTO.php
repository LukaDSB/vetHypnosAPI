<?php

class ProntuarioCompletoDTO {
    public int $id;
    public string $data_prontuario;
    public ?string $observacoes;
    public array $animal; 
    public array $procedimento; 
    public array $medicamentos;
    public array $medicoes_clinicas;

    public function __construct() {
        $this->medicamentos = [];
        $this->medicoes_clinicas = [];
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'data_prontuario' => $this->data_prontuario,
            'observacoes' => $this->observacoes,
            'animal' => $this->animal,
            'procedimento' => $this->procedimento,
            'medicamentos' => $this->medicamentos,
            'medicoes_clinicas' => $this->medicoes_clinicas,
        ];
    }
}