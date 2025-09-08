<?php
require_once __DIR__ . '/../dao/MedicamentoDAO.php';

class MedicamentoModel {
    private $medicamentoDAO;

    public function __construct() {
        $this->medicamentoDAO = new MedicamentoDAO();
    }

    public function createMedicamento  (MedicamentoDTO $medicamento): bool {
        return $this->medicamentoDAO->insert($medicamento);
    }

    public function deleteMedicamento(int $id): bool {
        return $this->medicamentoDAO->delete($id);
    }
    
    public function getAllMedicamentos(): array {
        return $this->medicamentoDAO->getAllMedicamentos();
    }

    public function getMedicamentoById(int $id){
        return $this->medicamentoDAO->getMedicamentoById($id);
    }

    public function checkId(int $id) {
        return $this->medicamentoDAO->checkId($id);
    }

    public function updateMedicamento(int $id, $medicamento, object $dadosUsuario): bool {
        return $this->medicamentoDAO->update($id, $medicamento, $dadosUsuario);
    }
}