<?php
namespace App\DTO;

class ProntuarioDetalhadoDTO {
    public $id;
    public $animal_id;
    public $animal_nome;

    public $usuario_id;
    public $usuario_nome;
    
    public $data_prontuario;
    public $tipo_procedimento_id;
    public $statusProntuario;
    public $observacoes;
    public $prontuario;
    public $procedimento;

    private $medicamentos = [];

    private $medicoesClinicas = [];

    public static function fromArray(array $data): self {
        $dto = new self();

        $dto->id = $data['id'] ?? null;
        $dto->animal_id = $data['animal_id'] ?? null;
        $dto->animal_nome = $data['animal_nome'] ?? $data['animal_nome'] ?? null;
        $dto->usuario_id = $data['usuario_id'] ?? null;
        $dto->usuario_nome = $data['usuario_nome'] ?? null;
        $dto->data_prontuario = $data['data_prontuario'] ?? null;
        $dto->observacoes = $data['observacoes'] ?? null;
        $dto->statusProntuario = $data['statusProntuario'] ?? null;
        $dto->tipo_procedimento_id = $data['tipo_procedimento_id'] ?? null;
        $dto->procedimento = $data['procedimento'] ?? null;
        $dto->prontuario = $data['prontuario'] ?? null;

        if (isset($data['medicamentos']) && is_array($data['medicamentos'])) {$dto->setMedicamentos($data['medicamentos']);}
        if (isset($data['medicoes_clinicas']) && is_array($data['medicoes_clinicas'])) {$dto->setMedicoesClinicas($data['medicoes_clinicas']);}

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
            'statusProntuario' => $this->statusProntuario,
            'tipo_procedimento_id' => $this->tipo_procedimento_id,
            'procedimento' => $this->procedimento,
            'medicamentos' => $this->medicamentos,
            'medicoes_clinicas' => $this->medicoesClinicas
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

    public function getMedicamentos(): array {return $this->medicamentos;}
    public function setMedicamentos(array $medicamentos): void {$this->medicamentos = $medicamentos;}

    public function getMedicoesClinicas(): array {return $this->medicoesClinicas;}
    public function setMedicoesClinicas(array $medicoes): void {$this->medicoesClinicas = $medicoes;}

    public function getStatusProntuario(){return $this->statusProntuario;}
    public function setStatusProntuario($statusProntuario){$this->statusProntuario = $statusProntuario;}

    public function getProcedimento(){return $this->procedimento;}
    public function setProcedimento($procedimento){$this->procedimento = $procedimento;}
}
