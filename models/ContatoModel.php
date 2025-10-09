<?php
namespace App\Models;

use App\DAO\ContatoDAO;

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

    public function checkId(int $id){
        return $this->contatoDAO->checkId($id);
    }

    public function updateContato($id, $contato){
        return $this->contatoDAO->update($id, $contato);
    }

    public function getAllContatos(){
        return $this->contatoDAO->getAllContatos();
    }
}