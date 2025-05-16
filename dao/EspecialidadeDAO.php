<?php


require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../dto/EspecialidadeDTO.php';

class EspecialidadeDAO{
    private $conn;
    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    public function selectById(int $id)  {
        $query = "
        SELECT id as e_id,
        nome as e_nome,
        descricao as  e_descricao 
        FROM especialidade
        WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result){
            return null;
        }
        $result = Especialidade::fromArray($result);
        return $result;
    }

    public function getAllEspecialidades(): array {
        $query = "
        SELECT id as e_id,
        nome as e_nome,
        descricao as  e_descricao 
        FROM especialidade";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Especialidade::fromArray($row);
        }

        return $result;
    }


}












?>