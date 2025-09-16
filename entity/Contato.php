<?php
require_once __DIR__ . '/../entity/Tipo_Contato.php';
class Contato{
    private ? int $id;
    private ? string $descricao;
    private ? int $tipo_contato_id;
    private ? Tipo_Contato $tipo_contato;




    public function __construct(
        ?int $id,
        ?string $descricao,
        ?int $tipo_contato_id,
        ?Tipo_Contato $tipo_contato
        ){ 
        $this->id = $id;
        $this->descricao = $descricao;
        $this->tipo_contato_id = $tipo_contato_id;
        $this->tipo_contato = $tipo_contato;
    }

    public function toArray(): array {
    return [
        "id" => $this->id,
        "descricao" => $this->descricao,
        "tipo_contato" => $this->tipo_contato ? $this->tipo_contato->toArray() : null,
    ];
}

    public static function fromArray(array $data): self {
        $tipo_contato = null;
        if (!empty($data['tipo_contato_id']) && !empty($data['tipo_contato_descricao'])) {
            $tipo_contato = Tipo_Contato::fromArray($data);
        }
        return new self(
            isset($data['contato_id_ref']) ? (int) $data['id'] : null,
            $data['contato_descricao'],
            $data['tipo_contato_id'],
            $tipo_contato
        );
    }
    public function getId() { return $this->id; }
    public function getDescricao(){return $this->descricao;}
    public function getTipo_contato_id(){return $this->tipo_contato_id;}
}