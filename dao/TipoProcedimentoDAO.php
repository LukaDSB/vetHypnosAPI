<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../entity/Tipo_Procedimento.php';
class TipoProcedimentoDAO{
    private $conn;

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getTiposProcedimento(): array {
        $query = "SELECT * 
              FROM tipo_procedimento";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = TipoProcedimento::fromArray($row);
        }
        return $result;
    }

    public function selectById(int $id) {
        $query = "SELECT c.*, 
              t.descricao as tipo_contato_descricao
              FROM contato c LEFT JOIN tipo_contato t ON c.tipo_contato_id = t.id
              where c.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = Contato::fromArray($stmt->fetch(PDO::FETCH_ASSOC)) ;
        return $result;
    }
}