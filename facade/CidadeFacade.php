<?php
namespace App\Facade;

use App\Models\CidadeModel;

class CidadeFacade{
    private $cidadeModel;

    public function __construct(){
        $this->cidadeModel = new CidadeModel();
    }

    public function createCidade($data){
        $cidade = CidadeDTO::fromArray($data);
        try{
            return $this->cidadeModel->createCidade($cidade);
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function getAllCidades(){
        return $this->cidadeModel->getAllCidades();
    }

    public function getCidade(int $id){
        try{
            return $this->cidadeModel->getcidade($id);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function updateCidade($id, $data){
        $cidade = cidadeDTO::fromArray($data);
        if(empty($id)){
            throw new \Exception("Id invalido ou necessario");
        }
        try{
            return $this->cidadeModel->updateCidade($id, $cidade);
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteCidade(int $id){
        try{
            return $this->cidadeModel->deleteCidade($id);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

}