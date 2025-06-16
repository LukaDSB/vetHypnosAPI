<?php

require_once __DIR__ ."/../config/database.php";
require_once __DIR__ ."/../dto/EnderecoDTO.php";


class EnderecoDAO{

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createEndereco(EnderecoDTO $endereco){
        $sql = "
        insert into endereco(
        rua, 
        numero, 
        bairro, 
        cidade_id
        ) values (
        :rua, 
        :numero, 
        :bairro, 
        :cidade_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":rua", $endereco->getRua());
        $stmt->bindParam(":numero",$endereco->getNumero()) ;
        $stmt->bindParam(":bairro",$endereco->getBairro());
        $stmt->bindParam(":cidade_id",$endereco->getCidade());
        return $stmt->execute();
    }

    public function getAllEnderecos(){
        $sql = "
        select
        e.id as endereco_id,
        e.rua as endereco_rua,
        e.numero as endereco_numero,
        e.bairro as endereco_bairro,
        e.cidade_id,
        c.nome as cidade_nome,
        c.estado_id,
        es.nome as estado_nome
        from endereco e
        join
        cidade c on e.cidade_id = c.id
        join
        estado es on c.estado_id = es.id
        order by e.id;

        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = EnderecoDTO::fromArray($row);
        }
        return $result;
    }

    public function getEndereco(int $id){
        $sql = "
        select
        e.id as endereco_id,
        e.rua as endereco_rua,
        e.numero as endereco_numero,
        e.bairro as endereco_bairro,
        e.cidade_id,
        c.nome as cidade_nome,
        c.estado_id,
        es.nome as estado_nome
        from endereco e
        join
        cidade c on e.cidade_id = c.id
        join
        estado es on c.estado_id = es.id
        where e.id = :id;
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(empty($row)){
            throw new Exception("Nenhum endereco com esse id foi encontrado(a)");
        }
        $result = EnderecoDTO::fromArray($row);
        
        return $result;
    }

    public function updateEndereco(int $id, EnderecoDTO $endereco){
        $sql = "
        update endereco set
        rua = :rua,
        numero = :numero,
        bairro = :bairro,
        cidade_id = :cidade_id
        where id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":rua", $endereco->getRua());
        $stmt->bindParam(":numero", $endereco->getNumero());
        $stmt->bindParam(":bairro", $endereco->getBairro());
        $stmt->bindParam(":cidade_id", $endereco->getCidade());
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            throw new Exception("Nenhum endereco com esse id foi encontrado(a)");
        }
    }

    public function deleteEndereco(int $id){
        $sql = "
        delete from endereco
        where id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            throw new Exception("Nenhum endereco com esse id foi encontrado(a)");
        }
    }




}