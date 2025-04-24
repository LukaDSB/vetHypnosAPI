<?php
require_once __DIR__ . '/../entity/Especie.php';

class Animal {
    private ?int $id;
    private string $nome;
    private ?int $especie_id;
    private ?int $data_nascimento;
    private ?string $sexo;
    private ?float $peso;
    private ?int $tutor_id;
    private ?int $obito;
    private ?Especie $especie;


    public function __construct(
        ?int $id,
        ?string $nome,
        ?int $especie_id,
        ?int $data_nascimento,
        ?string $sexo,
        ?float $peso,
        ?int $tutor_id,
        ?int $obito,
        ?Especie $especie
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->especie_id = $especie_id;
        $this->data_nascimento = $data_nascimento ? (int) $data_nascimento : null;
        $this->sexo = $sexo;
        $this->peso = $peso;
        $this->tutor_id = $tutor_id;
        $this->obito = $obito;
        $this->especie = $especie;
    }

    public static function fromArray(array $data): self {
        $especie = null;
        if (!empty($data['especie_id']) && !empty($data['especie_especie'])) {
            $especie = new Especie(
                $data['especie_id'],
                $data['especie_especie'],
                null
            );
        }
        
        return new self(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['nome'],
            isset($data['data_nascimento']) ? $data['data_nascimento'] : null,
            $data['data_nascimento'],
            $data['sexo'],
            $data['peso'],
            isset($data['tutor_id']) ? (int) $data['tutor_id'] : null,
            $data['obito'],
            $especie
        );
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'data_nascimento'=> $this->data_nascimento,
            'sexo'=> $this->sexo,
            'peso'=> $this->peso,
            'tutor_id'=> $this->tutor_id,
            'obito'=> $this->obito,
            'especie_id'=> $this->especie_id,
            'especie'=> $this->especie ? $this->especie->toArray() : null
        ];
    }

    public function getId() { return $this->id; }

    public function getNome() { return $this->nome; }

    public function getEspecie() { return $this->especie; }

    public function getEspecieId() { return $this->especie_id; }

    public function getPeso() { return $this->peso; }

    public function getTutorId() { return $this->tutor_id; }

    public function getObito() { return $this->obito; }

    public function getDataNascimento() { return $this->data_nascimento; }

    public function getSexo() { return $this->sexo; }
}
?>
