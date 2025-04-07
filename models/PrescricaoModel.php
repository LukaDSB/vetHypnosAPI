<?php

require_once __DIR__ . '/../dao/PrescricaoDAO.php';

class PrescricaoModel{

    private $prescricaoDAO;
    public function __construct(){
        $this->prescricaoDAO = new PrescricaoDAO();
    }

    public function createPrescricao($prescricao){
        return $this->prescricaoDAO->insert($prescricao);
    }

    public function deletePrescricao(int $id){
        return $this->prescricaoDAO->delete($id);
    }


    public function updatePrescricao($prescricao){
        return $this->prescricaoDAO->update($prescricao);
    }


    public function getAllPrescricoes(){
        return $this->prescricaoDAO->getAllPrescricoes();
    }

    
    public function checkId(int $id) {
        return $this->prescricaoDAO->checkId($id);
    }
}



?>