<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../dto/Contato.php';
class ContatoDAO{
    private $conn;
    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function delete(Int $id) : bool{
        $query = "DELETE FROM contato WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function update(int $id, Contato $contato): bool {
         
        $sql = "UPDATE contato SET 
                    descricao = :descricao,
                    tipo_contato_id = :tipo_contato_id
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
    
        $stmt->bindParam(':descricao', $contato->getDescricao());
        $stmt->bindParam('tipo_contato_id', $contato->getTipo_contato_id());
        $stmt->bindParam(':id', $id);
    
        
        return $stmt->execute();
    }

    public function insert(Contato $contato): bool {
        $query = "INSERT INTO contato (
        descricao,
        tipo_contato_id
        ) VALUES (
        :descricao,
        :tipo_contato_id
        )";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':descricao', $contato->getDescricao());
        $stmt->bindParam('tipo_contato_id', $contato->getTipo_contato_id());
        return $stmt->execute();
    }
    

    public function checkId(int $id): bool {
        $query = "SELECT * FROM contato WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? true : false;
    }


    public function getAllContatos(): array {
        $query = "SELECT c.*, 
              t.descricao as tipo_contato_descricao
              FROM contato c LEFT JOIN tipo_contato t ON c.tipo_contato_id = t.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Contato::fromArray($row);
        }
        return $result;
    }


}












?>