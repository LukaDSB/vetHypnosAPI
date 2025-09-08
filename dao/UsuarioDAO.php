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
        // ALTERADO: Query reflete a tabela e usa `usuario`
        $query = "INSERT INTO usuario (nome, email, senha, crmv, cpf, clinica_id, especialidade_id) 
                  VALUES (:nome, :email, :senha, :crmv, :cpf, :clinica_id, :especialidade_id)";
        
        $stmt = $this->conn->prepare($query);
    
        // bindParam para todos os campos
        $stmt->bindValue(':nome', $usuario->getNome());
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->bindValue(':senha', $usuario->getSenha()); // O hash será passado aqui
        $stmt->bindValue(':crmv', $usuario->getCrmv());
        $stmt->bindValue(':cpf', $usuario->getCpf());
        $stmt->bindValue(':clinica_id', $usuario->getClinicaId());
        $stmt->bindValue(':especialidade_id', $usuario->getEspecialidadeId());
    
        return $stmt->execute();
    }
    
    // NOVO: Método essencial para login e verificação de duplicados
    public function findByEmail(string $email) {
        $query = "SELECT * FROM usuario WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsuarios(): array {
        // ALTERADO: Query NUNCA deve retornar a senha em listagens!
        $query = "SELECT id, nome, email, crmv, cpf, clinica_id, especialidade_id FROM usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Usuario::fromArray($row);
        }
        return $result;
    }
}