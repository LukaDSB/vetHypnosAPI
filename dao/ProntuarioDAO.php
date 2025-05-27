<?php
require_once __DIR__ . '/../dto/ProntuarioDTO.php';
require_once __DIR__ . '/../dto/ProntuarioDetalhadoDTO.php';
require_once __DIR__ . '/../config/Database.php';

class ProntuarioDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllProntuarios(): array {
        $query = "SELECT p.id, u.nome as usuario_nome, u.id as usuario_id, a.nome as animal_nome, a.id as animal_id, p.data_prontuario, p.tipo_procedimento_id, p.status_prontuario, p.observacoes
        FROM prontuario p
        INNER JOIN usuario u ON p.usuario_id = u.id
        INNER JOIN animal a ON p.animal_id = a.id
        ORDER BY p.id ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = ProntuarioDetalhadoDTO::fromArray($row);
        }

        return $result;
    }

    public function createprontuario(ProntuarioDetalhadoDTO $prontuario): bool {
        $query = "INSERT INTO prontuario (animal_id, usuario_id, data_prontuario, observacoes, tipo_procedimento_id, status_prontuario) 
          VALUES (:animal_id, :usuario_id, :data_prontuario, :observacoes, :tipo_procedimento_id, :status_prontuario)";


        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":animal_id", $prontuario->getAnimalId());
        $stmt->bindParam(":usuario_id", $prontuario->getUsuarioId());
        $stmt->bindParam(":data_prontuario", $prontuario->getDataProntuario());
        $stmt->bindParam(":observacoes", $prontuario->getObservacoes());
        $stmt->bindParam(":tipo_procedimento_id", $prontuario->getTipoProcedimentoId());
        $stmt->bindParam(":status_prontuario", $prontuario->getStatusProntuario());
    
        return $stmt->execute();
    }

    public function update(ProntuarioDetalhadoDTO $prontuario, $id): bool {
        $query = "UPDATE prontuario SET animal_id = :animal_id, usuario_id = :usuario_id, data_prontuario = :data_prontuario, observacoes = :observacoes, tipo_procedimento_id = :tipo_procedimento_id, status_prontuario = :status_prontuario WHERE id = :id";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":animal_id", $prontuario->getAnimalId());
        $stmt->bindParam(":usuario_id", $prontuario->getUsuarioId());
        $stmt->bindParam(":data_prontuario", $prontuario->getDataProntuario());
        $stmt->bindParam(":observacoes", $prontuario->getObservacoes());
        $stmt->bindParam(":tipo_procedimento_id", $prontuario->getTipoProcedimentoId());
        $stmt->bindParam(":status_prontuario", $prontuario->getStatusProntuario());
        $stmt->bindParam(":id", $id);
        
        return $stmt->execute();
    }

    public function delete(int $id):bool{
        $query = "DELETE from prontuario where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
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