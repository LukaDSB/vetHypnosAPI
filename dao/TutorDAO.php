<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../dto/TutorDTO.php';


class TutorDAO{
    private $conn;

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    
    
    public function insert(Tutor $tutor): bool {
        $query = "INSERT INTO tutor (
        nome,
        cpf,
        endereco_id,
        contato_id
        ) VALUES (
        :nome,
        :cpf,
        :endereco_id,
        :contato_id
        )";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $tutor->getNome());
        $stmt->bindParam(':cpf', $tutor->getCpf());
        $stmt->bindParam(':endereco_id', $tutor->getEnderecoId());
        $stmt->bindParam(':contato_id', $tutor->getContatoId());
        return $stmt->execute();
    }
    
    
    public function getAll(): array {
        $query = 
        "
            SELECT 
            t.id AS tutor_id,
            t.nome AS tutor_nome,
            t.cpf AS tutor_cpf,
            
            e.id AS endereco_id,
            e.cidade_id AS endereco_cidade_id,
            e.rua AS endereco_rua,
            e.numero AS endereco_numero,
            e.bairro AS endereco_bairro,
            
            ci.id AS cidade_id,
            ci.nome AS cidade_nome,
            ci.estado_id AS cidade_estado_id,
            
            es.id AS estado_id,
            es.nome AS estado_nome,
            
            c.id AS contato_id,
            c.descricao AS contato_descricao,
            c.tipo_contato_id,
            
            ti.descricao as tipo_contato_descricao
            FROM tutor t
            LEFT JOIN endereco e ON e.id = t.endereco_id
            LEFT JOIN cidade ci ON ci.id = e.cidade_id
            LEFT JOIN estado es ON es.id = ci.estado_id
            LEFT JOIN contato c ON c.id = t.contato_id
            LEFT JOIN tipo_contato ti on ti.id = c.tipo_contato_id;
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = TutorDTO::fromArray($row);
        }
        return $result;
    }

    public function selectById(int $id) {
        $query = "SELECT 
        t.id AS tutor_id,
        t.nome AS tutor_nome,
        t.cpf AS tutor_cpf,
        e.id AS endereco_id,
        c.id AS contato_id
        FROM tutor t
        LEFT JOIN endereco e ON e.id = t.endereco_id
        LEFT JOIN contato c ON c.id = t.contato_id
        where t.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $result = TutorDTO::fromArray($result);
        return $result;
    }

    public function update(Tutor $tutor): bool {
        $query = "UPDATE tutor SET 
                    nome = :nome,
                    cpf = :cpf,
                    endereco_id = :endereco_id,
                    contato_id = :contato_id
                WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $tutor->getNome());
        $stmt->bindParam(':cpf', $tutor->getCpf());
        $stmt->bindParam(':endereco_id', $tutor->getEnderecoId());
        $stmt->bindParam(':contato_id', $tutor->getContatoId());
        $stmt->bindParam(':id', $tutor->getId());
        return $stmt->execute();
    }
    public function checkId(int $id){
        $query = "
        SELECT 1 FROM tutor WHERE id = :id
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$result){
            return null;
        }
        return $result;
    }
    
    public function delete(int $id): bool {
        $query = "DELETE FROM tutor WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
}