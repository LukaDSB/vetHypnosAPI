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
    

    public function getAllAnimais($filtros): array {
    $query = "SELECT a.*, 
                     e.id AS especie_id_join,
                     e.especie AS especie_nome
              FROM animal a
              LEFT JOIN especie e ON a.especie_id = e.id
              WHERE 1=1";

    $params = [];

    if (!empty($filtros['nome'])) {
        $query .= " AND a.nome LIKE ?";
        $params[] = '%' . $filtros['nome'] . '%';
    }

    // if (!empty($filtros['tutor_id'])) {
    //     $query .= " AND a.tutor_id = ?";
    //     $params[] = $filtros['tutor_id'];
    // }

    try {
        $stmt = $this->conn->prepare($query);

        // 3. CORREÇÃO: Passamos o array $params para o método execute().
        // O PDO vai substituir de forma segura cada '?' na query pelo
        // valor correspondente no array $params.
        $stmt->execute($params);

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Animal::fromArray($row);
        }

        return $result;

    } catch (PDOException $e) {
        // É uma boa prática capturar exceções do PDO para depuração
        // ou para retornar uma mensagem de erro controlada.
        // Em um ambiente de produção, você poderia logar o erro: error_log($e->getMessage());
        // E retornar um array vazio ou uma mensagem de erro.
        http_response_code(500);
        // die("Erro ao executar a query: " . $e->getMessage()); // Para depuração
        return []; // Retorna vazio em caso de falha
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
        $query = "DELETE FROM animal WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}