<?php

require_once __DIR__ ."/../facade/EstadoFacade.php";

class EstadoController{
    
    private $estadoFacade;
    public function __construct(){
        $this->estadoFacade = new EstadoFacade();
    }

    public function createEstado($data){
        try{
            $this->estadoFacade->createEstado($data);
            http_response_code(201);
            echo json_encode(["message" => "Estado criado com sucesso."]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getAllEstados(){
       try {
            $estados = $this->estadoFacade->getAllEstados();
            $response = array_map(fn($estado) => $estado->toArray(), $estados);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getEstado($id){
        try{
            $estado = $this->estadoFacade->getEstado($id);
            $response = $estado->toArray();
            http_response_code(200);
            echo json_encode($response);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message"=> $e->getMessage()]);
        }
    }

    public function updateEstado($id, $data){
        try{
            $this->estadoFacade->updateEstado($id, $data);
            http_response_code(201);
            echo json_encode(["message" => "Estado atualizado com sucesso."]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function deleteEstado($id){
        try{
            $this->estadoFacade->deleteEstado($id);
            http_response_code(200);
            echo json_encode(["message"=> "Estado deletado com sucesso"]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message"=> $e->getMessage()]);
        }
    }

}