<?php
require_once __DIR__ . '/../dto/EspecialidadeDTO.php';
class Usuario {
    private ?int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private ?string $crmv;
    private ?string $cpf;
    private ?int $clinica_id;
    private ?int $especialidade_id;
    private ?Especialidade $especialidade;

    


    public function __construct(
        ?int $id,
        string $nome,
        string $email,
        string $senha,
        ?string $crmv,
        ?string $cpf,
        ?int $clinica_id,
        ?int $especialidade_id,
        ?Especialidade $especialidade

              ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->crmv = $crmv;
        $this->cpf = $cpf;
        $this->clinica_id = $clinica_id;
        $this->especialidade_id = $especialidade_id;
        $this->especialidade = $especialidade;
    }

    public static function fromArray(array $data): self {
        if (!empty($data['especialidade_id'])) {
            $especialidade = Especialidade::fromArray($data);
            
        } else {
            $especialidade = null;
        }

        return new self(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['nome'],
            $data['email'],
            $data['senha'],
            $data['crmv'],
            $data['cpf'],
            $data['clinica_id'],
            $data['especialidade_id'],
            $especialidade
        );
    }


    public function toArray(): array {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha,
            'crmv' => $this->crmv,
            'cpf' => $this->cpf,
            'clinica_id' => $this->clinica_id,
            'especialidade_id' => $this->especialidade_id,
            'especialidade' =>$this->especialidade ? $this->especialidade->toArray(): null,
        ];
    }

    public function getId() { return $this->id; }
    
    public function getNome() { return $this->nome; }
    
    public function getEspecialidade() { return $this->especialidade; }
    
    public function getEmail() { return $this->email; }
    
    public function getSenha() { return $this->senha; }
    public function getCrmv(){return $this->crmv;}
    public function getCpf(){return $this->cpf;}
    public function getClinicaId(){return $this->clinica_id;}
    public function getEspecialidadeId(){return $this->especialidade_id;}
}
?>
