<?php
namespace App\Facade;

use App\Models\TutorModel;
use App\DAO\TutorDAO;
use InvalidArgumentException;
use App\DTO\TutorCompletoDTO;

class TutorFacade {
    private $tutorModel;
    private $tutorDAO;

    public function __construct() {
        $this->tutorModel = new TutorModel();
        $this->tutorDAO = new TutorDAO();
    }

    public function createTutor(array $data): bool{
        $tutorDTO = TutorCompletoDTO::fromArray($data);
        return $this->tutorDAO->insert($tutorDTO);
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
        $tutor = TutorCompletDTO::fromArray($data);
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