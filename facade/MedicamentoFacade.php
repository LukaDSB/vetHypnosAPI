<?php
require_once __DIR__ . '/../models/MedicamentoModel.php';

class MedicamentoFacade {
    private $medicamentoModel;

    public function __construct() {
        $this->medicamentoModel = new MedicamentoModel();
    }

    public function validateAndCreateMedicamento(array $data): bool {
        $medicamento = Medicamento::fromArray($data);

        return $this->medicamentoModel->createMedicamento($medicamento);
    }

    public function validateAndDeleteMedicamento(int $id): bool {
        if (empty($id) || $id <= 0) {
            throw new InvalidArgumentException("O ID do medicamento é obrigatório e deve ser um valor válido para a exclusão.");
        }
        return $this->medicamentoModel->deleteMedicamento($id);
    }



    public function getMedicamentos(): array {
        return $this->medicamentoModel->getAllMedicamentos(); 
    }

    public function validateAndUpdateMedicamento(array $data): bool {
        if (empty($data['ID'])) {
            throw new InvalidArgumentException("O ID do medicamento é obrigatório para a atualização.");
        }

        $id = (int) $data['ID'];
        $medicamento = Medicamento::fromArray($data);

        return $this->medicamentoModel->updateMedicamento($id, $medicamento);
    }

    
}
?>
