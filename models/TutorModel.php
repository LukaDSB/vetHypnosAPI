<?php

require_once __DIR__ . '/../dao/TutorDAO.php';

class TutorModel{
    private $tutorDAO;
    public function __construct(){
        $this->tutorDAO = new TutorDAO();
    }

    public function create ( $animal ): bool {
        return $this->animalDAO->insert($animal);
    }

    public function getById(int $id) {
        return $this->tutorDAO->selectById($id);
    }

    public function getAll(): array {
        return $this->tutorDAO->getAll();
    }

    public function update( $animal ) {
        return $this->tutorDAO->atualizarAnimal($animal);
    }
    public function delete($id){
        return $this->tutorDAO->delete($id);
    }



}