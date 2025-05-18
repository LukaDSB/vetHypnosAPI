<?php
require_once __DIR__ . '/../dto/MedicamentoDTO.php';
require_once __DIR__ . '/../config/Database.php';

class MedicamentoDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function delete(Int $id) : bool{
        $query = "DELETE FROM medicamento WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
 
    public function update(int $id, MedicamentoDTO $medicamento): bool {
        
        $sql = "UPDATE medicamento SET 
                    nome = :nome, 
                    concentracao = :concentracao, 
                    categoria_medicamento_id = :categoria_medicamento_id, 
                    fabricante = :fabricante, 
                    lote = :lote, 
                    validade = :validade, 
                    quantidade = :quantidade
                WHERE id = :id";
        
        
        $stmt = $this->conn->prepare($sql);
 
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $medicamento->getNome());
        $stmt->bindParam(':concentracao', $medicamento->getConcentracao());
        $stmt->bindParam('categoria_medicamento_id', $medicamento->getCategoria_medicamento_id());
        $stmt->bindParam('fabricante', $medicamento->getFabricante());
        $stmt->bindParam('lote', $medicamento->getLote());
        $stmt->bindParam('validade', $medicamento->getValidade());
        $stmt->bindParam('quantidade', $medicamento->getQuantidade());
        return $stmt->execute();
    }
     

    public function insert(MedicamentoDTO $medicamento): bool {
        $query = "INSERT INTO medicamento (nome, concentracao, categoria_medicamento_id, fabricante, lote, validade, quantidade) VALUES (:nome, :concentracao, :categoria_medicamento_id, :fabricante, :lote, :validade, :quantidade)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':nome', $medicamento->getNome());
        $stmt->bindParam(':concentracao', $medicamento->getConcentracao());
        $stmt->bindParam('categoria_medicamento_id', $medicamento->getCategoria_medicamento_id());
        $stmt->bindParam('fabricante', $medicamento->getFabricante());
        $stmt->bindParam('lote', $medicamento->getLote());
        $stmt->bindParam('validade', $medicamento->getValidade());
        $stmt->bindParam('quantidade', $medicamento->getQuantidade());
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
        FROM medicamento m LEFT JOIN categoria_medicamento c ON m.categoria_medicamento_id = c.id";
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
}
?>
