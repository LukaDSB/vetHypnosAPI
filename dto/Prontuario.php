<?php
class Prontuario {
    private ?int $id;
    private ?int $paciente_id;
    private ?int $usuario_id;
    private ?string $data;
    private ?string $observacoes;
    

    public function __construct(?int $id, ?int $paciente_id, ?int $usuario_id, ?string $data, ?string $observacoes) {
        $this->id = $id;
        $this->paciente_id = $paciente_id;
        $this->usuario_id = $usuario_id;
        $this->data = $data;
        $this->observacoes = $observacoes;
    }

    public static function fromArray(array $data): self {
        return new self(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['paciente_id'],
            $data['usuario_id'],
            $data['data'],
            $data['observacoes']
        );
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'paciente_id' => $this->paciente_id,
            'usuario_id' => $this->usuario_id,
            'data' => $this->data,
            'observacoes' => $this->observacoes
        ];
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getPaciente_id() { return $this->paciente_id; }
    public function setPaciente_id($paciente_id) { $this->paciente_id = $paciente_id; }
    
    public function getUsuario_id() { return $this->usuario_id; }
    public function setUsuario_id($usuario_id) { $this->usuario_id = $usuario_id;}

    public function getdata() { return $this->data; }
    public function setdata($data) { $this->data = $data;}

    public function getObservacoes(){return $this->observacoes;}
    public function setObservacoes($observacoes){$this->observacoes = $observacoes;}
}
?>
