<?php
namespace App\Controllers;

use App\Facade\ClinicaFacade;

class ClinicaController{
    
    private $clinicaFacade;
    public function __construct(){
        $this->clinicaFacade = new ClinicaFacade();
    }

    public function createClinica($data){
        try{
            $this->clinicaFacade->createClinica($data);
            http_response_code(201);
            echo json_encode(["message" => "Clínica criado(a) com sucesso!"]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getAllClinicas(){
       try {
            $clinicas = $this->clinicaFacade->getAllClinicas();
            $response = array_map(fn($clinica) => $clinica->toArray(), $clinicas);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getClinica($id){
        try{
            $clinica = $this->clinicaFacade->getClinica($id);
            $response = $clinica->toArray();
            http_response_code(200);
            echo json_encode($response);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message"=> $e->getMessage()]);
        }
    }

    public function updateClinica($id, $data){
        try{
            $this->clinicaFacade->updateClinica($id, $data);
            http_response_code(201);
            echo json_encode(["message" => "Clinica atualizado(a) com sucesso."]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function deleteClinica($id){
        try{
            $this->clinicaFacade->deleteClinica($id);
            http_response_code(200);
            echo json_encode(["message"=> "Clinica deletado(a) com sucesso"]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message"=> $e->getMessage()]);
        }
    }

}