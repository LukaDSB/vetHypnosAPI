<?php

require_once __DIR__ ."/../models/EspecieModel.php";

class EspecieFacade{
    private $especieModel;

    public function __construct(){
        $this->especieModel = new EspecieModel();
    }

    public function createEspecie($data){
        $especie = EspecieDTO::fromArray($data);
        try{
            return $this->especieModel->createEspecie($especie);
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function getAllEspecies(){
        return $this->especieModel->getAllEspecies();
    }

    public function getEspecie(int $id){
        try{
            return $this->especieModel->getEspecie($id);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function updateEspecie(int $id, $data){
        $especie = EspecieDTO::fromArray($data);
        try{
            return $this->especieModel->updateEspecie($id, $especie);
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteEspecie(int $id){
        try{
            return $this->especieModel->deleteEspecie($id);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

}