<?php
require_once __DIR__ . '/../dto/Medicamento.php';
require_once __DIR__ . '/../config/Database.php';

class MedicamentoDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function delete(Int $id) : bool{
        $query = "DELETE FROM medicamento WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
 
    public function update(int $id, Medicamento $medicamento): bool {
        
        $sql = "UPDATE medicamento SET 
                    Nome = :Nome, 
                    Concentracao = :Concentracao, 
                    Categoria_ID = :Categoria_ID, 
                    fabricante = :fabricante, 
                    lote = :lote, 
                    validade = :validade, 
                    quantidade = :quantidade
                WHERE ID = :id";
        
        
        $stmt = $this->conn->prepare($sql);
    
    
        $stmt->bindParam(':Nome', $medicamento->getNome());
        $stmt->bindParam(':Concentracao', $medicamento->getConcentracao());
        $stmt->bindParam('Categoria_ID', $medicamento->getCategoria_id());
        $stmt->bindParam('fabricante', $medicamento->getFabricante());
        $stmt->bindParam('lote', $medicamento->getLote());
        $stmt->bindParam('validade', $medicamento->getValidade());
        $stmt->bindParam('quantidade', $medicamento->getQuantidade());
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        
        return $stmt->execute();
    }
     

    public function insert(Medicamento $medicamento): bool {
        $query = "INSERT INTO medicamento (Nome, Concentracao, Categoria_ID, fabricante, lote, validade, quantidade) VALUES (:Nome, :Concentracao, :Categoria_ID, :fabricante, :lote, :validade, :quantidade)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':Nome', $medicamento->getNome());
        $stmt->bindParam(':Concentracao', $medicamento->getConcentracao());
        $stmt->bindParam('Categoria_ID', $medicamento->getCategoria_id());
        $stmt->bindParam('fabricante', $medicamento->getFabricante());
        $stmt->bindParam('lote', $medicamento->getLote());
        $stmt->bindParam('validade', $medicamento->getValidade());
        $stmt->bindParam('quantidade', $medicamento->getQuantidade());
    
        return $stmt->execute();
    }
    

    public function getAllMedicamentos(): array {
        $query = "SELECT id, nome, concentracao, Categoria_ID, fabricante, lote, validade, quantidade FROM medicamento";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Medicamento::fromArray($row);
        }

        return $result;
    }
    public function findById(int $id): ?array {
        $query = "SELECT * FROM medicamento WHERE ID = :ID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ID', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        $medicamento = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $medicamento ?: null;
    }
    
}
?>
