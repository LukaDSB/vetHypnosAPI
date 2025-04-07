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
        if (empty($id) || $id <= 0) {
            throw new InvalidArgumentException("O ID da prescricao é obrigatório e deve ser um valor válido para a exclusão.");
        }
        if($this->prescricaoModel->checkId($id)) {
            return $this->prescricaoModel->deletePrescricao($id);
    }
    return throw new InvalidArgumentException("A prescricao com este id nao existe.");
    }

    public function validateAndUpdatePrescricao($data){

        $prescricao = Prescricao::fromArray($data);
        $id = $prescricao->getId();
        if (empty($id) || $id <= 0) {
            throw new InvalidArgumentException("O ID da prescricao é obrigatório e deve ser um valor válido para a atualizacao.");
        }
        if($this->prescricaoModel->checkId($id)) {
            return $this->prescricaoModel->updatePrescricao($prescricao);
    }
    return throw new InvalidArgumentException("A prescricao com este id nao existe.");
    }
}
?>
