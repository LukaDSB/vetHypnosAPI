<?php
require_once __DIR__ . '/../dao/MedicamentoDAO.php';

class MedicamentoModel {
    private $medicamentoDAO;

    public function __construct() {
        $this->medicamentoDAO = new MedicamentoDAO();
    }

    public function createMedicamento  ( $medicamento): bool {
        return $this->medicamentoDAO->insert($medicamento);
    }

    public function deleteMedicamento(int $id): bool {
        return $this->medicamentoDAO->delete($id);
    }
    
    public function getAllMedicamentos(): array {
        return $this->medicamentoDAO->getAllMedicamentos();
    }

    public function findById(int $id): ?array {
        return $this->medicamentoDAO->findById($id);
    }

    public function updateMedicamento(int $id, $medicamento): bool {
        return $this->medicamentoDAO->update($id, $medicamento);
    }
    
}


?>
