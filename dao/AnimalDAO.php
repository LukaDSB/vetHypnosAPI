<?php
require_once __DIR__ . '/../dto/Animal.php';
require_once __DIR__ . '/../config/Database.php';

class AnimalDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function insert(Animal $animal): bool {
        $query = "INSERT INTO animal (nome, especie_id, data_nascimento, sexo, peso, tutor_id, obito) VALUES (:nome, :especie_id, :data_nascimento, :sexo, :peso, :tutor_id, :obito)";
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
    

    public function getAllAnimais(): array {
        $query = "SELECT a.*, 
                     e.id AS especie_id,
                     e.especie AS especie_especie
              FROM animal a
              LEFT JOIN especie e ON a.especie_id = e.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Animal::fromArray($row);
        }

        return $result;
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
        $query = "DELETE FROM animal WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}