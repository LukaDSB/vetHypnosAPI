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
//novo    
public function validateAndDeleteMedicamento(array $data): bool {
    if (empty($data['ID'])) {
        throw new InvalidArgumentException("O ID do medicamento é obrigatório para a exclusão.");
    }
 
    $id = (int) $data['ID'];

    // Se necessário, verifique se o ID existe antes de deletar
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
