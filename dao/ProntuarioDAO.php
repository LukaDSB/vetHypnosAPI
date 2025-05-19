<?php
require_once __DIR__ . '/../dto/ProntuarioDTO.php';
require_once __DIR__ . '/../config/Database.php';

class ProntuarioDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function insert(ProntuarioDTO $prontuario): bool {
        $query = "INSERT INTO prontuario (paciente_id, usuario_id, data_prontuario, observacoes) VALUES (:paciente_id, :usuario_id, :data_prontuario, :observacoes)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":paciente_id", $prontuario->getPaciente_id());
        $stmt->bindParam(":usuario_id", $prontuario->getUsuario_id());
        $stmt->bindParam(":data_prontuario", $prontuario->getDataProntuario());
        $stmt->bindParam(":observacoes", $prontuario->getObservacoes());
    
        return $stmt->execute();
    }

    public function update(ProntuarioDTO $prontuario): bool {
        $query = "UPDATE prontuario SET paciente_id = :paciente_id, usuario_id = :usuario_id, data_prontuario = :data_prontuario, observacoes = :observacoes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":id",$prontuario->getId());
        $stmt->bindParam(":paciente_id", $prontuario->getPaciente_id());
        $stmt->bindParam(":usuario_id", $prontuario->getUsuario_id());
        $stmt->bindParam(":data_prontuario", $prontuario->getDataProntuario());
        $stmt->bindParam(":observacoes", $prontuario->getObservacoes());
    
        return $stmt->execute();
    }


    public function delete(int $id):bool{
        $query = "DELETE from prontuario where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    

    public function getAllProntuarios(): array {
        $query = "SELECT * FROM prontuario";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = ProntuarioDTO::fromArray($row);
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
