<?php
namespace App\Models;

use App\DAO\CategoriaMedicamentoDAO;

class CategoriaMedicamentoModel{

    private $categoriaMedicamentoDAO;
    public function __construct(){
        $this->categoriaMedicamentoDAO = new CategoriaMedicamentoDAO();
    }

    public function createCategoriaMedicamento($categoria_medicamento){
        return $this->categoriaMedicamentoDAO->insert($categoria_medicamento);
    }

    public function deleteCategoriaMedicamento(int $id){
        return $this->categoriaMedicamentoDAO->delete($id);
    }


    public function updateCategoriaMedicamento(int $ID, $categoria_medicamento){
        return $this->categoriaMedicamentoDAO->update($ID, $categoria_medicamento);
    }

    public function getAllCategorias(){
        return $this->categoriaMedicamentoDAO->getAllCategorias();
    }

    public function checkId($id){
        return $this->categoriaMedicamentoDAO->checkId($id);
    }
}