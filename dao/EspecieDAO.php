<?php

require_once __DIR__ ."/../config/database.php";
require_once __DIR__ ."/../dto/EspecieDTO.php";


class EspecieDAO{

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createEspecie(EspecieDTO $especie){
        $sql = "insert into especie(especie) values (:especie)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":especie", $especie->getEspecie());
         return $stmt->execute();
    }

    public function getAllEspecies(){
        $sql = "
        select id as especie_id,
        especie from especie
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = EspecieDTO::fromArray($row);
        }
        return $result;
    }

    public function getEspecie(int $id){
        $sql = "
        select id as especie_id,
        especie
        from especie
        where id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(empty($row)){
            throw new Exception("Nenhuma especie com esse id foi encontrada");
        }
        $result = EspecieDTO::fromArray($row);
        
        return $result;
    }

    public function updateEspecie(int $id, EspecieDTO $especie){
        $sql = "
        update especie set
        especie = :especie
        where id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":especie", $especie->getEspecie());
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            throw new Exception("Nenhuma especie com esse id foi encontrada");
        }
    }

    public function deleteEspecie(int $id){
        $sql = "
        delete from especie
        where id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            throw new Exception("Nenhuma especie com esse id foi encontrada");
        }
    }




}