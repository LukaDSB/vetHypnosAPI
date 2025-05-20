<?php

require_once __DIR__ . '/../dao/Categoria_MedicamentoDAO.php';

class Categoria_MedicamentoModel{

    private $categoria_medicamentoDAO;
    public function __construct(){
        $this->categoria_medicamentoDAO = new Categoria_MedicamentoDAO();
    }

    public function createCategoria_Medicamento($categoria_medicamento){
        return $this->categoria_medicamentoDAO->insert($categoria_medicamento);
    }

    public function deleteCategoria_Medicamento(int $id){
        return $this->categoria_medicamentoDAO->delete($id);
    }


    public function updateCategoria_Medicamento(int $ID, $categoria_medicamento){
        return $this->categoria_medicamentoDAO->update($ID, $categoria_medicamento);
    }

    public function getAllCategorias(){
        return $this->categoria_medicamentoDAO->getAllCategorias();
    }

    public function checkId($id){
        return $this->categoria_medicamentoDAO->checkId($id);
    }
}