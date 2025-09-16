<?php
require_once __DIR__ . '/../models/AnimalModel.php';

class AnimalFacade {
    private $animalModel;

    public function __construct() {
        $this->animalModel = new AnimalModel();
    }

    public function createAnimal(array $data): bool {
        $animal = Animal::fromArray($data);
        return $this->animalModel->createAnimal($animal);
    }

    public function getAnimais($filtros): array {
        return $this->animalModel->getAllAnimais($filtros);
    }

    public function atualizarAnimal(array $data): bool {
        empty($data['id']) ? (throw new InvalidArgumentException("O id do animal é obrigatório para a atualização.")) : null;
        $animal = Animal::fromArray($data);
        return $this->animalModel->atualizarAnimal($animal);
    }

    public function delete(int $id): bool {
        return $this->animalModel->delete($id);
    }
}