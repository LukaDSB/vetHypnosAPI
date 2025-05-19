<?php
require_once __DIR__ . '/../dto/Paciente.php';
require_once __DIR__ . '/../config/Database.php';

class PacienteDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function insert(Paciente $paciente): bool {
        $query = "INSERT INTO animal (nome, especie, idade, sexo, peso, tutor_id, obito) VALUES (:nome, :especie, :idade, :sexo, :peso, :tutor_id, :obito)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':nome', $paciente->getNome());
        $stmt->bindParam(':especie', $paciente->getEspecie());
        $stmt->bindParam('idade', $paciente->getIdade());
        $stmt->bindParam('sexo', $paciente->getSexo());
        $stmt->bindParam('peso', $paciente->getPeso());
        $stmt->bindParam('tutor_id', $paciente->getIdTutor());
        $stmt->bindParam('obito', $paciente->getObito());
    
        return $stmt->execute();
    }
    

    public function getAllPacientes(): array {
        $query = "SELECT * FROM animal";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Paciente::fromArray($row);
        }

        return $result;
    }
}
?>
