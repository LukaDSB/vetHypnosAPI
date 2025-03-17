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
        $query = "DELETE FROM farmacos WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function update(int $id, array $data): bool {
        
        $sql = "UPDATE farmacos SET 
                    Nome = :Nome, 
                    Concentracao = :Concentracao, 
                    Categoria_ID = :Categoria_ID, 
                    fabricante = :fabricante, 
                    lote = :lote, 
                    validade = :validade, 
                    quantidade = :quantidade
                WHERE ID = :id";
        
        
        $stmt = $this->conn->prepare($sql);
    
        // Vincula os parâmetros
        $stmt->bindParam(':Nome', $data['Nome'], PDO::PARAM_STR);
        $stmt->bindParam(':Concentracao', $data['Concentracao'], PDO::PARAM_STR);
        $stmt->bindParam(':Categoria_ID', $data['Categoria_ID'], PDO::PARAM_INT);
        $stmt->bindParam(':fabricante', $data['fabricante'], PDO::PARAM_STR);
        $stmt->bindParam(':lote', $data['lote'], PDO::PARAM_STR);
        $stmt->bindParam(':validade', $data['validade'], PDO::PARAM_STR);
        $stmt->bindParam(':quantidade', $data['quantidade'], PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        
        return $stmt->execute();
    }
     

    public function insert(Medicamento $medicamento): bool {
        $query = "INSERT INTO farmacos (Nome, Concentracao, Categoria_ID, fabricante, lote, validade, quantidade) VALUES (:Nome, :Concentracao, :Categoria_ID, :fabricante, :lote, :validade, :quantidade)";
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
        $query = "SELECT ID, Nome, Concentracao, Categoria_ID, fabricante, lote, validade, quantidade FROM farmacos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Medicamento::fromArray($row);
        }

        return $result;
    }
    public function findById(int $id): ?array {
        $query = "SELECT * FROM farmacos WHERE ID = :ID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ID', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        $medicamento = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $medicamento ?: null;
    }
    
}
?>
