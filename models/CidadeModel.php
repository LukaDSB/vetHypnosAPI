<?php
namespace App\Models;

use App\DAO\CidadeDAO;

class CidadeModel{
    private $cidadeDAO;
    public function __construct(){
        $this->cidadeDAO = new CidadeDAO();
    }

    public function createCidade(CidadeDTO $cidade){
        return $this->cidadeDAO->createCidade($cidade);
    }

    public function getAllCidades(){
        return $this->cidadeDAO->getAllCidades();
    }

    public function getCidade(int $id){
        return $this->cidadeDAO->getCidade($id);
    }


    public function updateCidade(int $id, cidadeDTO $cidade){
        return $this->cidadeDAO->updateCidade($id, $cidade);
    }

    public function deleteCidade(int $id){
        return $this->cidadeDAO->deleteCidade($id);
    }

}