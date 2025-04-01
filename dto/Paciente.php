<?php
class Paciente {
    private ?int $id;
    private string $nome;
    private string $especie;
    private int $idade;
    private string $sexo;
    private float $peso;
    private int $tutor_id;
    private int $obito;


    public function __construct(?int $id, string $nome, string $especie, int $idade, string $sexo, float $peso, int $tutor_id, int $obito) {
        $this->id = $id;
        $this->nome = $nome;
        $this->especie = $especie;
        $this->idade = $idade;
        $this->sexo = $sexo;
        $this->peso = $peso;
        $this->tutor_id = $tutor_id;
        $this->obito = $obito;
    }

    public static function fromArray(array $data): self {
        return new self(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['nome'],
            $data['especie'],
            $data['idade'],
            $data['sexo'],
            $data['peso'],
            $data['idTutor'],
            $data['obito']
        );
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'especie'=> $this->especie,
            'idade'=> $this->idade,
            'sexo'=> $this->sexo,
            'peso'=> $this->peso,
            'idTutor'=> $this->tutor_id,
            'obito'=> $this->obito
        ];
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }
    public function getEspecie() { return $this->especie; }
    public function setEspecie($especie) { $this->especie = $especie; }
    public function getPeso() { return $this->peso; }
    public function setPeso($peso) { $this->peso = $peso; }
    public function getIdTutor() { return $this->tutor_id; }
    public function setIdTutor($tutor_id) { $this->tutor_id = $tutor_id;}
    public function getObito() { return $this->obito; }
    public function setObito($obito) { $this->obito = $obito; }
    public function getIdade() { return $this->idade; }
    public function setIdade($idade) { $this->idade = $idade; }
    public function getSexo() { return $this->sexo; }
    public function setSexo($sexo) { $this->sexo = $sexo; }
}
?>
