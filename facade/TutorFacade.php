<?php
require_once __DIR__ . '/../models/TutorModel.php';

class TutorFacade {
    private $tutorModel;

    public function __construct() {
        $this->tutorModel = new TutorModel();
    }

    public function createAnimal(array $data): bool {
        $animal = Animal::fromArray($data);
        return $this->animalModel->createAnimal($animal);
    }

    public function getAll(): array {
        return $this->tutorModel->getAll();
    }

    public function getById(int $id){
        if(empty($this->tutorModel->getById($id))){
            throw new Exception('Nenhum tutor com esse id foi encontrado');
        }
        return $this->tutorModel->getById($id);
    }

    public function atualizarAnimal(array $data): bool {
        empty($data['id']) ? throw new InvalidArgumentException("O id do animal é obrigatório para a atualização.") : null;
        $animal = Animal::fromArray($data);
        return $this->animalModel->atualizarAnimal($animal);
    }

    public function delete(int $id): bool {
        return $this->animalModel->delete($id);
    }
}