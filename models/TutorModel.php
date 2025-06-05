<?php

require_once __DIR__ . '/../dao/TutorDAO.php';

class TutorModel{
    private $tutorDAO;
    public function __construct(){
        $this->tutorDAO = new TutorDAO();
    }

    public function create ( $tutor ): bool {
        return $this->tutorDAO->insert($tutor);
    }

    public function getById(int $id) {
        return $this->tutorDAO->selectById($id);
    }

    public function getAll(): array {
        return $this->tutorDAO->getAll();
    }

    public function update( $tutor ) {
        return $this->tutorDAO->update($tutor);
    }
    public function checkId(int $id){
        return $this->tutorDAO->checkId($id);
    }
    public function delete(int $id){
        return $this->tutorDAO->delete($id);
    }



}