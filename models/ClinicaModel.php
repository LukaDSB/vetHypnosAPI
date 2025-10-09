<?php
namespace App\Models;

use App\DAO\ClinicaDAO;

class ClinicaModel{
    private $clinicaDAO;
    public function __construct(){
        $this->clinicaDAO = new ClinicaDAO();
    }

    public function createClinica(ClinicaDTO $clinica){
        return $this->clinicaDAO->createClinica($clinica);
    }

    public function getAllClinicas(){
        return $this->clinicaDAO->getAllClinicas();
    }

    public function getClinica(int $id){
        return $this->clinicaDAO->getClinica($id);
    }


    public function updateClinica(int $id, ClinicaDTO $clinica){
        return $this->clinicaDAO->updateClinica($id, $clinica);
    }

    public function deleteClinica(int $id){
        return $this->clinicaDAO->deleteClinica($id);
    }

}