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
        $query = "DELETE FROM categoria_medicamento WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function update(int $id, Categoria_Medicamento $categoria_medicamento): bool {
         
        $sql = "UPDATE categoria_medicamento SET 
                    Descricao = :Descricao
                WHERE ID = :id";
        
        
        $stmt = $this->conn->prepare($sql);
    
        // Vincula os parâmetros
        $stmt->bindParam(':Descricao', $categoria_medicamento->getDescricao());
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        
        return $stmt->execute();
    }

    public function insert(Categoria_Medicamento $categoria_medicamento): bool {
        $query = "INSERT INTO categoria_medicamento (Descricao) VALUES (:Descricao)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':Descricao', $categoria_medicamento->getDescricao());
        
        return $stmt->execute();
    }
    public function selectById(int $id): array {
        $query = "SELECT * FROM categoria_medicamento WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $categoria = new Categoria_Medicamento($result['ID'], $result['Descricao']);
        return $categoria->toArray();
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