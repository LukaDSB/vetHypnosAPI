<?php
class Usuario {
    private ?int $id;
    private string $nome;
    private string $email;
    private ?string $especialidade;
    private string $senha;

    public function __construct(?int $id, string $nome, string $email, ?string $especialidade, string $senha) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->especialidade = $especialidade;
        $this->senha = $senha;
    }

    public static function fromArray(array $data): self {
        return new self(
            isset($data['id']) ? (int) $data['id'] : null,
            $data['nome'],
            $data['email'],
            $data['especialidade'] ?? null,
            $data['senha']
        );
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'especialidade' => $this->especialidade,
            'senha' => $this->senha
        ];
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }
    
    public function getEspecialidade() { return $this->especialidade; }
    public function setEspecialidade($especialidade) { $this->especialidade = $especialidade; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getSenha() { return $this->senha; }
    public function setSenha($senha) { $this->senha = $senha; }
}