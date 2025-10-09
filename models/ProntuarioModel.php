<?php
namespace App\Models;

use App\DAO\ProntuarioDAO;

class ProntuarioModel{

    private $prontuarioDAO;
    public function __construct(){
        $this->prontuarioDAO = new ProntuarioDAO();
    }

    public function createprontuario($prontuario){
        return $this->prontuarioDAO->createCompleto($prontuario);
    }

    public function deleteprontuario(int $id){
        return $this->prontuarioDAO->delete($id);
    }

    public function updateprontuario($id, $prontuario){
        return $this->prontuarioDAO->updateCompleto($id, $prontuario);
    }

    public function getAllProntuarios(){
        return $this->prontuarioDAO->getAllProntuarios();
    }

    public function getProntuarioById(int $id){
        return $this->prontuarioDAO->getProntuarioCompletoById($id);
    }
    
    public function checkId(int $id) {
        return $this->prontuarioDAO->checkId($id);
    }
}