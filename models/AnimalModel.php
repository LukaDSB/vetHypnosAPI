<?php
namespace App\Models;

use App\DAO\AnimalDAO;

class AnimalModel {
    private $animalDAO;

    public function __construct() {
        $this->animalDAO = new AnimalDAO();
    }

    public function createAnimal ( $animal ): bool {
        return $this->animalDAO->insert($animal);
    }

    public function getAllAnimais($filtros): array {
        return $this->animalDAO->getAllanimais($filtros);
    }

    public function atualizarAnimal( $animal ) {
        return $this->animalDAO->atualizarAnimal($animal);
    }

    public function delete($id): bool {
        return $this->animalDAO->delete($id);
    }
}