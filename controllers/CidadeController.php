<?php

require_once __DIR__ ."/../facade/CidadeFacade.php";

class CidadeController{
    
    private $cidadeFacade;
    public function __construct(){
        $this->cidadeFacade = new CidadeFacade();
    }

    public function createCidade($data){
        try{
            $this->cidadeFacade->createCidade($data);
            http_response_code(201);
            echo json_encode(["message" => "Cidade criado(a) com sucesso."]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getAllCidades(){
       try {
            $cidades = $this->cidadeFacade->getAllCidades();
            $response = array_map(fn($cidade) => $cidade->toArray(), $cidades);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getCidade($id){
        try{
            $cidade = $this->cidadeFacade->getCidade($id);
            $response = $cidade->toArray();
            http_response_code(200);
            echo json_encode($response);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message"=> $e->getMessage()]);
        }
    }

    public function updateCidade($id, $data){
        try{
            $this->cidadeFacade->updateCidade($id, $data);
            http_response_code(201);
            echo json_encode(["message" => "Cidade atualizado(a) com sucesso."]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function deleteCidade(int $id){
        try{
            $this->cidadeFacade->deleteCidade($id);
            http_response_code(200);
            echo json_encode(["message"=> "Cidade deletado(a) com sucesso"]);
        }catch(Exception $e){
            http_response_code(400);
            echo json_encode(["message"=> $e->getMessage()]);
        }
    }

}