<?php
namespace App\DTO;

class TipoProcedimentoContagemDTO
{
    private ?int $id;
    private ?string $tipo_procedimento;
    private int $total_procedimentos; // Novo campo para a contagem

    public function __construct(
        ?int $id, 
        ?string $tipo_procedimento, 
        int $total_procedimentos
    ) {
        $this->id = $id;
        $this->tipo_procedimento = $tipo_procedimento;
        $this->total_procedimentos = $total_procedimentos;
    }
    
    public static function fromArray(array $data): self {
        return new self(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['tipo_procedimento'] ?? null,
            (int) $data['total_procedimentos']
        );
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'tipo_procedimento' => $this->tipo_procedimento,
            'total_procedimentos' => $this->total_procedimentos, // Este é o campo que precisa aparecer!
        ];
    }
}