<?php
require_once __DIR__ . '/../models/MedicamentoModel.php';
require_once __DIR__ .'/../dto/MedicamentoDTO.php';
class MedicamentoFacade {
    private $medicamentoModel;

    public function __construct() {
        $this->medicamentoModel = new MedicamentoModel();
    }

    public function validateAndCreateMedicamento(array $data): bool {
        $medicamento = MedicamentoDTO::fromArray($data);
        
        return $this->medicamentoModel->createMedicamento($medicamento);
    }


    public function validateAndDeleteMedicamento(int $id): bool {
        if (empty($id) || $id <= 0) {
            throw new InvalidArgumentException("O ID do medicamento é obrigatório e deve ser um valor válido para a exclusão.");
        }
        if($this->medicamentoModel->checkId($id)) {
            return $this->medicamentoModel->deleteMedicamento($id);
    }
    return throw new InvalidArgumentException("O medicamento com este id nao existe.");
    }



    public function getMedicamentos(): array {
        return $this->medicamentoModel->getAllMedicamentos(); 
    }

    public function validateAndUpdateMedicamento(array $data): bool {
        $id = (int) $data['id'];
        if (empty($id)) {
            throw new InvalidArgumentException("O id do medicamento é obrigatório para a atualização.");
        }
        if ($this->medicamentoModel->checkId($id)) {
            $medicamento = Medicamento::fromArray($data);
            return $this->medicamentoModel->updateMedicamento($id, $medicamento);
        }
        else{
            throw new InvalidArgumentException("O medicamento com esse id não existe");
        }

        
    }

    
}
?>
