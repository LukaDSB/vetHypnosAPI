<?php
class ProntuarioDTO {
    private ?int $id;
    private ?int $paciente_id;
    private ?int $usuario_id;
    private ?string $data_prontuario;
    private ?string $observacoes;
    

    public function __construct(?int $id, ?int $paciente_id, ?int $usuario_id, ?string $data_prontuario, ?string $observacoes) {
        $this->id = $id;
        $this->paciente_id = $paciente_id;
        $this->usuario_id = $usuario_id;
        $this->data_prontuario = $data_prontuario;
        $this->observacoes = $observacoes;
    }

    public static function fromArray(array $data): self {
        return new self(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['paciente_id'],
            $data['usuario_id'],
            $data['data_prontuario'],
            $data['observacoes']
        );
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'paciente_id' => $this->paciente_id,
            'usuario_id' => $this->usuario_id,
            'data_prontuario' => $this->data_prontuario,
            'observacoes' => $this->observacoes
        ];
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getPaciente_id() { return $this->paciente_id; }
    public function setPaciente_id($paciente_id) { $this->paciente_id = $paciente_id; }
    
    public function getUsuario_id() { return $this->usuario_id; }
    public function setUsuario_id($usuario_id) { $this->usuario_id = $usuario_id;}

    public function getDataProntuario() { return $this->data_prontuario; }
    public function setDataProntuario($data_prontuario) { $this->data_prontuario = $data_prontuario;}

    public function getObservacoes(){return $this->observacoes;}
    public function setObservacoes($observacoes){$this->observacoes = $observacoes;}
}
?>
