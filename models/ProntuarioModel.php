<?php

require_once __DIR__ . '/../dao/prontuarioDAO.php';

class ProntuarioModel{

    private $prontuarioDAO;
    public function __construct(){
        $this->prontuarioDAO = new ProntuarioDAO();
    }

    public function createprontuario($prontuario){
        return $this->prontuarioDAO->insert($prontuario);
    }

    public function deleteprontuario(int $id){
        return $this->prontuarioDAO->delete($id);
    }

    public function updateprontuario($prontuario){
        return $this->prontuarioDAO->update($prontuario);
    }

    public function getAllProntuarios(){
        return $this->prontuarioDAO->getAllProntuarios();
    }

    
    public function checkId(int $id) {
        return $this->prontuarioDAO->checkId($id);
    }
}