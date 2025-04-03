<?php
require_once __DIR__ . '/../models/PrescricaoModel.php';

class PrescricaoFacade {
    private $prescricaoModel;

    public function __construct() {
        $this->prescricaoModel = new PrescricaoModel();
    }

    public function validateAndCreatePrescricao(array $data): bool {
        if (empty($data['paciente_id']) || empty($data['usuario_id'])) {
            throw new Exception("Campos paciente_id e usuario_id são obrigatórios.");
        }

        $prescricao = Prescricao::fromArray($data);

        return $this->prescricaoModel->createPrescricao($prescricao);
    }

    public function getPrescricao(): array {
        return $this->prescricaoModel->getAllPrescricoes();
    }


    public function validateAndDeletePrescricao($id){
        return $this->prescricaoModel->deletePrescricao($id);
    }
}
?>
