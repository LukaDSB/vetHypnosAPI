<?php
namespace App\Models;

use App\DAO\TutorDAO;

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

    public function update( $id, $tutor ) {
        return $this->tutorDAO->update($id, $tutor);
    }
    public function checkId(int $id){
        return $this->tutorDAO->checkId($id);
    }
    public function delete(int $id){
        return $this->tutorDAO->delete($id);
    }



}