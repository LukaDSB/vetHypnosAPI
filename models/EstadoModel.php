<?php
namespace App\Models;

use App\DAO\EstadoDAO;

class EstadoModel{
    private $estadoDAO;
    public function __construct(){
        $this->estadoDAO = new EstadoDAO();
    }

    public function createEstado(EstadoDTO $estado){
        return $this->estadoDAO->createEstado($estado);
    }

    public function getAllEstados(){
        return $this->estadoDAO->getAllEstados();
    }

    public function getEstado(int $id){
        return $this->estadoDAO->getEstado($id);
    }


    public function updateEstado(int $id, EstadoDTO $estado){
        return $this->estadoDAO->updateEstado($id, $estado);
    }

    public function deleteEstado(int $id){
        return $this->estadoDAO->deleteEstado($id);
    }

}