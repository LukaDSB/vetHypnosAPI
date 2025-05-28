<?php

require_once __DIR__ . '/../dao/EspecialidadeDAO.php';

class EspecialidadeModel{
    private $especialidadeDAO;

    public function __construct(){
        $this->especialidadeDAO = new EspecialidadeDAO();
    }

    public function createEspecialidade($especialidade){
        return $this->especialidadeDAO->insert($especialidade);
    }

    public function deleteEspecialidade($id){
        return $this->especialidadeDAO->delete($id);
    }

    public function checkId(int $id){
        return $this->especialidadeDAO->checkId($id);
    }

    public function updateEspecialidade($especialidade, $id){
        return $this->especialidadeDAO->update($especialidade, $id);
    }

    public function getAllEspecialidades(){
        return $this->especialidadeDAO->getAllEspecialidades();
    }
}