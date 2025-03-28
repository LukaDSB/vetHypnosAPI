<?php


require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../dto/Categoria_Medicamento.php';

class Categoria_MedicamentoDAO{
    private $conn;
    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function delete(Int $id) : bool{
        $query = "DELETE FROM categoria_medicamento WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function update(int $id, Categoria_Medicamento $categoria_medicamento): bool {
         
        $sql = "UPDATE categoria_medicamento SET 
                    descricao = :descricao
                WHERE id = :id";
        
        
        $stmt = $this->conn->prepare($sql);
    
        $stmt->bindParam(':descricao', $categoria_medicamento->getDescricao());
        $stmt->bindParam(':id', $id);
    
        
        return $stmt->execute();
    }

    public function insert(Categoria_Medicamento $categoria_medicamento): bool {
        $query = "INSERT INTO categoria_medicamento (descricao) VALUES (:descricao)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':descricao', $categoria_medicamento->getDescricao());
        
        return $stmt->execute();
    }
    
    public function checkId($id) : bool{
        $query = 'SELECT 8 FROM categoria_medicamento WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? true : false;

    }

    public function getAllCategorias(): array {
        $query = "SELECT * FROM categoria_medicamento";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Categoria_Medicamento::fromArray($row);
        }

        return $result;
    }


}












?>