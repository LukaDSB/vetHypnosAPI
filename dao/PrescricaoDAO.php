<?php
require_once __DIR__ . '/../dto/Prescricao.php';
require_once __DIR__ . '/../config/Database.php';

class PrescricaoDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function insert(Prescricao $prescricao): bool {
        $query = "INSERT INTO prescricoes (paciente_id, usuario_id, data_precricao, observacoes) VALUES (:paciente_id, :usuario_id, :data_precricao, :observacoes)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":paciente_id", $prescricao->getPaciente_id());
        $stmt->bindParam(":usuario_id", $prescricao->getUsuario_id());
        $stmt->bindParam(":data_prescricao", $prescricao->getData_prescricao());
        $stmt->bindParam(":observacoes", $prescricao->getObservacoes());
    
        return $stmt->execute();
    }

    public function update(int $id, Prescricao $prescricao): bool {
        $query = "UPDATE protocolos SET paciente_id = :paciente_id, usuario_id = :usuario_id, data_prescricao = :data_prescricao, observacoes = :observacoes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":id",$id);
        $stmt->bindParam(":paciente_id", $prescricao->getPaciente_id());
        $stmt->bindParam(":usuario_id", $prescricao->getUsuario_id());
        $stmt->bindParam(":data_prescricao", $prescricao->getData_prescricao());
        $stmt->bindParam(":observacoes", $prescricao->getObservacoes());
    
        return $stmt->execute();
    }


    public function delete(int $id):bool{
        $query = "DELETE from prescricoes where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam("", $id);
        return $stmt->execute();
    }
    

    public function getAllPrescricoes(): array {
        $query = "SELECT * FROM prescricoes";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = Prescricao::fromArray($row);
        }

        return $result;
    }
}
?>
