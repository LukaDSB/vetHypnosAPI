<?php
require_once __DIR__ . '/../dto/Usuario.php';
require_once __DIR__ . '/../config/Database.php';

class UsuarioDAO {
    private $conexao;

    public function __construct() {
        $database = new Database();
        $this->conexao = $database->getConnection();
    }

    public function insert(Usuario $usuario): bool {
        $query = "INSERT INTO usuarios (nome, email, especialidade, senha) VALUES (:nome, :email, :especialidade, :senha)";
        $stmt = $this->conexao->prepare($query);
        $nome = $usuario->getNome();
        $email = $usuario->getEmail();
        $especialidade = $usuario->getEspecialidade();
        $senha = $usuario->getSenha();

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':especialidade', $especialidade);
        $stmt->bindParam(':senha', $senha);
    
        return $stmt->execute();
    }
    

    public function getAllUsuarios(): array {
        $query = "SELECT id, nome, especialidade, email, senha FROM usuarios";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Usuario::fromArray($row);
        }

        return $result;
    }

    public function getById(Int $id): array {
        $query = "SELECT id, nome, especialidade, email, senha FROM usuarios WHERE id = :id";
        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Usuario::fromArray($row);
        }

        return $result;
    }
}
?>
