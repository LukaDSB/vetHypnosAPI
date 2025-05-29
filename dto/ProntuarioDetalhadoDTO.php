<?php
class ProntuarioDetalhadoDTO {
    public $id;
    public $animal_id;
    public $animal_nome;

    public $usuario_id;
    public $usuario_nome;
    
    public $data_prontuario;
    public $tipo_procedimento_id;
    public $status;
    public $observacoes;
    public $prontuario;

    public static function fromArray(array $data): self {
        $dto = new self();

        $dto->id = $data['id'] ?? null;
        $dto->animal_id = $data['animal_id'] ?? null;
        $dto->animal_nome = $data['animal_nome'] ?? $data['animal_nome'] ?? null;
        $dto->usuario_id = $data['usuario_id'] ?? null;
        $dto->usuario_nome = $data['usuario_nome'] ?? null;
        $dto->data_prontuario = $data['data_prontuario'] ?? null;
        $dto->prontuario = $data['prontuario'] ?? null;
        $dto->status = $data['status'] ?? null;
        $dto->tipo_procedimento_id = $data['tipo_procedimento_id'] ?? null;
        $dto->observacoes = $data['observacoes'] ?? null;


        return $dto;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'animal_id' => $this->animal_id,
            'animal_nome' => $this->animal_nome,
            'usuario_id' => $this->usuario_id,
            'usuario_nome' => $this->usuario_nome,
            'data_prontuario' => $this->data_prontuario,
            'observacoes' => $this->observacoes,
            'status' => $this->status,
            'tipo_procedimento_id' => $this->tipo_procedimento_id,
        ];
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getAnimalId() { return $this->animal_id; }
    public function setAnimalId($animal_id) { $this->animal_id = $animal_id; }
    
    public function getUsuarioId() { return $this->usuario_id; }
    public function setUsuarioId($usuario_id) { $this->usuario_id = $usuario_id;}

    public function getDataProntuario() { return $this->data_prontuario; }
    public function setDataProntuario($data_prontuario) { $this->data_prontuario = $data_prontuario;}

    public function getObservacoes(){return $this->observacoes;}
    public function setObservacoes($observacoes){$this->observacoes = $observacoes;}

    public function getTipoProcedimentoId(){return $this->tipo_procedimento_id;}
    public function setTipoProcedimentoId($tipo_procedimento_id){$this->$tipo_procedimento_id = $tipo_procedimento_id;}

    public function getStatusProntuario(){return $this->status;}
    public function setStatusProntuario($status){$this->status = $status;}
}
