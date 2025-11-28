<?php
namespace App\DAO;

use App\DTO\MedicamentoDTO;
use App\Config\Database;
use PDO;

class MedicamentoDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

public function update(int $id, MedicamentoDTO $medicamento, object $dadosUsuario): bool {
    
    $this->conn->beginTransaction();
    try {
        $nomeUsuario = $dadosUsuario->nome;
        $nomeUsuarioSanitized = $this->conn->quote($nomeUsuario); 
        $this->conn->exec("SET @app_user = {$nomeUsuarioSanitized}");
        
        $sql = 
            "UPDATE medicamento SET 
                    nome = :nome, 
                    concentracao = :concentracao, 
                    categoria_medicamento_id = :categoria_medicamento_id, 
                    fabricante = :fabricante, 
                    lote = :lote, 
                    validade = :validade, 
                    quantidade = :quantidade
                WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':nome', $medicamento->getNome());
        $stmt->bindValue(':concentracao', $medicamento->getConcentracao());
        $stmt->bindValue(':categoria_medicamento_id', $medicamento->getCategoria_medicamento_id(), PDO::PARAM_INT);
        $stmt->bindValue(':fabricante', $medicamento->getFabricante());
        $stmt->bindValue(':lote', $medicamento->getLote());
        $stmt->bindValue(':validade', $medicamento->getValidade());
        $stmt->bindValue(':quantidade', $medicamento->getQuantidade());
        
        $result = $stmt->execute();
        
        $this->conn->commit();
        return $result;

    } catch (\PDOException $e) {
        $this->conn->rollBack();
        error_log("Erro ao atualizar medicamento e setar log: " . $e->getMessage());
        return false;
    }
}
    
    
    public function insert(MedicamentoDTO $medicamento): bool {
        $query = "INSERT INTO medicamento (nome, concentracao, categoria_medicamento_id, fabricante, lote, validade, quantidade, dose_min, dose_max) VALUES (:nome, :concentracao, :categoria_medicamento_id, :fabricante, :lote, :validade, :quantidade, :dose_min, :dose_max)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':nome', $medicamento->getNome());
        $stmt->bindParam(':concentracao', $medicamento->getConcentracao());
        $stmt->bindParam('categoria_medicamento_id', $medicamento->getCategoria_medicamento_id());
        $stmt->bindParam('fabricante', $medicamento->getFabricante());
        $stmt->bindParam('lote', $medicamento->getLote());
        $stmt->bindParam('validade', $medicamento->getValidade());
        $stmt->bindParam('quantidade', $medicamento->getQuantidade());
        $stmt->bindParam('dose_min', $medicamento->getDoseMin());
        $stmt->bindParam('dose_max', $medicamento->getDoseMax());

        return $stmt->execute();
    }
    
    public function checkId(int $id): bool {
        $query = "SELECT * FROM medicamento WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? true : false;
    }
    
    public function getAllMedicamentos(): array {
        $query = "SELECT m.*, 
        c.descricao as categoria_medicamento_descricao
        FROM medicamento m LEFT JOIN categoria_medicamento c ON m.categoria_medicamento_id = c.id order by m.id desc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = MedicamentoDTO::fromArray($row);
        }
        
        return $result;
    }
    
    public function getMedicamentoById(int $id){
        $query = "SELECT m.*, 
        c.descricao as categoria_medicamento_descricao
        FROM medicamento m LEFT JOIN categoria_medicamento c ON m.categoria_medicamento_id = c.id
        where m.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $result = MedicamentoDTO::fromArray($row);
        return $result;
    }

    public function delete(Int $id) : bool{
        $query = "DELETE FROM medicamento WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}