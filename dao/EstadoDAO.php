<?php

require_once __DIR__ ."/../config/database.php";
require_once __DIR__ ."/../dto/EstadoDTO.php";


class EstadoDAO{

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createEstado(EstadoDTO $estado){
        $sql = "insert into estado(nome) values (:nome)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nome", $estado->getNome());
         return $stmt->execute();
    }

    public function getAllEstados(){
        $sql = "
        select id as estado_id,
        nome as estado_nome
        from estado
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = EstadoDTO::fromArray($row);
        }
        return $result;
    }

    public function getEstado(int $id){
        $sql = "
        select id as estado_id,
        nome as estado_nome
        from estado
        where id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(empty($row)){
            throw new Exception("Nenhum estado com esse id foi encontrado");
        }
        $result = EstadoDTO::fromArray($row);
        
        return $result;
    }

    public function updateEstado(int $id, EstadoDTO $estado){
        $sql = "
        update estado set
        nome = :nome
        where id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nome", $estado->getNome());
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            throw new Exception("Nenhum estado com esse id foi encontrado");
        }
    }

    public function deleteEstado(int $id){
        $sql = "
        delete from estado
        where id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            throw new Exception("Nenhum estado com esse id foi encontrado");
        }
    }




}