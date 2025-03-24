<?php

require_once __DIR__ . '/../dao/ContatoDAO.php';

class ContatoModel{

    private $contatoDAO;
    public function __construct(){
        $this->contatoDAO = new ContatoDAO();
    }

    public function createContato($contato){
        return $this->contatoDAO->insert($contato);
    }

    public function deleteContato(int $id){
        return $this->contatoDAO->delete($id);
    }


    public function updateContato(int $id, $contato){
        return $this->contatoDAO->update($id, $contato);
    }


    public function getAllContatos(){
        return $this->contatoDAO->getAllContatos();
    }
}



?>