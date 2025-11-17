<?php
namespace App\DAO;

use App\DTO\Animal;
use App\Config\Database;
use PDO;

class AnimalDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function insert(Animal $animal): bool {
        $query = "INSERT INTO animal (nome, especie_id, data_nascimento, sexo, peso, tutor_id, obito, ativo) VALUES (:nome, :especie_id, :data_nascimento, :sexo, :peso, :tutor_id, :obito, 1)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':nome', $animal->getNome());
        $stmt->bindParam(':especie_id', $animal->getEspecieId());
        $stmt->bindParam('data_nascimento', $animal->getDataNascimento());
        $stmt->bindParam('sexo', $animal->getSexo());
        $stmt->bindParam('peso', $animal->getPeso());
        $stmt->bindParam('tutor_id', $animal->getTutorId());
        $stmt->bindParam('obito', $animal->getObito());
    
        return $stmt->execute();
    }
    

    public function getAllAnimais($filtros): array {
    $query = "SELECT a.*, 
                     e.id AS especie_id,
                     e.especie AS especie_especie
              FROM animal a
              LEFT JOIN especie e ON a.especie_id = e.id
              LEFT join tutor t on a.tutor_id = t.id
              WHERE a.ativo = 1";

    $params = [];

    if (!empty($filtros['nome'])) {
        $query .= " AND a.nome LIKE ?";
        $params[] = '%' . $filtros['nome'] . '%';
    }

    
    if (!empty($filtros['especie'])) {
        $query .= " AND e.especie LIKE ?";
        $params[] = '%' . $filtros['especie'] . '%';
    }

    if (!empty($filtros['tutor'])) {
        $query .= " AND t.nome LIKE ?";
        $params[] = '%' . $filtros['tutor'] . '%';
    }
    
    $query .= " order by a.id desc";
    try {
        $stmt = $this->conn->prepare($query);

        $stmt->execute($params);

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Animal::fromArray($row);
        }

        return $result;

    } catch (PDOException $e) {
        http_response_code(500);
        return [];
        }
    }

    public function atualizarAnimal(Animal $animal){
        $sql = "UPDATE animal SET 
                    nome = :nome,
                    especie_id = :especie_id, 
                    data_nascimento = :data_nascimento, 
                    sexo = :sexo, 
                    peso = :peso, 
                    tutor_id = :tutor_id, 
                    obito = :obito
                WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
 
        $stmt->bindValue(':nome', $animal->getNome());
        $stmt->bindValue(':especie_id', $animal->getEspecieId());
        $stmt->bindValue(':data_nascimento', $animal->getDataNascimento());
        $stmt->bindValue(':sexo', $animal->getSexo());
        $stmt->bindValue(':peso', $animal->getPeso());
        $stmt->bindValue(':tutor_id', $animal->getTutorId());
        $stmt->bindValue(':obito', $animal->getObito());
        $stmt->bindValue(':id', $animal->getId());
        
        return $stmt->execute();
    }

    public function delete(Int $id) : bool{
        $query = "UPDATE animal SET ativo = 0 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}