<?php

require_once __DIR__ ."/../dao/EspecieDAO.php";

class EspecieModel{
    private $especieDAO;
    public function __construct(){
        $this->especieDAO = new EspecieDAO();
    }

    public function createEspecie(EspecieDTO $especie){
        return $this->especieDAO->createEspecie($especie);
    }

    public function getAllEspecies(){
        return $this->especieDAO->getAllEspecies();
    }

    public function getEspecie(int $id){
        return $this->especieDAO->getEspecie($id);
    }


    public function updateEspecie(int $id, EspecieDTO $especie){
        return $this->especieDAO->updateEspecie($id, $especie);
    }

    public function deleteEspecie(int $id){
        return $this->especieDAO->deleteEspecie($id);
    }

}