<?php

require_once __DIR__ ."/../models/EstadoModel.php";

class EstadoFacade{
    private $estadoModel;

    public function __construct(){
        $this->estadoModel = new EstadoModel();
    }

    public function createEstado($data){
        $estado = EstadoDTO::fromArray($data);
        try{
            return $this->estadoModel->createEstado($estado);
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function getAllEstados(){
        return $this->estadoModel->getAllEstados();
    }

    public function getEstado($id){
        if(empty($id)){
            throw new \Exception("Id invalido ou necessario");
        }
        try{
            return $this->estadoModel->getEstado($id);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function updateEstado($id, $data){
        $estado = EstadoDTO::fromArray($data);
        if(empty($id)){
            throw new \Exception("Id invalido ou necessario para atualização");
        }
        try{
            return $this->estadoModel->updateEstado($id, $estado);
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteEstado($id){
        if(empty($id)){
            throw new \Exception("Id invalido ou necessario");
        }
        try{
            return $this->estadoModel->deleteEstado($id);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

}