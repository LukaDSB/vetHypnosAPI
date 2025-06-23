<?php

require_once __DIR__ ."/../config/Database.php";
require_once __DIR__ ."/../dto/ClinicaDTO.php";


class ClinicaDAO{

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createClinica(ClinicaDTO $clinica){
        $sql = "
        insert into clinica(
        nome, 
        endereco_id, 
        contato_id
        ) values (
        :nome, 
        :endereco_id, 
        :contato_id, 
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nome", $clinica->getNome());
        $stmt->bindParam(":endereco_id",$clinica->getEnderecoId()) ;
        $stmt->bindParam(":contato_id",$clinica->getContatoId());
        return $stmt->execute();
    }

    public function getAllClinicas(){
        $sql = "
        select
		cli.id as clinica_id,
		cli.nome as clinica_nome,
        cli.endereco_id,
        cli.contato_id,
        co.descricao as contato_descricao,
        co.tipo_contato_id,
        ti.descricao as tipo_contato_descricao,
        e.rua as endereco_rua,
        e.numero as endereco_numero,
        e.bairro as endereco_bairro,
        e.cidade_id,
        c.nome as cidade_nome,
        c.estado_id,
        es.nome as estado_nome
        from clinica cli
        join
        contato co on co.id = cli.contato_id
        join
        tipo_contato ti on ti.id = co.tipo_contato_id
		join
        endereco e on e.id = cli.endereco_id
        join
        cidade c on c.id = e.cidade_id
        join
        estado es on es.id = c.estado_id
        ;
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = ClinicaDTO::fromArray($row);
        }
        return $result;
    }

    public function getClinica(int $id){
        $sql = "
        select
		cli.id as clinica_id,
		cli.nome as clinica_nome,
        cli.endereco_id,
        cli.contato_id,
        co.descricao as contato_descricao,
        co.tipo_contato_id,
        ti.descricao as tipo_contato_descricao,
        e.rua as endereco_rua,
        e.numero as endereco_numero,
        e.bairro as endereco_bairro,
        e.cidade_id,
        c.nome as cidade_nome,
        c.estado_id,
        es.nome as estado_nome
        from clinica cli
        join
        contato co on co.id = cli.contato_id
        join
        tipo_contato ti on ti.id = co.tipo_contato_id
		join
        endereco e on e.id = cli.endereco_id
        join
        cidade c on c.id = e.cidade_id
        join
        estado es on es.id = c.estado_id
        where cli.id = :id
        ;
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(empty($row)){
            throw new Exception("Nenhuma clinica com esse id foi encontrado(a)");
        }
        $result = ClinicaDTO::fromArray($row);
        
        return $result;
    }

    public function updateClinica(int $id, ClinicaDTO $clinica){
        $sql = "
        update clinica set
        nome = :nome,
        endereco_id = :endereco_id,
        contato_id = :contato_id,
        where id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nome", $clinica->getNome());
        $stmt->bindParam(":endereco_id", $clinica->getEnderecoId());
        $stmt->bindParam(":contato_id", $clinica->getContatoId());
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            throw new Exception("Nenhuma clinica com esse id foi encontrado(a)");
        }
    }

    public function deleteClinica(int $id){
        $sql = "
        delete from clinica
        where id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            throw new Exception("Nenhuma clinica com esse id foi encontrado(a)");
        }
    }




}