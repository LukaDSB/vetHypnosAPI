<?php

require_once __DIR__ ."/../facade/EspecieFacade.php";

class EspecieController{
    
    private $especieFacade;
    public function __construct(){
        $this->especieFacade = new EspecieFacade();
    }

    public function createEspecie($data){
        try{
            $this->especieFacade->createEspecie($data);
            http_response_code(201);
            echo json_encode(["message" => "Especie criada com sucesso."]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getAllEspecies(){
       try {
            $especies = $this->especieFacade->getAllEspecies();
            $response = array_map(fn($especie) => $especie->toArray(), $especies);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getEspecie(int $id){
        try{
            $especie = $this->especieFacade->getEspecie($id);
            $response = $especie->toArray();
            http_response_code(200);
            echo json_encode($response);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message"=> $e->getMessage()]);
        }
    }

    public function updateEspecie(int $id, $data){
        try{
            $this->especieFacade->updateEspecie($id, $data);
            http_response_code(201);
            echo json_encode(["message" => "Especie atualizada com sucesso."]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function deleteEspecie(int $id){
        try{
            $this->especieFacade->deleteEspecie($id);
            http_response_code(200);
            echo json_encode(["message"=> "Especie deletada com sucesso"]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message"=> $e->getMessage()]);
        }
    }

}