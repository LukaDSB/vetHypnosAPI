<?php
class TipoProcedimento{
    private ?int $id;
    private ?string $tipo_procedimento;

    public function __construct(?int $id, ?string $tipo_procedimento){
        $this->id = $id;
        $this->tipo_procedimento = $tipo_procedimento;
    }

    
    public static function fromArray(array $data): self {

        return new self(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['tipo_procedimento'],
        );
    }

    public function toArray(){
         return [
            'id' => $this->id,
            'tipo_procedimento' => $this->tipo_procedimento,
        ];
    }

    public function getId(){return $this->id;}
    public function getTipoProcedimento(){return $this->tipo_procedimento;}
}