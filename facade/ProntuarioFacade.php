<?php
require_once __DIR__ . '/../models/ProntuarioModel.php';

class ProntuarioFacade {
    private $prontuarioModel;

    public function __construct() {
        $this->prontuarioModel = new ProntuarioModel();
    }

    public function createProntuario(array $data): bool {
        if (empty($data['animal_id']) || empty($data['usuario_id'])) {
            throw new Exception("Campos animal_id e usuario_id são obrigatórios.");
        }

        $prontuario = ProntuarioDetalhadoDTO::fromArray($data);

        return $this->prontuarioModel->createProntuario($prontuario);
    }

    public function getProntuario(): array {
        return $this->prontuarioModel->getAllProntuarios();
    }

    public function validateAndDeleteProntuario($id){
        if (empty($id) || $id <= 0) {
            throw new InvalidArgumentException("O ID do prontuario é obrigatório e deve ser um valor válido para a exclusão.");
        }
        if(!$this->prontuarioModel->checkId($id)) {
            throw new InvalidArgumentException("O Prontuario com este id nao existe.");
        }
        return $this->prontuarioModel->deleteProntuario($id);
    }

    public function updateProntuario($data, $id){
        $prontuario = ProntuarioDetalhadoDTO::fromArray($data);
        if (empty($id) || $id <= 0) {
            throw new InvalidArgumentException("O ID do prontuario é obrigatório e deve ser um valor válido para a atualizacao.");
        }
        if(!$this->prontuarioModel->checkId($id)) {
            throw new InvalidArgumentException("O prontuario com este id nao existe.");
        }
        return $this->prontuarioModel->updateProntuario($prontuario, $id);
    }
}