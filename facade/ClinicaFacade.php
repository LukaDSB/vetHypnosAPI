<?php

require_once __DIR__ ."/../models/ClinicaModel.php";

class ClinicaFacade{
    private $clinicaModel;

    public function __construct(){
        $this->clinicaModel = new ClinicaModel();
    }

    public function createClinica($data){
        $clinica = ClinicaDTO::fromArray($data);
        try{
            return $this->clinicaModel->createClinica($clinica);
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function getAllClinicas(){
        return $this->clinicaModel->getAllClinicas();
    }

    public function getClinica($id){
        if(empty($id)){
            throw new \Exception("Id invalido ou necessario");
        }
        try{
            return $this->clinicaModel->getClinica($id);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function updateClinica($id, $data){
        $clinica = ClinicaDTO::fromArray($data);
        if(empty($id)){
            throw new \Exception("Id invalido ou necessario para atualização");
        }
        try{
            return $this->clinicaModel->updateClinica($id, $clinica);
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteClinica($id){
        if(empty($id)){
            throw new \Exception("Id invalido ou necessario");
        }
        try{
            return $this->clinicaModel->deleteClinica($id);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

}