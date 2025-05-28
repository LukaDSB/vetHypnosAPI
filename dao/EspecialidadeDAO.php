<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../dto/Especialidade.php';
class EspecialidadeDAO{
    private $conn;

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function delete(int $id): bool {
        $checkQuery = "SELECT COUNT(*) FROM especialidade WHERE id = :id";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $checkStmt->execute();
    
        if ($checkStmt->fetchColumn() == 0) {
            throw new Exception("Especialidade com ID $id não encontrado.");
        }
    
        $query = "DELETE FROM especialidade WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    public function update(Especialidade $especialidade, $id): bool {
        $sql = "UPDATE especialidade SET 
                    nome = :nome,
                    descricao = :descricao
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':descricao', $especialidade->getDescricao());
        $stmt->bindParam(':nome', $especialidade->getNome());
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    public function insert(Especialidade $especialidade): bool {
        $query = "INSERT INTO especialidade (
        nome,
        descricao
        ) VALUES (
        :nome,
        :descricao
        )";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $especialidade->getNome());
        $stmt->bindParam(':descricao', $especialidade->getDescricao());
        return $stmt->execute();
    }

    public function getAllEspecialidades(): array {
        $query = "SELECT e.* FROM especialidade e";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Especialidade::fromArray($row);
        }
        return $result;
    }
}