<?php

require_once __DIR__ . '/../dao/ProtocoloDAO.php';

class ProtocoloModel{

    private $protocoloDAO;
    public function __construct(){
        $this->protocoloDAO = new ProtocoloDAO();
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
}



?>