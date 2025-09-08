<?php
class Usuario
{
    private ?int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private ?string $crmv;
    private ?string $cpf;
    private ?int $clinica_id;
    private ?int $especialidade_id;

    public function __construct(?int $id, string $nome, string $email, string $senha, ?string $crmv, ?string $cpf, ?int $clinica_id, ?int $especialidade_id)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->crmv = $crmv;
        $this->cpf = $cpf;
        $this->clinica_id = $clinica_id;
        $this->especialidade_id = $especialidade_id;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['nome'],
            $data['email'],
            $data['senha'] ?? '',
            $data['crmv'] ?? null,
            $data['cpf'] ?? null,
            isset($data['clinica_id']) ? (int) $data['clinica_id'] : null,
            isset($data['especialidade_id']) ? (int) $data['especialidade_id'] : null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'crmv' => $this->crmv,
            'cpf' => $this->cpf,
            'clinica_id' => $this->clinica_id,
            'especialidade_id' => $this->especialidade_id,
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNome(): string
    {
        return $this->nome;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getSenha(): string
    {
        return $this->senha;
    }
    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEspecialidade()
    {
        return $this->especialidade;
    }
    public function setEspecialidade($especialidade)
    {
        $this->especialidade = $especialidade;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCrmv()
    {
        return $this->crmv;
    }
    public function setCrmv($crmv)
    {
        $this->crmv = $crmv;
    }

    public function getCpf()
    {
        return $this->cpf;
    }
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getClinicaId()
    {
        return $this->clinica_id;
    }
    public function getEspecialidadeId()
    {
        return $this->especialidade_id;
    }
}