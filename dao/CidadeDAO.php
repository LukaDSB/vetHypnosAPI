<?php

require_once __DIR__ ."/../config/Database.php";
require_once __DIR__ ."/../dto/CidadeDTO.php";


class CidadeDAO{

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createCidade(CidadeDTO $cidade){
        $sql = "insert into cidade(nome, estado_id) values (:nome, :estado_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nome", $cidade->getNome());
        $stmt->bindParam(":estado_id",$cidade->getEstado_id()) ;
         return $stmt->execute();
    }

    public function getAllCidades(){
        $sql = "
        select e.id as estado_id,
        e.nome as estado_nome,
        c.id as cidade_id,
        c.nome as cidade_nome
        from estado e
        join
        cidade c on e.id = c.estado_id;
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = CidadeDTO::fromArray($row);
        }
        return $result;
    }

    public function getCidade(int $id){
        $sql = "
        select e.id as estado_id,
        e.nome as estado_nome,
        c.id as cidade_id,
        c.nome as cidade_nome
        from estado e
        left join
        cidade c on e.id = c.estado_id
        where c.id = :id;
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(empty($row)){
            throw new Exception("Nenhuma cidade com esse id foi encontrada");
        }
        $result = CidadeDTO::fromArray($row);
        
        return $result;
    }

    public function updateCidade(int $id, CidadeDTO $cidade){
        $sql = "
        update cidade set
        nome = :nome,
        estado_id = :estado_id
        where id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nome", $cidade->getNome());
        $stmt->bindParam(":estado_id", $cidade->getEstado_id());
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            throw new Exception("Nenhuma cidade com esse id foi encontrada");
        }
    }

    public function deleteCidade(int $id){
        $sql = "
        delete from cidade
        where id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            throw new Exception("Nenhuma cidade com esse id foi encontrada");
        }
    }




}