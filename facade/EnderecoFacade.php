<?php

require_once __DIR__ ."/../models/EnderecoModel.php";

class EnderecoFacade{
    private $enderecoModel;

    public function __construct(){
        $this->enderecoModel = new EnderecoModel();
    }

    public function createEndereco($data){
        $endereco = EnderecoDTO::fromArray($data);
        try{
            return $this->enderecoModel->createEndereco($endereco);
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function getAllEnderecos(){
        return $this->enderecoModel->getAllEndereco();
    }

    public function getEnedereco($id){
        if(empty($id)){
            throw new \Exception("Id invalido ou necessario");
        }
        try{
            return $this->enderecoModel->getEndereco($id);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function updateEndereco($id, $data){
        $endereco = EnderecoDTO::fromArray($data);
        if(empty($id)){
            throw new \Exception("Id invalido ou necessario para atualização");
        }
        try{
            return $this->enderecoModel->updateEndereco($id, $endereco);
        }
        catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteEndereco($id){
        if(empty($id)){
            throw new \Exception("Id invalido ou necessario");
        }
        try{
            return $this->enderecoModel->deleteEndereco($id);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

}