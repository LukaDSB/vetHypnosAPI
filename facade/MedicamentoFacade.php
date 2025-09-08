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
        if(!$this->medicamentoModel->checkId($id)) {
                throw new InvalidArgumentException("O medicamento com este id nao existe."); 
        }
    return $this->medicamentoModel->deleteMedicamento($id);
    }



    public function getMedicamentos(): array {
        return $this->medicamentoModel->getAllMedicamentos(); 
    }

    public function getMedicamentoByuId(int $id) {
        if(empty($id)){
            throw new Exception("O id do medicamento eh obrigatorio");
        }
        if(!$this->medicamentoModel->checkId($id)){
            throw new Exception("Nenhum medicamento com este id foi encontrado!");        
        }
        return $this->medicamentoModel->getMedicamentoById($id);
    }

    public function validateAndUpdateMedicamento(array $data, int $id, object $dadosUsuario): bool {
        if (empty($id)) {
            throw new InvalidArgumentException("O id do medicamento é obrigatório para a atualização.");
        }
        if (!$this->medicamentoModel->checkId($id)) {
            throw new InvalidArgumentException("O medicamento com esse id não existe");
        }
       $medicamento = MedicamentoDTO::fromArray($data);
        return $this->medicamentoModel->updateMedicamento($id, $medicamento, $dadosUsuario);
        
    }
}