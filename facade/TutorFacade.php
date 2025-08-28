<?php
require_once __DIR__ . '/../models/TutorModel.php';

class TutorFacade {
    private $tutorModel;

    public function __construct() {
        $this->tutorModel = new TutorModel();
    }

    public function createTutor(array $data): bool {
        $tutor = TutorDTO::fromArray($data);
        return $this->tutorModel->create($tutor);
    }

    public function getAll(): array {
        return $this->tutorModel->getAll();
    }

    public function getById(int $id){
        if(empty($this->tutorModel->checkId($id))){
            throw new Exception('Nenhum tutor com esse id foi encontrado');
        }
        return $this->tutorModel->getById($id);
    }

    public function update($id, array $data): bool {
        !$id ? (throw new InvalidArgumentException("O id do tutor é obrigatório para a atualização.")) : null;
        $tutor = TutorDTO::fromArray($data);
        return $this->tutorModel->update($id, $tutor);
    }

    public function delete($id): bool {

        empty($id) ? (throw new InvalidArgumentException("O id do tutor é obrigatório para a exclusao.")) : null;
        if(!$this->tutorModel->checkId($id)){
            throw new Exception("Nenhum tutor com esse id foi encontrado.");
        }
        return $this->tutorModel->delete($id);
    }
}