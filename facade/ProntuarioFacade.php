<?php
require_once __DIR__ . '/../models/ProntuarioModel.php';

class ProntuarioFacade {
    private $prontuarioModel;

    public function __construct() {
        $this->prontuarioModel = new ProntuarioModel();
    }

    public function validateAndCreateProntuario(array $data): bool {
        if (empty($data['paciente_id']) || empty($data['usuario_id'])) {
            throw new Exception("Campos paciente_id e usuario_id são obrigatórios.");
        }

        $prontuario = Prontuario::fromArray($data);

        return $this->prontuarioModel->createProntuario($prontuario);
    }

    public function getProntuario(): array {
        return $this->prontuarioModel->getAllProntuarios();
    }


    public function validateAndDeleteProntuario($id){
        if (empty($id) || $id <= 0) {
            throw new InvalidArgumentException("O ID da prontuario é obrigatório e deve ser um valor válido para a exclusão.");
        }
        if($this->prontuarioModel->checkId($id)) {
            return $this->prontuarioModel->deleteProntuario($id);
    }
    return throw new InvalidArgumentException("A prontuario com este id nao existe.");
    }

    public function validateAndUpdateProntuario($data){

        $prontuario = Prontuario::fromArray($data);
        $id = $prontuario->getId();
        if (empty($id) || $id <= 0) {
            throw new InvalidArgumentException("O ID da prontuario é obrigatório e deve ser um valor válido para a atualizacao.");
        }
        if($this->prontuarioModel->checkId($id)) {
            return $this->prontuarioModel->updateProntuario($prontuario);
    }
    return throw new InvalidArgumentException("A prontuario com este id nao existe.");
    }
}
?>
