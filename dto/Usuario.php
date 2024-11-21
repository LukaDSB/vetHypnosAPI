<?php
class Usuario {
    private $id;
    private $nome;
    private $especialidade;
    private $email;
    private $senha;

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
?>
