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

    public function detelePrescricao(int $id){
        return $this->prescricaoDAO->delete($id);
    }


    public function updatePrescricao(int $ID, $prescricao){
        return $this->prescricaoDAO->update($ID, $prescricao);
    }


    public function getAllPrescricoes(){
        return $this->prescricaoDAO->getAllPrescricoes();
    }
}



?>