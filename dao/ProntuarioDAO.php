<?php
require_once __DIR__ . '/../dto/Prontuario.php';
require_once __DIR__ . '/../config/Database.php';

class ProntuarioDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function insert(Prontuario $prontuario): bool {
        $query = "INSERT INTO prontuario (paciente_id, usuario_id, data, observacoes) VALUES (:paciente_id, :usuario_id, :data, :observacoes)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":paciente_id", $prontuario->getPaciente_id());
        $stmt->bindParam(":usuario_id", $prontuario->getUsuario_id());
        $stmt->bindParam(":data", $prontuario->getData());
        $stmt->bindParam(":observacoes", $prontuario->getObservacoes());
    
        return $stmt->execute();
    }

    public function update(Prontuario $prontuario): bool {
        $query = "UPDATE prontuario SET paciente_id = :paciente_id, usuario_id = :usuario_id, data = :data, observacoes = :observacoes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":id",$prontuario->getId());
        $stmt->bindParam(":paciente_id", $prontuario->getPaciente_id());
        $stmt->bindParam(":usuario_id", $prontuario->getUsuario_id());
        $stmt->bindParam(":data", $prontuario->getdata());
        $stmt->bindParam(":observacoes", $prontuario->getObservacoes());
    
        return $stmt->execute();
    }


    public function delete(int $id):bool{
        $query = "DELETE from prontuario where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    

    public function getAllPrescricoes(): array {
        $query = "SELECT * FROM prontuario";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Prontuario::fromArray($row);
        }

        return $result;
    }

    public function checkId(int $id): bool {
        $query = "SELECT * FROM prontuario WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? true : false;
    }


   
}
?>
