<?php
require_once __DIR__ . '/../dto/Usuario.php';
require_once __DIR__ . '/../config/Database.php';

class UsuarioDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function insert(Usuario $usuario): bool {
        $query = "INSERT INTO usuarios (nome, email, especialidade, senha) VALUES (:nome, :email, :especialidade, :senha)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':nome', $usuario->getNome());
        $stmt->bindParam(':email', $usuario->getEmail());
        $stmt->bindParam(':especialidade', $usuario->getEspecialidade());
        $stmt->bindParam(':senha', $usuario->getSenha());
    
        return $stmt->execute();
    }
    

    public function getAllUsuarios(): array {
        $query = "SELECT id, nome, email, senha FROM usuarios";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Usuario::fromArray($row);
        }

        return $result;
    }
}
?>
