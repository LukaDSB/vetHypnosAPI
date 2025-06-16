<?php

require_once __DIR__ ."/../dao/EnderecoDAO.php";

class EnderecoModel{
    private $enderecoDAO;
    public function __construct(){
        $this->enderecoDAO = new EnderecoDAO();
    }

    public function createEndereco(EnderecoDTO $endereco){
        return $this->enderecoDAO->createEndereco($endereco);
    }

    public function getAllEndereco(){
        return $this->enderecoDAO->getAllEnderecos();
    }

    public function getEndereco(int $id){
        return $this->enderecoDAO->getEndereco($id);
    }


    public function updateEndereco(int $id, EnderecoDTO $endereco){
        return $this->enderecoDAO->updateEndereco($id, $endereco);
    }

    public function deleteEndereco(int $id){
        return $this->enderecoDAO->deleteEndereco($id);
    }

}